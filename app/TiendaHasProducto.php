<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiendaHasProducto extends Model
{

    protected $table = 'tienda_has_producto';
    protected $fillable = ['tienda_id', 'producto_id'];
}
