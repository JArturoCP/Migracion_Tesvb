<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adscripcion_personal extends Model
{
    public $timestamps = false;
  protected $table='adscripcion_personal';
    protected $primaryKey = 'id_adscripcion';
    protected $fillable=[
        'id_personal','id_unidad_persona'];
}
