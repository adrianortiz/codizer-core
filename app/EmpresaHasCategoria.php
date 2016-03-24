<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaHasCategoria extends Model
{
    protected $table = 'empresa_has_categoria';
    protected $primaryKey = 'empresa_id';
    protected $fillable = ['categoria_id'];
    public $timestamps = false;
}
