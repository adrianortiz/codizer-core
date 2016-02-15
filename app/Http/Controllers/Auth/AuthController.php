<?php

namespace App\Http\Controllers\Auth;

use App\Perfil;
use App\User;
use App\UserHasPerfil;
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
        // Nuevo modelo de usuario sin persistir
        $user = new User([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->role = 'core';
        $user->save();

        return $user;
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
        // Identificamos el id del usuario y buscamos su rut de perfil
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
