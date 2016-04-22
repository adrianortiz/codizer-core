<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DireccionFactura
 *
 * @mixin \Eloquent
 */
class DireccionFactura extends Model
{
    protected $table = 'direccion_factura';
    protected $primaryKey = 'id';
    protected $fillable = ['dir', 'city', 'stateOrProvince', 'cp'];
    public $timestamps = true;
}
