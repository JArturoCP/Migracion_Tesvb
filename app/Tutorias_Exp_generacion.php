<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorias_Exp_generacion extends Model
{
    public $incrementing = false;
    protected $table='exp_generacion';
    protected $primaryKey='id_generacion';
    protected $fillable=['generacion'];

    public function grupos()
    {
        return $this->hasMany('App\Tutorias_Exp_asigna_generacion', 'id_generacion', 'id_generacion')
            ->whereNull('deleted_at')
            ->where('id_jefe_periodo', session('id_jefe_periodo'));
    }

}