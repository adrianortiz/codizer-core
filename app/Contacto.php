<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contacto
 *
 * @mixin \Eloquent
 */
class Contacto extends Model
{
    protected $table = 'contacto';
    protected $primaryKey = 'id';
    protected $fillable = ['foto', 'nombre', 'ap_paterno', 'ap_materno', 'sexo', 'f_nacimiento', 'profesion', 'estado_civil', 'estado', 'desc_contacto'];
}
