<?php

namespace App\Http\Controllers;

use App\Exports\Ingles_est_generoExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;
class In_desempeno_academico_inglesController extends Controller
{
    public function index(Request $request  )
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
          AND inv.id_periodo = ?
          AND inv.id_estado = 2
        ORDER BY gr.id_carrera', [$periodo_ingles, $periodo_ingles]);

        $niveles = [
            'Básico 1', 'Básico 2', 'Básico 3', 'Básico 4', 'Básico 5',
            'Intermedio 1', 'Intermedio 2', 'Intermedio 3', 'Intermedio 4', 'Intermedio 5'
        ];

        // Inicializar tabla de totales por carrera y nivel
        $tabla = [];

        // Inicializar grupos por categoría
        $grupos_por_categoria = [
            'aprobados' => [],
            'reprobados' => [],
            'desertores' => [],
        ];

        // Mapeo de niveles para normalización
        $mapa_niveles = [
            'Basico 1' => 'Básico 1', 'BÁSICO 1' => 'Básico 1', 'basico 1' => 'Básico 1', 'básico 1' => 'Básico 1',
            'Basico 2' => 'Básico 2', 'BÁSICO 2' => 'Básico 2', 'basico 2' => 'Básico 2',
            'Basico 3' => 'Básico 3', 'BÁSICO 3' => 'Básico 3',
            'Basico 4' => 'Básico 4', 'BÁSICO 4' => 'Básico 4',
            'Basico 5' => 'Básico 5', 'BÁSICO 5' => 'Básico 5',
            'Intermedio 1' => 'Intermedio 1', 'Intermedio I' => 'Intermedio 1', 'INTERMEDIO I' => 'Intermedio 1',
            'Intermedio 2' => 'Intermedio 2', 'INTERMEDIO II' => 'Intermedio 2',
            'Intermedio 3' => 'Intermedio 3', 'INTERMEDIO III' => 'Intermedio 3',
            'Intermedio 4' => 'Intermedio 4',
            'Intermedio 5' => 'Intermedio 5'
        ];

        foreach ($datos_alum as $fila) {

            $carrera = $fila->carrera;
            $nivel = mb_convert_case($fila->nivel, MB_CASE_TITLE, "UTF-8");
            $nivel = $mapa_niveles[$nivel] ?? $nivel;

            if (!in_array($nivel, $niveles)) {
                continue;
            }

            $calificacion = $fila->promedio;

            // Inicializar la estructura de tabla por carrera si no existe
            if (!isset($tabla[$carrera])) {
                $tabla[$carrera] = [
                    'aprobados'   => array_fill_keys($niveles, 0),
                    'reprobados'  => array_fill_keys($niveles, 0),
                    'desertores'  => array_fill_keys($niveles, 0),
                    'total_aprobados'   => 0,
                    'total_reprobados'  => 0,
                    'total_desertores'  => 0,
                    'total_por_carrera' => 0
                ];
            }

            $tabla[$carrera]['total_por_carrera']++;

            if (is_null($calificacion) || $calificacion == 0) {
                $categoria = 'desertores';
                $tabla[$carrera]['desertores'][$nivel]++;
                $tabla[$carrera]['total_desertores']++;
            } elseif ($calificacion >= 70) {
                $categoria = 'aprobados';
                $tabla[$carrera]['aprobados'][$nivel]++;
                $tabla[$carrera]['total_aprobados']++;
            } else {
                $categoria = 'reprobados';
                $tabla[$carrera]['reprobados'][$nivel]++;
                $tabla[$carrera]['total_reprobados']++;
            }

            // Inicializar grupos por categoría, carrera y nivel
            if (!isset($grupos_por_categoria[$categoria][$carrera])) {
                $grupos_por_categoria[$categoria][$carrera] = [];
                foreach ($niveles as $niv) {
                    $grupos_por_categoria[$categoria][$carrera][$niv] = [];
                }
            }

            if (!isset($grupos_por_categoria[$categoria][$carrera][$nivel][$fila->id_grupo])) {
                $grupos_por_categoria[$categoria][$carrera][$nivel][$fila->id_grupo] = [
                    'grupo' => $fila->id_grupo,
                    'total' => 0
                ];
            }

            $grupos_por_categoria[$categoria][$carrera][$nivel][$fila->id_grupo]['total']++;
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
            'aprobados'  => array_sum($totales_por_nivel['aprobados']),
            'reprobados' => array_sum($totales_por_nivel['reprobados']),
            'desertores' => array_sum($totales_por_nivel['desertores']),
        ];

