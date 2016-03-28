<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    protected $table = 'img_producto';
    protected $primaryKey = 'id';
    protected $fillable = ['img', 'producto_id','principal'];
    public $timestamps = true;
}
