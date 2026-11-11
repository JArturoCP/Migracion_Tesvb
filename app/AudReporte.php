<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudReporte extends Model
{
    protected $table = 'aud_reportes';
    protected $primaryKey='id_reporte';
    protected $fillable=['id_agenda','id_auditado'];

    public function getResponsables($id_nota){
        return AudResponsableAcciones::join("gnral_personales","gnral_personales.id_personal","audresponsable_acciones.id_personal")
        ->where("audresponsable_acciones.id_notas",$id_nota)
            ->get();
    }


}
