<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudRevisorAcciones extends Model
{
    use SoftDeletes;

    protected $table="aud_revisor_acciones";
    protected $primaryKey="id_revisor";
    protected $fillable=[ 'id_responsable', 'id_personal'];

    public function personal()
    {
        return $this->belongsTo(Gnral_Personales::class, 'id_personal');
    }

    public function responsable()
    {
        return $this->belongsTo(AudResponsableAcciones::class, 'id_responsable');
    }
}
