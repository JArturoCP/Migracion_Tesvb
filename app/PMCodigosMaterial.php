<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PMCodigosMaterial extends Model
{
    //
    use SoftDeletes;
    protected $table = 'pmcodigos_material';
    protected $primaryKey='id_codigo';
    protected $fillable=['id_material','codigo'];
    protected $dates = ['deleted_at'];
}
