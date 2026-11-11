<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calEvaluaciones extends Model
{
    protected $table = 'cal_evaluaciones';

    protected $primaryKey = 'id_evaluacion';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'id_unidad',
        'id_carga_academica',
        'calificacion',
        'esc',
        'observaciones',
        'id_canalizacion'
    ];
}
