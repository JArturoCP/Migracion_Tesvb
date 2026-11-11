<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudLiderAcciones extends Model
{
    use SoftDeletes;

    protected $table="aud_lider_acciones";
    protected $primaryKey="id_lider";
    protected $fillable=[ 'id_personal'];

    public function personal()
    {
        return $this->belongsTo(Gnral_Personales::class, 'id_personal');
    }

}
