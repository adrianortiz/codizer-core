<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    protected $table = 'contact_phone';
    protected $primaryKey = 'id';
    protected $fillable = ['desc_tel', 'numero_tel', 'contacto_id'];
}
