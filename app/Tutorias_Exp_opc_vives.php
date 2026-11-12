<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorias_Exp_opc_vives extends Model
{
    public $timestamps = false;
    protected $table ="exp_opc_vives";
    protected $primaryKey="id_opc_vives";
    protected $fillable=["desc_opc"];
}
