<?php

namespace App\Http\Controllers\Auth;

use App\ContactAddress;
use App\Contacto;
use App\Perfil;
use App\User;
use App\Http\Controllers\Controller;
use App\UserHasPerfil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'paterno' => 'required|max:255',
            'materno' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            // Contacto a registrar
            $contact = new Contacto([
                'foto'          => 'unknow.png',
                'nombre'        => ucwords(strtolower($data['name'])),
                'ap_paterno'    => ucwords(strtolower($data['paterno'])),
                'ap_materno'    => ucwords(strtolower($data['materno'])),
                'estado'        => 'iniciado',
                'profesion'     => '-'
            ]);
            $contact->save();


            // Nuevo modelo de usuario sin persistir
            $user = new User([
                'email'         => $data['email'],
                'password'      => $data['password'],
                'contacto_id'   => $contact->id
            ]);
            $user->role = 'core';
            $user->save();

            $perfil = new Perfil([
                'rol'           => 'normal',
                'perfil_route'  => Str::slug($data['name'] . ' '. $data['paterno'] . ' ' .Carbon::createFromTimestamp(0)->diffInSeconds()), // str_random(10),//.random_bytes(5)
                'cover'         => 'cover.png'
            ]);
            $perfil->save();

            $userHasPerfil = new UserHasPerfil([
                'users_id'  => $user->id,
                'perfil_id' => $perfil->id
            ]);
            $userHasPerfil->save();


            $contact_dir = new ContactAddress([
                "desc_dir" => '',
                "calle" => '',
                "numero_dir" => '',
                "piso_edificio" => '',
                "ciudad" => '',
                "cp" => '',
                "estado_dir" => '',
                "pais" => '',
                "contacto_id" => $contact->id
            ]);
            $contact_dir->save();

            DB::commit();
            return $user;

        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}