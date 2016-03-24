<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactSocial extends Model
{
    protected $table = 'contact_social';
    protected $primaryKey = 'id';
    protected $fillable = ['red_social_nombre', 'url', 'contacto_id'];
}
