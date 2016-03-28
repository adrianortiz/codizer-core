<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaHasProducto extends Model
{

    protected $table = 'empresa_has_producto';
    protected $fillable = ['empresa_id', 'producto_id'];
}
