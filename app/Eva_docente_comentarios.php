<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eva_docente_comentarios extends Model
{

    protected $table = 'eva_docente_comentarios';
    protected $primaryKey = 'id_comentario';
    protected $fillable = [
        'id_alumno_materia',
        'comentario'
    ];

}

