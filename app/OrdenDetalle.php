<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDetalle extends Model
{
    protected $table = 'orden_detalle';
    protected $primaryKey = 'id';
    protected $fillable = ['producto_id', 'producto_nombre', 'producto_precio_base', 'producto_precio_final', 'cantidad', 'regla_porciento_orden', 'tipo_oferta_orden'];
    public $timestamps = true;
}
