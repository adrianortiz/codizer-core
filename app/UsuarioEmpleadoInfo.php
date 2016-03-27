<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioEmpleadoInfo extends Model
{
    protected $table = 'usuario_empleado_info';
    protected $primaryKey = 'id';
    protected $fillable = ['estado', 'salario', 'nivel', 'users_id', 'empresa_id', 'tienda_id'];
    public $timestamps = true;
}
