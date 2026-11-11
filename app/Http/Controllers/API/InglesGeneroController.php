<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InglesGeneroController extends Controller
{
    public function obtenerDatosGenero(Request $request)
    {
        $periodo_ingles = Session::get('periodo_ingles');

        $alumnos = DB::table('in_validar_carga')
            ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('gnral_semestres', 'gnral_semestres.id_semestre', '=', 'gnral_alumnos.id_semestre')
            ->join('gnral_carreras', 'gnral_carreras.id_carrera', '=', 'gnral_alumnos.id_carrera')
            ->join('in_carga_academica_ingles', 'in_carga_academica_ingles.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_carga_academica_ingles.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_carga_academica_ingles.id_grupo')
            ->where('in_carga_academica_ingles.id_periodo_ingles', '=', $periodo_ingles)
            ->where('in_validar_carga.id_periodo', '=', $periodo_ingles)
            ->where('in_validar_carga.id_estado', '=', 2)
            ->select(
                'gnral_alumnos.genero',
                'gnral_carreras.nombre as carrera',
                'in_niveles_ingles.descripcion as nivel_ingles'
            )
            ->get();

        // Estructura general
        $datosAgrupados = [];
        $contar_m = 0;
        $contar_f = 0;

        foreach ($alumnos as $alumno) {
            $carrera = $alumno->carrera;
            $nivel = $alumno->nivel_ingles;
            $genero = $alumno->genero;

            // Contadores generales
            if ($genero === 'M') {
                $contar_m++;
            } else {
                $contar_f++;
            }

            // Inicializa si no existe
            if (!isset($datosAgrupados[$carrera])) {
                $datosAgrupados[$carrera] = [];
            }
            if (!isset($datosAgrupados[$carrera][$nivel])) {
                $datosAgrupados[$carrera][$nivel] = ['M' => 0, 'F' => 0];
            }

            // Sumar al grupo correspondiente
            $datosAgrupados[$carrera][$nivel][$genero]++;
        }

        // Porcentaje global
        $total = $contar_m + $contar_f;
        $res_h = ($total > 0) ? round(($contar_m * 100) / $total) : 0;
        $res_m = ($total > 0) ? round(($contar_f * 100) / $total) : 0;

        return response()->json([
            'porcentaje_genero' => [
                ["name" => "Hombres", "y" => $res_h],
                ["name" => "Mujeres", "y" => $res_m],
            ],
            'por_carrera_nivel' => $datosAgrupados
        ]);
    }
}