        // Porcentajes por carrera
        foreach ($tabla as $carrera => &$datos) {
            $total = $datos['total_por_carrera'];
            if ($total > 0) {
                $datos['porcentaje_aprobados']  = round(($datos['total_aprobados'] / $total) * 100, 2);
                $datos['porcentaje_reprobados'] = round(($datos['total_reprobados'] / $total) * 100, 2);
                $datos['porcentaje_desertores'] = round(($datos['total_desertores'] / $total) * 100, 2);
            } else {
                $datos['porcentaje_aprobados'] = 0;
                $datos['porcentaje_reprobados'] = 0;
                $datos['porcentaje_desertores'] = 0;
            }
        }
        unset($datos);

        // Porcentaje general
        $total_global = $total_general['aprobados'] + $total_general['reprobados'] + $total_general['desertores'];
        $porcentaje_general = [
            'aprobados'  => $total_global > 0 ? round(($total_general['aprobados'] / $total_global) * 100, 2) : 0,
            'reprobados' => $total_global > 0 ? round(($total_general['reprobados'] / $total_global) * 100, 2) : 0,
            'desertores' => $total_global > 0 ? round(($total_general['desertores'] / $total_global) * 100, 2) : 0,
        ];

        // Porcentaje por nivel (se basa en el total de cada categoría)
        $porcentaje_por_nivel = [
            'aprobados' => [],
            'reprobados' => [],
            'desertores' => [],
        ];

        foreach ($niveles as $nivel) {
            $porcentaje_por_nivel['aprobados'][$nivel] =
                $total_general['aprobados'] > 0 ? round(($totales_por_nivel['aprobados'][$nivel] / $total_general['aprobados']) * 100, 2) : 0;

            $porcentaje_por_nivel['reprobados'][$nivel] =
                $total_general['reprobados'] > 0 ? round(($totales_por_nivel['reprobados'][$nivel] / $total_general['reprobados']) * 100, 2) : 0;

            $porcentaje_por_nivel['desertores'][$nivel] =
                $total_general['desertores'] > 0 ? round(($totales_por_nivel['desertores'][$nivel] / $total_general['desertores']) * 100, 2) : 0;
        }

