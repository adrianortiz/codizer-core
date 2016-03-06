<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasPerfil extends Model
{
    protected $table = 'users_has_perfil';
    protected $fillable = ['users_id', 'perfil_id'];
    public $timestamps = false;
}
