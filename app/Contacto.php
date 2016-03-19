<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';
    protected $primaryKey = 'id';
    protected $fillable = ['foto', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'f_nacimiento', 'profesion', 'estado', 'desc_origen', 'desc_contacto', 'email', 'password', 'role'];
}
