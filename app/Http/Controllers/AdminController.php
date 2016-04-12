<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use App\UserHasPerfil;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /**
         * SE RESCRIBIO LA RUTA PARA ADMIN
         * PARA FUNCIONAR CON CORE
         */
        // Identificamos el id del usuario y buscamos su ruta de perfil
        $perfilId = UserHasPerfil::where('users_id',\Auth::user()->id)->value('perfil_id');
        $perfilRoute = Perfil::where('id', $perfilId)->value('perfil_route');

        return Redirect::route('perfil', array('nick' => $perfilRoute));

        // return view('admin/panel');
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
        $user = User::findOrFail($id);
        return view('admin/admin-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Requests\EditUserRequest $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $user = User::findOrFail($request->id);
                $user->fill($request->all());
                $user->save();

                DB::commit();
                return response()->json([
                    'message' => "Cuenta actualizada.",
                    'user' => $user->email
                ]);

            } catch (\Exception $e) {
                DB::rollback();

                return response()->json([
                    'error' => 'Ocurrio un error.',
                    'case' => $e
                ]);
            }
        }
        abort(404);
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
