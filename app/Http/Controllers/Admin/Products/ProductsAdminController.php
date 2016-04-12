<?php

namespace App\Http\Controllers\Admin\Products;

use App\Empresa;
use App\Facades\Core;
use App\Producto;
use App\Tienda;
use App\User;
use App\UsuarioEmpleadoInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class ProductsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();
        $perfil = $userPerfil;
        $contacto = $userContacto;


        // Métodos para contactos
        $userView = User::where('contacto_id', $contacto[0]->id)->first();
        $user = User::findOrFail(\Auth::user()->id);
        $contacts = Core::getContactos($user->id);
        $friends = Core::getAmigos($userView->id);
        $followers = Core::getFollowers($contacto);


        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('companies.index', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        // Saber si el usuario tiene empresa
        $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

        if ($empresa === null) {
            return view('admin.company.new-company', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers'));

        } else {

            $countTiendas = Tienda::where('empresa_id', $empresa->id)->count();
            $countEmpleados = UsuarioEmpleadoInfo::where('empresa_id', $empresa->id)->count();
            $listTiendas = Tienda::where('empresa_id', $empresa->id)->orderBy('id', 'asc')->lists('nombre', 'id');
            $tienda = Tienda::where('empresa_id', $empresa->id)->orderBy('id', 'asc')->first();
            $products = Core::getAllProductosByIdTienda( $tienda->id );

            $idEmpresa = $empresa->id;
            $idTienda = $tienda->id;

            $fabricantesList  = Core::getFabricantesByIdEmpresa( $idEmpresa );
            $ofertasList    =   Core::getOfertasByIdEmpresa($idEmpresa);
            $categoriasList =   Core::getCategoriasByIdEmpresa($idEmpresa);

            return view('admin.company.product-admin',
                compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'countEmpleados', 'contacts', 'friends', 'followers', 'listTiendas', 'products', 'idEmpresa', 'idTienda', 'fabricantesList', 'ofertasList', 'categoriasList'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByStore(Request $request)
    {
        if ($request->ajax()) {

            $products   = Core::getProductosByTiendaId($request['id']);
            $tienda     = Tienda::where('id', $request['id'])->first();
            $idTienda   = $tienda->id;
            $idEmpresa  = $tienda->empresa_id;

            return response()->json([
                'products'          => $products,
                'url'               => URL::to('/') . '/media/photo-product/',
                'idTienda'          => $idTienda,
                'idEmpresa'         => $idEmpresa
            ]);
        }

        abort(404);
    }
}
