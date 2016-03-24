<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    protected $table = 'contact_mail';
    protected $primaryKey = 'id';
    protected $fillable = ['desc_mail', 'email', 'contacto_id'];
}
