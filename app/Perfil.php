<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfil';
    protected $primaryKey = 'id';
    protected $fillable = ['rol', 'perfil_route', 'sobre_mi', 'aptitudes', 'apodo', 'cita_favorita'];
    public $timestamps = false;
}
