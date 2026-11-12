<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodosCarreras extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_periodo_carrera';
     protected $table = 'gnral_periodo_carreras';
}
