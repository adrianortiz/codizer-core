<?php
/**
 * User: Codizer
 * Date: 3/3/16
 * Time: 9:53 AM
 */

namespace App\Components;

use App\Categoria;
use App\ContactAddress;
use App\ContactMail;
use App\ContactPhone;
use App\ContactSocial;
use App\Empresa;
use App\Perfil;
use App\Contacto;
use App\ProductoHasCategoria;
use App\Tienda;
use App\User;
use App\UserHasPerfil;
use App\UsuarioEmpleadoInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Core
{
    /**
     * Valida que la ruta del perfil exista
     * en la base de datos
     *
     * @param $nameFirstName
     * @return mixed
     */
    public function isRouteValid($nameFirstName)
    {
        $existeRuta = Perfil::where('perfil_route', $nameFirstName)->count();
        if (!$existeRuta == 1) {
            abort(404);
        }
    }

    /**
     * Valida que la ruta de la tienda exista
     * de lo contrario muestra el error 404
     *
     * @param $tiendaRoute
     */
    public function isTiendaRouteValid($tiendaRoute)
    {
        $existeRuta = Tienda::where('store_route', $tiendaRoute)->count();
        if (!$existeRuta == 1) {
            abort(404);
        }
    }

    /**
     * Getter para obtener el perfil de una cuenta
     *
     * @param $nameFirstName
     * @return mixed
     */
    public function getPerfil($nameFirstName)
    {
        return Perfil::where('perfil_route', $nameFirstName)->get();
    }

    /**
     * Getter para obtener el contacto de un perfil
     *
     * @param $perfil
     * @return mixed
     */
    public function getContact($perfil)
    {
        $userHasPerfil = UserHasPerfil::where('perfil_id', $perfil[0]->id)->first();
        $user = User::findOrFail($userHasPerfil->users_id);
        return Contacto::where('id', $user->contacto_id)->get();
    }

    /**
     * Getter para obtener el perfil de un usuario logueado
     * @return mixed
     */
    public function  getUserPerfil()
    {
        $userHasPerfil = UserHasPerfil::where('users_id', \Auth::user()->id)->first();
        return Perfil::where('id', $userHasPerfil->perfil_id)->get();
    }

    /**
     * Getter para obtener los datos de un usuario logueado
     * @return mixed
     */
    public function getUserContact()
    {
        $user = User::findOrFail(\Auth::user()->id);
        return Contacto::where('id', $user->contacto_id)->get();
    }

    /**
     * Get all users, profiles and contacts
     * Where the name or last-name is
     * equals to $searh
     *
     * @param $searh String
     * @return mixed
     */
    public function searchGlobal($searh) {
        return DB::table('users')
            ->join('contacto', 'users.contacto_id', '=', 'contacto.id')
            ->join('users_has_perfil', 'users.id', '=', 'users_has_perfil.users_id')
            ->join('perfil', 'users_has_perfil.perfil_id', '=', 'perfil.id')
            ->where(DB::raw('concat(nombre, " ", ap_paterno, " ", ap_materno)'), 'LIKE', '%'.$searh.'%')
            ->skip(0)->take(5)
            ->select('contacto.*', 'perfil.perfil_route')
            ->get();
    }

    /**
     * Get all contacts that one user has inserted
     *
     * @return mixed
     */
    public function getContactos($idUser){
        return Contacto::join('users_has_agenda_contactos', 'users_has_agenda_contactos.contacto_id', '=', 'contacto.id')
            ->where('users_id',  $idUser)
            ->select('contacto.*')
            ->get();
    }

    /**
     * Get all information of one specific contact
     * @return mixed
     */
    public function getContactInfo($id){
        return Contacto::where('contacto.id', $id)
            ->select('id', 'foto', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'f_nacimiento', 'profesion', 'estado_civil', 'estado', 'desc_contacto')
            ->get();
    }

    /**
     * Get all address that a contact has
     * @param $id
     */
    public function getContactAddress($id){
        return ContactAddress::join('contacto', 'contacto.id', '=', 'contact_address.contacto_id')
            ->where('contacto_id', $id)
            ->select('contact_address.id', 'desc_dir', 'calle', 'numero_dir', 'piso_edificio', 'ciudad', 'cp', 'estado_dir', 'pais')
            ->get();
    }

    /**
     * Get all phones that a contact has
     * @param $id
     */
    public function getContactPhone($id){
        return ContactPhone::join('contacto', 'contacto.id', '=', 'contact_phone.contacto_id')
            ->where('contacto_id', $id)
            ->select('contact_phone.id', 'desc_tel', 'numero_tel')
            ->get();
    }

    /**
     * Get all emails that a contact has
     * @param $id
     */
    public function getContactMail($id){
        return ContactMail::join('contacto', 'contacto.id', '=', 'contact_mail.contacto_id')
            ->where('contacto_id', $id)
            ->select('contact_mail.id', 'desc_mail', 'email')
            ->get();
    }

    /**
     * Get all social network that a contact has
     * @param $id
     */
    public function getContactSocial($id){
        return ContactSocial::join('contacto', 'contacto.id', '=', 'contact_social.contacto_id')
            ->where('contacto_id', $id)
            ->select('contact_social.id', 'red_social_nombre', 'url')
            ->get();
    }

    /**
     * Get all friends that one user has added
     *
     * @param $contacto
     * @return mixed
     */
    public function getAmigos($userId) {
        return User::join('contacto', 'users.contacto_id', '=', 'contacto.id')
            ->join('users_has_friend_users', 'users.id', '=', 'users_has_friend_users.users_id_friend')
            ->where('users_has_friend_users.users_id', $userId)
            ->select('contacto.*', 'users.email' , 'users.password', 'users.role', 'users.id AS user_id_we')
            ->get();
    }

    /**
     * Get all followers that one user has added
     *
     * @param $contacto
     * @return mixed
     */
    public function getFollowers($contacto){
        return Contacto::join('users', 'users.id', '=', 'contacto.id')
            ->join('users_has_follower_users', 'users_has_follower_users.users_id_followers', '=', 'contacto.id')
            ->where('users_id', '=', $contacto[0]->id)
            ->select('contacto.*', 'users.email' , 'users.password', 'users.role')
            ->get();
    }

    public function hasEmpresa()
    {
        $empresa = Empresa::where('users_id', '=', \Auth::user()->id )-get();

        if ($empresa)
            return $empresa;
        else
            return false;
    }

    public function getOfertas($empresaId)
    {
        return DB::table('oferta')
            ->join('empresa_has_oferta', 'oferta.id', '=', 'empresa_has_oferta.oferta_id')
            ->where('empresa_id', '=', $empresaId)
            ->get();
    }

    public function getFabricantes($empresaId)
    {
        return DB::table('fabricante')
            ->join('empresa_has_fabricante', 'fabricante.id', '=', 'empresa_has_fabricante.fabricante_id')
            ->where('empresa_id', '=', $empresaId)
            ->get();
    }

    public function getCategorias($empresaId)
    {
        return DB::table('categoria')
            ->join('empresa_has_categoria', 'categoria.id', '=', 'empresa_has_categoria.categoria_id')
            ->where('empresa_id', '=', $empresaId)
            ->get();
    }

    public function getCategoriasByIdProduct( $idProduct )
    {
        /*
        return Categoria::join('producto_has_categoria', 'categoria.id', '=', 'producto_has_categoria.categoria_id')
            ->where('producto_has_categoria.producto_id', '=', $idProduct)
            ->get();
        */

        return ProductoHasCategoria::join('categoria', 'producto_has_categoria.categoria_id', '=', 'categoria.id')
            ->where('producto_id', '=', $idProduct)
            ->get();
    }

    /**
     * Validar que la ruta de la tienda sea unica
     * Si es 0 significa que no existe y es valida
     *
     * @param $tiendaRoute
     * @return mixed
     */
    public function existTiendaRoute($tiendaRoute) {
        return Tienda::where('store_route', $tiendaRoute)->count();
    }

    /**
     * Validar que no exista esa configuración de empleado en la BD
     * Si es 0 significa que no existe esa configuración
     *
     * @param Request $request
     * @return integer
     */
    public function existEmployeeConfig(Request $request)
    {
        return $existEmployee = UsuarioEmpleadoInfo::where('empresa_id', $request['empresa_id'])
                ->where('tienda_id', $request['tienda_id'])
                ->where('nivel', $request['nivel'])
                ->where('users_id', $request['users_id'])
                ->where('estado', $request['estado'])
                ->count();
    }

    /**
     * Obtener todos los empleados de una empresa
     * en base al id de la empresa
     *
     * @param $empresaId
     * @return mixed
     */
    public function getAllEmployeesByEmpresaId( $empresaId )
    {
        return DB::table('usuario_empleado_info')
            ->join('empresa', 'usuario_empleado_info.empresa_id', '=', 'empresa.id')
            ->join('tienda', 'usuario_empleado_info.tienda_id', '=', 'tienda.id')
            ->join('users', 'usuario_empleado_info.users_id', '=', 'users.id')
            ->join('contacto', 'users.contacto_id', '=', 'contacto.id')
            ->join('users_has_perfil', 'users.id', '=', 'users_has_perfil.users_id')
            ->join('perfil', 'perfil.id', '=', 'users_has_perfil.perfil_id')
            ->where('usuario_empleado_info.empresa_id', '=', $empresaId)
            ->select('usuario_empleado_info.*', 'usuario_empleado_info.id AS empleado_id', 'usuario_empleado_info.estado AS empleado_estado', 'tienda.nombre AS nombre_tienda', 'tienda.foto AS foto_tienda', 'contacto.*', 'perfil_route', 'store_route')
            ->get();
    }

    /**
     * Obtener un empleado especifico, en base al id del empleado
     *
     * @param $employeeId
     * @return mixed
     */
    public function getEmployeeById( $employeeId )
    {
        return DB::table('usuario_empleado_info')
            ->join('empresa', 'usuario_empleado_info.empresa_id', '=', 'empresa.id')
            ->join('tienda', 'usuario_empleado_info.tienda_id', '=', 'tienda.id')
            ->join('users', 'usuario_empleado_info.users_id', '=', 'users.id')
            ->join('contacto', 'users.contacto_id', '=', 'contacto.id')
            ->join('users_has_perfil', 'users.id', '=', 'users_has_perfil.users_id')
            ->join('perfil', 'perfil.id', '=', 'users_has_perfil.perfil_id')
            ->where('usuario_empleado_info.id', '=', $employeeId)
            ->select('usuario_empleado_info.*', 'usuario_empleado_info.id AS empleado_id', 'usuario_empleado_info.estado AS empleado_estado', 'tienda.nombre AS nombre_tienda', 'tienda.foto AS foto_tienda', 'contacto.*', 'perfil_route', 'store_route')
            ->first();
    }


    /**
     * Obtener los empleos que tiene asignado un empleado
     * en base al id de usuario
     *
     * @param $userId
     * @return mixed
     */
    public function getAllEmpleosDeEmpleadoByUserId( $userId )
    {
        // Extra 'empresa.nombre AS nombre_empresa'
        return DB::table('usuario_empleado_info')
            ->join('empresa', 'usuario_empleado_info.empresa_id', '=', 'empresa.id')
            ->join('tienda', 'usuario_empleado_info.tienda_id', '=', 'tienda.id')
            ->join('users', 'usuario_empleado_info.users_id', '=', 'users.id')
            ->join('contacto', 'users.contacto_id', '=', 'contacto.id')
            ->join('users_has_perfil', 'users.id', '=', 'users_has_perfil.users_id')
            ->join('perfil', 'perfil.id', '=', 'users_has_perfil.perfil_id')
            ->where('usuario_empleado_info.users_id', '=', $userId)
            ->where('usuario_empleado_info.estado', '1')
            ->select('logo', 'empresa.nombre AS nombre_empresa', 'usuario_empleado_info.*', 'usuario_empleado_info.id AS empleado_id', 'usuario_empleado_info.estado AS empleado_estado', 'tienda.nombre AS nombre_tienda', 'tienda.foto AS foto_tienda', 'contacto.*', 'perfil_route', 'store_route')
            ->get();
    }


    /**
     * Obtener Fabricantes de una empresa
     *
     * @param $empresaId
     * @return mixed
     */
    public function getFabricantesByIdEmpresa( $empresaId ) {

        return DB::table('empresa')
            ->join('empresa_has_fabricante', 'empresa.id', '=', 'empresa_has_fabricante.empresa_id')
            ->join('fabricante', 'empresa_has_fabricante.fabricante_id', '=', 'fabricante.id')
            ->where('empresa.id', $empresaId)
            ->lists('fabricante.nombre', 'fabricante.id');
    }


    /**
     * @param $empresaId
     * @return mixed
     */
    public function getOfertasByIdEmpresa( $empresaId ) {

        return DB::table('empresa')
            ->join('empresa_has_oferta', 'empresa.id', '=', 'empresa_has_oferta.empresa_id')
            ->join('oferta', 'empresa_has_oferta.oferta_id', '=', 'oferta.id')
            ->where('empresa.id', $empresaId)
            ->lists(DB::raw('concat(oferta.tipo_oferta, " ", oferta.regla_porciento, "%") AS regla_porciento'), 'oferta.id');




    }

    /**
     * @param $empresaId
     * @return mixed
     */
    public function getCategoriasByIdEmpresa( $empresaId ) {

        return DB::table('empresa')
            ->join('empresa_has_categoria', 'empresa.id', '=', 'empresa_has_categoria.empresa_id')
            ->join('categoria', 'empresa_has_categoria.categoria_id', '=', 'categoria.id')
            ->where('empresa.id', $empresaId)
            ->select('categoria.nombre', 'categoria.id')
            ->get();
    }

    /**
     * Permite obtener los productos de una tienda en base a su store_route
     * Los productos solo pueden ser productos activos o inactivos
     *
     * @param $storeRoute
     * @param $estadoProduct
     * @return mixed
     */
    public function getAllProductosByTiendaRoute( $storeRoute, $estadoProduct ) {

        return DB::table('tienda')
            ->join('tienda_has_producto', 'tienda.id', '=', 'tienda_has_producto.tienda_id')
            ->join('producto', 'producto.id', '=', 'tienda_has_producto.producto_id')
            ->join('oferta', 'producto.oferta_id', '=', 'oferta.id')
            ->join('img_producto', 'producto.id', '=', 'img_producto.producto_id')
            ->where('tienda.store_route', $storeRoute)
            ->where('producto.estado', $estadoProduct)
            ->where('img_producto.principal', '1')
            ->select('producto.*', 'tienda_has_producto.producto_id', 'oferta.*', 'img_producto.*')
            ->get();
    }

    /**
     * Obtener todos los productos de una tienda y listarlos
     * en el administrador de productos. Estos productos
     * pueden o no estar activos para editar
     *
     * @param $idTienda
     * @return mixed
     */
    public function getAllProductosByIdTienda( $idTienda ) {

        return DB::table('tienda')
            ->join('tienda_has_producto', 'tienda.id', '=', 'tienda_has_producto.tienda_id')
            ->join('producto', 'producto.id', '=', 'tienda_has_producto.producto_id')
            ->join('oferta', 'producto.oferta_id', '=', 'oferta.id')
            ->join('img_producto', 'producto.id', '=', 'img_producto.producto_id')
            ->where('tienda.id', $idTienda)
            ->where('img_producto.principal', '1')
            ->select('producto.*', 'tienda_has_producto.producto_id', 'oferta.*', 'img_producto.*')
            ->get();
    }

    /**
     * Obtener un producto en base al id del producto y id de la tienda
     * Solo retorna un producto activo
     * con su imagen activa
     *
     * @param $storeRoute
     * @param $idProduct
     * @return mixed
     */
    public function getProductoById( $idTienda, $idProduct )
    {
        return DB::table('tienda')
            ->join('tienda_has_producto', 'tienda.id', '=', 'tienda_has_producto.tienda_id')
            ->join('producto', 'producto.id', '=', 'tienda_has_producto.producto_id')
            ->join('oferta', 'producto.oferta_id', '=', 'oferta.id')
            ->join('fabricante', 'producto.fabricante_id', '=', 'fabricante.id')
            ->join('img_producto', 'producto.id', '=', 'img_producto.producto_id')
            ->where('tienda_has_producto.tienda_id', $idTienda)
            ->where('tienda_has_producto.producto_id', $idProduct)
            ->where('producto.estado', '1')
            ->where('img_producto.principal', '1')
            ->select('producto.*', 'oferta.*', 'img_producto.*', 'fabricante.nombre AS nombre_fabricante', 'producto.id AS product_id')
            ->first();
    }

    /**
     * Obtener el precio final de un producto, aplicando su porcentaje de descuento
     * o acumulación del mismo.
     *
     * @param $price
     * @param $incrementDecrement '+' or '-'
     * @param $rulePercent
     * @return float
     */
    public function getFinalPriceByProduct($price, $incrementDecrement, $rulePercent)
    {
        $porcentaje = $rulePercent / 100;
        $valor = $price * $porcentaje;

        if ($incrementDecrement === '+')
            return $result = (double)($price + $valor);
        else
            return $result = (double)($price - $valor);

    }

    public function getEmpresaById($empresaId){
        return DB::table('empresa')
            ->where('id', '=' ,$empresaId)
            ->first();
    }

    public function getTiendaById($tiendaId){
        return DB::table('tienda')
            ->where('id', '=' ,$tiendaId)
            ->first();
    }

}