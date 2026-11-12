<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class amb_encargados extends Model
{
    public $timestamps = false;
    protected $table = 'amb_encargados';
    protected $primaryKey='id_encargado';
    protected $fillable=['id_personal','id_control','fecha_reg'];
}
