<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gnral_grupos extends Model
{
    public $timestamps = false;
    protected $table = 'gnral_grupos';
    protected $primaryKey='id_grupo';
    protected $fillable=['grupo'];
}
