<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaHasFabricante extends Model
{
    protected $table = 'empresa_has_fabricante';
    protected $primaryKey = 'empresa_id';
    protected $fillable = ['fabricante_id'];
    public $timestamps = false;
}
