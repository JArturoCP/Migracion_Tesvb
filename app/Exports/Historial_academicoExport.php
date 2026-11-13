<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;
class Historial_academicoExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $id_alumno;
    protected $id_plan;
    protected $id_especialidad;
    protected $calificada;

    public function __construct($id_alumno,$id_plan,$id_especialidad,$calificada){

        $this->id_alumno=$id_alumno;
        $this->id_plan=$id_plan;
        $this->id_especialidad=$id_especialidad;
        $this->calificada=$calificada;
    }
    public function view(): View
    {
        ini_set('max_execution_time', 0); // 300 segundos (5 minutos)
        set_time_limit(0); // Alternativa si ini_set no funciona

        $id_alumno=  $this->id_alumno;
        $calificada=$this->calificada;
        $especialidad=DB::selectOne('SELECT * FROM `cal_especialidad` WHERE `id_especialidad` = ? ', [$this->id_especialidad]);
        $especialidad=$especialidad->especialidad;
        $plan=DB::selectOne('SELECT * FROM `cal_plan` WHERE `id_plan` = ? ', [$this->id_plan]);
        $plan=$plan->plan;

        $alumno=DB::selectOne('SELECT gnral_alumnos.*, gnral_carreras.nombre carrera from gnral_carreras,gnral_alumnos where gnral_alumnos.id_carrera=gnral_carreras.id_carrera and gnral_alumnos.id_alumno= ?', [$id_alumno]);
        $nombre=mb_strtoupper($alumno->apaterno,'utf-8')." ".mb_strtoupper($alumno->amaterno,'utf-8')." ".mb_strtoupper($alumno->nombre,'utf-8');
        $no_cuenta=mb_strtoupper($alumno->cuenta);
        $carrera=mb_strtoupper($alumno->carrera);
        $id_periodo=Session::get('periodotrabaja');

        if ($calificada == 1) {
           $materias_rep = DB::select('SELECT distinct gnral_materias.id_materia from eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
 where eva_validacion_de_cargas.id_alumno= ? and eva_carga_academica.id_status_materia=1
 and eva_carga_academica.id_materia NOT IN (773,817,845,853,1160,1263,1264,1265,1443,1496,1565,1566,1567,1568,1569,1571,2516,2517,2614)
 and eva_validacion_de_cargas.estado_validacion in (2,8,9,10) and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
  and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
  and gnral_periodos.id_periodo >= 20 and eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno]);
//dd($materias_rep);
            $materias = array();
            foreach ($materias_rep as $materias_rep) {
                $contar_mat = DB::selectOne('SELECT  count(gnral_materias.id_materia) contar_materia FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                        WHERE eva_validacion_de_cargas.id_alumno= ?
                                                        AND eva_carga_academica.id_status_materia=1
                                                        AND eva_carga_academica.id_materia= ?
                                                        AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10)
                                                        AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                        AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                                                        AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                                                        AND gnral_periodos.id_periodo >= 20 and eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $materias_rep->id_materia]);
                if ($contar_mat->contar_materia > 1) {
                    $max_periodo = DB::selectOne('SELECT  max(eva_validacion_de_cargas.id_periodo) periodo  FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                          WHERE eva_validacion_de_cargas.id_alumno= ?
                                                          AND eva_carga_academica.id_status_materia=1
                                                          AND eva_carga_academica.id_materia= ?
                                                          AND eva_validacion_de_cargas.estado_validacion in (2,8,9,10)
                                                           AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                           AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                                                           AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                                                           AND gnral_periodos.id_periodo >= 20
                                                           AND eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $materias_rep->id_materia]);
                    $max = DB::selectOne('SELECT  eva_carga_academica.id_carga_academica   FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                 WHERE eva_validacion_de_cargas.id_alumno= ?
                                                 AND eva_carga_academica.id_status_materia=1
                                                 AND eva_carga_academica.id_materia= ?
                                                 AND eva_validacion_de_cargas.estado_validacion in (2,8,9,10)
                                                 AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                 AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                                                 AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                                                 AND gnral_periodos.id_periodo = ?
                                                 AND eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $materias_rep->id_materia, $max_periodo->periodo]);
