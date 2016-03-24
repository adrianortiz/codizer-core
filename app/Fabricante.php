<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    protected $table = 'fabricante';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre'];
    public $timestamps = false;
}
