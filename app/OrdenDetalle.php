<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrdenDetalle
 *
 * @mixin \Eloquent
 */
class OrdenDetalle extends Model
{
    protected $table = 'orden_detalle';
    protected $primaryKey = 'id';
    protected $fillable = ['ventas_id', 'producto_id', 'producto_nombre', 'producto_precio_base', 'producto_precio_final', 'producto_precio_final_por_cantidad', 'cantidad', 'regla_porciento_orden', 'tipo_oferta_orden'];
    public $timestamps = true;
}
