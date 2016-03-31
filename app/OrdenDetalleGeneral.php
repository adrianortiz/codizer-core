<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDetalleGeneral extends Model
{
    protected $table = 'orden_detalle_general';
    protected $primaryKey = 'id';
    protected $fillable = ['orden_detalle_id', 'users_id', 'tienda_id'];
    public $timestamps = true;
}
