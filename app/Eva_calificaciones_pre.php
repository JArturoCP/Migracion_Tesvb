<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eva_calificaciones_pre extends Model
{
    protected $table = 'eva_calificaciones_pre';
    protected $primaryKey='id';
    protected $fillable=['id_periodo','no_pregunta','calificacion_p','id_hrs_profesor','id_criterio'];
}