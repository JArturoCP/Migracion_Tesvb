<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodos extends Model
{
    public $timestamps = false;
     protected $table = 'gnral_periodos';
    protected $primaryKey='id_periodo';
    protected $fillable=['periodo'];
}
