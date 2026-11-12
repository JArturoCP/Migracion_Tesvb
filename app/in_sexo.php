<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class in_sexo extends Model
{
    public $timestamps = false;
protected $table='in_sexo';
    protected $primaryKey='id_sexo';
    protected $fillable=['descripcion'];
}
