<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SistemaPago
 *
 * @mixin \Eloquent
 */
class SistemaPago extends Model
{
    protected $table = 'sistema_pago';
    protected $primaryKey = 'id';
    protected $fillable = ['card'];
    public $timestamps = false;
}
