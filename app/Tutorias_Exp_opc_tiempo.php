<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorias_Exp_opc_tiempo extends Model
{
    public $timestamps = false;
    //
    protected $table ="exp_opc_tiempo";
    protected $primaryKey="id_opc_tiempo";
    protected $fillable=["desc_opc"];
}
