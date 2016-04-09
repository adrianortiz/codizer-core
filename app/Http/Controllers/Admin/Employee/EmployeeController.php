<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Empresa;
use App\Facades\Core;
use App\Tienda;
use App\User;
use App\UsuarioEmpleadoInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $nameFirstName )
    {
        $userPerfil     = Core::getUserPerfil();
        $userContacto   = Core::getUserContact();
        $perfil         = $userPerfil;
        $contacto       = $userContacto;


        // Métodos para contactos
        $userView   = User::where('contacto_id', $contacto[0]->id)->first();
        $user       = User::findOrFail(\Auth::user()->id);
        $contacts   = Core::getContactos($user->id);
        $friends    = Core::getAmigos($userView->id);
        $followers  = Core::getFollowers($contacto);


        // Nos aseguramos de que la ruta sea la del usuario logueado
        if ( $nameFirstName != $userPerfil[0]->perfil_route)
            return \Redirect::route('stores.index', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);

        // Saber si el usuario tiene empresa
        $empresa = Empresa::where('users_id', \Auth::user()->id)->first();

        if ($empresa === null) {
            return view('admin.company.new-company', compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'contacts', 'friends', 'followers'));

        } else {
            $countTiendas = Tienda::where('empresa_id', $empresa->id)->count();
            $tiendas = Tienda::where('empresa_id', $empresa->id)->get();

            // Lists for selects input form
            $empresasList = Empresa::where('users_id', \Auth::user()->id)->lists('nombre', 'id');
            $tiendasList  = Tienda::where('empresa_id', $empresa->id)->lists('nombre', 'id');

            $amigosListToEmployee = Core::getAmigos(\Auth::user()->id);

            $countEmpleados = UsuarioEmpleadoInfo::where('empresa_id', $empresa->id)->count();
            $empleados = Core::getAllEmployeesByEmpresaId($empresa->id);

            return view('admin.company.employee',
                compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empresa', 'countTiendas', 'tiendas', 'empresasList', 'tiendasList', 'amigosListToEmployee', 'countEmpleados', 'empleados', 'contacts', 'friends', 'followers'));
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

        if ($request->ajax()) {

            // Validar que no exista esa configuración de empleado en la BD
            if (Core::existEmployeeConfig($request) === 0)
            {
                $employee = new UsuarioEmpleadoInfo();
                $employee->fill($request->all());
                $employee->save();

                $employeeAll = Core::getEmployeeById( $employee->id );

                // Modificar las rutas
                $employeeAll->foto_tienda = URL::to('/') . '/media/photo-store/' . $employeeAll->foto_tienda;
                $employeeAll->foto = URL::to('/') . '/media/photo-perfil/' . $employeeAll->foto;
                $employeeAll->perfil_route = route('perfil', $employeeAll->perfil_route);
                $employeeAll->store_route = URL::to('/') . '/tienda/' . $employeeAll->store_route;

                return response()->json([
                    'empleado' => $employeeAll
                ]);

            } else {
                return response()->json([
                    'message' => 'Ya existe un empleado con esa configuración. Intentalo de nuevo.'
                ]);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {

            $employeeAll = Core::getEmployeeById( $request['id'] );

            // Modificar las rutas
            $employeeAll->foto_tienda = URL::to('/') . '/media/photo-store/' . $employeeAll->foto_tienda;
            $employeeAll->foto = URL::to('/') . '/media/photo-perfil/' . $employeeAll->foto;
            $employeeAll->perfil_route = route('perfil', $employeeAll->perfil_route);

            return response()->json([
                'empleado' => $employeeAll
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {

            // Validar que no exista esa configuración de empleado en la BD
            if (Core::existEmployeeConfig($request) === 0)
            {
                $employee = UsuarioEmpleadoInfo::findOrFail($request['id']);
                $employee->fill($request->all());
                $employee->save();

                $employeeAll = Core::getEmployeeById( $employee->id );

                // Modificar las rutas
                $employeeAll->foto_tienda = URL::to('/') . '/media/photo-store/' . $employeeAll->foto_tienda;
                $employeeAll->foto = URL::to('/') . '/media/photo-perfil/' . $employeeAll->foto;
                $employeeAll->perfil_route = route('perfil', $employeeAll->perfil_route);
                $employeeAll->store_route = URL::to('/') . '/tienda/' . $employeeAll->store_route;

                return response()->json([
                    'empleado' => $employeeAll
                ]);

            } else {
                return response()->json([
                    'message' => 'Ya existe un empleado con esa configuración. Intentalo de nuevo.'
                ]);
            }

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

    /**
     *
     * Empleado view
     *
     * @param $nameFirstName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function listEmployeeByUser($nameFirstName) {

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
            return \Redirect::route('stores.index', $userPerfil[0]->perfil_route);

        Core::isRouteValid($userPerfil[0]->perfil_route);
        $empleos = Core::getAllEmpleosDeEmpleadoByUserId( \Auth::user()->id );

        return view('admin.empleado.empleo',
            compact('perfil', 'contacto', 'userPerfil', 'userContacto', 'empleos', 'contacts', 'friends', 'followers'));

    }
}
