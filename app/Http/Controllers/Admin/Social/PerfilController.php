<?php

namespace App\Http\Controllers\Admin\Social;

use App\Contacto;
use App\Perfil;
use App\User;
use App\UserHasPerfil;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nameFirstName)
    {

        $existeRuta = Perfil::where('perfil_route', $nameFirstName)->count();

        if (!$existeRuta == 1) {
            abort(404);
        }

        $perfil = Perfil::where('perfil_route', $nameFirstName)->get();
        $userHasPerfil = UserHasPerfil::where('perfil_id', $perfil[0]->id)->get();
        $contacto = Contacto::where('id', $userHasPerfil[0]->users_id)->get();

        $userContacto = Contacto::where('id', \Auth::user()->id)->get();

        // dd($ruta->toArray());
        // dd($ruta[0]->perfil_route);
        return view('admin.social.perfil', compact('userContacto', 'perfil', 'contacto'));

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
}
