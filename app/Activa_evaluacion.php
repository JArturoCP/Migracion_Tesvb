<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activa_evaluacion extends Model
{
    public $incrementing = false;
       protected $table = 'eva_activa_evaluacion';
       protected $primaryKey='id';
       protected $fillable=['estado'];
}
