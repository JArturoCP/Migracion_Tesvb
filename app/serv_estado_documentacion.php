<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class serv_estado_documentacion extends Model
{
    public $timestamps = false;
    protected $table = 'serv_estado_documentacion';
    protected $primaryKey='id_estado_documentacion';
    protected $fillable=['estado_documentacion'];
}
