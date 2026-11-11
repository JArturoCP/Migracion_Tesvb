<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudAcciones extends Model
{
    protected $table = 'aud_acciones';
    protected $primaryKey = 'id_acciones';
    protected $fillable = ['id_responsable','descripcion','fecha'];

}
