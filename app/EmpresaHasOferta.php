<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaHasOferta extends Model
{
    protected $table = 'empresa_has_oferta';
    protected $primaryKey = 'empresa_id';
    protected $fillable = ['oferta_id'];
    public $timestamps = false;
}
