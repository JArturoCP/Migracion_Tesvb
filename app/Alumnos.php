<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Alumnos extends Model
{
    protected $table = 'gnral_alumnos';
    protected $primaryKey='id_alumno';
    protected $fillable=[
                'cuenta',
                'nombre',
                'apaterno',
                'amaterno',
                'genero',
                'fecha_nac',
                'edad',
                'curp_al',
                'edo_civil',
                'nacionalidad',
                'twiter_al',
                'correo_al',
                'facebook_al',
                'cel_al',
                'tel_fijo_al',
                'entidad_nac_al',
                'grado_estudio_al',
                'id_carrera',
                'id_semestre',
                'grupo',
                'promedio',
                'estado',
        'id_municipio',
        'calle_al',
        'n_ext_al',
        'n_int_al',
        'entre_calle',
        'y_calle',
        'otra_ref',
        'colonia_al',
        'localidad_al',
        'cp',
        'id_usuario',
        'discapacidad',
        'descripcion_discapacidad',
        'lengua',
        'descripcion_lengua',
        'id_seguro_social',
        'numero_seguro_social',
        'id_escuela_procedencia',
        'promedio_preparatoria',
        's_a',
        'tipo_admision'
                             ];
    public static function getAlumnos(){
    return DB::select("
        SELECT 
            a.id_alumno,
            a.nombre,
            a.apaterno,
            a.amaterno,
            g.grupo,
            c.siglas
        FROM gnral_alumnos a
        INNER JOIN gnral_carreras c ON a.id_carrera = c.id_carrera
        INNER JOIN gnral_grupos g ON a.grupo = g.id_grupo
        INNER JOIN asigna_tutor a_t 
            ON a.id_carrera = a_t.id_carrera 
            AND a.id_semestre = a_t.id_semestre 
            AND a.grupo = a_t.id_grupo
    ");
}

    public static function getAlumno(){
    return DB::select("
        SELECT 
            a.nombre AS alumno_nombre,
            a.apaterno,
            a.amaterno,
            s.descripcion AS semestre,
            c.siglas,
            a.grupo,
            p.nombre AS tutor_nombre,
            p.correo AS tutor_correo
        FROM gnral_alumnos a
        INNER JOIN gnral_carreras c ON a.id_carrera = c.id_carrera
        INNER JOIN asigna_tutor ast ON ast.id_grupo = a.grupo 
            AND ast.id_carrera = a.id_carrera 
            AND ast.id_semestre = s.id_semestre
        INNER JOIN gnral_semestres s ON ast.id_semestre = s.id_semestre
        INNER JOIN gnral_personales p ON p.id_personal = ast.id_personal
    ");
}
}
