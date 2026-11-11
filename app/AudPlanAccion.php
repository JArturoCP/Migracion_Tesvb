<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudPlanAccion extends Model
{
    use SoftDeletes;

    protected $table="aud_plan_acciones";
    protected $primaryKey="id_plan_acciones";
    protected $fillable=[ 'id_responsable', 'acciones', 'id_responsable_implantar', 'fecha_implantar_accion','id_responsable_revisar','fecha_verificacion', 'id_evidencia', 'path_evidencia', 'estado', 'observaciones', 'fecha_planeada', 'tipo'];
    //
}
