<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forms';


    protected $fillable = ['name', 'description', 'user_id'];
    protected $hidden = ['remember_token'];

    /*
     * Lógica de las colecciones
     */
    public function getTitleAttribute()
    {
        return $this->name;
    }

    public function getTitleAndDescAttribute()
    {
        return $this->name . ' ' . $this->description;
    }
}
