<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gnral_Tipos_Usuario extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_tipo_usuario';
    protected $table = 'gnral_tipos_usuario';
}