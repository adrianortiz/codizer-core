<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Producto
 *
 * @mixin \Eloquent
 */
class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id';
    protected $fillable = ['codigo_producto', 'cantidad_disponible','nombre', 'slug','precio','desc_producto','estado', 'fabricante_id','oferta_id','users_id'];
    public $timestamps = true;
}
