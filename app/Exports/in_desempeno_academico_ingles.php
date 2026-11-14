<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class in_desempeno_academico_ingles implements FromView
{

    protected $id_nivel,$id_grupo,$id_carrera;

    public function __construct( $id_nivel,$id_grupo,$id_carrera)
    {
        $this->id_nivel=$id_nivel;
        $this->id_grupo=$id_grupo;
        $this->id_carrera=$id_carrera;
    }
    public function view():View
    {
        // Obtener periodo actual
        $periodo_ingles = Session::get('periodo_ingles');

        $niveles = DB::select('SELECT n.id_niveles_ingles, n.descripcion AS nivel, COUNT(ca.id_alumno) AS total_estudiantes
            FROM in_carga_academica_ingles ca
            INNER JOIN in_niveles_ingles n ON n.id_niveles_ingles = ca.id_nivel
            WHERE n.id_niveles_ingles NOT IN (11,12)
            GROUP BY n.id_niveles_ingles, n.descripcion
            ORDER BY n.id_niveles_ingles ASC
        ');

        $grupo_ingles_raw = DB::select('SELECT n.id_niveles_ingles, n.descripcion AS nivel,
           gp.id_grupo_ingles, gp.descripcion AS grupo,
           grc.id_carrera
    FROM in_carga_academica_ingles ca
    INNER JOIN in_niveles_ingles n ON n.id_niveles_ingles = ca.id_nivel
    INNER JOIN in_grupo_ingles gp ON gp.id_grupo_ingles = ca.id_grupo
    INNER JOIN gnral_alumnos al ON al.id_alumno = ca.id_alumno
    INNER JOIN gnral_carreras grc ON grc.id_carrera = al.id_carrera
     INNER JOIN in_periodos inp ON inp.id_periodo_ingles = ca.id_periodo_ingles
    WHERE n.id_niveles_ingles NOT IN (11,12)
    AND ca.id_periodo_ingles = ?
    GROUP BY n.id_niveles_ingles, n.descripcion, gp.id_grupo_ingles, gp.descripcion, grc.id_carrera
    ORDER BY n.id_niveles_ingles ASC
', [$periodo_ingles]);
//dd($niveles,$carreras_ingles);

        // Organizar grupos por nivel y carrera
        $gruposPorNivelCarrera = [];
        foreach($grupo_ingles_raw as $g){
            $gruposPorNivelCarrera[$g->id_niveles_ingles][$g->id_carrera][] = [
                'id_grupo' => $g->id_grupo_ingles,
                'descripcion' => $g->grupo
            ];
        }

        // Obtener los datos de los alumnos
        $datos_alum_in = DB::select('SELECT gr.cuenta, gr.nombre, gr.apaterno, gr.amaterno, 
       gr.id_carrera AS id_carrera, ing.id_nivel AS id_nivel, niv.descripcion AS nivel,
       ing.id_grupo AS id_grupo, gr.genero, grc.nombre AS carrera, 
       in_ev.calificacion AS promedio
        FROM gnral_alumnos gr
        INNER JOIN in_carga_academica_ingles ing ON ing.id_alumno = gr.id_alumno
        INNER JOIN in_niveles_ingles niv ON ing.id_nivel = niv.id_niveles_ingles
        INNER JOIN in_grupo_ingles grp ON ing.id_grupo = grp.id_grupo_ingles
        INNER JOIN gnral_carreras grc ON grc.id_carrera = gr.id_carrera
        INNER JOIN in_periodos inp ON inp.id_periodo_ingles = ing.id_periodo_ingles
        INNER JOIN in_evaluar_calificacion in_ev ON in_ev.id_carga_ingles = ing.id_carga_ingles
        WHERE in_ev.id_evaluar_calificacion = (
            SELECT MAX(id_evaluar_calificacion) 
            FROM in_evaluar_calificacion 
            WHERE id_carga_ingles = ing.id_carga_ingles
        )
        AND ing.id_nivel = ?
        AND ing.id_grupo = ?
        AND gr.id_carrera = ?
        AND ing.id_periodo_ingles = ?
        ORDER BY gr.id_carrera, ing.id_grupo',
            [
                $this->id_nivel,
                $this->id_grupo,
                $this->id_carrera,
                $periodo_ingles
            ]);


        // Cálculo de las métricas
        $totalAlumnos = count($datos_alum_in);
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
        $indice_reprobacion = $totalAlumnos ? ($reprobados / $totalAlumnos) * 100 : 0;
        $indice_desercion = $totalAlumnos ? ($desertores / $totalAlumnos) * 100 : 0;
        $atencion_demanda = ($totalAlumnos / 2307) * 100;  // Suponiendo 2307 alumnos susceptibles
        $eficiencia_terminal = ($aprobados / 2000) * 100;  // Suponiendo 2000 alumnos de nuevo ingreso (N-10)

        // Promedio de la materia
        $promedio_materia = $totalAlumnos > 0 ? $promedioTotal / $totalAlumnos : 0;

        // Pasar los datos y métricas a la vista
        return view('ingles.desempeno_academico.concentrado_ingles_desempeno', compact(
            'datos_alum_in',
            'indice_reprobacion',
            'indice_desercion',
            'atencion_demanda',
            'eficiencia_terminal',
            'promedio_materia',
            'periodo_ingles',
            'niveles',
            'gruposPorNivelCarrera',
            'grupo_ingles_raw'
        ));
    }
}
