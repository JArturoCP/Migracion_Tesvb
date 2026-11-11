<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\In_Estadisticas_GeneralesExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class In_Excel_Estadisticas_GeneralesController extends Controller
{
    public function exportar_estadisticas_generales()
    {
        $periodo_ingles = Session::get('periodo_ingles');

        $periodo = DB::table('in_periodos')
            ->where('id_periodo_ingles', $periodo_ingles)
            ->first();

        if (!$periodo) {
            abort(404, 'Periodo no encontrado');
        }

        $datos_alum = DB::select('SELECT DISTINCT
        gr.cuenta, gr.nombre, gr.apaterno, gr.amaterno, 
        gr.id_carrera AS id_carrera, ing.id_nivel AS id_nivel,
        ing.id_grupo AS id_grupo, gr.genero, grc.nombre AS carrera, 
        prom.promedio_total AS promedio, niv.descripcion AS nivel
    FROM gnral_alumnos gr
    INNER JOIN in_carga_academica_ingles ing ON ing.id_alumno = gr.id_alumno
    INNER JOIN in_niveles_ingles niv ON ing.id_nivel = niv.id_niveles_ingles
    INNER JOIN in_grupo_ingles grp ON ing.id_grupo = grp.id_grupo_ingles
    INNER JOIN gnral_carreras grc ON grc.id_carrera = gr.id_carrera
    INNER JOIN in_periodos inp ON inp.id_periodo_ingles = ing.id_periodo_ingles
    INNER JOIN in_validar_carga inv ON gr.id_alumno = inv.id_alumno
    LEFT JOIN (
  SELECT id_carga_ingles, ROUND(AVG(calificacion)) AS promedio_total
  FROM in_evaluar_calificacion
  WHERE id_unidad IN (1,2,3,4)
  GROUP BY id_carga_ingles
) prom ON prom.id_carga_ingles = ing.id_carga_ingles

    WHERE ing.id_nivel NOT IN (11, 12)
      AND ing.id_periodo_ingles = ?
      AND grp.id_grupo_ingles = ing.id_grupo
      AND inv.id_estado = 2
    AND ing.estado_nivel = 1
', [$periodo_ingles]);
        //dd($datos_alum);
        $niveles = [
            'Básico 1', 'Básico 2', 'Básico 3', 'Básico 4', 'Básico 5',
            'Intermedio 1', 'Intermedio 2', 'Intermedio 3', 'Intermedio 4', 'Intermedio 5'
        ];

        $tabla = [];

        foreach ($datos_alum as $fila) {
            $carrera = $fila->carrera;
            $nivel = mb_convert_case($fila->nivel, MB_CASE_TITLE, "UTF-8");

            if (!in_array($nivel, $niveles)) {
                continue;
            }

            $calificacion = $fila->promedio;

            if (!isset($tabla[$carrera])) {
                $tabla[$carrera] = [
                    'aprobados'   => [],
                    'reprobados'  => [],
                    'desertores'  => [],
                    'total_aprobados'   => 0,
                    'total_reprobados'  => 0,
                    'total_desertores'  => 0,
                    'total_por_carrera' => 0
                ];

                foreach (['aprobados', 'reprobados', 'desertores'] as $tipo) {
                    foreach ($niveles as $niv) {
                        $tabla[$carrera][$tipo][$niv] = 0;
                    }
                }
            }

            $tabla[$carrera]['total_por_carrera']++;

            if (is_null($calificacion)) {
                $tabla[$carrera]['desertores'][$nivel]++;
                $tabla[$carrera]['total_desertores']++;
            } elseif ($calificacion >= 70) {
                $tabla[$carrera]['aprobados'][$nivel]++;
                $tabla[$carrera]['total_aprobados']++;
            } else {
                $tabla[$carrera]['reprobados'][$nivel]++;
                $tabla[$carrera]['total_reprobados']++;
            }
        }

        // Totales por nivel
        $totales_por_nivel = [
            'aprobados' => array_fill_keys($niveles, 0),
            'reprobados' => array_fill_keys($niveles, 0),
            'desertores' => array_fill_keys($niveles, 0),
        ];

        foreach ($tabla as $datos) {
            foreach ($niveles as $nivel) {
                $totales_por_nivel['aprobados'][$nivel] += $datos['aprobados'][$nivel] ?? 0;
                $totales_por_nivel['reprobados'][$nivel] += $datos['reprobados'][$nivel] ?? 0;
                $totales_por_nivel['desertores'][$nivel] += $datos['desertores'][$nivel] ?? 0;
            }
        }

        // Totales generales
        $total_general = [
            'aprobados' => array_sum($totales_por_nivel['aprobados']),
            'reprobados' => array_sum($totales_por_nivel['reprobados']),
            'desertores' => array_sum($totales_por_nivel['desertores']),
        ];

        return Excel::download(
            new In_Estadisticas_GeneralesExport(
                $tabla,
                $niveles,
                $totales_por_nivel,
                $total_general,
                $periodo
            ),
            'estadisticas_generales.xlsx'
        );
    }

}