//dd($max);
                    $materias_n = DB::selectOne("SELECT gm.*, eca.id_tipo_curso,eca.id_carga_academica, gp.year,gp.siglas, gp.id_periodo,
                    CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        END AS tipo_alumno
                            FROM eva_carga_academica eca
                                JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                JOIN gnral_periodos gp ON eca.id_periodo = gp.id_periodo
                                    WHERE eca.id_carga_academica = ?
                                        ORDER BY gm.id_semestre ASC",[$max->id_carga_academica]);
                    $alumnos_materia['id_carga_academica'] = $materias_n->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_n->id_materia;
                    $alumnos_materia['unidades'] = $materias_n->unidades;
                    $alumnos_materia['clave'] = $materias_n->clave;
                    $alumnos_materia['nombre_materia'] = $materias_n->nombre;
                    $alumnos_materia['creditos'] = $materias_n->creditos;
                    $alumnos_materia['periodo'] = $materias_n->siglas;
                    $alumnos_materia['year'] = $materias_n->year;
                    $alumnos_materia['id_semestre'] = $materias_n->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_n->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_n->tipo_alumno;
                    //dd($materias_n);
                } else {
                    $materias_o = DB::selectOne("SELECT gm.*, eca.id_tipo_curso, eca.id_carga_academica, gp.year, gp.siglas, gp.id_periodo,
                    CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        END AS tipo_alumno
                            FROM eva_validacion_de_cargas evc
                                INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno
                                AND evc.id_periodo = eca.id_periodo
                                INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                                WHERE evc.id_alumno = ?
                                    AND eca.id_status_materia = 1
                                    AND eca.id_materia = ?
                                    AND evc.estado_validacion IN (2,8,9,10)
                                    AND gp.id_periodo >= 20
                                ORDER BY gm.id_semestre ASC", [$id_alumno, $materias_rep->id_materia]);

                    $alumnos_materia['id_carga_academica'] = $materias_o->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_o->id_materia;
                    $alumnos_materia['unidades'] = $materias_o->unidades;
                    $alumnos_materia['clave'] = $materias_o->clave;
                    $alumnos_materia['nombre_materia'] = $materias_o->nombre;
                    $alumnos_materia['creditos'] = $materias_o->creditos;
                    $alumnos_materia['periodo'] = $materias_o->siglas;
                    $alumnos_materia['year'] = $materias_o->year;
                    $alumnos_materia['id_semestre'] = $materias_o->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_o->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_o->tipo_alumno;
                }
                array_push($materias, $alumnos_materia);

            }
        } elseif ($calificada == 2) {
             $materias_rep = DB::select('SELECT distinct gnral_materias.id_materia from eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
 where eva_validacion_de_cargas.id_alumno= ? and eva_carga_academica.id_status_materia=1
and eva_carga_academica.id_materia NOT IN (773,817,845,853,1160,1263,1264,1265,1443,1496,1565,1566,1567,1568,1569,1571,2516,2517,2614)
 and eva_validacion_de_cargas.estado_validacion in (2,8,9,10) and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
  and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
  and gnral_periodos.id_periodo >= 20 and  gnral_periodos.id_periodo < ? and eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $id_periodo]);

            $materias = array();
            foreach ($materias_rep as $materias_rep) {
                $contar_mat = DB::selectOne('SELECT  count(gnral_materias.id_materia) contar_materia FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                        WHERE eva_validacion_de_cargas.id_alumno= ?
                                                        AND eva_carga_academica.id_status_materia=1
                                                        AND eva_carga_academica.id_materia= ?
                                                        AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10)
                                                        AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                        AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                                                        AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                                                        AND gnral_periodos.id_periodo >= 20
                                                        AND  gnral_periodos.id_periodo < ?
                                                        AND eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $materias_rep->id_materia, $id_periodo]);

                if ($contar_mat->contar_materia > 1) {
                    $max_periodo = DB::selectOne('SELECT max(eva_validacion_de_cargas.id_periodo) periodo FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                        WHERE eva_validacion_de_cargas.id_alumno= ?
                                                        AND eva_carga_academica.id_status_materia=1
                                                        AND eva_carga_academica.id_materia= ?
                                                        AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10)
                                                        AND eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                        AND eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                                                        AND eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                                                        AND gnral_periodos.id_periodo >= 20
                                                        AND gnral_periodos.id_periodo < ?
                                                        AND eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $materias_rep->id_materia, $id_periodo]);

                    $max = DB::selectOne('SELECT  eva_carga_academica.id_carga_academica  FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                                where eva_validacion_de_cargas.id_alumno= ?
                                                and eva_carga_academica.id_status_materia=1
                                                and eva_carga_academica.id_materia= ?
                                                and eva_validacion_de_cargas.estado_validacion in (2,8,9,10)
                                                and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
                                                and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo
                                                and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
                                                and gnral_periodos.id_periodo = ?
                                                and eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno, $materias_rep->id_materia, $max_periodo->periodo]);

                    $materias_n = DB::selectOne("SELECT gm.*, eca.id_tipo_curso,eca.id_carga_academica, gp.year,gp.siglas, gp.id_periodo,
                    CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        END AS tipo_alumno
                            FROM eva_carga_academica eca
                                JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                JOIN gnral_periodos gp ON eca.id_periodo = gp.id_periodo
                                    WHERE eca.id_carga_academica = ?
                                        ORDER BY gm.id_semestre ASC",[$max->id_carga_academica]);
                    $alumnos_materia['id_carga_academica'] = $materias_n->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_n->id_materia;
                    $alumnos_materia['unidades'] = $materias_n->unidades;
                    $alumnos_materia['clave'] = $materias_n->clave;
                    $alumnos_materia['nombre_materia'] = $materias_n->nombre;
                    $alumnos_materia['creditos'] = $materias_n->creditos;
                    $alumnos_materia['periodo'] = $materias_n->siglas;
                    $alumnos_materia['year'] = $materias_n->year;
                    $alumnos_materia['id_semestre'] = $materias_n->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_n->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_n->tipo_alumno;
                    $alumnos_materia['id_carga_academica'] = $materias_n->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_n->id_materia;
                    $alumnos_materia['unidades'] = $materias_n->unidades;
                    $alumnos_materia['clave'] = $materias_n->clave;
                    $alumnos_materia['nombre_materia'] = $materias_n->nombre;
                    $alumnos_materia['creditos'] = $materias_n->creditos;
                    $alumnos_materia['periodo'] = $materias_n->siglas;
                    $alumnos_materia['year'] = $materias_n->year;
                    $alumnos_materia['id_semestre'] = $materias_n->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_n->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_n->tipo_alumno;

                } else {
                    $materias_o = DB::selectOne("SELECT gm.*, eca.id_tipo_curso, eca.id_carga_academica, gp.year, gp.siglas, gp.id_periodo,
                    CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        END AS tipo_alumno
                            FROM eva_validacion_de_cargas evc
                                INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno
                                AND evc.id_periodo = eca.id_periodo
                                INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                                WHERE evc.id_alumno = ?
                                    AND eca.id_status_materia = 1
                                    AND eca.id_materia = ?
                                    AND evc.estado_validacion IN (2,8,9,10)
                                    AND gp.id_periodo >= 20
                                ORDER BY gm.id_semestre ASC", [$id_alumno, $materias_rep->id_materia]);
                    $alumnos_materia['id_carga_academica'] = $materias_o->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materias_o->id_materia;
                    $alumnos_materia['unidades'] = $materias_o->unidades;
                    $alumnos_materia['clave'] = $materias_o->clave;
                    $alumnos_materia['nombre_materia'] = $materias_o->nombre;
                    $alumnos_materia['creditos'] = $materias_o->creditos;
                    $alumnos_materia['periodo'] = $materias_o->siglas;
                    $alumnos_materia['year'] = $materias_o->year;
                    $alumnos_materia['id_semestre'] = $materias_o->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materias_o->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materias_o->tipo_alumno;

                }
                array_push($materias, $alumnos_materia);
            }

        }
        //dd($materias,$alumnos_materia);

        $suma_promedio_final = 0;
        $suma_materia = 0;
        $alumnos = array();

        foreach ($materias as $mat) {
            $suma_materia++;
            $datos_alumnos['numero'] = $suma_materia;
            $datos_alumnos['id_carga_academica'] = $mat['id_carga_academica'];
            $datos_alumnos['id_materia'] = $mat['id_materia'];
            $datos_alumnos['nombre_materia'] = $mat['nombre_materia'];
            $datos_alumnos['id_semestre'] = $mat['id_semestre'];
            $datos_alumnos['clave'] = $mat['clave'];
            $datos_alumnos['creditos'] = $mat['creditos'];
            $datos_alumnos['periodo'] = $mat['periodo'];
            $datos_alumnos['year'] = $mat['year'];
            $datos_alumnos['id_tipo_curso'] = $mat['id_tipo_curso'];
            $datos_alumnos['tipo_alumno'] = $mat['tipo_alumno'];

            // --- Consultas ---
            $materia_promedio = DB::selectOne('SELECT SUM(calificacion) suma FROM cal_evaluaciones WHERE id_carga_academica = ? AND calificacion >= 70', [$mat['id_carga_academica']]);
            $materia_promedio = $materia_promedio->suma ?? 0;

            $contar_unidades_pasadas = DB::selectOne('SELECT COUNT(calificacion) suma FROM cal_evaluaciones WHERE id_carga_academica = ? AND calificacion >= 70', [$mat['id_carga_academica']]);
            $contar_unidades_pasadas = $contar_unidades_pasadas->suma ?? 0;

            $contar_sumativa = DB::selectOne('SELECT COUNT(esc) contar FROM cal_evaluaciones WHERE id_carga_academica = ? AND esc = 1', [$mat['id_carga_academica']]);
            $contar_sumativa = $contar_sumativa->contar ?? 0;

            // --- Inicializa promedio y te ---
            $promedio = 0;
            $te = '';

            if ($contar_unidades_pasadas == $mat['unidades']) {
                // Calcular promedio solo si aprobó todas las unidades
                if ($contar_unidades_pasadas > 0) {
                    $promedio = round($materia_promedio / $contar_unidades_pasadas);
                }

                if ($mat['id_tipo_curso'] == 1) {
                    $te = ($contar_sumativa == 0) ? 'O' : 'ESC';
                } elseif ($mat['id_tipo_curso'] == 2) {
                    $te = ($contar_sumativa == 0) ? 'O2' : 'ESC2';
                } elseif ($mat['id_tipo_curso'] == 3) {
                    $te = ($contar_sumativa == 0) ? 'CE' : 'EG';
                } elseif ($mat['id_tipo_curso'] == 4) {
                    $te = 'CG';
                }
            } else {
                // No aprobó todas las unidades → promedio 0
                $promedio = 0;

                if ($mat['id_tipo_curso'] == 1) $te = 'ESC';
                if ($mat['id_tipo_curso'] == 2) $te = 'ESC2';
                if ($mat['id_tipo_curso'] == 3) $te = 'CE';
                if ($mat['id_tipo_curso'] == 4) $te = 'EG';
            }

            // --- Ajuste final según tipo de alumno ---
            if ($mat['tipo_alumno'] == 'CON') {
                $te = 'CON';
            } elseif ($mat['tipo_alumno'] == 'REE') {
                $te = 'REE';
            }

            $datos_alumnos['promedio'] = $promedio;
            $datos_alumnos['te'] = $te;
            array_push($alumnos, $datos_alumnos);
        }

        $suma_mat = 0;
        $promedio_final = 0;
        $contar_creditos = 0;
        $materias_actualizadas = array();
        $datos_residencia = array();
        $datos_servicio = array();
        $datos_actividades = array();
        foreach ($alumnos as $alum) {
            $eliminacion_mat = DB::selectOne('SELECT COUNT(id_carga_academica) total FROM cal_eliminacion_materia WHERE id_carga_academica= ?', [$alum['id_carga_academica']]);
            if ($eliminacion_mat->total == 0) {
                $suma_mat++;
                $datos_alu['numero'] = $suma_materia;
                $datos_alu['id_carga_academica'] = $alum['id_carga_academica'];
                $datos_alu['id_materia'] = $alum['id_materia'];
                $datos_alu['nombre_materia'] = $alum['nombre_materia'];
                $datos_alu['id_semestre'] = $alum['id_semestre'];
                $datos_alu['clave'] = $alum['clave'];
                if ($alum['promedio'] < 70) {
                    $datos_alu['creditos'] = 0;
                } else {
                    $datos_alu['creditos'] = $alum['creditos'];
                    $contar_creditos += $alum['creditos'];
                }
                $datos_alu['promedio'] = $alum['promedio'];
                $datos_alu['periodo'] = $alum['periodo'];
                $datos_alu['year'] = $alum['year'];
                $datos_alu['id_tipo_curso'] = $alum['id_tipo_curso'];
                $datos_alu['tipo_alumno'] = $alum['tipo_alumno'];
                $datos_alu['esc'] = $alum['te'];
                $promedio_final += $alum['promedio'];

                array_push($materias_actualizadas, $datos_alu);
            }

        }

        $residencia=DB::selectOne('SELECT count(id_cal_residencia) residencia FROM cal_residencia WHERE id_alumno= ?', [$id_alumno]);
        $residencia=$residencia->residencia;
        if($residencia == 0){
            //dd($residencia);
            $datos_residencia2=DB::selectOne('SELECT count(id_evaluacion) eval FROM cal_evaluaciones where id_carga_academica in
                                                (select id_carga_academica from eva_carga_academica where id_alumno= ? and
                                                id_materia  IN  (773,817,845,853,1160,1263,1264,1265,1443,1496,1565,1566,1567,1568,1569,1571,2516,2517,2614))', [$id_alumno]);

            $residencia=$datos_residencia2->eval;
            if($residencia==0){
                $resi=0;
                $datos_residencia=0;
                //  $fecha_re=0;
            }else{
                $datos_residencia=DB::selectOne('SELECT calificacion, created_at as fecha_termino FROM cal_evaluaciones where id_carga_academica in
                                                (select id_carga_academica from eva_carga_academica where id_alumno= ? and
                                                id_materia  IN  (773,817,845,853,1160,1263,1264,1265,1443,1496,1565,1566,1567,1568,1569,1571,2516,2517,2614))', [$id_alumno]);
                $promedio_residencia=$datos_residencia->calificacion;
                $promedio_final=$promedio_final+$promedio_residencia;
                // dd($promedio_final);
                $suma_mat++;
            }

            // $resi=0;
            /// $datos_residencia=0;
            //  $fecha_re=0;

        }
        else{

            $resi=10;
            $datos_residencia=DB::selectOne('SELECT * FROM cal_residencia WHERE id_alumno= ?', [$id_alumno]);
            $promedio_residencia=$datos_residencia->calificacion;
            $promedio_final=$promedio_final+$promedio_residencia;
            $suma_mat++;
            if($promedio_residencia >= 70){
                $contar_creditos=$contar_creditos+$resi;
            }

        }

        $servicio_social=DB::selectOne('SELECT count(id_servicio_social) servicio FROM cal_servicio_social WHERE id_alumno= ?', [$id_alumno]);
        $servicio_social=$servicio_social->servicio;
        if($servicio_social == 0){
            $servicio=0;
            $datos_servicio=0;
            $fecha_s=0;

        }
        else{
            $servicio=10;
            $datos_servicio=DB::selectOne('SELECT *FROM cal_servicio_social WHERE id_alumno= ?', [$id_alumno]);
            $promedio_servicio=$datos_servicio->calificacion;
            $promedio_final=$promedio_final+$promedio_servicio;
            $suma_mat++;
            if($promedio_servicio >= 70) {
                $contar_creditos = $contar_creditos + $servicio;
            }
        }


        $actividades_complementaria=DB::selectOne('SELECT count(id_actividades_comple)actividades from cal_actividades_complementarias WHERE id_alumno= ?', [$id_alumno]);
        $actividades_complementaria=$actividades_complementaria->actividades;
        if($actividades_complementaria == 0){
            $actividades=0;
            $datos_actividades=0;
        }
        else{
            $actividades=5;
            $datos_actividades=DB::selectOne('SELECT *from cal_actividades_complementarias WHERE id_alumno= ?', [$id_alumno]);

            $contar_creditos=$contar_creditos+$actividades;
        }

//dd($suma_mat);
        if($promedio_final == 0)
        {
            $promedio_f=0;
        }
        else{
            $promedio_f=($promedio_final/$suma_mat);
            $promedio_f = number_format($promedio_f, 2, '.', ' ');
        }
        $especialidad=mb_strtoupper($especialidad);
        $plan=mb_strtoupper($plan);
        $fechas = date("Y-m-d");

        // Asegúrate de que $id_alumno esté definido previamente
        if (isset($id_alumno)) {
            // Obtener el folio del alumno específico
            $folio = DB::selectOne('SELECT folio FROM gnral_alumnos WHERE id_alumno = ?', [$id_alumno]);

            // Verificar si se obtuvo un resultado
            if ($folio && isset($folio->folio)) {
                $folio_text = $folio->folio;
            } else {
                $folio_text = 'Folio no disponible';
            }
        } else {
            // Manejo en caso de que $id_alumno no esté definido
            $folio_text = 'Folio no disponible (ID de alumno no especificado)';
        }




        return view('servicios_escolares.historial_academico.excel_historial_academico',compact('no_cuenta','nombre','carrera','materias_actualizadas',
            'datos_residencia','residencia','servicio','datos_servicio','actividades','datos_actividades','contar_creditos','contar_creditos','promedio_f'));

    }
}
