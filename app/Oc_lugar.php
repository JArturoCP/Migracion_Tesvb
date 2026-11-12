<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oc_lugar extends Model
{
    public $timestamps = false;
    protected $table='oc_lugar';
    protected $primaryKey='id_lugar';
    protected $fillable=['descripcion'];
}