        return view('ingles.desempeno_academico.niveles', compact(
            'tabla',
            'totales_por_nivel',
            'porcentaje_por_nivel',
            'total_general',
            'grupos_por_categoria',
            'niveles',
            'porcentaje_general',
            'periodo'
        ));

    }

    public  function ver_estadistica_alta_demanda()
    {
        // Obtener periodo actual
        $periodo_ingles=Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');

        $datos_alum_in = DB::select('SELECT 
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
    INNER JOIN (SELECT id_carga_ingles, AVG(calificacion) AS promedio_total
        FROM in_evaluar_calificacion
        WHERE id_unidad IN (1,2,3,4)
        GROUP BY id_carga_ingles) prom 
        ON prom.id_carga_ingles = ing.id_carga_ingles
    WHERE ing.id_nivel NOT IN (11, 12)
      AND ing.id_periodo_ingles = ?
      AND grp.id_grupo_ingles = ing.id_grupo
', [$periodo_ingles]);

        $alumnos_TESVB = DB::select('SELECT eva_carga_academica.id_alumno AS total_alumnos_inscritos 
        FROM eva_carga_academica 
        WHERE eva_carga_academica.id_periodo =? ', [$periodo]);

        //dd($alumnos_TESVB);

        $newCLE = DB::select('SELECT in_carga_academica_ingles.id_alumno from in_carga_academica_ingles where id_periodo_ingles = 13;');

        // Cálculo de las métricas
        $totalumnos= count($datos_alum_in);
        //dd($totalumnos_TESVB);
        $totalAlumnos_TESVB = count($alumnos_TESVB);
        $totalAlumnosCLE = count($newCLE);
        //dd($totalAlumnos);
        $aprobados = 0;
        $reprobados = 0;
        $desertores = 0;
        $promedioTotal = 0;

        foreach ($datos_alum_in as $alumno) {
            // Calcular el promedio total
            $promedioTotal += $alumno->promedio;

            // Contar los alumnos aprobados, reprobados y desertores
            if ($alumno->promedio >= 70) {
                $aprobados++;
            } elseif ($alumno->promedio < 70 && $alumno->promedio > 0) {
                $reprobados++;
            } elseif ($alumno->promedio == 0) {
                $desertores++;
            }
        }

        // Calcular las métricas
        $indice_reprobacion = ($reprobados / $totalumnos) * 100;
        $indice_desercion = ($desertores / $totalumnos) * 100;
        //$atencion_demanda = ($totalumnos / $totalAlumnos_TESVB) * 100;
        $atencion_demanda = $totalAlumnos_TESVB > 0
            ? round(($totalumnos / $totalAlumnos_TESVB) * 100, 2)
            : 0;
        //dd($atencion_demanda);
        $eficiencia_terminal = ($aprobados / ($totalumnos - $totalAlumnosCLE)) * 100;  // Suponiendo 2000 alumnos de nuevo ingreso (N-10)

        // Promedio de la materia
        $promedio_materia = $totalumnos > 0 ? $promedioTotal / $totalumnos : 0;



        return view('ingles.estadisticas.estadisticas_atencion_demanda',compact('periodo_ingles','datos_alum_in','indice_desercion','indice_reprobacion','atencion_demanda','eficiencia_terminal'));
    }

    private function calcularAltaDemanda()
    {
        $periodo_ingles = Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');

        /*$datos_alum_in = DB::select('SELECT
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
    INNER JOIN (SELECT id_carga_ingles, AVG(calificacion) AS promedio_total
        FROM in_evaluar_calificacion
        WHERE id_unidad IN (1,2,3,4)
        GROUP BY id_carga_ingles) prom 
        ON prom.id_carga_ingles = ing.id_carga_ingles
    WHERE ing.id_nivel NOT IN (11, 12)
      AND ing.id_periodo_ingles = ?
      AND grp.id_grupo_ingles = ing.id_grupo
    ', [$periodo_ingles]);*/

        $datos_alum_in = DB::select('SELECT 
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
    INNER JOIN (
        SELECT id_carga_ingles, AVG(calificacion) AS promedio_total
        FROM in_evaluar_calificacion
        WHERE id_unidad IN (1,2,3,4)
        GROUP BY id_carga_ingles
    ) prom ON prom.id_carga_ingles = ing.id_carga_ingles
    WHERE ing.id_nivel NOT IN (11, 12)
      AND ing.id_periodo_ingles = ?
      AND grp.id_grupo_ingles = ing.id_grupo
      AND gr.id_alumno NOT IN (
            SELECT id_alumno 
            FROM in_carga_academica_ingles 
            WHERE id_nivel = 10
      )
', [$periodo_ingles]);


        $alumnos_TESVB = DB::select('SELECT id_alumno 
        FROM eva_carga_academica 
        WHERE id_periodo = ?', [$periodo]);

        $newCLE = DB::select('SELECT id_alumno 
        FROM in_validar_carga 
        WHERE id_periodo = 13');

        $totalumnos = count($datos_alum_in);
        $totalAlumnos_TESVB = count($alumnos_TESVB);

        $atencion_demanda = $totalAlumnos_TESVB > 0
            ? round(($totalumnos / $totalAlumnos_TESVB) * 100, 2)
            : 0;

        return $atencion_demanda;
    }


    public function ver_estadistica_eficiencia_terminal()
    {
        // Obtener periodo actual
        $periodo_ingles=Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');

        $datos_alum_in = DB::select('SELECT DISTINCT
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
      AND inv.id_periodo = ?
      AND inv.id_estado = 2
    ORDER BY gr.id_carrera
', [$periodo_ingles, $periodo_ingles]);


        $alumnos_TESVB = DB::select('SELECT eva_carga_academica.id_alumno AS total_alumnos_inscritos 
        FROM eva_carga_academica 
        WHERE eva_carga_academica.id_periodo =? ', [$periodo]);

        $newCLE = DB::select('SELECT in_carga_academica_ingles.id_alumno from in_carga_academica_ingles where id_periodo_ingles = 13;');

        $totalumnos= count($datos_alum_in);
        //dd($totalumnos_TESVB);
        $totalAlumnos_TESVB = count($alumnos_TESVB);
        $totalAlumnosCLE = count($newCLE);
        //dd($totalAlumnosCLE);
        $aprobados = 0;
        $reprobados = 0;
        $desertores = 0;
        $promedioTotal = 0;

        foreach ($datos_alum_in as $alumno) {
            // Calcular el promedio total
            $promedioTotal += $alumno->promedio;

            // Contar los alumnos aprobados, reprobados y desertores
            if ($alumno->promedio >= 70) {
                $aprobados++;
            } elseif ($alumno->promedio < 70 && $alumno->promedio > 0) {
                $reprobados++;
            } elseif ($alumno->promedio == 0) {
                $desertores++;
            }
        }

        // Calcular las métricas
        $indice_reprobacion = ($reprobados / $totalumnos) * 100;
        $indice_desercion = ($desertores / $totalumnos) * 100;
        $atencion_demanda = ($totalumnos / $totalAlumnos_TESVB) * 100;
        //$eficiencia_terminal = ($aprobados / ($totalumnos - $totalAlumnosCLE)) * 100;
        $eficiencia_terminal = $totalAlumnosCLE > 0
            ? round(($aprobados / $totalAlumnosCLE) * 100, 2)
            : 0;

        //dd($eficiencia_terminal);
        // Promedio de la materia
        $promedio_materia = $totalumnos > 0 ? $promedioTotal / $totalumnos : 0;
        return view('ingles.estadisticas.estadisticas_eficiencia_terminal',
            compact( 'periodo_ingles','datos_alum_in','indice_desercion','indice_reprobacion','atencion_demanda','eficiencia_terminal'));
    }

    private function calcularEficienciaTerminal()
    {
        $periodo_ingles = Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');

        $datos_alum_in = DB::select('SELECT DISTINCT
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
      AND inv.id_periodo = ?
      AND inv.id_estado = 2
    ORDER BY gr.id_carrera
', [$periodo_ingles, $periodo_ingles]);

        $newCLE = DB::select('SELECT id_alumno 
        FROM in_carga_academica_ingles 
        WHERE id_periodo_ingles = 13');

        $totalumnos = count($datos_alum_in);
        //dd($totalumnos);
        $totalAlumnosCLE = count($newCLE);

        $aprobados = 0;

        foreach ($datos_alum_in as $alumno) {
            if ($alumno->promedio >= 70) {
                $aprobados++;
            }
        }

        $eficiencia_terminal = $totalAlumnosCLE > 0
            ? round(($aprobados / $totalAlumnosCLE) * 100, 2)
            : 0;

        return $eficiencia_terminal;
    }


    public function ver_estadisticas_genero()
    {
        $periodo_ingles = Session::get('periodo_ingles');

        // Cálculo de genero
        $alumnos = DB::table('in_validar_carga')
            ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('gnral_semestres', 'gnral_semestres.id_semestre', '=', 'gnral_alumnos.id_semestre')
            ->join('gnral_carreras', 'gnral_carreras.id_carrera', '=', 'gnral_alumnos.id_carrera')
            ->join('in_carga_academica_ingles', 'in_carga_academica_ingles.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_carga_academica_ingles.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_carga_academica_ingles.id_grupo')
            ->where('in_carga_academica_ingles.id_periodo_ingles', $periodo_ingles)
            ->where('in_validar_carga.id_periodo', $periodo_ingles)
            ->where('in_validar_carga.id_estado', 2)
            ->get();

        $contar_m = $alumnos->where('genero', 'M')->count();
        $contar_f = $alumnos->where('genero', 'F')->count();

        // Reutilizamos TUS cálculos reales:
        $atencion_demanda = $this->calcularAltaDemanda();
        $eficiencia_terminal = $this->calcularEficienciaTerminal();

        return view('ingles.estadisticas.estadisticas_genero', compact(
            'contar_m',
            'contar_f',
            'atencion_demanda',
            'eficiencia_terminal'
        ));
    }

    public function excelestadisticas_genero()
    {
        return Excel::download(new Ingles_est_generoExport(), 'Estadisticas_genero.xlsx');
    }


    public function estadisticas_genero(){
        $periodo_ingles=Session::get('periodo_ingles');
        $alumnos = DB::table('in_validar_carga')
            ->join('gnral_alumnos', 'gnral_alumnos.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('gnral_semestres', 'gnral_semestres.id_semestre', '=', 'gnral_alumnos.id_semestre')
            ->join('gnral_carreras', 'gnral_carreras.id_carrera', '=', 'gnral_alumnos.id_carrera')
            ->join('in_carga_academica_ingles', 'in_carga_academica_ingles.id_alumno', '=', 'in_validar_carga.id_alumno')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_carga_academica_ingles.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_carga_academica_ingles.id_grupo')
            ->where('in_carga_academica_ingles.id_periodo_ingles','=',$periodo_ingles)
            ->where('in_validar_carga.id_periodo','=',$periodo_ingles)
            ->where('in_validar_carga.id_estado','=',2)
            ->select('gnral_alumnos.id_alumno','gnral_alumnos.cuenta','gnral_alumnos.nombre','gnral_alumnos.apaterno','gnral_alumnos.amaterno','in_validar_carga.','in_carga_academica_ingles.','in_niveles_ingles.descripcion as nivel_ingles','in_grupo_ingles.descripcion as grupo_ingles','gnral_alumnos.genero','gnral_semestres.descripcion as semestre','gnral_carreras.nombre as carrera')
            ->get();

        $contar_m=0;
        $contar_f=0;
        foreach ($alumnos as $alumno)
        {
            if($alumno->genero == "M"){
                $contar_m++;
            }else{
                $contar_f++;
            }
        }

        $datosAgrupados = [];

        //dd($alumnos);

        foreach ($alumnos as $alumno) {
            $carrera = $alumno->carrera;
            $nivel = $alumno->nivel_ingles;
            $genero = $alumno->genero;

            if (!isset($datosAgrupados[$carrera])) {
                $datosAgrupados[$carrera] = [];
            }

            if (!isset($datosAgrupados[$carrera][$nivel])) {
                $datosAgrupados[$carrera][$nivel] = ['M' => 0, 'F' => 0];
            }

            if ($genero === 'M') {
                $datosAgrupados[$carrera][$nivel]['M']++;
            } else {
                $datosAgrupados[$carrera][$nivel]['F']++;
            }
        }

        return view('ingles.estadisticas.grafica_genero',compact('contar_m','contar_f','datosAgrupados'));

    }

    private function obtenerDatosAlumnos($periodo_ingles)
    {
        return DB::select('SELECT DISTINCT
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
    }

    public function ver_estadisticas_generales()
    {
        $periodo_ingles = Session::get('periodo_ingles');

        $periodo = DB::table('in_periodos')
            ->where('id_periodo_ingles', $periodo_ingles)
            ->first();

        if (!$periodo) {
            abort(404, 'Periodo no encontrado');
        }

        /*$datos_alum = DB::select('SELECT DISTINCT
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
    ORDER BY gr.id_carrera
', [$periodo_ingles]);*/

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
      AND inv.id_periodo = ?
      AND inv.id_estado = 2
    ORDER BY gr.id_carrera
', [$periodo_ingles, $periodo_ingles]);



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

            if (is_null($calificacion) || $fila->promedio == 0) {
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
            'aprobados'  => array_sum($totales_por_nivel['aprobados']),
            'reprobados' => array_sum($totales_por_nivel['reprobados']),
            'desertores' => array_sum($totales_por_nivel['desertores']),
        ];

        // Porcentajes por carrera
        foreach ($tabla as $carrera => &$datos) {
            $total = $datos['total_por_carrera'];
            if ($total > 0) {
                $datos['porcentaje_aprobados']  = round(($datos['total_aprobados'] / $total) * 100, 2);
                $datos['porcentaje_reprobados'] = round(($datos['total_reprobados'] / $total) * 100, 2);
                $datos['porcentaje_desertores'] = round(($datos['total_desertores'] / $total) * 100, 2);
            } else {
                $datos['porcentaje_aprobados'] = 0;
                $datos['porcentaje_reprobados'] = 0;
                $datos['porcentaje_desertores'] = 0;
            }
        }
        unset($datos);

        // Porcentaje general
        $total_global = $total_general['aprobados'] + $total_general['reprobados'] + $total_general['desertores'];

        $porcentaje_general = [
            'aprobados'  => $total_global > 0 ? round(($total_general['aprobados'] / $total_global) * 100, 2) : 0,
            'reprobados' => $total_global > 0 ? round(($total_general['reprobados'] / $total_global) * 100, 2) : 0,
            'desertores' => $total_global > 0 ? round(($total_general['desertores'] / $total_global) * 100, 2) : 0,
        ];

        // Porcentaje por nivel (se basa en el total de cada categoría)
        $porcentaje_por_nivel = [
            'aprobados' => [],
            'reprobados' => [],
            'desertores' => [],
        ];

        foreach ($niveles as $nivel) {
            $porcentaje_por_nivel['aprobados'][$nivel] =
                $total_general['aprobados'] > 0 ?
                    round(($totales_por_nivel['aprobados'][$nivel] / $total_general['aprobados']) * 100, 2) : 0;

            $porcentaje_por_nivel['reprobados'][$nivel] =
                $total_general['reprobados'] > 0 ?
                    round(($totales_por_nivel['reprobados'][$nivel] / $total_general['reprobados']) * 100, 2) : 0;

            $porcentaje_por_nivel['desertores'][$nivel] =
                $total_general['desertores'] > 0 ?
                    round(($totales_por_nivel['desertores'][$nivel] / $total_general['desertores']) * 100, 2) : 0;
        }

        return view('ingles.desempeno_academico.estadisticas_generales', compact(
            'periodo_ingles',
            'periodo',
            'tabla',
            'totales_por_nivel',
            'total_general',
            'porcentaje_general',
            'porcentaje_por_nivel',
            'niveles'
        ));
    }

    public function ver_estadistica_indice_reprobacion()
    {
        // Obtener periodo actual
        $periodo_ingles=Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');

        $datos_alum_in = DB::select('SELECT DISTINCT
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
      AND inv.id_periodo = ?
      AND inv.id_estado = 2
    ORDER BY gr.id_carrera
', [$periodo_ingles, $periodo_ingles]);


        $alumnos_TESVB = DB::select('SELECT eva_carga_academica.id_alumno AS total_alumnos_inscritos 
        FROM eva_carga_academica 
        WHERE eva_carga_academica.id_periodo =? ', [$periodo]);

        $newCLE = DB::select('SELECT in_carga_academica_ingles.id_alumno from in_carga_academica_ingles where id_periodo_ingles = 13;');

        $totalumnos= count($datos_alum_in);
        //dd($totalumnos_TESVB);
        $totalAlumnos_TESVB = count($alumnos_TESVB);
        $totalAlumnosCLE = count($newCLE);
        //dd($totalAlumnosCLE);
        $aprobados = 0;
        $reprobados = 0;
        $desertores = 0;
        $promedioTotal = 0;

        foreach ($datos_alum_in as $alumno) {
            // Calcular el promedio total
            $promedioTotal += $alumno->promedio;

            // Contar los alumnos aprobados, reprobados y desertores
            if ($alumno->promedio >= 70) {
                $aprobados++;
            } elseif ($alumno->promedio < 70 && $alumno->promedio > 0) {
                $reprobados++;
            } elseif ($alumno->promedio == 0) {
                $desertores++;
            }
        }

        // Calcular las métricas
        $indice_reprobacion = ($reprobados / $totalumnos) * 100;
        $indice_desercion = ($desertores / $totalumnos) * 100;
        $atencion_demanda = ($totalumnos / $totalAlumnos_TESVB) * 100;
        //$eficiencia_terminal = ($aprobados / ($totalumnos - $totalAlumnosCLE)) * 100;
        $eficiencia_terminal = $totalAlumnosCLE > 0
            ? round(($aprobados / $totalAlumnosCLE) * 100, 2)
            : 0;

        //dd($eficiencia_terminal);
        // Promedio de la materia
        $promedio_materia = $totalumnos > 0 ? $promedioTotal / $totalumnos : 0;
        return view('ingles.estadisticas.estadisticas_eficiencia_terminal',
            compact( 'periodo_ingles','datos_alum_in','indice_desercion','indice_reprobacion','atencion_demanda','eficiencia_terminal'));
    }


    public function ver_estadistica_indice_desercion()
    {
        // Obtener periodo actual
        $periodo_ingles=Session::get('periodo_ingles');
        $periodo = Session::get('periodo_actual');

        $datos_alum_in = DB::select('SELECT DISTINCT
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
      AND inv.id_periodo = ?
      AND inv.id_estado = 2
    ORDER BY gr.id_carrera
', [$periodo_ingles, $periodo_ingles]);


        $alumnos_TESVB = DB::select('SELECT eva_carga_academica.id_alumno AS total_alumnos_inscritos 
        FROM eva_carga_academica 
        WHERE eva_carga_academica.id_periodo =? ', [$periodo]);

        $newCLE = DB::select('SELECT in_carga_academica_ingles.id_alumno from in_carga_academica_ingles where id_periodo_ingles = 13;');

        $totalumnos= count($datos_alum_in);
        //dd($totalumnos_TESVB);
        $totalAlumnos_TESVB = count($alumnos_TESVB);
        $totalAlumnosCLE = count($newCLE);
        //dd($totalAlumnosCLE);
        $aprobados = 0;
        $reprobados = 0;
        $desertores = 0;
        $promedioTotal = 0;

        foreach ($datos_alum_in as $alumno) {
            // Calcular el promedio total
            $promedioTotal += $alumno->promedio;

            // Contar los alumnos aprobados, reprobados y desertores
            if ($alumno->promedio >= 70) {
                $aprobados++;
            } elseif ($alumno->promedio < 70 && $alumno->promedio > 0) {
                $reprobados++;
            } elseif ($alumno->promedio == 0) {
                $desertores++;
            }
        }

        // Calcular las métricas
        $indice_reprobacion = ($reprobados / $totalumnos) * 100;
        $indice_desercion = ($desertores / $totalumnos) * 100;
        $atencion_demanda = ($totalumnos / $totalAlumnos_TESVB) * 100;
        //$eficiencia_terminal = ($aprobados / ($totalumnos - $totalAlumnosCLE)) * 100;
        $eficiencia_terminal = $totalAlumnosCLE > 0
            ? round(($aprobados / $totalAlumnosCLE) * 100, 2)
            : 0;

        //dd($eficiencia_terminal);
        // Promedio de la materia
        $promedio_materia = $totalumnos > 0 ? $promedioTotal / $totalumnos : 0;
        return view('ingles.estadisticas.estadisticas_eficiencia_terminal',
            compact( 'periodo_ingles','datos_alum_in','indice_desercion','indice_reprobacion','atencion_demanda','eficiencia_terminal'));
    }


}