<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gnral_Reticulas extends Model
{
    protected $primaryKey = 'id_reticula';
	protected $table = 'gnral_reticulas';
    protected $fillable = ['clave','id_carrera'];
}
