<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ContactAddress
 *
 * @mixin \Eloquent
 */
class ContactAddress extends Model
{
    protected $table = 'contact_address';
    protected $primaryKey = 'id';
    protected  $fillable = ['desc_dir', 'calle', 'numero_dir', 'piso_edificio', 'ciudad', 'cp', 'estado_dir', 'pais', 'contacto_id'];
}
