<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SistemaPago extends Model
{
    protected $table = 'sistema_pago';
    protected $primaryKey = 'id';
    protected $fillable = ['card'];
    public $timestamps = false;
}
