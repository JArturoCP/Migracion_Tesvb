<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMMaterial_Prestamos extends Model
{
    use SoftDeletes;
    protected $table = 'pmprestamos_materiales';
    protected $primaryKey='id_material';
    protected $fillable=['descripcion','cantidad'];
    protected $dates = ['deleted_at'];


}
