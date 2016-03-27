<?php

namespace App\Http\Controllers\Admin\Company;

use App\Categoria;
use App\Empresa;
use App\EmpresaHasCategoria;
use App\EmpresaHasFabricante;
use App\EmpresaHasOferta;
use App\Fabricante;
use App\Facades\Core;
use App\Oferta;
use App\Tienda;
use App\User;
use App\UsuarioEmpleadoInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Controlamos para que se muestre un formulario de crear empresa
     * y tambien forzamos a que se carge la información del usuario logueado
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {
        $userPerfil = Core::getUserPerfil();
        $userContacto = Core::getUserContact();
        $perfil = $userPerfil;
        $contacto = $userContacto;

        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('companies.index', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        // Saber si el usuario tiene empresa
        $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

        if ($empresa === null) {
            return view('admin.company.new-company', compact('perfil', 'contacto', 'userPerfil', 'userContacto'));

        } else {
            $countTiendas = Tienda::where('empresa_id', $empresa->id)->count();
            $countEmpleados = UsuarioEmpleadoInfo::where('empresa_id', $empresa->id)->count();

            return view('admin.company.company', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'countEmpleados'));
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
        if ($request->ajax() ) {

            // GET AND SAVE PHOTO COMPANY
            $filePhotoCompany = $request->file('logo');
            $namePhotoCompany = 'company-'.\Auth::user()->id . Carbon::now()->second . $filePhotoCompany->getClientOriginalName();
            \Storage::disk('photo_company')->put($namePhotoCompany, \File::get($filePhotoCompany));

            // Generte data
            /*
            $company = new Empresa([
                'users_id'       => \Auth::user()->id,
                'estado'        => '1',
                'logo'          => $namePhotoCompany,
                'nombre'        => $request['nombre'],
                'rfc'           => $request['rfc'],
                'pagina_web'    => $request['pagina_web'],
                'giro_empresa'  => $request['giro_empresa'],
                'sector'        => $request['sector'],
                'direccion'     => $request['direccion'],
                'tel'           => $request['tel'],
                'fax'           => $request['fax'],
                'correo'        => $request['correo'],
                'idioma'        => $request['idioma'],
                'pais'          => $request['pais']
            ]);
            */

            $company = new Empresa();
            $company->fill($request->all());
            $company->users_id = \Auth::user()->id;
            $company->estado = '1';
            $company->logo = $namePhotoCompany;


            // Save company and categoria, oferta y fabricante por defecto
            if ( $company->save() ) {

                /**
                 * Crear categoria, oferta y fabricante por defecto
                 * Para asi poder llenar los combos de las vistas para asignarlas a los productos
                 * y que mínimo exista una por defecto por seguridad
                 *
                 * categoria    -> nombre = Sin categoría
                 * oferta       -> regla_porciento = 0
                 * fabricante   -> nombre = Sin fabricante
                 */

                $categoria = new Categoria();
                $categoria->nombre = 'Sin categoría';
                $categoria->save();

                $empresaHasCategoria = new EmpresaHasCategoria();
                $empresaHasCategoria->empresa_id = $company->id;
                $empresaHasCategoria->categoria_id = $categoria->id;
                $empresaHasCategoria->save();


                $oferta = new Oferta();
                $oferta->regla_porciento = 0;
                $oferta->tipo_oferta = '-';
                $oferta->save();

                $empresaHasOferta = new EmpresaHasOferta();
                $empresaHasOferta->empresa_id = $company->id;
                $empresaHasOferta->oferta_id = $oferta->id;
                $empresaHasOferta->save();


                $fabricante =  new Fabricante();
                $fabricante->nombre = 'Sin fabricante';
                $fabricante->save();

                $empresaHasFabricante = new EmpresaHasFabricante();
                $empresaHasFabricante->empresa_id = $company->id;
                $empresaHasFabricante->fabricante_id = $fabricante->id;
                $empresaHasFabricante->save();


                $userPerfil = Core::getUserPerfil();

                return response()->json([
                    'message' => 'Empresa dada de alta.',
                    'url'       => route('companies.index', $userPerfil[0]->perfil_route)
                ]);
            }
        }

        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax() ) {

            $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

            return response()->json([
                'company' => $empresa
            ]);
        }
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
     * Actualizar una empresa, comprobar si la petición es AJAX y si trae
     * una imagen para eliminar la actual y agregar la nueva
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        if ($request->ajax() ) {

            $empresa = Empresa::findOrFail($request['id']);
            $empresa->fill($request->all());

            if ($request->file('logo') )
            {
                // Guardar la nueva imagen en el disco
                $filePhotoCompany = $request->file('logo');
                $namePhotoCompany = 'company-'.\Auth::user()->id . Carbon::now()->second . $filePhotoCompany->getClientOriginalName();
                \Storage::disk('photo_company')->put($namePhotoCompany, \File::get($filePhotoCompany));

                $nameImgToDelete = $empresa->logo;
                $empresa->logo = $namePhotoCompany;

                // ELIMINAR LA VIEJA IMAGEN DEL DISCO DURO
            }


            $empresa->save();

            // Obtener nombre y ruta del logo de la imagen
            $empresa->logo = URL::to('/') . '/media/photo-company/' . $empresa->logo;

            return response()->json([
                'company' => $empresa
            ]);
        }
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


}
