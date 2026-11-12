<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jefaturas extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_jefatura';
    protected $table = 'actcomple_jefaturas';
}
