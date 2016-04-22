<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\User
 *
 * @property-read \App\Form $collectionsForm
 * @property-write mixed $password
 * @property-read \App\Empresa $empresaId
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'contacto_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /*
     * Crear una relacion en base a objetos
     */
    public function collectionsForm()
    {
        // Edad
        // return \Carbon\Carbon::parse($this->created_at)->age;
        return $this->hasOne('App\Form');
    }

    public function setPasswordAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function empresaId()
    {
        return $this->hasOne('App\Empresa', 'users_id');
    }
}