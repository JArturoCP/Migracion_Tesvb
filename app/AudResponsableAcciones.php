<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudResponsableAcciones extends Model
{
    protected $table = 'audresponsable_acciones';
    protected $primaryKey = 'id_responsable';
    protected $fillable = ['id_personal','id_notas','estado','viable','requiere_accion',
        'requiere_correccion','causa_raiz','accion_correctiva','analisis',
        'actualizacion_riesgos', 'cambios_sistema', 'valor_actr','valor_cambios','observaciones', 'observaciones_lider'];

    static function getDataResponsable()
    {
        return self::join('aud_notas', 'audresponsable_acciones.id_notas', '=', 'aud_notas.id_notas')
            ->join('aud_reportes', 'aud_notas.id_reporte', '=', 'aud_reportes.id_reporte')
            ->join('aud_agenda', 'aud_reportes.id_agenda', '=', 'aud_agenda.id_agenda')
            ->join('aud_auditoria', 'aud_agenda.id_auditoria', 'aud_auditoria.id_auditoria');
            //->whereNull('audresponsable_acciones.estado');
    }

    public function personal()
    {
        return $this->belongsTo(Gnral_Personales::class, 'id_personal');
    }

}
