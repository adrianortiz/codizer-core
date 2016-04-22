<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Empresa
 *
 * @mixin \Eloquent
 */
class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id';
    protected $fillable = ['users_id', 'estado', 'logo', 'nombre', 'rfc', 'pagina_web', 'giro_empresa', 'sector', 'direccion', 'tel', 'fax', 'correo', 'idioma', 'pais'];
    public $timestamps = true;
}
