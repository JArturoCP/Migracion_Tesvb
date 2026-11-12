<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudEvidencia extends Model
{
    public $timestamps = false;
    protected $table="aud_evidencias";
    protected $primaryKey="id_evidencia";
    protected $fillable=[ 'descripcion'];
}
