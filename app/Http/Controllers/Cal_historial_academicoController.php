<?php

namespace App\Http\Controllers;

use App\Exports\Historial_academicoExport;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Cal_historial_academicoController extends Controller {
    public function index() {
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();
        return view('servicios_escolares.historial_academico.historial_carreras', compact('carreras'));
    }

    public function historial_academico($id_carrera) {
        $carr = DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = ?', [$id_carrera]);
        $nombre_carrera = $carr->nombre;
        $alumnos=DB::select('SELECT gnral_alumnos.* FROM eva_validacion_de_cargas,gnral_alumnos WHERE eva_validacion_de_cargas.id_alumno=gnral_alumnos.id_alumno
        AND eva_validacion_de_cargas.id_periodo >=20 AND gnral_alumnos.id_carrera= ? GROUP BY gnral_alumnos.id_alumno
        ORDER BY gnral_alumnos.apaterno ASC,gnral_alumnos.amaterno   ASC,gnral_alumnos.nombre   ASC', [$id_carrera]);
        return view('servicios_escolares.historial_academico.historial_alumnos', compact('nombre_carrera', 'alumnos'));
    }

    public function historial_alumno($id_alumno, $calificada) {
        $id_periodo = Session::get('periodotrabaja');
        $alumno_data = DB::selectOne('SELECT * FROM gnral_alumnos WHERE id_alumno = ?',[$id_alumno]);
        $alumno = $alumno_data->cuenta . " "
        . mb_strtoupper($alumno_data->apaterno, 'utf-8') . " "
        . mb_strtoupper($alumno_data->amaterno, 'utf-8') . " "
        . mb_strtoupper($alumno_data->nombre, 'utf-8');
        $id_carrera_data = DB::selectOne('SELECT id_carrera FROM gnral_alumnos WHERE id_alumno = ?',[$id_alumno]);
        $id_carrera = $id_carrera_data->id_carrera;
        $especialidad = DB::select('SELECT * FROM cal_especialidad WHERE id_carrera = ?',[$id_carrera]);
        $plan = DB::select('SELECT * FROM cal_plan WHERE id_carrera = ?',[$id_carrera]);
        $especialidad2 = DB::select('SELECT * FROM cal_especialidad WHERE id_carrera = ?',[$id_carrera]);
        $plan2 = DB::select('SELECT * FROM cal_plan WHERE id_carrera = ?',[$id_carrera]);
        $materias_excluidas = [773, 817, 845, 853, 1160, 1263, 1264, 1265, 1443, 1496, 1502, 1565, 1566, 1567, 1568, 1569, 1571, 2516, 2517, 2614, 2250];
        $marcadores_excluidas = implode(',', array_fill(0, count($materias_excluidas), '?'));
        $materias = array();
        if ($calificada == 1) {
            $materias_rep = DB::select(" SELECT eca.id_carga_academica,gm.id_materia,gm.unidades, gm.clave, gm.nombre AS nombre_materia,
            gm.creditos, gp.siglas AS periodo, gp.year, gm.id_semestre, eca.id_tipo_curso,
                CASE
                WHEN eca.tipo_alumno = 'C' THEN 'CON'
                WHEN eca.tipo_alumno = 'R' THEN 'REE'
                ELSE ''
                END AS tipo_alumno
                FROM eva_validacion_de_cargas evc
                INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno AND evc.id_periodo = eca.id_periodo
                INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                WHERE evc.id_alumno = ?
                AND eca.id_status_materia = 1 AND eca.id_materia NOT IN ($marcadores_excluidas)
                AND gp.id_periodo >= 20 AND gp.id_periodo < ?
                AND evc.id_periodo = (SELECT MAX(evc2.id_periodo) FROM eva_validacion_de_cargas evc2
                INNER JOIN eva_carga_academica eca2 ON evc2.id_alumno = eca2.id_alumno AND evc2.id_periodo = eca2.id_periodo
                WHERE evc2.id_alumno = evc.id_alumno AND eca2.id_materia = eca.id_materia AND eca2.id_status_materia = 1 AND evc2.id_periodo >= 20 AND evc2.id_periodo < ?)
                AND evc.estado_validacion IN (2,8,9,10) ORDER BY gm.id_semestre ASC, gm.nombre ASC ", [$id_alumno, ...$materias_excluidas, $id_periodo, $id_periodo]);

                foreach ($materias_rep as $materia) {
                    $alumnos_materia = array();
                    $alumnos_materia['id_carga_academica'] = $materia->id_carga_academica;
                    $alumnos_materia['id_materia'] = $materia->id_materia;
                    $alumnos_materia['unidades'] = $materia->unidades;
                    $alumnos_materia['clave'] = $materia->clave;
                    $alumnos_materia['nombre_materia'] = $materia->nombre_materia;
                    $alumnos_materia['creditos'] = $materia->creditos;
                    $alumnos_materia['periodo'] = $materia->periodo;
                    $alumnos_materia['year'] = $materia->year;
                    $alumnos_materia['id_semestre'] = $materia->id_semestre;
                    $alumnos_materia['id_tipo_curso'] = $materia->id_tipo_curso;
                    $alumnos_materia['tipo_alumno'] = $materia->tipo_alumno;
                    $materias[] = $alumnos_materia;
                    }
                    } elseif ($calificada == 2) {
                        $materias_rep = DB::select("SELECT eca.id_carga_academica,gm.id_materia,gm.unidades,gm.clave,gm.nombre AS nombre_materia,gm.creditos,gp.siglas AS periodo,
                        gp.year,gm.id_semestre,eca.id_tipo_curso,
                        CASE
                        WHEN eca.tipo_alumno = 'C' THEN 'CON'
                        WHEN eca.tipo_alumno = 'R' THEN 'REE'
                        ELSE ''
                        END AS tipo_alumno
                        FROM eva_validacion_de_cargas evc
                        INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno  AND evc.id_periodo = eca.id_periodo
                        INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                        INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                        WHERE evc.id_alumno = ? AND eca.id_status_materia = 1 AND eca.id_materia NOT IN ($marcadores_excluidas)
                        AND gp.id_periodo >= 20 AND gp.id_periodo < ?
                         AND evc.id_periodo = (SELECT MAX(evc2.id_periodo) FROM eva_validacion_de_cargas evc2
                         INNER JOIN eva_carga_academica eca2 ON evc2.id_alumno = eca2.id_alumno AND evc2.id_periodo = eca2.id_periodo
                         WHERE evc2.id_alumno = evc.id_alumno AND eca2.id_materia = eca.id_materia AND eca2.id_status_materia = 1
                         AND evc2.id_periodo >= 20 AND evc2.id_periodo < ?)
                         AND evc.estado_validacion IN (2,8,9,10)ORDER BY gm.id_semestre ASC,gm.nombre ASC", [$id_alumno, ...$materias_excluidas, $id_periodo, $id_periodo]);

                         foreach ($materias_rep as $materia_rep) {
                            $contar_mat = DB::selectOne("SELECT COUNT(gnral_materias.id_materia) AS contar_materia FROM eva_validacion_de_cargas, eva_carga_academica, gnral_materias, gnral_periodos
                            WHERE eva_validacion_de_cargas.id_alumno = ? AND eva_carga_academica.id_status_materia = 1 AND eva_carga_academica.id_materia = ? AND eva_validacion_de_cargas.estado_validacion
                            IN (2,8,9,10) AND eva_validacion_de_cargas.id_alumno = eva_carga_academica.id_alumno AND eva_validacion_de_cargas.id_periodo = eva_carga_academica.id_periodo
                            AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo AND gnral_periodos.id_periodo >= 20 AND gnral_periodos.id_periodo < ? AND eva_carga_academica.id_materia = gnral_materias.id_materia
                            ", [$id_alumno,$materia_rep->id_materia,$id_periodo]);

                            if ($contar_mat->contar_materia > 1) {
                                $max_periodo = DB::selectOne(" SELECT MAX(eva_validacion_de_cargas.id_periodo) AS periodo FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                WHERE eva_validacion_de_cargas.id_alumno = ? AND eva_carga_academica.id_status_materia = 1 AND eva_carga_academica.id_materia = ?
                                AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10) AND eva_validacion_de_cargas.id_alumno = eva_carga_academica.id_alumno
                                AND eva_validacion_de_cargas.id_periodo =eva_carga_academica.id_periodo AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo
                                AND gnral_periodos.id_periodo >= 20 AND gnral_periodos.id_periodo < ? AND eva_carga_academica.id_materia = gnral_materias.id_materia", [$id_alumno,$materia_rep->id_materia,$id_periodo]);

                                $max = DB::selectOne(" SELECT eva_carga_academica.id_carga_academica FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                WHERE eva_validacion_de_cargas.id_alumno = ? AND eva_carga_academica.id_status_materia = 1 AND eva_carga_academica.id_materia = ?
                                AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10) AND eva_validacion_de_cargas.id_alumno = eva_carga_academica.id_alumno
                                AND eva_validacion_de_cargas.id_periodo = eva_carga_academica.id_periodo AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo
                                AND gnral_periodos.id_periodo = ? AND eva_carga_academica.id_materia = gnral_materias.id_materia ", [$id_alumno,$materia_rep->id_materia,$max_periodo->periodo]);

                                $materias_n = DB::selectOne("SELECT gm.*,eca.id_tipo_curso,eca.id_carga_academica,gp.year,gp.siglas,gp.id_periodo,
                                CASE WHEN eca.tipo_alumno = 'C' THEN 'CON' WHEN eca.tipo_alumno = 'R' THEN 'REE' ELSE '' END AS tipo_alumno
                                FROM eva_carga_academica eca
                                JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                JOIN gnral_periodos gp ON eca.id_periodo = gp.id_periodo
                                WHERE eca.id_carga_academica = ? ORDER BY gm.id_semestre ASC", [$max->id_carga_academica]);

                                $alumnos_materia = array();
                                $alumnos_materia['id_carga_academica'] = $materias_n->id_carga_academica;
                                $alumnos_materia['id_materia'] = $materias_n->id_materia;
                                $alumnos_materia['unidades'] = $materias_n->unidades;
                                $alumnos_materia['clave'] = $materias_n->clave;
                                $alumnos_materia['nombre_materia'] = $materias_n->nombre;
                                $alumnos_materia['creditos'] = $materias_n->creditos;
                                $alumnos_materia['periodo'] =  $materias_n->siglas;
                                $alumnos_materia['year'] = $materias_n->year;
                                $alumnos_materia['id_semestre'] = $materias_n->id_semestre;
                                $alumnos_materia['id_tipo_curso'] =  $materias_n->id_tipo_curso;
                                $alumnos_materia['tipo_alumno'] = $materias_n->tipo_alumno;
                                }
                                else {
                                    $materias_o = DB::selectOne("SELECT gm.*,eca.id_tipo_curso,eca.id_carga_academica,gp.year,gp.siglas,gp.id_periodo,
                                    CASE
                                    WHEN eca.tipo_alumno = 'C' THEN 'CON'
                                    WHEN eca.tipo_alumno = 'R' THEN 'REE'
                                    ELSE ''
                                    END AS tipo_alumno
                                    FROM eva_validacion_de_cargas evc
                                    INNER JOIN eva_carga_academica eca ON evc.id_alumno = eca.id_alumno AND evc.id_periodo = eca.id_periodo
                                    INNER JOIN gnral_materias gm ON eca.id_materia = gm.id_materia
                                    INNER JOIN gnral_periodos gp ON evc.id_periodo = gp.id_periodo
                                    WHERE evc.id_alumno = ? AND eca.id_status_materia = 1
                                    AND eca.id_materia = ? AND evc.estado_validacion IN (2,8,9,10)
                                    AND gp.id_periodo >= 20  ORDER BY gm.id_semestre ASC", [$id_alumno,$materia_rep->id_materia]);

                                    $alumnos_materia = array();
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
                                    $materias[] = $alumnos_materia;
                                    }
                                 }
                                 $suma_promedio_final = 0;
                                 $suma_materia = 0;
                                 $alumnos = array();
                                 foreach ($materias as $mat) {
                                    $suma_materia++;
                                    $datos_alumnos = array();
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
                                    $materia_promedio = DB::selectOne('SELECT SUM(calificacion) AS suma FROM cal_evaluaciones WHERE id_carga_academica = ? AND calificacion >= 70', [$mat['id_carga_academica']]);
                                    $materia_promedio = $materia_promedio->suma ?? 0;
                                    $contar_unidades_pasadas = DB::selectOne('SELECT COUNT(calificacion) AS suma FROM cal_evaluaciones WHERE id_carga_academica = ? AND calificacion >= 70 ', [$mat['id_carga_academica']]);
                                    $contar_unidades_pasadas =$contar_unidades_pasadas->suma ?? 0;
                                    $contar_sumativa = DB::selectOne('SELECT COUNT(esc) AS contar FROM cal_evaluaciones WHERE id_carga_academica = ? AND esc = 1', [$mat['id_carga_academica']]);
                                    $contar_sumativa = $contar_sumativa->contar ?? 0;
                                    $promedio = 0;
                                    $te = '';
                                    if ($contar_unidades_pasadas == $mat['unidades']) {
                                        if ($contar_unidades_pasadas > 0) {
                                            $promedio = round($materia_promedio / $contar_unidades_pasadas);
                                        }
                                        if ($mat['id_tipo_curso'] == 1) {
                                            $te = ($contar_sumativa == 0) ? 'O': 'ESC';
                                        } elseif ($mat['id_tipo_curso'] == 2) {
                                            $te = ($contar_sumativa == 0) ? 'O2': 'ESC2';
                                        } elseif ($mat['id_tipo_curso'] == 3) {
                                            $te = ($contar_sumativa == 0) ? 'CE': 'EG';
                                        } elseif ($mat['id_tipo_curso'] == 4) {
                                            $te = 'CG';
                                        }
                                    } else {
                                        $promedio = 0;
                                        if ($mat['id_tipo_curso'] == 1) {
                                            $te = 'ESC';
                                        }
                                        if ($mat['id_tipo_curso'] == 2) {
                                            $te = 'ESC2';
                                        }
                                        if ($mat['id_tipo_curso'] == 3) {
                                            $te = 'CE';
                                        }
                                        if ($mat['id_tipo_curso'] == 4) {
                                            $te = 'EG';
                                        }
                                    }
                                    if ($mat['tipo_alumno'] == 'CON') {
                                        $te = 'CON';
                                    } elseif ($mat['tipo_alumno'] == 'REE') {
                                        $te = 'REE';
                                    }
                                    $datos_alumnos['promedio'] = $promedio;
                                    $datos_alumnos['te'] = $te;
                                    $alumnos[] = $datos_alumnos;
                                }
                                    $suma_mat = 0;
                                    $promedio_final = 0;
                                    $contar_creditos = 0;
                                    $materias_actualizadas = array();
                                    $datos_residencia = array();
                                    $datos_servicio = array();
                                    $datos_actividades = array();

                                    foreach ($alumnos as $alum) {
                                        $eliminacion_mat = DB::selectOne("SELECT COUNT(id_carga_academica) AS total  FROM cal_eliminacion_materia WHERE id_carga_academica = ? ", [$alum['id_carga_academica']]);
                                        if ($eliminacion_mat->total == 0) {
                                            $suma_mat++;
                                            $datos_alu = array();
                                            $datos_alu['numero'] = $suma_materia;
                                            $datos_alu['id_carga_academica'] = $alum['id_carga_academica'];
                                            $datos_alu['id_materia'] = $alum['id_materia'];
                                            $datos_alu['nombre_materia'] = $alum['nombre_materia'];
                                            $datos_alu['id_semestre'] = $alum['id_semestre'];
                                            $datos_alu['clave'] = $alum['clave'];

                                            if ($alum['promedio'] < 70) {
                                                $datos_alu['creditos'] = 0;
                                                }
                                                else {
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
                                                $materias_actualizadas[] = $datos_alu;
                                            }
                                        }
                                        $residencia_data = DB::selectOne("SELECT COUNT(id_cal_residencia) AS residencia FROM cal_residencia WHERE id_alumno = ?", [$id_alumno]);
                                        $residencia = $residencia_data->residencia;
                                        if ($residencia == 0) {
                                            $datos_residencia2 = DB::selectOne("SELECT COUNT(id_evaluacion) AS calificacion FROM cal_evaluaciones WHERE id_carga_academica IN (SELECT id_carga_academica FROM eva_carga_academica WHERE id_alumno = ?
                                            AND id_materia IN ($marcadores_excluidas))", [$id_alumno, ...$materias_excluidas]);
                                            $residencia = $datos_residencia2->calificacion;
                                        }
                                        $verifi_reg_ante = 0;
                                        $periodo_seguimiento = 0;
                                        $verificar_periodo_residencia = 0;
                                        if ($residencia == 0) {
                                            $resi = 0;
                                            $verificar_reg_ante = DB::selectOne("SELECT COUNT(id_anteproyecto) AS contar FROM resi_anteproyecto WHERE id_alumno = ? AND id_periodo >= 26 AND estado_enviado = 3", [$id_alumno]);
                                            $verificar_reg_ante = $verificar_reg_ante->contar;
                                            $verificar_periodo_residencia = DB::select("SELECT gnral_periodos.id_periodo,gnral_periodos.periodo FROM eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
                                            WHERE eva_validacion_de_cargas.id_alumno = ? AND eva_carga_academica.id_status_materia = 1 AND eva_carga_academica.id_materia IN ($marcadores_excluidas) AND eva_validacion_de_cargas.estado_validacion IN (2,8,9,10)
                                            AND eva_validacion_de_cargas.id_alumno = eva_carga_academica.id_alumno AND eva_validacion_de_cargas.id_periodo = eva_carga_academica.id_periodo AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo
                                            AND gnral_periodos.id_periodo >= 20 AND eva_carga_academica.id_materia = gnral_materias.id_materia", [$id_alumno, ...$materias_excluidas]);
                                            if (empty($verificar_periodo_residencia)) {
                                                $verificar_periodo_residencia = 0;
                                                }
                                                if ($verificar_reg_ante == 0) {
                                                    $verifi_reg_ante = 0;
                                                    $periodo_seguimiento = 0;
                                                    }
                                                    else {
                                                        $periodo1 = DB::selectOne("SELECT id_periodo FROM resi_anteproyecto WHERE id_alumno = ?", [$id_alumno]);
                                                        $periodo1 = $periodo1->id_periodo + 1;
                                                        $verifi_reg_ante = 1;
                                                        $periodo_seguimiento = DB::selectOne("SELECT * FROM gnral_periodos WHERE id_periodo = ?", [$periodo1]);
                                                        $periodo_seguimiento = $periodo_seguimiento->periodo;
                                                        }
                                                }
                                                else {
                                                    $resi = 10;
                                                    $residencia4 = DB::selectOne("SELECT COUNT(id_cal_residencia) AS residencia FROM cal_residencia WHERE id_alumno = ?", [$id_alumno]);
                                                    $residencia4 = $residencia4->residencia;
                                                    if ($residencia4 == 0) {
                                                        $datos_residencia = DB::selectOne("SELECT calificacion, created_at AS fecha_termino FROM cal_evaluaciones WHERE id_carga_academica IN (SELECT id_carga_academica FROM eva_carga_academica
                                                        WHERE id_alumno = ? AND id_materia IN ($marcadores_excluidas))", [$id_alumno, ...$materias_excluidas]);
                                                        $promedio_residencia = $datos_residencia->calificacion;
                                                        $promedio_final += $promedio_residencia;
                                                        $suma_mat++;
                                                        }
                                                        else {
                                                            $datos_residencia = DB::selectOne("SELECT *  FROM cal_residencia  WHERE id_alumno = ?", [$id_alumno]);
                                                            $promedio_residencia = $datos_residencia->calificacion;
                                                            $promedio_final += $promedio_residencia;
                                                            $suma_mat++;
                                                }
                                                if ($promedio_residencia >= 70) {
                                                    $contar_creditos += $resi;
                                                }
                                            }
                                            $servicio_social = DB::selectOne("SELECT COUNT(id_servicio_social) AS servicio FROM cal_servicio_social WHERE id_alumno = ? ", [$id_alumno]);
                                            $servicio_social = $servicio_social->servicio;
                                            if ($servicio_social == 0) {
                                                $servicio = 0;
                                            }
                                            else {
                                                $servicio = 10;
                                                $datos_servicio = DB::selectOne("SELECT *  FROM cal_servicio_social WHERE id_alumno = ? ", [$id_alumno]);
                                                $promedio_servicio = $datos_servicio->calificacion;
                                                $promedio_final += $promedio_servicio;
                                                $suma_mat++;
                                                if ($promedio_servicio >= 70) {
                                                    $contar_creditos += $servicio;
                                                    }
                                                    }
                                                    $actividades_complementaria = DB::selectOne("SELECT COUNT(id_actividades_comple) AS actividades FROM cal_actividades_complementarias WHERE id_alumno = ?", [$id_alumno]);
                                                    $actividades_complementaria = $actividades_complementaria->actividades;
                                                    if ($actividades_complementaria == 0) {
                                                        $actividades = 0;
                                                    }
                                                    else {
                                                        $actividades = 5;
                                                        $datos_actividades = DB::selectOne("SELECT * FROM cal_actividades_complementarias WHERE id_alumno = ?", [$id_alumno]);
                                                        $contar_creditos += $actividades;
                                                    }
                                                    if ($promedio_final == 0 || $suma_mat == 0) {
                                                        $promedio_f = 0;
                                                    }
                                                    else {
                                                        $promedio_f = ($promedio_final / $suma_mat);
                                                        $promedio_f = number_format($promedio_f,2,'.',' ');
                                                    }
                                                    $mat_eliminadas = DB::select("SELECT cal_eliminacion_materia.id_eliminacion_materia,cal_eliminacion_materia.id_carga_academica,cal_eliminacion_materia.fecha,gnral_materias.*,gnral_periodos.*
                                                    FROM eva_carga_academica, gnral_materias,gnral_periodos,cal_eliminacion_materia
                                                    WHERE eva_carga_academica.id_materia = gnral_materias.id_materia AND eva_carga_academica.id_alumno = ?
                                                    AND cal_eliminacion_materia.id_carga_academica = eva_carga_academica.id_carga_academica AND eva_carga_academica.id_periodo = gnral_periodos.id_periodo", [$id_alumno]);

                                                    return view('servicios_escolares.historial_academico.historial_academico',compact('materias_actualizadas','id_alumno','residencia','datos_residencia','servicio','datos_servicio','actividades',
                                                    'datos_actividades','promedio_f','contar_creditos','alumno','suma_mat','plan','especialidad','plan2','especialidad2','calificada','mat_eliminadas','verifi_reg_ante','periodo_seguimiento','verificar_periodo_residencia'));
                                                    }


    public function calificar_residencia(Request $request, $id_alumno)
    {
        $this->validate($request, [
            'cal_residencia' => 'required',
            'fecha_residencia' => 'required',
        ]);

        $cal_residencia = $request->input('cal_residencia');
        $fecha_residencia = $request->input('fecha_residencia');
        //$fecha_residencia=now();
        $dia = substr($fecha_residencia, 0, 2);
        $mes = substr($fecha_residencia, 3, 2);
        $year = substr($fecha_residencia, 6, 4);
        // dd($year);


        $fecha_residencia = $year . "-" . $mes . "-" . $dia;

        //dd($fecha_residencia);
        $clave = "RES-0001";
        DB:: table('cal_residencia')->insert(['calificacion' => $cal_residencia, 'id_alumno' => $id_alumno, 'fecha_termino' => $fecha_residencia, 'clave' => $clave]);
        return back();
    }

    public function calificar_servicio_social(Request $request, $id_alumno)
{
    $this->validate($request, [
        'cal_servicio' => 'required',
        'fecha_servicio' => 'required',
    ]);

    $cal_servicio = $request->input('cal_servicio');
    $fecha_servicio = $request->input('fecha_servicio');

    $dia = substr($fecha_servicio, 0, 2);
    $mes = substr($fecha_servicio, 3, 2);
    $year = substr($fecha_servicio, 6, 4);

    $fecha_servicio = $year . "-" . $mes . "-" . $dia;

    DB::table('cal_servicio_social')->updateOrInsert(
        [
            'id_alumno' => $id_alumno,
            'clave' => 'SSC-0001',
        ],
        [
            'calificacion' => $cal_servicio,
            'fecha_termino' => $fecha_servicio,
        ]
    );

    return back();
}

  public function editar_calificar_servicio_social(Request $request, $id_alumno)
{
    $this->validate($request, [
        'cal_servicio' => 'required',
        'fecha_servicio' => 'required',
    ]);

    $cal_servicio = $request->input('cal_servicio');
    $fecha_servicio = $request->input('fecha_servicio');

    $dia = substr($fecha_servicio, 0, 2);
    $mes = substr($fecha_servicio, 3, 2);
    $year = substr($fecha_servicio, 6, 4);

    $fecha_servicio = $year . "-" . $mes . "-" . $dia;

    DB::table('cal_servicio_social')
        ->where('id_alumno', $id_alumno)
        ->where('clave', 'SSC-0001')
        ->update([
            'calificacion' => $cal_servicio,
            'fecha_termino' => $fecha_servicio,
        ]);

    return back();
}

   public function eliminar_calificar_servicio_social($id_alumno)
{
    $eliminado = DB::table('cal_servicio_social')
        ->where('id_alumno', $id_alumno)
        ->where('clave', 'SSC-0001')
        ->delete();

    if ($eliminado) {
        return back()->with(
            'success',
            'Calificación de servicio social eliminada correctamente.'
        );
    }

    return back()->with(
        'error',
        'No se encontró el registro de servicio social para eliminar.'
    );
}


    public function calificar_actividades(Request $request, $id_alumno)
    {
        $cal_act = "ACA";
        $clave = "ACC-0001";
        DB:: table('cal_actividades_complementarias')->insert(['cal' => $cal_act, 'id_alumno' => $id_alumno, 'clave' => $clave]);
        return back();
    }

    public function bajas_temporales()
    {
        $carreras = DB::select('SELECT * FROM gnral_carreras WHERE id_carrera!=9
AND id_carrera!=11 AND id_carrera!=15  ORDER BY id_carrera ');
        $ver = 0;
        return view('servicios_escolares.bajas_estudiantes.bajas_temporales_estudiantes', compact('carreras', 'ver'));

    }

    public function bajas_definitivas()
    {
        $carreras = DB::select('SELECT * FROM gnral_carreras WHERE id_carrera!=9
AND id_carrera!=11 AND id_carrera!=15  ORDER BY id_carrera ');
        $ver = 0;

        return view('servicios_escolares.bajas_estudiantes.bajas_definitivas_estudiantes', compact('carreras', 'ver'));


    }

    public function ver_bajas_temporales($id_carrera)
    {
        $periodo = Session::get('periodo_actual');
        $carreras = DB::select('SELECT * FROM gnral_carreras WHERE id_carrera !=9 AND id_carrera !=11 AND id_carrera !=15  ORDER BY id_carrera ');
        $ver = 1;
        $alumnos = DB::select('SELECT DISTINCT
        gnral_alumnos.id_alumno,gnral_alumnos.cuenta,
        gnral_alumnos.nombre,gnral_alumnos.apaterno,
        gnral_alumnos.amaterno,eva_validacion_de_cargas.estado_validacion,
        eva_validacion_de_cargas.id_periodo,eva_validacion_de_cargas.id
        FROM gnral_alumnos
        INNER JOIN eva_validacion_de_cargas ON gnral_alumnos.id_alumno = eva_validacion_de_cargas.id_alumno
        INNER JOIN eva_carga_academica ON eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
        AND eva_carga_academica.id_periodo = eva_validacion_de_cargas.id_periodo
        WHERE eva_validacion_de_cargas.id_periodo = ?
        AND eva_validacion_de_cargas.estado_validacion IN (10, 11)
        AND gnral_alumnos.id_carrera = ?', [$periodo, $id_carrera]);


        //dd($alumnos);
        return view('servicios_escolares.bajas_estudiantes.bajas_temporales_estudiantes', compact('carreras', 'ver', 'id_carrera', 'alumnos'));

    }


    public function guardarBajaTemporal(Request $request)
    {
        // Validación
        $request->validate([
            'id_alumno' => 'required|integer',
            'id' => 'required|integer',
            'observacion' => 'required|string|max:250',
        ]);

        // Insertar la observación en la tabla cal_bitacoras_bajas_temp_alumnos
        DB::table('cal_bitacoras_bajas_temp_alumnos')->insert([
            'id_alumno' => $request->id_alumno,
            'id' => $request->id,
            'observaciones' => $request->observacion,
        ]);

        // Actualizar el estado_validacion a 0 si es 10, 11 o 12
        DB::table('eva_validacion_de_cargas')
            ->where('id_alumno', $request->id_alumno)
            ->where('id_periodo', session('periodo_actual')) // asegurar que solo afecte al periodo actual
            ->whereIn('estado_validacion', [10, 11, 12])
            ->update(['estado_validacion' => 0]);

        return back()->with('success', 'Baja temporal registrada correctamente y estado actualizado.');
    }



    public function ver_bajas_definitivas($id_carrera)
    {
        $periodo = Session::get('periodo_actual');
        $carreras = DB::select('SELECT * FROM gnral_carreras WHERE id_carrera !=9 AND id_carrera !=11 AND id_carrera !=15  ORDER BY id_carrera ');
        $ver = 1;
        $alumnos = DB::select('SELECT DISTINCT gnral_alumnos.id_alumno,gnral_alumnos.cuenta,
        gnral_alumnos.nombre,gnral_alumnos.apaterno,gnral_alumnos.amaterno,eva_validacion_de_cargas.estado_validacion,
        eva_validacion_de_cargas.id_periodo,eva_validacion_de_cargas.id
            FROM gnral_alumnos
                INNER JOIN eva_validacion_de_cargas ON gnral_alumnos.id_alumno = eva_validacion_de_cargas.id_alumno
                INNER JOIN eva_carga_academica ON eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
                                                      AND eva_carga_academica.id_periodo = eva_validacion_de_cargas.id_periodo
            WHERE eva_validacion_de_cargas.id_periodo = ?
            AND  eva_validacion_de_cargas.estado_validacion IN (12, 13)
              AND gnral_alumnos.id_carrera = ?', [$periodo, $id_carrera]);

        //dd($alumnos);
        return view('servicios_escolares.bajas_estudiantes.bajas_definitivas_estudiantes', compact('carreras', 'ver', 'id_carrera', 'alumnos'));

    }

    public function guardarBajaDefinitiva(Request $request)
    {
        $request->validate([
            'id_alumno' => 'required|integer',
            'id' => 'required|integer',
            'observacion' => 'required|string|max:250',
        ]);

        // Insertar la observación en la tabla cal_bitacoras_bajas_def_alumnos
        DB::table('cal_bitacoras_bajas_def_alumnos')->insert([
            'id_alumno' => $request->id_alumno,
            'id' => $request->id,
            'observaciones' => $request->observacion,
        ]);

        // Actualizar el estado_validacion a 0 si es 10, 11 o 12
        DB::table('eva_validacion_de_cargas')
            ->where('id_alumno', $request->id_alumno)
            ->where('id_periodo', session('periodo_actual')) // asegurar que solo afecte al periodo actual
            ->whereIn('estado_validacion', [10, 11, 12,13])
            ->update(['estado_validacion' => 0]);

        return back()->with('success', 'Baja definitiva registrada correctamente.');
    }


    public function guardarDictamen(Request $request)
    {
        // Validar datos
        $request->validate([
            'id_carga' => 'required|integer',
            'oficio'   => 'required|string|max:255',
        ]);

        // Buscar el registro donde se guardará
        $carga = CargaAcademica::find($request->id_carga);

        if(!$carga){
            return back()->with('error', 'No se encontró la carga académica.');
        }

        // Guardar valores
        $carga->dictamen = $request->oficio; // NOMBRE DEL CAMPO EN TU BD
        $carga->save();

        return back()->with('success', 'Dictamen agregado correctamente.');
    }


    public function al_cal_academico()
    {
        $id_usuario = Session::get('usuario_alumno');
        $datosalumno = DB::selectOne('select * FROM `gnral_alumnos` WHERE id_usuario= ?', [$id_usuario]);
        $id_alumno = $datosalumno->id_alumno;
        $alumno = DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE `id_alumno` = ?', [$id_alumno]);
        $alumno = $alumno->cuenta . " " . mb_strtoupper($alumno->apaterno, 'utf-8') . " " . mb_strtoupper($alumno->amaterno, 'utf-8') . " " . mb_strtoupper($alumno->nombre, 'utf-8');
        $materias = DB::select('SELECT gnral_materias.*,eva_carga_academica.id_tipo_curso,eva_carga_academica.id_carga_academica,gnral_periodos.year,
gnral_periodos.siglas from eva_validacion_de_cargas,eva_carga_academica,gnral_materias,gnral_periodos
 where eva_validacion_de_cargas.id_alumno= ? and eva_carga_academica.id_status_materia=1
 and eva_validacion_de_cargas.estado_validacion in (2,8,9) and eva_validacion_de_cargas.id_alumno=eva_carga_academica.id_alumno
  and eva_validacion_de_cargas.id_periodo=eva_carga_academica.id_periodo and eva_validacion_de_cargas.id_periodo=gnral_periodos.id_periodo
  and gnral_periodos.id_periodo >= 20 and eva_carga_academica.id_materia=gnral_materias.id_materia ORDER BY `gnral_materias`.`id_semestre` ASC', [$id_alumno]);
//dd($materias);
        $alumnos = array();
        $contar_mat = 0;
        $contar_promedio = 0;
        $contar_creditos = 0;
        foreach ($materias as $materia) {


            $contar_unidades_pasadas = DB::selectOne('SELECT count(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and calificacion >=70', [$materia->id_carga_academica]);
            $contar_unidades_pasadas = $contar_unidades_pasadas->suma;

            if ($contar_unidades_pasadas == $materia->unidades) {
                $contar_mat++;
                $contar_creditos += $materia->creditos;
                $alumnos_materia['id_carga_academica'] = $materia->id_carga_academica;
                $alumnos_materia['id_materia'] = $materia->id_materia;
                $alumnos_materia['clave'] = $materia->clave;
                $alumnos_materia['nombre_materia'] = $materia->nombre;
                $alumnos_materia['creditos'] = $materia->creditos;
                $alumnos_materia['periodo'] = $materia->siglas;
                $alumnos_materia['year'] = $materia->year;
                $alumnos_materia['id_semestre'] = $materia->id_semestre;


                $materia_promedio = DB::selectOne('SELECT SUM(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and calificacion >=70', [$materia->id_carga_academica]);
                $materia_promedio = $materia_promedio->suma;

                $contar_sumativa = DB::selectOne('SELECT count(calificacion) suma FROM `cal_evaluaciones` WHERE `id_carga_academica` = ? and esc =70', [$materia->id_carga_academica]);
                $contar_sumativa = $contar_sumativa->suma;
                $promedio_materia = round($materia_promedio / $materia->unidades);
                $contar_promedio += $promedio_materia;
                $alumnos_materia['promedio'] = $promedio_materia;
                if ($contar_sumativa == 0) {
                    if ($materia->id_tipo_curso == 1) {
                        $te = 'O';
                    }

                    if ($materia->id_tipo_curso == 2) {
                        $te = 'O2';
                    }
                    if ($materia->id_tipo_curso == 3) {
                        $te = 'CE';
                    }
                    if ($materia->id_tipo_curso == 3) {
                        $te = 'EG';
                    }

                } else {
                    if ($materia->id_tipo_curso == 1) {
                        $te = 'ESC';
                    }
                    if ($materia->id_tipo_curso == 2) {
                        $te = 'ESC2';
                    }
                    if ($materia->id_tipo_curso == 3) {
                        $te = 'EG';
                    }
                    if ($materia->id_tipo_curso == 4) {
                        $te = 'EG';
                    }

                }
                $alumnos_materia['esc'] = $te;

                array_push($alumnos, $alumnos_materia);
            }


        }
        if ($contar_mat == 0) {
            $contar_creditos = 0;
            $promedio_alumno = 0;
        } else {
            $contar = 0;
            $residencia = DB::selectOne('SELECT count(id_cal_residencia) residencia FROM cal_residencia WHERE id_alumno= ?', [$id_alumno]);
            $residencia = $residencia->residencia;
            if ($residencia == 0) {
                $resi = 0;
                $promedio_residencia = 0;
            } else {

                $resi = 10;
                $datos_residencia = DB::selectOne('SELECT *FROM cal_residencia WHERE id_alumno= ?', [$id_alumno]);
                $promedio_residencia = $datos_residencia->calificacion;
                $contar_promedio = $contar_promedio + $promedio_residencia;
                $contar++;
            }

            $servicio_social = DB::selectOne('SELECT count(id_servicio_social) servicio FROM cal_servicio_social WHERE id_alumno= ?', [$id_alumno]);
            $servicio_social = $servicio_social->servicio;
            if ($servicio_social == 0) {
                $servicio = 0;
                $promedio_servicio = 0;
            } else {
                $servicio = 10;
                $datos_servicio = DB::selectOne('SELECT * FROM cal_servicio_social WHERE id_alumno= ?', [$id_alumno]);
                $promedio_servicio = $datos_servicio->calificacion;
                $contar_promedio = $contar_promedio + $promedio_servicio;
                $contar++;
            }


            $actividades_complementaria = DB::selectOne('SELECT count(id_actividades_comple)actividades from cal_actividades_complementarias WHERE id_alumno= ?', [$id_alumno]);
            $actividades_complementaria = $actividades_complementaria->actividades;
            if ($actividades_complementaria == 0) {
                $actividades = 0;
            } else {
                $actividades = 5;
                $datos_actividades = DB::selectOne('SELECT *from cal_actividades_complementarias WHERE id_alumno= ?', [$id_alumno]);

            }
            $contar_mat = $contar_mat + $contar;
            $contar_creditos = $contar_creditos + $resi + $servicio + $actividades;
            $promedio_alumno = round($contar_promedio / $contar_mat);
        }
        return view('evaluacion_docente.Alumnos.promedio_academico', compact('promedio_alumno'));
    }

    public function eliminar_materia(Request $request)
    {
        $this->validate($request, [
            'id_carga_academica' => 'required',
        ]);
        $hora = date("Y-m-d H:i");
        $id_carga_academica = $request->input('id_carga_academica');
        DB:: table('cal_eliminacion_materia')->insert(['id_carga_academica' => $id_carga_academica, 'fecha' => $hora]);
        return back();


    }

    public function agregar_nuevamente(Request $request)
    {

        $this->validate($request, [
            'id_carga_academica_l' => 'required',
        ]);

        $id_carga_academica = $request->input('id_carga_academica_l');
        DB::delete('DELETE  FROM cal_eliminacion_materia  WHERE id_carga_academica = ?', [$id_carga_academica]);
        return back();


    }

    public function planes_estudio()
    {
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();
        $id_carrera = 0;
        $no_seleccion = 0;
        return view("servicios_escolares.historial_academico.planes_estudio", compact('carreras', 'id_carrera', 'no_seleccion'));

    }

    public function planes_estudio_carrera($id_carrera)
    {
        $planes = DB::select('SELECT cal_plan.*,gnral_carreras.nombre FROM gnral_carreras,cal_plan
WHERE gnral_carreras.id_carrera=cal_plan.id_carrera and gnral_carreras.id_carrera= ?', [$id_carrera]);
        // dd($planes);
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();
        $no_seleccion = 1;
        return view("servicios_escolares.historial_academico.planes_estudio", compact('carreras', 'id_carrera', 'no_seleccion', 'planes'));

    }

    public function modificar_plan($id_plan)
    {
        $plan = DB::selectOne('SELECT cal_plan.*,gnral_carreras.nombre FROM gnral_carreras,cal_plan
WHERE gnral_carreras.id_carrera=cal_plan.id_carrera and cal_plan.id_plan= ?', [$id_plan]);
        return view("servicios_escolares.historial_academico.modificar_plan", compact('plan'));
    }

    public function modificacion_plan($id_plan, $plan)
    {
        DB::table('cal_plan')
            ->where('id_plan', $id_plan)
            ->update(['plan' => $plan]);
        return back();
    }

    public function registrar_plan(Request $request, $id_carrera)
    {
        $this->validate($request, [
            'nombre_plan' => 'required',
        ]);
        $nombre_plan = $request->input('nombre_plan');
        $nombre_plan = mb_strtoupper($nombre_plan, 'utf-8');
        DB:: table('cal_plan')->insert(['plan' => $nombre_plan, 'id_carrera' => $id_carrera]);
        return back();
    }

    public function especialidades()
    {
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();
        $id_carrera = 0;
        $no_seleccion = 0;
        return view("servicios_escolares.historial_academico.especialidades", compact('carreras', 'id_carrera', 'no_seleccion'));

    }

    public function especialidades_carrera($id_carrera)
    {
        $especialidades = DB::select('SELECT cal_especialidad.*,gnral_carreras.nombre  FROM cal_especialidad,gnral_carreras WHERE cal_especialidad.id_carrera=gnral_carreras.id_carrera and gnral_carreras.id_carrera = ?', [$id_carrera]);
        $carreras = DB::table('gnral_carreras')
            ->where('id_carrera', '!=', 9)
            ->where('id_carrera', '!=', 11)
            ->where('id_carrera', '!=', 15)
            ->get();
        $no_seleccion = 1;
        return view("servicios_escolares.historial_academico.especialidades", compact('carreras', 'id_carrera', 'no_seleccion', 'especialidades'));

    }

    public function modificar_especialidad($id_especialidad)
    {
        $especialidad = DB::selectOne('SELECT cal_especialidad.*,gnral_carreras.nombre FROM cal_especialidad,gnral_carreras WHERE
cal_especialidad.id_carrera=gnral_carreras.id_carrera and cal_especialidad.id_especialidad = ?', [$id_especialidad]);
        return view("servicios_escolares.historial_academico.modificar_especialidad", compact('especialidad'));
    }

    public function modificacion_especialidad($id_especialidad, $especialidad)
    {
        DB::table('cal_especialidad')
            ->where('id_especialidad', $id_especialidad)
            ->update(['especialidad' => $especialidad]);
        return back();
    }

    public function registrar_especialidad(Request $request, $id_carrera)
    {
        $this->validate($request, [
            'nombre_especialidad' => 'required',
        ]);
        $nombre_especialidad = $request->input('nombre_especialidad');
        $nombre_especialidad = mb_strtoupper($nombre_especialidad, 'utf-8');
        DB:: table('cal_especialidad')->insert(['especialidad' => $nombre_especialidad, 'id_carrera' => $id_carrera]);
        return back();
    }

    public function excel_academico($id_alumno, $id_plan, $id_especialidad, $calificada)
    {
        $alumno = DB::selectOne('SELECT cuenta,nombre,apaterno,amaterno FROM gnral_alumnos WHERE id_alumno= ? ', [$id_alumno]);

        return Excel::download(new Historial_academicoExport($id_alumno, $id_plan, $id_especialidad, $calificada), 'Concentrado_' . $alumno->cuenta . '_' . $alumno->nombre . '_' . $alumno->apaterno . '_' . $alumno->amaterno . '.xlsx');

    }

    public function bitacora_def_temp()
    {
        $periodo = Session::get('periodo_actual');
        $ver = 1; // Para que la vista muestre las tablas directamente

        /* // Obtener todas las bajas temporales
         $alumnos_temporales = DB::select("
         SELECT DISTINCT
             gnral_alumnos.id_alumno,
             gnral_alumnos.cuenta,
             gnral_alumnos.nombre,
             gnral_alumnos.apaterno,
             gnral_alumnos.amaterno,
             eva_validacion_de_cargas.estado_validacion,
             eva_validacion_de_cargas.id_periodo,
             eva_validacion_de_cargas.id
         FROM gnral_alumnos
         INNER JOIN eva_validacion_de_cargas ON gnral_alumnos.id_alumno = eva_validacion_de_cargas.id_alumno
         INNER JOIN eva_carga_academica ON eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
             AND eva_carga_academica.id_periodo = eva_validacion_de_cargas.id_periodo
         WHERE eva_validacion_de_cargas.id_periodo = ?
         AND eva_validacion_de_cargas.estado_validacion IN (10, 11)
     ", [$periodo]);*/

        // Obtener todas las bajas definitivas
        /*$alumnos_definitivos = DB::select("
        SELECT DISTINCT
            gnral_alumnos.id_alumno,
            gnral_alumnos.cuenta,
            gnral_alumnos.nombre,
            gnral_alumnos.apaterno,
            gnral_alumnos.amaterno,
            eva_validacion_de_cargas.estado_validacion,
            eva_validacion_de_cargas.id_periodo,
            eva_validacion_de_cargas.id
        FROM gnral_alumnos
        INNER JOIN eva_validacion_de_cargas ON gnral_alumnos.id_alumno = eva_validacion_de_cargas.id_alumno
        INNER JOIN eva_carga_academica ON eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
            AND eva_carga_academica.id_periodo = eva_validacion_de_cargas.id_periodo
        WHERE eva_validacion_de_cargas.id_periodo = ?
        AND eva_validacion_de_cargas.estado_validacion = 12
    ", [$periodo]);*/


        $alumnos_temporales = DB::select('SELECT DISTINCT
    c.id_alumno,
    c.id,
    c.observaciones,
    a.cuenta,
    a.nombre,
    a.apaterno,
    a.amaterno
FROM cal_bitacoras_bajas_temp_alumnos c
INNER JOIN gnral_alumnos a
    ON c.id_alumno = a.id_alumno;');

        $alumnos_definitivos = DB::select('SELECT DISTINCT
    c.id_alumno,
    c.id,
    c.observaciones,
    a.cuenta,
    a.nombre,
    a.apaterno,
    a.amaterno
FROM cal_bitacoras_bajas_def_alumnos c
INNER JOIN gnral_alumnos a
    ON c.id_alumno = a.id_alumno;');

        return view('servicios_escolares.bajas_estudiantes.bitacora_bajas_def_tem', compact(
            'ver',
            'alumnos_temporales',
            'alumnos_definitivos',
            'periodo'
        ));
    }
}
