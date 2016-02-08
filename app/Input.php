<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inputs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'type_validation', 'type_input', 'form_id', 'description'];
}
