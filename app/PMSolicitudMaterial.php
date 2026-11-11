<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class PMSolicitudMaterial extends Model
{
    use SoftDeletes;

    //public $timestamps = true;s

    protected $table='pmsolicitud_material';

    protected $primaryKey='id_solicitud';
    protected $fillable=['id_material','codigo','id_estudiante', 'id_docente','id_jefatura','estatus','fecha_salida','fecha_entrega'];

    public function material()
    {
        return $this->belongsTo(PMMaterial_Prestamos::class,'id_material');
    }

    public function jefaturas()
    {
        return $this->belongsTo(Jefaturas::class,'id_jefatura');
    }



}
