<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorias_Exp_bebidas extends Model
{
    public $timestamps = false;
    //
    protected $table ="exp_bebidas";
    protected $primaryKey = 'id_expbebidas';

    protected $fillable=["descripcion_bebida"];
}
