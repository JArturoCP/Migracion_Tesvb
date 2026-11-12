<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorias_Exp_bachillerato extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table ="exp_bachillerato";
    protected $primaryKey="id_bachillerato";
    protected $fillable=["desc_bachillerato"];
}
