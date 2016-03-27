<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'producto';
    protected $primaryKey = 'id';
    protected $fillable = ['codigo_producto', 'cantidad_disponible','nombre','precio','desc_producto','estado',
        'fabricante_id','oferta_id','users_id'];
}
