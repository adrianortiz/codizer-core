<?php

namespace App\Http\Controllers\Auth;

use App\ContactAddress;
use App\Contacto;
use App\Perfil;
use App\User;
use Carbon\Carbon;
use App\UserHasPerfil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
     * Recibir todos los datos del formulario
     * return User::create(\HttpRequest::all());
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


    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return route('login');
    }


    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        // Identificamos el id del usuario y buscamos su ruta de perfil
        $perfilId = UserHasPerfil::where('users_id',\Auth::user()->id)->value('perfil_id');
        $perfilRoute = Perfil::where('id', $perfilId)->value('perfil_route');

        return route('perfil', array('nick' => $perfilRoute));
    }


    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return trans('validation.login');
    }

}
