<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\carreras;
use App\materias;
use App\reticulas;
use Session;

class Beca_SolicitudController extends Controller
{
    // =========================================================================
    //  Reglas de la convocatoria enero-julio 2026:
    //   id_estado en beca_autorizar:
    //     1 = Pendiente (esperando validación)
    //     2 = Rechazado por S. de S. E.
    //     3 = Autorizado por S. de S. E. (pasa a S. de E. P.)
    //     4 = Rechazado por S. de E. P.
    //     5 = Autorizado por S. de E. P. (final)
    //  id_estado en beca_vulnerabilidad (id_estado del alumno):
    //     1 = Madre de familia
    //     2 = Condición de discapacidad
    //     3 = Normal (no vulnerable)
    //  id_descuento en beca_descuento:
    //     1 = 100%
    //     2 = 50% (con sumativa)
    //     3 = 50% (sin sumativa, rango 90-94 normal o 85-89 vulnerable)
    // =========================================================================
    private function esAlumnoRegular($id_alumno)
    {
        $reprobadas = DB::selectOne("
            SELECT COUNT(ce.id_evaluacion) AS total
            FROM cal_evaluaciones ce
            JOIN eva_carga_academica eca ON eca.id_carga_academica = ce.id_carga_academica
            JOIN eva_validacion_de_cargas evc
                ON evc.id_alumno  = eca.id_alumno
               AND evc.id_periodo = eca.id_periodo
            JOIN gnral_periodos gp ON gp.id_periodo = evc.id_periodo
            WHERE eca.id_alumno = ?
              AND eca.id_status_materia = 1
              AND evc.estado_validacion IN (2,8,9,10)
              AND gp.id_periodo >= 20
              AND eca.id_materia NOT IN (773,817,845,853,1160,1263,1264,1265,
                                         1443,1496,1565,1566,1567,1568,1569,
                                         1571,2516,2517,2614,2250)
              AND ce.calificacion < 70
        ", [$id_alumno]);

        // Si total = 0 → no tiene ninguna reprobada/NA → es regular
        return $reprobadas->total == 0;
    }


    private function tieneSancion($id_alumno, $id_periodo)
    {
        $periodo_anterior = $id_periodo - 1;

        $adeudo_depto = DB::selectOne("
            SELECT COUNT(id_adeudo_departamento) AS total
            FROM adeudo_departamento
            WHERE id_alumno  = ?
              AND id_periodo = ?
        ", [$id_alumno, $periodo_anterior]);

        if ($adeudo_depto->total > 0) {
            return true;
        }

        $adeudo_carrera = DB::selectOne("
            SELECT COUNT(id_adeudo_carrera) AS total
            FROM adeudo_carrera
            WHERE id_alumno  = ?
              AND id_periodo = ?
        ", [$id_alumno, $periodo_anterior]);

        return $adeudo_carrera->total > 0;
    }

    private function validarConvocatoria($beca)
    {
        $promedio   = (float) $beca->promedio;
        $descuento  = (int)   $beca->id_descuento;     // 1=100%, 2=50%sumativa, 3=50%
        $estado     = (int)   $beca->id_estado_alumno; // 1=madre, 2=discapacidad, 3=normal
        $es_vulnerable = ($estado == 1 || $estado == 2);

        // ── REQUISITO 1: Ser alumno regular ──────────────────────────────────
        if (!$this->esAlumnoRegular($beca->id_alumno)) {
            return [
                'aprobado' => false,
                'motivo'   => 'El alumno no es regular (tiene calificaciones reprobatorias o NA en su historial académico).',
            ];
        }

        // ── REQUISITO 2: Sin adeudos en el semestre inmediato anterior ───────
        if ($this->tieneSancion($beca->id_alumno, $beca->id_periodo)) {
            return [
                'aprobado' => false,
                'motivo'   => 'El alumno tiene adeudos registrados en el semestre inmediato anterior.',
            ];
        }

        // ── ESTUDIANTE NORMAL ─────────────────────────────────────────────────
        if (!$es_vulnerable) {
            // a) 95-100, sin sumativa → 100%
            if ($descuento == 1 && $promedio >= 95 && $promedio <= 100) {
                return ['aprobado' => true, 'motivo' => 'Promedio 95-100 sin sumativa (100%).'];
            }
            // d) 95-100, con sumativa → 50%
            if ($descuento == 2 && $promedio >= 95 && $promedio <= 100) {
                return ['aprobado' => true, 'motivo' => 'Promedio 95-100 con una sumativa (50%).'];
            }
            // c) 90-94, sin sumativa → 50%
            if ($descuento == 3 && $promedio >= 90 && $promedio < 95) {
                return ['aprobado' => true, 'motivo' => 'Promedio 90-94 sin sumativa (50%).'];
            }

            return [
                'aprobado' => false,
                'motivo'   => 'No cumple los requisitos de promedio/sumativas para estudiante regular.',
            ];
        }

        // ── ESTUDIANTE VULNERABLE ─────────────────────────────────────────────
        // b) 90-100, sin sumativa → 100%
        if ($descuento == 1 && $promedio >= 90 && $promedio <= 100) {
            return ['aprobado' => true, 'motivo' => 'Vulnerable, promedio 90-100 sin sumativa (100%).'];
        }
        // f) 90-100, con sumativa → 50%
        if ($descuento == 2 && $promedio >= 90 && $promedio <= 100) {
            return ['aprobado' => true, 'motivo' => 'Vulnerable, promedio 90-100 con una sumativa (50%).'];
        }
        // e) 85-89, sin sumativa → 50%
        if ($descuento == 3 && $promedio >= 85 && $promedio < 90) {
            return ['aprobado' => true, 'motivo' => 'Vulnerable, promedio 85-89 sin sumativa (50%).'];
        }

        return [
            'aprobado' => false,
            'motivo'   => 'No cumple los requisitos de promedio/sumativas para estudiante vulnerable.',
        ];
    }

    //  VALIDACIÓN AUTOMÁTICA

    public function auto_verificar_beca()
    {
        $id_periodo = Session::get('periodo_actual');

        // Traer todos los pendientes del periodo con su estado de vulnerabilidad
        $pendientes = DB::select("
            SELECT
                ba.id_autorizar,
                ba.id_alumno,
                ba.id_periodo,
                ba.promedio,
                ba.id_descuento,
                bv.id_estado AS id_estado_alumno
            FROM beca_autorizar ba
            JOIN beca_vulnerabilidad bv
                ON bv.id_alumno = ba.id_alumno
               AND bv.id_periodo = ba.id_periodo
            WHERE ba.id_periodo = ?
              AND ba.id_estado  = 1
        ", [$id_periodo]);

        $aprobados = 0;
        $rechazados = 0;

        foreach ($pendientes as $beca) {
            $resultado = $this->validarConvocatoria($beca);

            if ($resultado['aprobado']) {
                // Autorizado automáticamente por S. de S. E. → pasa a revisión de S. de E. P.
                DB::update(
                    'UPDATE beca_autorizar SET id_estado = 3 WHERE id_autorizar = ?',
                    [$beca->id_autorizar]
                );
                $aprobados++;
            } else {
                // Rechazado automáticamente por S. de S. E.
                DB::update(
                    'UPDATE beca_autorizar SET id_estado = 2 WHERE id_autorizar = ?',
                    [$beca->id_autorizar]
                );
                $rechazados++;
            }
        }

        $total = $aprobados + $rechazados;
        return back()->with('mensaje_auto',
            "Validación automática completada: {$total} solicitudes procesadas — {$aprobados} autorizadas, {$rechazados} rechazadas."
        );
    }

    public function index()
    {
        $id_periodo = Session::get('periodo_actual');
        $fecha_hoy  = date("Y-m-d ");
        $periodo_beca = DB::selectOne('
            SELECT count(id_beca_periodo) estado
            FROM beca_periodo
            WHERE id_periodo = ?
              AND ? BETWEEN fecha_inicial AND fecha_final
        ', [(string) ($id_periodo), (string) ($fecha_hoy)]);
        $periodo_beca = $periodo_beca->estado;
        $semestres    = DB::select("select * from gnral_semestres");

        $id_usuario  = Session::get('usuario_alumno');
        $datosalumno = DB::table('gnral_alumnos')
            ->join('gnral_carreras', 'gnral_carreras.id_carrera', '=', 'gnral_alumnos.id_carrera')
            ->join('gnral_semestres', 'gnral_semestres.id_semestre', '=', 'gnral_alumnos.id_semestre')
            ->select('gnral_alumnos.*', 'gnral_semestres.descripcion as semestre', 'gnral_carreras.nombre as carrera')
            ->where('id_usuario', '=', $id_usuario)
            ->get();

        $id_alumno  = $datosalumno[0]->id_alumno;
        $id_carrera = Session::get('carrera');
        $id_semestre = $datosalumno[0]->id_semestre;

        $alta_carga = DB::selectOne('
            SELECT count(id) validacion
            FROM eva_validacion_de_cargas
            WHERE id_alumno = ?
              AND id_periodo = ?
              AND estado_validacion in (2,8,9)
        ', [$id_alumno, $id_periodo]);
        $alta_carga = $alta_carga->validacion;

        if ($alta_carga == 0) {
            $alta_carga = 0;
            $peri = DB::selectOne('
                SELECT beca_periodo.*, gnral_periodos.periodo
                FROM beca_periodo, gnral_periodos
                WHERE beca_periodo.id_periodo = gnral_periodos.id_periodo
            ');
            $descuento_estimulo = 0;
            $promedio_final     = 0;
            return view('beca_estimulo.solicitud_beca',
                compact('periodo_beca', 'alta_carga', 'peri', 'datosalumno', 'descuento_estimulo', 'promedio_final'));
        } else {
            $peri = DB::selectOne('
                SELECT beca_periodo.*, gnral_periodos.periodo
                FROM beca_periodo, gnral_periodos
                WHERE beca_periodo.id_periodo = gnral_periodos.id_periodo
            ');
            $alta_carga  = 1;
            $estado_beca = DB::selectOne('
                SELECT COUNT(id_autorizar) autorizar
                FROM beca_autorizar
                WHERE id_alumno = ?
                  AND id_periodo = ?
            ', [$id_alumno, $id_periodo]);
            $estado_beca = $estado_beca->autorizar;

            if ($estado_beca == 0) {
                $estado_estimulo = 1;

                $estado_vulnerabilidad  = DB::selectOne('
                    SELECT COUNT(id_vulnerabilidad) contar
                    FROM beca_vulnerabilidad
                    WHERE id_alumno = ?
                      AND id_periodo = ?
                ', [$id_alumno, $id_periodo]);
                $estado_vulnerabilidad1 = $estado_vulnerabilidad->contar;

                if ($estado_vulnerabilidad1 == 0) {
                    return view('beca_estimulo.vulnerabilidad', compact('estado_vulnerabilidad'));
                }

                {
                    $vulnerabilidad = DB::selectOne('
                        SELECT * FROM beca_vulnerabilidad
                        WHERE id_alumno = ?
                          AND id_periodo = ?
                    ', [$id_alumno, $id_periodo]);

                    $docentes = DB::select('
                        SELECT gnral_materias.id_materia, eva_carga_academica.id_tipo_curso,
                               gnral_materias.nombre AS materias, gnral_materias.unidades,
                               gnral_materias.id_materia, eva_tipo_curso.nombre_curso,
                               eva_carga_academica.id_carga_academica, eva_carga_academica.grupo,
                               gnral_materias.id_semestre, gnral_materias.creditos,
                               eva_status_materia.nombre_status
                        FROM gnral_materias, eva_status_materia, eva_tipo_curso, gnral_grupos,
                             eva_carga_academica, gnral_periodos, gnral_alumnos, eva_validacion_de_cargas
                        WHERE eva_carga_academica.id_materia        = gnral_materias.id_materia
                          AND eva_carga_academica.id_status_materia = eva_status_materia.id_status_materia
                          AND eva_carga_academica.id_tipo_curso     = eva_tipo_curso.id_tipo_curso
                          AND eva_carga_academica.id_periodo        = gnral_periodos.id_periodo
                          AND eva_carga_academica.grupo             = gnral_grupos.id_grupo
                          AND eva_carga_academica.id_alumno         = gnral_alumnos.id_alumno
                          AND gnral_periodos.id_periodo             = ?
                          AND gnral_alumnos.id_alumno               = eva_validacion_de_cargas.id_alumno
                          AND gnral_periodos.id_periodo             = eva_validacion_de_cargas.id_periodo
                          AND eva_validacion_de_cargas.estado_validacion IN (2,8,9)
                          AND eva_validacion_de_cargas.id_alumno    = ?
                          AND eva_status_materia.id_status_materia  = 1
                    ', [$id_periodo, $id_alumno]);

                    $mayor_unidades        = 0;
                    $array_materias        = [];
                    $numero_curso_no_normal = 0;
                    $diferente_semestre    = 0;
                    $mat_reprobadas        = 0;
                    $sumativas             = 0;
                    $promedio_final        = 0;
                    $mat                   = 0;
                    $servicio_s            = 0;

                    foreach ($docentes as $dat_alumno) {
                        $esc_alumno      = false;
                        $reprobada       = false;
                        $suma_unidades   = 0;
                        $unidades_evaluadas = 0;
                        $promedio_general = 0;

                        if ($dat_alumno->id_materia == 2258) {
                            $estado_servicio = DB::selectOne('SELECT count(id_servicio_social) contar FROM cal_servicio_social WHERE id_alumno = ?', [$id_alumno]);
                            if ($estado_servicio->contar == 0) {
                                // sin servicio social registrado, omitir
                            } else {
                                $dat_materia['id_materia']  = $dat_alumno->id_materia;
                                $dat_materia['id_semestre'] = $dat_alumno->id_semestre;
                                $dat_materia['curso']       = $dat_alumno->nombre_curso;
                                $dat_materia["materia"]     = $dat_alumno->materias;
                                $dat_materia["unidades"]    = $dat_alumno->unidades;
                                $mayor_unidades = $mayor_unidades > $dat_alumno->unidades ? $mayor_unidades : $dat_alumno->unidades;
                                $array_calificaciones = [];
                                $calificaciones = DB::select('SELECT * FROM cal_evaluaciones WHERE id_carga_academica = ? ORDER BY cal_evaluaciones.id_unidad', [$dat_alumno->id_carga_academica]);
                                $contar_evaluaciones = DB::selectOne('SELECT count(id_evaluacion) contar FROM cal_evaluaciones WHERE id_carga_academica = ? ORDER BY cal_evaluaciones.id_unidad', [$dat_alumno->id_carga_academica]);
                                $contar_evaluaciones = $contar_evaluaciones->contar;
                                $calificaciones != null ? $unidades_evaluadas = 0 : $unidades_evaluadas = 1;
                                foreach ($calificaciones as $calificacion) {
                                    $dat_calificaciones['id_evaluacion'] = $calificacion->id_evaluacion;
                                    $dat_calificaciones['calificacion']  = $calificacion->calificacion;
                                    $dat_calificaciones['id_unidad']     = $calificacion->id_unidad;
                                    if ($calificacion->calificacion < 70 || $calificacion->esc == 1) { $esc_alumno = true; }
                                    if ($calificacion->calificacion < 70) { $reprobada = true; $promedio_general++; $mat_reprobadas++; }
                                    $unidades_evaluadas++;
                                    $suma_unidades += $calificacion->calificacion >= 70 ? $calificacion->calificacion : 0;
                                    array_push($array_calificaciones, $dat_calificaciones);
                                }
                                if ($promedio_general == 0 && $contar_evaluaciones == $dat_alumno->unidades || $dat_alumno->id_materia == 2258) {
                                    if ($dat_alumno->id_materia == 2258) {
                                        $estado_servicio = DB::selectOne('SELECT count(id_servicio_social) contar FROM cal_servicio_social WHERE id_alumno = ?', [$id_alumno]);
                                        if ($estado_servicio->contar == 0) { $pro = 0; $servicio_s = 1; }
                                        else { $servicio_s = 2; $servicio = DB::selectOne('SELECT * FROM cal_servicio_social WHERE id_alumno = ?', [$id_alumno]); $pro = $servicio->calificacion; }
                                    } else {
                                        $pro = intval(round($suma_unidades / $dat_alumno->unidades) + 0);
                                    }
                                    $promedio_final += $pro;
                                    $dat_materia['promedio'] = $pro;
                                } else {
                                    $dat_materia['promedio'] = 0;
                                }
                                if ($esc_alumno == true) { $sumativas++; }
                                $dat_materia['reprobada']    = $reprobada;
                                $dat_materia['esc_alumno']   = $esc_alumno;
                                $dat_materia["calificaciones"] = $array_calificaciones;
                                array_push($array_materias, $dat_materia);
                                $mat++;
                            }
                        } else {
                            $dat_materia['id_materia']  = $dat_alumno->id_materia;
                            $dat_materia['id_semestre'] = $dat_alumno->id_semestre;
                            $dat_materia['curso']       = $dat_alumno->nombre_curso;
                            $dat_materia["materia"]     = $dat_alumno->materias;
                            $dat_materia["unidades"]    = $dat_alumno->unidades;
                            $mayor_unidades = $mayor_unidades > $dat_alumno->unidades ? $mayor_unidades : $dat_alumno->unidades;
                            $array_calificaciones = [];
                            $calificaciones = DB::select('SELECT * FROM cal_evaluaciones WHERE id_carga_academica = ? ORDER BY cal_evaluaciones.id_unidad', [$dat_alumno->id_carga_academica]);
                            $contar_evaluaciones = DB::selectOne('SELECT count(id_evaluacion) contar FROM cal_evaluaciones WHERE id_carga_academica = ? ORDER BY cal_evaluaciones.id_unidad', [$dat_alumno->id_carga_academica]);
                            $contar_evaluaciones = $contar_evaluaciones->contar;
                            $calificaciones != null ? $unidades_evaluadas = 0 : $unidades_evaluadas = 1;
                            foreach ($calificaciones as $calificacion) {
                                $dat_calificaciones['id_evaluacion'] = $calificacion->id_evaluacion;
                                $dat_calificaciones['calificacion']  = $calificacion->calificacion;
                                $dat_calificaciones['id_unidad']     = $calificacion->id_unidad;
                                if ($calificacion->calificacion < 70 || $calificacion->esc == 1) { $esc_alumno = true; }
                                if ($calificacion->calificacion < 70) { $reprobada = true; $promedio_general++; $mat_reprobadas++; }
                                $unidades_evaluadas++;
                                $suma_unidades += $calificacion->calificacion >= 70 ? $calificacion->calificacion : 0;
                                array_push($array_calificaciones, $dat_calificaciones);
                            }
                            if ($promedio_general == 0 && $contar_evaluaciones == $dat_alumno->unidades || $dat_alumno->id_materia == 2258) {
                                if ($dat_alumno->id_materia == 2258) {
                                    $estado_servicio = DB::selectOne('SELECT count(id_servicio_social) contar FROM cal_servicio_social WHERE id_alumno = ?', [$id_alumno]);
                                    if ($estado_servicio->contar == 0) { $pro = 0; $servicio_s = 1; }
                                    else { $servicio_s = 2; $servicio = DB::selectOne('SELECT * FROM cal_servicio_social WHERE id_alumno = ?', [$id_alumno]); $pro = $servicio->calificacion; }
                                } else {
                                    $pro = intval(round($suma_unidades / $dat_alumno->unidades) + 0);
                                }
                                $promedio_final += $pro;
                                $dat_materia['promedio'] = $pro;
                            } else {
                                $dat_materia['promedio'] = 0;
                            }
                            if ($esc_alumno == true) { $sumativas++; }
                            $dat_materia['reprobada']      = $reprobada;
                            $dat_materia['esc_alumno']     = $esc_alumno;
                            $dat_materia["calificaciones"] = $array_calificaciones;
                            array_push($array_materias, $dat_materia);
                            $mat++;
                        }
                    }

                    if ($promedio_final > 0 && $mat > 0) {
                        $promedio_final = round($promedio_final / $mat, 2);
                        $promedio_final = number_format($promedio_final, 2, '.', '');
                    } else {
                        $promedio_final = 0;
                    }

                    if ($vulnerabilidad->id_estado == 1 || $vulnerabilidad->id_estado == 2) {
                        if ($numero_curso_no_normal == 0 && $mat_reprobadas == 0 && $sumativas == 0 && $promedio_final >= 90 && $promedio_final <= 100) {
                            $descuento_estimulo = 1;
                        } elseif ($numero_curso_no_normal == 0 && $mat_reprobadas == 0 && $sumativas == 1 && $promedio_final >= 90 && $promedio_final <= 100) {
                            $descuento_estimulo = 2;
                        } elseif ($numero_curso_no_normal == 0 && $mat_reprobadas == 0 && $sumativas == 0 && $promedio_final >= 85 && $promedio_final < 90) {
                            $descuento_estimulo = 3;
                        } else {
                            $descuento_estimulo = 4;
                        }
                        return view('beca_estimulo.solicitud_beca_vulnerabilidad',
                            compact('peri', 'periodo_beca', 'alta_carga', 'estado_estimulo', 'descuento_estimulo',
                                    'array_materias', 'mayor_unidades', 'datosalumno', 'promedio_final',
                                    'estado_beca', 'semestres', 'vulnerabilidad', 'servicio_s'));
                    } else {
                        if ($numero_curso_no_normal == 0 && $mat_reprobadas == 0 && $sumativas == 0 && $promedio_final >= 95 && $promedio_final <= 100) {
                            $descuento_estimulo = 1;
                        } elseif ($numero_curso_no_normal == 0 && $mat_reprobadas == 0 && $sumativas == 1 && $promedio_final >= 95 && $promedio_final <= 100) {
                            $descuento_estimulo = 2;
                        } elseif ($numero_curso_no_normal == 0 && $mat_reprobadas == 0 && $sumativas == 0 && $promedio_final >= 90 && $promedio_final < 95) {
                            $descuento_estimulo = 3;
                        } else {
                            $descuento_estimulo = 4;
                        }
                        return view('beca_estimulo.solicitud_beca',
                            compact('peri', 'periodo_beca', 'alta_carga', 'estado_estimulo', 'descuento_estimulo',
                                    'array_materias', 'mayor_unidades', 'datosalumno', 'promedio_final',
                                    'estado_beca', 'semestres', 'servicio_s'));
                    }
                }
            } else {
                $estado_beca        = 1;
                $estado_estimulo    = 0;
                $descuento_estimulo = 0;
                $promedio_final     = 0;
                $registro_estado    = DB::selectOne('
                    SELECT beca_autorizar.*, gnral_semestres.descripcion AS semestre
                    FROM beca_autorizar, gnral_semestres
                    WHERE beca_autorizar.id_alumno  = ?
                      AND beca_autorizar.id_periodo = ?
                      AND beca_autorizar.id_semestre = gnral_semestres.id_semestre
                ', [$id_alumno, $id_periodo]);
                return view('beca_estimulo.solicitud_beca',
                    compact('periodo_beca', 'alta_carga', 'estado_beca', 'datosalumno',
                            'registro_estado', 'estado_estimulo', 'descuento_estimulo', 'promedio_final'));
            }
        }
    }

    public function enviar_estimulo($id_alumno, $descuento_estimulo, $promedio_final, $id_semestre)
    {
        $id_periodo = Session::get('periodo_actual');
        $fecha      = date("d/m/Y");

        if ($descuento_estimulo == 1) {         // 100%
            DB::table('beca_autorizar')->insert([
                'id_alumno'   => $id_alumno,
                'id_descuento'=> 1,
                'promedio'    => (string) $promedio_final,
                'id_estado'   => 1,
                'id_periodo'  => $id_periodo,
                'id_semestre' => $id_semestre,
                'fecha'       => $fecha,
            ]);
        } elseif ($descuento_estimulo == 2) {   // 50% con sumativa
            DB::table('beca_autorizar')->insert([
                'id_alumno'   => $id_alumno,
                'id_descuento'=> 2,
                'promedio'    => (string) $promedio_final,
                'id_estado'   => 1,
                'id_periodo'  => $id_periodo,
                'id_semestre' => $id_semestre,
                'fecha'       => $fecha,
            ]);
        } elseif ($descuento_estimulo == 3) {   // 50%
            DB::table('beca_autorizar')->insert([
                'id_alumno'   => $id_alumno,
                'id_descuento'=> 3,
                'promedio'    => (string) $promedio_final,
                'id_estado'   => 1,
                'id_periodo'  => $id_periodo,
                'id_semestre' => $id_semestre,
                'fecha'       => $fecha,
            ]);
        }
        return back();
    }

    public function verificar_beca($id_autorizar, $autorizacion)
    {
        if ($autorizacion == 1) {
            DB::update('UPDATE beca_autorizar SET id_estado = 3 WHERE id_autorizar = ?', [$id_autorizar]);
        }
        if ($autorizacion == 2) {
            DB::update('UPDATE beca_autorizar SET id_estado = 2 WHERE id_autorizar = ?', [$id_autorizar]);
        }
        return back();
    }

    // =========================================================================
    //  ESCOLARES AUTORIZAR – Vista de S. de S. E.
    // =========================================================================
    public function escolares_autorizar()
    {
        $id_periodo = Session::get('periodo_actual');

        $autorizar_escolares = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ?
              AND ba.id_estado  = 1
        ', [$id_periodo]);

        $rechazados_escolares = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ?
              AND ba.id_estado  = 2
        ', [$id_periodo]);

        $autorizar_profesionales = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ?
              AND ba.id_estado  = 3
        ', [$id_periodo]);

        $rechazados_profesionales = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ?
              AND ba.id_estado  = 4
        ', [$id_periodo]);

        $autorizados_profesionales = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ?
              AND ba.id_estado  = 5
        ', [$id_periodo]);

        return view('beca_estimulo.autorizar_escolares',
            compact('autorizar_escolares', 'rechazados_escolares',
                    'autorizar_profesionales', 'rechazados_profesionales', 'autorizados_profesionales'));
    }

    // =========================================================================
    //  AUTORIZAR ACADEMICO – Vista de S. de E. P.
    // =========================================================================
    public function autorizar_academico()
    {
        $id_periodo = Session::get('periodo_actual');

        $autorizar_escolares = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ? AND ba.id_estado = 1
        ', [$id_periodo]);

        $rechazados_escolares = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ? AND ba.id_estado = 2
        ', [$id_periodo]);

        $autorizar_profesionales = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ? AND ba.id_estado = 3
        ', [$id_periodo]);

        $rechazados_profesionales = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ? AND ba.id_estado = 4
        ', [$id_periodo]);

        $autorizados_profesionales = DB::select('
            SELECT ga.correo_al, ga.id_alumno, ga.cuenta, ga.nombre, ga.apaterno, ga.amaterno,
                   ga.curp_al, bd.descripcion descuento, bd.id_descuento, ba.promedio,
                   gs.id_semestre, gs.descripcion semestre, ba.id_autorizar,
                   gc.id_carrera, gc.nombre carrera, bv.id_estado
            FROM gnral_alumnos ga
            JOIN beca_autorizar ba      ON ba.id_alumno   = ga.id_alumno
            JOIN beca_descuento bd      ON bd.id_descuento = ba.id_descuento
            JOIN gnral_semestres gs     ON gs.id_semestre  = ba.id_semestre
            JOIN gnral_carreras gc      ON gc.id_carrera   = ga.id_carrera
            JOIN beca_vulnerabilidad bv ON bv.id_alumno   = ga.id_alumno
                                       AND bv.id_periodo  = ba.id_periodo
            WHERE ba.id_periodo = ? AND ba.id_estado = 5
        ', [$id_periodo]);

        $total_madres      = 0;
        $total_discapacidad = 0;
        $total_normales    = 0;
        $total_alumnos     = 0;

        foreach ($autorizados_profesionales as $autorizadas) {
            $total_alumnos++;
            if ($autorizadas->id_estado == 1)      { $total_madres++; }
            elseif ($autorizadas->id_estado == 2)  { $total_discapacidad++; }
            else                                    { $total_normales++; }
        }

        return view('beca_estimulo.autorizar_academico',
            compact('total_alumnos', 'total_madres', 'total_discapacidad', 'total_normales',
                    'autorizar_escolares', 'rechazados_escolares', 'autorizar_profesionales',
                    'rechazados_profesionales', 'autorizados_profesionales'));
    }
    //  VERIFICAR BECA PROFESIONALES (S. de E. P.) — sin cambios
    public function verificar_beca_profesionales($id_autorizar, $autorizacion)
    {
        if ($autorizacion == 1) {
            DB::update('UPDATE beca_autorizar SET id_estado = 5 WHERE id_autorizar = ?', [$id_autorizar]);
        }
        if ($autorizacion == 2) {
            DB::update('UPDATE beca_autorizar SET id_estado = 4 WHERE id_autorizar = ?', [$id_autorizar]);
        }
        return back();
    }
}
