<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Venta
 *
 * @mixin \Eloquent
 */
class Venta extends Model
{
    protected $table = 'venta';
    protected $primaryKey = 'id';
    protected $fillable = ['coden_code', 'sistema_pago_id', 'users_id', 'direccion_factura_id', 'empresa_id', 'tienda_id', 'estado'];
    public $timestamps = true;
}
