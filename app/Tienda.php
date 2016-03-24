<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = 'tienda';
    protected $primaryKey = 'id';
    protected $fillable = ['estado', 'nombre', 'foto', 'store_route', 'store_route_platilla', 'desc', 'empresa_id'];
    public $timestamps = true;
}
