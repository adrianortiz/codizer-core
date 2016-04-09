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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

            return view('admin.company.company', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'countEmpleados', 'contacts', 'friends', 'followers'));
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

            /**
             * Save company and categoria, oferta y fabricante por defecto
             *
             * Crear categoria, oferta y fabricante por defecto
             * Para asi poder llenar los combos de las vistas para asignarlas a los productos
             * y que mínimo exista una por defecto por seguridad
             *
             * categoria    -> nombre = Sin categoría
             * oferta       -> regla_porciento = 0
             * fabricante   -> nombre = Sin fabricante
             */

            DB::beginTransaction();
            try {

                $company = new Empresa();
                $company->fill($request->all());
                $company->users_id = \Auth::user()->id;
                $company->estado = '1';
                $company->logo = $namePhotoCompany;
                $company->save();

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


                $fabricante = new Fabricante();
                $fabricante->nombre = 'Sin fabricante';
                $fabricante->save();

                $empresaHasFabricante = new EmpresaHasFabricante();
                $empresaHasFabricante->empresa_id = $company->id;
                $empresaHasFabricante->fabricante_id = $fabricante->id;
                $empresaHasFabricante->save();

                $userPerfil = Core::getUserPerfil();

                DB::commit();

                return response()->json([
                    'message' => 'Empresa dada de alta.',
                    'url' => route('companies.index', $userPerfil[0]->perfil_route)
                ]);

            } catch (\Exception $e) {
                // Delete img
                File::delete('media/photo-company/' . $namePhotoCompany);
                DB::rollback();

                return response()->json([
                    'error' => 'Ocurrio un error.',
                    'errore' => $e
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

                // Eliminar la vieja imagen del disco duro y asignar la nueva a la empresa
                File::delete('media/photo-company/' . $empresa->logo);
                $empresa->logo = $namePhotoCompany;
            }

            $empresa->save();

            // Obtener nombre y ruta del logo de la imagen
            $empresa->logo = URL::to('/') . '/media/photo-company/' . $empresa->logo;

            return response()->json([
                'company'   => $empresa
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
