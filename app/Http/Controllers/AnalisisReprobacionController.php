<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AnalisisReprobacionController extends Controller
{
    const CALIFICACION_MINIMA_APROBATORIA = 70;

    public function index(Request $request)
    {
        $periodos = DB::table('gnral_periodos')
            ->select('id_periodo', 'periodo', 'year', 'estado', 'fecha_inicio', 'fecha_termino')
            ->orderBy('id_periodo', 'desc')
            ->get();

        $periodoId = (int) $request->get('id_periodo', 0);

        if ($periodoId <= 0) {
            $periodoActivo = $periodos->firstWhere('estado', 1);
            $periodoId = $periodoActivo ? (int) $periodoActivo->id_periodo : (int) optional($periodos->first())->id_periodo;
        }

        $contexto = $this->resolverContextoUsuario($periodoId, $request);

        if (!$contexto['permitido']) {
            return view('analisis_reprobacion.index', array(
                'periodos' => $periodos,
                'contexto' => $contexto,
                'carreras' => collect(),
                'materias' => collect(),
                'unidades' => collect(),
                'resumenMaterias' => collect(),
                'alumnosRiesgo' => collect(),
                'filtros' => array(
                    'id_periodo' => $periodoId,
                    'id_carrera' => null,
                    'id_materia' => null,
                    'grupo' => null,
                    'id_unidad' => null,
                ),
            ));
        }

        $carreraId = (int) $contexto['id_carrera'];
        $materiaId = $request->filled('id_materia') ? (int) $request->get('id_materia') : null;
        $grupo = $request->filled('grupo') ? (int) $request->get('grupo') : null;
        $unidadId = $request->filled('id_unidad') ? (int) $request->get('id_unidad') : null;

        $materias = $this->obtenerMateriasDocentes($periodoId, $carreraId);
        $unidades = $this->obtenerUnidades($periodoId, $materiaId, $grupo);
        $resumenMaterias = $this->obtenerResumenMaterias($periodoId, $carreraId, $materiaId, $grupo, $unidadId);
        $alumnosRiesgo = $this->obtenerAlumnosRiesgo($periodoId, $carreraId, $materiaId, $grupo, $unidadId);

        return view('analisis_reprobacion.index', array(
            'periodos' => $periodos,
            'contexto' => $contexto,
            'carreras' => collect($contexto['carreras']),
            'materias' => $materias,
            'unidades' => $unidades,
            'resumenMaterias' => $resumenMaterias,
            'alumnosRiesgo' => $alumnosRiesgo,
            'filtros' => array(
                'id_periodo' => $periodoId,
                'id_carrera' => $carreraId,
                'id_materia' => $materiaId,
                'grupo' => $grupo,
                'id_unidad' => $unidadId,
            ),
        ));
    }

    public function generarCorte(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer|min:1',
            'id_carrera' => 'required|integer|min:1',
            'id_materia' => 'required|integer|min:1',
            'grupo' => 'required|integer|min:1',
            'id_unidad' => 'nullable|integer|min:0',
            'id_personal_docente' => 'nullable|integer|min:0',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $periodoId = (int) $request->get('id_periodo');
        $carreraId = (int) $request->get('id_carrera');
        $materiaId = (int) $request->get('id_materia');
        $grupo = (int) $request->get('grupo');
        $unidadId = $request->filled('id_unidad') ? (int) $request->get('id_unidad') : 0;
        $docenteId = $request->filled('id_personal_docente') ? (int) $request->get('id_personal_docente') : 0;
        $anioCorte = (int) date('Y');
        $mesCorte = (int) date('n');

        $contexto = $this->resolverContextoUsuario($periodoId, $request);

        if (!$contexto['permitido'] || (int) $contexto['id_carrera'] !== $carreraId) {
            return redirect()->route('j_carrera.analisis_reprobacion.index', array(
                'id_periodo' => $periodoId,
                'id_carrera' => $carreraId,
                'id_materia' => $materiaId,
                'grupo' => $grupo,
                'id_unidad' => $unidadId ?: null,
            ))->with('error', 'No tienes permiso para generar el corte de esta carrera.');
        }

        $resumen = $this->obtenerResumenMaterias($periodoId, $carreraId, $materiaId, $grupo, $unidadId ?: null)->first();

        if (!$resumen) {
            return redirect()->route('j_carrera.analisis_reprobacion.index', array(
                'id_periodo' => $periodoId,
                'id_carrera' => $carreraId,
                'id_materia' => $materiaId,
                'grupo' => $grupo,
                'id_unidad' => $unidadId ?: null,
            ))->with('error', 'No hay datos para generar el corte mensual.');
        }

        $alumnosCorte = $this->obtenerAlumnosParaCorte($periodoId, $carreraId, $materiaId, $grupo, $unidadId ?: null);

        if ($alumnosCorte->isEmpty()) {
            return redirect()->route('j_carrera.analisis_reprobacion.index', array(
                'id_periodo' => $periodoId,
                'id_carrera' => $carreraId,
                'id_materia' => $materiaId,
                'grupo' => $grupo,
                'id_unidad' => $unidadId ?: null,
            ))->with('error', 'No se encontraron alumnos inscritos para generar el corte.');
        }

        DB::transaction(function () use ($periodoId, $carreraId, $materiaId, $grupo, $unidadId, $docenteId, $anioCorte, $mesCorte, $resumen, $contexto, $alumnosCorte) {
            $datosCorte = array(
                'fecha_corte' => now(),
                'anio_corte' => $anioCorte,
                'mes_corte' => $mesCorte,
                'total_inscritos' => (int) $resumen->total_inscritos,
                'total_reprobados' => (int) $resumen->total_reprobados,
                'porcentaje_reprobacion' => (float) $resumen->porcentaje_reprobacion,
                'id_usuario_genero' => Auth::id(),
                'id_personal_genero' => $contexto['id_personal'],
                'updated_at' => now(),
            );

            $existente = DB::table('ar_cortes_reprobacion')
                ->where('id_periodo', $periodoId)
                ->where('id_carrera', $carreraId)
                ->where('id_materia', $materiaId)
                ->where('id_grupo', $grupo)
                ->where('id_unidad', $unidadId)
                ->where('id_personal_docente', $docenteId)
                ->where('anio_corte', $anioCorte)
                ->where('mes_corte', $mesCorte)
                ->first();

            if ($existente) {
                DB::table('ar_cortes_reprobacion')
                    ->where('id_ar_corte', $existente->id_ar_corte)
                    ->update($datosCorte);

                $corteId = (int) $existente->id_ar_corte;

                DB::table('ar_corte_alumnos')
                    ->where('id_ar_corte', $corteId)
                    ->delete();
            } else {
                $datosCorte['id_periodo'] = $periodoId;
                $datosCorte['id_carrera'] = $carreraId;
                $datosCorte['id_materia'] = $materiaId;
                $datosCorte['id_grupo'] = $grupo;
                $datosCorte['id_unidad'] = $unidadId;
                $datosCorte['id_personal_docente'] = $docenteId;
                $datosCorte['created_at'] = now();

                $corteId = DB::table('ar_cortes_reprobacion')->insertGetId($datosCorte);
            }

            foreach ($alumnosCorte as $alumno) {
                DB::table('ar_corte_alumnos')->insert(array(
                    'id_ar_corte' => $corteId,
                    'id_periodo' => $periodoId,
                    'id_carrera' => $carreraId,
                    'id_materia' => $materiaId,
                    'id_grupo' => $grupo,
                    'id_unidad' => $unidadId,
                    'id_alumno' => $alumno->id_alumno,
                    'id_carga_academica' => $alumno->id_carga_academica,
                    'calificacion' => $alumno->calificacion,
                    'reprobado' => (int) $alumno->reprobado,
                    'materias_reprobadas_periodo' => (int) $alumno->materias_reprobadas,
                    'semaforo' => $alumno->semaforo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ));
            }
        });

        return redirect()->route('j_carrera.analisis_reprobacion.index', array(
            'id_periodo' => $periodoId,
            'id_carrera' => $carreraId,
            'id_materia' => $materiaId,
            'grupo' => $grupo,
            'id_unidad' => $unidadId ?: null,
        ))->with('success', 'Corte mensual de análisis generado correctamente.');
    }

    public function guardarEstrategia(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer|min:1',
            'id_carrera' => 'required|integer|min:1',
            'id_alumno' => 'required|integer|min:1',
            'estrategia' => 'required|string',
            'seguimiento' => 'nullable|string',
            'responsable_texto' => 'nullable|string|max:255',
            'fecha_compromiso' => 'nullable|date',
            'fecha_seguimiento' => 'nullable|date',
            'evidencia' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ), array(
            'estrategia.required' => 'La estrategia es obligatoria para estudiantes en amarillo o rojo.',
            'evidencia.mimes' => 'La evidencia debe ser PDF, imagen o documento Word.',
            'evidencia.max' => 'La evidencia no debe superar 10 MB.',
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $periodoId = (int) $request->get('id_periodo');
        $carreraId = (int) $request->get('id_carrera');
        $alumnoId = (int) $request->get('id_alumno');

        $contexto = $this->resolverContextoUsuario($periodoId, $request);

        if (!$contexto['permitido'] || (int) $contexto['id_carrera'] !== $carreraId) {
            return redirect()->back()->with('error', 'No tienes permiso para registrar seguimiento en esta carrera.');
        }

        $totalMaterias = $this->contarMateriasReprobadasAlumno($periodoId, $carreraId, $alumnoId);

        if ($totalMaterias < 2) {
            return redirect()->back()->with('error', 'Solo se puede registrar estrategia obligatoria cuando el estudiante está en amarillo o rojo.');
        }

        $semaforo = $totalMaterias == 2 ? 'amarillo' : 'rojo';
        $personalId = $contexto['id_personal'] ? (int) $contexto['id_personal'] : null;
        $userId = Auth::id();
        $archivo = $request->file('evidencia');
        $rutaRelativa = null;
        $extension = null;
        $nombreOriginal = null;
        $mime = null;
        $sizeBytes = null;

        if ($archivo) {
            if (!$archivo->isValid()) {
                return redirect()->back()->with('error', 'El archivo de evidencia no se cargó correctamente.');
            }

            $directorio = public_path('analisis_reprobacion/evidencias');

            if (!is_dir($directorio)) {
                @mkdir($directorio, 0775, true);
            }

            $extension = strtolower($archivo->getClientOriginalExtension());
            $nombreOriginal = $archivo->getClientOriginalName();
            $mime = $archivo->getClientMimeType();
            $sizeBytes = $archivo->getSize();
            $nombreArchivo = 'evidencia_' . $periodoId . '_' . $alumnoId . '_' . date('Ymd_His') . '.' . $extension;

            $archivo->move($directorio, $nombreArchivo);
            $rutaRelativa = 'analisis_reprobacion/evidencias/' . $nombreArchivo;
        }

        DB::transaction(function () use ($request, $periodoId, $carreraId, $alumnoId, $totalMaterias, $semaforo, $personalId, $userId, $rutaRelativa, $extension, $nombreOriginal, $mime, $sizeBytes) {
            $existente = DB::table('ar_estrategias_reprobacion')
                ->where('id_periodo', $periodoId)
                ->where('id_carrera', $carreraId)
                ->where('id_alumno', $alumnoId)
                ->first();

            $datosEstrategia = array(
                'total_materias_reprobadas' => $totalMaterias,
                'semaforo' => $semaforo,
                'estrategia' => $request->get('estrategia'),
                'seguimiento' => $request->get('seguimiento'),
                'id_personal_responsable' => $personalId,
                'responsable_texto' => $request->get('responsable_texto'),
                'fecha_compromiso' => $request->get('fecha_compromiso'),
                'fecha_seguimiento' => $request->get('fecha_seguimiento'),
                'estado' => 'en_seguimiento',
                'id_usuario_registro' => $userId,
                'id_personal_registro' => $personalId,
                'updated_at' => now(),
            );

            if ($existente) {
                DB::table('ar_estrategias_reprobacion')
                    ->where('id_ar_estrategia', $existente->id_ar_estrategia)
                    ->update($datosEstrategia);

                $estrategiaId = (int) $existente->id_ar_estrategia;
            } else {
                $datosEstrategia['id_periodo'] = $periodoId;
                $datosEstrategia['id_carrera'] = $carreraId;
                $datosEstrategia['id_alumno'] = $alumnoId;
                $datosEstrategia['created_at'] = now();

                $estrategiaId = DB::table('ar_estrategias_reprobacion')->insertGetId($datosEstrategia);
            }

            DB::table('ar_estrategia_materias')
                ->where('id_ar_estrategia', $estrategiaId)
                ->delete();

            $materias = $this->obtenerMateriasReprobadasAlumno($periodoId, $carreraId, $alumnoId);

            foreach ($materias as $materia) {
                DB::table('ar_estrategia_materias')->updateOrInsert(
                    array(
                        'id_ar_estrategia' => $estrategiaId,
                        'id_materia' => $materia->id_materia,
                        'id_unidad' => $materia->id_unidad,
                    ),
                    array(
                        'id_carga_academica' => $materia->id_carga_academica,
                        'calificacion' => $materia->calificacion,
                        'created_at' => now(),
                        'updated_at' => now(),
                    )
                );
            }

            if ($rutaRelativa) {
                DB::table('ar_evidencias_reprobacion')->insert(array(
                    'id_ar_estrategia' => $estrategiaId,
                    'ruta_archivo' => $rutaRelativa,
                    'nombre_original' => $nombreOriginal,
                    'extension' => $extension,
                    'mime' => $mime,
                    'size_bytes' => $sizeBytes,
                    'observaciones' => $request->get('seguimiento'),
                    'id_usuario_subio' => $userId,
                    'id_personal_subio' => $personalId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ));
            }
        });

        return redirect()->back()->with('success', 'Estrategia registrada correctamente.');
    }


    public function exportarReprobadosExcel(Request $request)
    {
        $periodoId = (int) $request->get('id_periodo', 0);

        /*
         * En producción el primer acceso al módulo puede abrirse sin id_periodo en la URL.
         * La vista sí resuelve un periodo por defecto, pero si el botón de Excel toma sólo
         * request()->query(), el exportador recibe id_periodo = 0 y descarga el archivo vacío.
         * Por eso el exportador también replica la selección automática del index.
         */
        if ($periodoId <= 0) {
            $periodoActivo = DB::table('gnral_periodos')
                ->select('id_periodo')
                ->where('estado', 1)
                ->orderBy('id_periodo', 'desc')
                ->first();

            if (!$periodoActivo) {
                $periodoActivo = DB::table('gnral_periodos')
                    ->select('id_periodo')
                    ->orderBy('id_periodo', 'desc')
                    ->first();
            }

            $periodoId = $periodoActivo ? (int) $periodoActivo->id_periodo : 0;
        }

        if ($periodoId <= 0) {
            abort(422, 'No se pudo determinar el periodo para exportar.');
        }

        $contexto = $this->resolverContextoUsuario($periodoId, $request);

        if (!$contexto['permitido']) {
            abort(403, 'No tienes permiso para exportar esta información.');
        }

        $carreraId = (int) $contexto['id_carrera'];
        $materiaId = $request->filled('id_materia') ? (int) $request->get('id_materia') : null;
        $grupo = $request->filled('grupo') ? (int) $request->get('grupo') : null;
        $unidadId = $request->filled('id_unidad') ? (int) $request->get('id_unidad') : null;

        $alumnos = $this->obtenerAlumnosRiesgo($periodoId, $carreraId, $materiaId, $grupo, $unidadId);

        $periodo = DB::table('gnral_periodos')
            ->where('id_periodo', $periodoId)
            ->first();

        $carrera = DB::table('gnral_carreras')
            ->where('id_carrera', $carreraId)
            ->first();

        $materia = null;
        if ($materiaId) {
            $materia = DB::table('gnral_materias')
                ->where('id_materia', $materiaId)
                ->first();
        }

        $limpiar = function ($valor) {
            return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
        };

        $nombreArchivo = 'reprobados_' . date('Ymd_His') . '.xls';

        $html = '';
        $html .= '<html><head><meta charset="UTF-8">';
        $html .= '<style>';
        $html .= 'table{border-collapse:collapse;width:100%;}';
        $html .= 'th,td{border:1px solid #000000;padding:5px;font-size:12px;}';
        $html .= 'th{background:#d9edf7;font-weight:bold;text-align:center;}';
        $html .= '.center{text-align:center;}';
        $html .= '.titulo{font-size:16px;font-weight:bold;}';
        $html .= '</style>';
        $html .= '</head><body>';

        $html .= '<table>';
        $html .= '<tr><td colspan="12" class="titulo">ANÁLISIS DE REPROBACIÓN - ESTUDIANTES REPROBADOS</td></tr>';
        $html .= '<tr><td colspan="12"><strong>Periodo:</strong> ' . $limpiar($periodo ? $periodo->periodo : $periodoId) . '</td></tr>';
        $html .= '<tr><td colspan="12"><strong>Programa educativo:</strong> ' . $limpiar($carrera ? $carrera->nombre : $carreraId) . '</td></tr>';
        $html .= '<tr><td colspan="12"><strong>Asignatura:</strong> ' . $limpiar($materia ? $materia->nombre : 'Todas') . '</td></tr>';
        $html .= '<tr><td colspan="12"><strong>Grupo:</strong> ' . $limpiar($grupo ?: 'Todos') . '</td></tr>';
        $html .= '<tr><td colspan="12"><strong>Unidad:</strong> ' . $limpiar($unidadId ?: 'Todas') . '</td></tr>';
        $html .= '<tr><td colspan="12"><strong>Fecha de descarga:</strong> ' . date('d/m/Y H:i') . '</td></tr>';
        $html .= '</table><br>';

        $html .= '<table>';
        $html .= '<thead><tr>';
        $html .= '<th>No.</th>';
        $html .= '<th>No. Cuenta</th>';
        $html .= '<th>Estudiante</th>';
        $html .= '<th>Asignatura</th>';
        $html .= '<th>Semestre</th>';
        $html .= '<th>Grupo</th>';
        $html .= '<th>Unidad</th>';
        $html .= '<th>Calificación</th>';
        $html .= '<th>No. asignaturas reprobadas</th>';
        $html .= '<th>Semáforo</th>';
        $html .= '<th>Estrategia registrada</th>';
        $html .= '<th>Estado estrategia</th>';
        $html .= '</tr></thead><tbody>';

        if ($alumnos->isEmpty()) {
            $html .= '<tr><td colspan="12" class="center">No hay estudiantes reprobados con los filtros seleccionados.</td></tr>';
        } else {
            $contador = 1;
            $alumnosAgrupados = $alumnos->groupBy('id_alumno');

            foreach ($alumnosAgrupados as $filasAlumno) {
                $alumnoPrincipal = $filasAlumno->first();
                $primeraFilaAlumno = true;

                $filasPorAsignaturaGrupo = $filasAlumno->groupBy(function ($fila) {
                    return $fila->id_materia . '_' . $fila->grupo;
                });

                foreach ($filasPorAsignaturaGrupo as $filasAsignatura) {
                    $asignaturaPrincipal = $filasAsignatura->first();
                    $primeraFilaAsignatura = true;

                    foreach ($filasAsignatura as $alumno) {
                        $html .= '<tr>';

                        if ($primeraFilaAlumno) {
                            $html .= '<td class="center">' . $contador . '</td>';
                            $html .= '<td class="center">' . $limpiar($alumnoPrincipal->cuenta) . '</td>';
                            $html .= '<td>' . $limpiar($alumnoPrincipal->estudiante) . '</td>';
                        } else {
                            $html .= '<td class="center"></td>';
                            $html .= '<td class="center"></td>';
                            $html .= '<td></td>';
                        }

                        if ($primeraFilaAsignatura) {
                            $html .= '<td>' . $limpiar($asignaturaPrincipal->materia) . '</td>';
                            $html .= '<td class="center">' . $limpiar($asignaturaPrincipal->id_semestre) . '</td>';
                            $html .= '<td class="center">' . $limpiar($asignaturaPrincipal->grupo) . '</td>';
                        } else {
                            $html .= '<td></td>';
                            $html .= '<td class="center"></td>';
                            $html .= '<td class="center"></td>';
                        }

                        $html .= '<td class="center">' . $limpiar($alumno->id_unidad) . '</td>';
                        $html .= '<td class="center">' . $limpiar($alumno->calificacion) . '</td>';

                        if ($primeraFilaAlumno) {
                            $html .= '<td class="center">' . $limpiar($alumnoPrincipal->materias_reprobadas) . '</td>';
                            $html .= '<td class="center">' . $limpiar(strtoupper($alumnoPrincipal->semaforo)) . '</td>';
                            $html .= '<td>' . $limpiar($alumnoPrincipal->estrategia_registrada ?: 'Sin estrategia registrada') . '</td>';
                            $html .= '<td class="center">' . $limpiar($alumnoPrincipal->estado_estrategia ?: 'Sin registro') . '</td>';
                        } else {
                            $html .= '<td class="center"></td>';
                            $html .= '<td class="center"></td>';
                            $html .= '<td></td>';
                            $html .= '<td class="center"></td>';
                        }

                        $html .= '</tr>';

                        $primeraFilaAlumno = false;
                        $primeraFilaAsignatura = false;
                    }
                }

                $contador++;
            }
        }

        $html .= '</tbody></table>';
        $html .= '</body></html>';

        return response($html, 200, array(
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $nombreArchivo . '"',
            'Cache-Control' => 'max-age=0',
            'Pragma' => 'public',
        ));
    }

    public function grafica(Request $request, $idMateria)
    {
        $periodoId = (int) $request->get('id_periodo', 0);
        $contexto = $this->resolverContextoUsuario($periodoId, $request);

        if (!$contexto['permitido']) {
            return response()->json(array('ok' => false, 'message' => 'No se pudo identificar la carrera del usuario.'), 403);
        }

        $materiaBase = DB::table('gnral_materias')
            ->where('id_materia', (int) $idMateria)
            ->first();

        if (!$materiaBase) {
            return response()->json(array('ok' => false, 'message' => 'Materia no encontrada.'), 404);
        }

        $carreraId = (int) $contexto['id_carrera'];
        $grupo = $request->filled('grupo') ? (int) $request->get('grupo') : null;
        $compararPorClave = trim((string) $materiaBase->clave) !== '';

        $query = DB::table('eva_carga_academica as ca')
            ->join('gnral_periodos as pe', 'pe.id_periodo', '=', 'ca.id_periodo')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->leftJoin('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->leftJoin('gnral_periodo_carreras as gpc', function ($join) {
                $join->on('gpc.id_periodo', '=', 'ca.id_periodo')
                    ->on('gpc.id_carrera', '=', 'r.id_carrera');
            })
            ->leftJoin('gnral_horarios as h', 'h.id_periodo_carrera', '=', 'gpc.id_periodo_carrera')
            ->leftJoin('gnral_horas_profesores as hp', function ($join) {
                $join->on('hp.id_horario_profesor', '=', 'h.id_horario_profesor')
                    ->on('hp.grupo', '=', 'ca.grupo');
            })
            ->leftJoin('gnral_materias_perfiles as mp', function ($join) {
                $join->on('mp.id_materia_perfil', '=', 'hp.id_materia_perfil')
                    ->on('mp.id_materia', '=', 'ca.id_materia');
            })
            ->leftJoin('gnral_personales as per', 'per.id_personal', '=', 'mp.id_personal')
            ->where('r.id_carrera', $carreraId);

        if ($compararPorClave) {
            $query->where('m.clave', $materiaBase->clave);
        } else {
            $query->where('m.nombre', $materiaBase->nombre);
        }

        if ($grupo !== null) {
            $query->where('ca.grupo', $grupo);
        }

        $historico = $query
            ->groupBy('pe.id_periodo', 'pe.periodo', 'pe.year', 'pe.fecha_inicio', 'm.clave', 'm.nombre')
            ->orderBy('pe.fecha_inicio', 'asc')
            ->select(
                'pe.id_periodo',
                'pe.periodo',
                'pe.year',
                'm.clave',
                'm.nombre as materia',
                DB::raw("GROUP_CONCAT(DISTINCT per.nombre ORDER BY per.nombre SEPARATOR ', ') as docentes"),
                DB::raw('COUNT(DISTINCT ca.id_alumno) as total_inscritos'),
                DB::raw('COUNT(DISTINCT CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN ca.id_alumno END) as total_reprobados'),
                DB::raw('ROUND((COUNT(DISTINCT CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN ca.id_alumno END) / NULLIF(COUNT(DISTINCT ca.id_alumno), 0)) * 100, 2) as porcentaje_reprobacion')
            )
            ->get();

        return response()->json(array(
            'ok' => true,
            'materia' => $materiaBase->nombre,
            'clave' => $materiaBase->clave,
            'data' => $historico,
        ));
    }


    public function graficaUnidades(Request $request, $idMateria, $grupo)
    {
        $periodoId = (int) $request->get('id_periodo', 0);
        $contexto = $this->resolverContextoUsuario($periodoId, $request);

        if (!$contexto['permitido']) {
            return response()->json(array(
                'ok' => false,
                'message' => 'No se pudo identificar la carrera del usuario.'
            ), 403);
        }

        $carreraId = (int) $contexto['id_carrera'];
        $idMateria = (int) $idMateria;
        $grupo = (int) $grupo;

        if ($periodoId <= 0 || $idMateria <= 0 || $grupo <= 0) {
            return response()->json(array(
                'ok' => false,
                'message' => 'Faltan datos para generar la gráfica por unidades.'
            ), 422);
        }

        $materia = DB::table('gnral_materias')
            ->where('id_materia', $idMateria)
            ->first();

        if (!$materia) {
            return response()->json(array(
                'ok' => false,
                'message' => 'Materia no encontrada.'
            ), 404);
        }

        $data = DB::table('cal_periodos_califica as pc')
            ->join('eva_carga_academica as ca', function ($join) {
                $join->on('ca.id_periodo', '=', 'pc.id_periodos')
                    ->on('ca.id_materia', '=', 'pc.id_materia')
                    ->on('ca.grupo', '=', 'pc.id_grupo');
            })
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->leftJoin('cal_unidades as u', 'u.id_unidad', '=', 'pc.id_unidad')
            ->leftJoin('cal_evaluaciones as ev', function ($join) {
                $join->on('ev.id_carga_academica', '=', 'ca.id_carga_academica')
                    ->on('ev.id_unidad', '=', 'pc.id_unidad');
            })
            ->where('pc.id_periodos', $periodoId)
            ->where('pc.id_materia', $idMateria)
            ->where('pc.id_grupo', $grupo)
            ->where('pc.evaluada', 1)
            ->where('r.id_carrera', $carreraId)
            ->groupBy('pc.id_unidad', 'u.descripcion')
            ->orderBy('pc.id_unidad')
            ->select(
                'pc.id_unidad',
                'u.descripcion',
                DB::raw('COUNT(DISTINCT ca.id_alumno) as total_inscritos'),
                DB::raw('COUNT(DISTINCT CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN ca.id_alumno END) as total_reprobados'),
                DB::raw('ROUND((COUNT(DISTINCT CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN ca.id_alumno END) / NULLIF(COUNT(DISTINCT ca.id_alumno), 0)) * 100, 2) as porcentaje_reprobacion')
            )
            ->get();

        return response()->json(array(
            'ok' => true,
            'materia' => $materia->nombre,
            'clave' => $materia->clave,
            'grupo' => $grupo,
            'data' => $data,
        ));
    }

    private function resolverContextoUsuario($periodoId, Request $request)
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return array(
                'permitido' => false,
                'mensaje' => 'No hay usuario autenticado.',
                'id_personal' => null,
                'id_carrera' => null,
                'carrera' => null,
                'carreras' => array(),
            );
        }

        $personal = DB::table('gnral_personales')
            ->where('correo', $usuario->email)
            ->first();

        if (!$personal) {
            return array(
                'permitido' => false,
                'mensaje' => 'El correo del usuario no está relacionado con gnral_personales.correo.',
                'id_personal' => null,
                'id_carrera' => null,
                'carrera' => null,
                'carreras' => array(),
            );
        }

        $carreras = DB::table('gnral_jefes_periodos as jp')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'jp.id_carrera')
            ->where('jp.id_personal', $personal->id_personal)
            ->when($periodoId > 0, function ($query) use ($periodoId) {
                $query->where('jp.id_periodo', $periodoId);
            })
            ->orderBy('jp.id_jefe_periodo', 'desc')
            ->select('jp.id_carrera', 'c.nombre as carrera', 'jp.id_periodo', 'jp.tipo_cargo')
            ->get();

        if ($carreras->isEmpty()) {
            return array(
                'permitido' => false,
                'mensaje' => 'El usuario no tiene carrera asignada como jefe de división en el periodo seleccionado.',
                'id_personal' => $personal->id_personal,
                'id_carrera' => null,
                'carrera' => null,
                'carreras' => array(),
            );
        }

        $carreraSeleccionada = null;

        if ($request->filled('id_carrera')) {
            $carreraSeleccionada = $carreras->firstWhere('id_carrera', (int) $request->get('id_carrera'));
        }

        if (!$carreraSeleccionada) {
            $carreraSeleccionada = $carreras->first();
        }

        return array(
            'permitido' => true,
            'mensaje' => null,
            'id_personal' => $personal->id_personal,
            'id_carrera' => (int) $carreraSeleccionada->id_carrera,
            'carrera' => $carreraSeleccionada->carrera,
            'carreras' => $carreras,
        );
    }

    private function obtenerMateriasDocentes($periodoId, $carreraId)
    {
        return DB::table('gnral_periodo_carreras as gpc')
            ->join('gnral_horarios as h', 'h.id_periodo_carrera', '=', 'gpc.id_periodo_carrera')
            ->join('gnral_horas_profesores as hp', 'hp.id_horario_profesor', '=', 'h.id_horario_profesor')
            ->join('gnral_materias_perfiles as mp', 'mp.id_materia_perfil', '=', 'hp.id_materia_perfil')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'mp.id_materia')
            ->join('gnral_personales as per', 'per.id_personal', '=', 'mp.id_personal')
            ->where('gpc.id_periodo', $periodoId)
            ->where('gpc.id_carrera', $carreraId)
            ->select(
                'm.id_materia',
                'm.clave',
                'm.nombre as materia',
                'm.unidades',
                'hp.grupo',
                'per.id_personal',
                'per.nombre as docente'
            )
            ->distinct()
            ->orderBy('m.nombre')
            ->orderBy('hp.grupo')
            ->get();
    }

    private function obtenerUnidades($periodoId, $materiaId = null, $grupo = null)
    {
        if (!$materiaId || !$grupo) {
            return collect();
        }

        return DB::table('cal_periodos_califica as pc')
            ->leftJoin('cal_unidades as u', 'u.id_unidad', '=', 'pc.id_unidad')
            ->where('pc.id_periodos', $periodoId)
            ->where('pc.id_materia', $materiaId)
            ->where('pc.id_grupo', $grupo)
            ->select('pc.id_unidad', 'u.descripcion', 'pc.evaluada', 'pc.fecha')
            ->distinct()
            ->orderBy('pc.id_unidad')
            ->get();
    }

    private function obtenerResumenMaterias($periodoId, $carreraId, $materiaId = null, $grupo = null, $unidadId = null)
    {
        $query = DB::table('eva_carga_academica as ca')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ca.id_alumno')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->join('gnral_carreras as c', 'c.id_carrera', '=', 'r.id_carrera')
            ->join('gnral_periodos as pe', 'pe.id_periodo', '=', 'ca.id_periodo')
            ->leftJoin('cal_evaluaciones as ev', function ($join) use ($unidadId) {
                $join->on('ev.id_carga_academica', '=', 'ca.id_carga_academica');
                if ($unidadId) {
                    $join->where('ev.id_unidad', '=', $unidadId);
                }
            })
            ->leftJoin('gnral_periodo_carreras as gpc', function ($join) {
                $join->on('gpc.id_periodo', '=', 'ca.id_periodo')
                    ->on('gpc.id_carrera', '=', 'r.id_carrera');
            })
            ->leftJoin('gnral_horarios as h', 'h.id_periodo_carrera', '=', 'gpc.id_periodo_carrera')
            ->leftJoin('gnral_horas_profesores as hp', function ($join) {
                $join->on('hp.id_horario_profesor', '=', 'h.id_horario_profesor')
                    ->on('hp.grupo', '=', 'ca.grupo');
            })
            ->leftJoin('gnral_materias_perfiles as mp', function ($join) {
                $join->on('mp.id_materia_perfil', '=', 'hp.id_materia_perfil')
                    ->on('mp.id_materia', '=', 'ca.id_materia');
            })
            ->leftJoin('gnral_personales as per', 'per.id_personal', '=', 'mp.id_personal')
            ->where('ca.id_periodo', $periodoId)
            ->where('r.id_carrera', $carreraId);

        if ($materiaId) {
            $query->where('ca.id_materia', $materiaId);
        }

        if ($grupo) {
            $query->where('ca.grupo', $grupo);
        }

        return $query
            ->groupBy('c.id_carrera', 'c.nombre', 'pe.id_periodo', 'pe.periodo', 'm.id_materia', 'm.clave', 'm.nombre', 'ca.grupo')
            ->orderBy(DB::raw('porcentaje_reprobacion'), 'desc')
            ->select(
                'c.id_carrera',
                'c.nombre as carrera',
                'pe.id_periodo',
                'pe.periodo',
                'm.id_materia',
                'm.clave',
                'm.nombre as materia',
                'ca.grupo',
                DB::raw("GROUP_CONCAT(DISTINCT per.nombre ORDER BY per.nombre SEPARATOR ', ') as docentes"),
                DB::raw("GROUP_CONCAT(DISTINCT per.id_personal ORDER BY per.id_personal SEPARATOR ',') as docentes_ids"),
                DB::raw('COUNT(DISTINCT ca.id_alumno) as total_inscritos'),
                DB::raw('COUNT(DISTINCT CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN ca.id_alumno END) as total_reprobados'),
                DB::raw('ROUND((COUNT(DISTINCT CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN ca.id_alumno END) / NULLIF(COUNT(DISTINCT ca.id_alumno), 0)) * 100, 2) as porcentaje_reprobacion')
            )
            ->get();
    }

    private function obtenerAlumnosRiesgo($periodoId, $carreraId, $materiaId = null, $grupo = null, $unidadId = null)
    {
        $subMaterias = $this->subconsultaMateriasReprobadas($periodoId, $carreraId);

        $query = DB::table('eva_carga_academica as ca')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ca.id_alumno')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->join(DB::raw('(' . $subMaterias->toSql() . ') as mr'), 'mr.id_alumno', '=', 'ca.id_alumno')
            ->mergeBindings($subMaterias)
            ->where('ca.id_periodo', $periodoId)
            ->where('r.id_carrera', $carreraId)
            ->where('ev.calificacion', '<', self::CALIFICACION_MINIMA_APROBATORIA);

        if ($materiaId) {
            $query->where('ca.id_materia', $materiaId);
        }

        if ($grupo) {
            $query->where('ca.grupo', $grupo);
        }

        if ($unidadId) {
            $query->where('ev.id_unidad', $unidadId);
        }

        $alumnos = $query
            ->groupBy(
                'a.id_alumno',
                'a.cuenta',
                'a.nombre',
                'a.apaterno',
                'a.amaterno',
                'a.id_semestre',
                'ca.id_carga_academica',
                'ca.id_materia',
                'm.nombre',
                'm.clave',
                'ca.grupo',
                'ev.id_unidad',
                'ev.calificacion',
                'mr.materias_reprobadas'
            )
            ->orderByRaw("CASE WHEN mr.materias_reprobadas >= 3 THEN 1 WHEN mr.materias_reprobadas = 2 THEN 2 ELSE 3 END")
            ->orderBy('ca.grupo')
            ->orderBy('a.apaterno')
            ->orderBy('a.amaterno')
            ->orderBy('a.nombre')
            ->orderBy('m.nombre')
            ->orderBy('ev.id_unidad')
            ->select(
                'a.id_alumno',
                'a.cuenta',
                DB::raw("CONCAT_WS(' ', a.nombre, a.apaterno, a.amaterno) as estudiante"),
                'a.id_semestre',
                'ca.id_carga_academica',
                'ca.id_materia',
                'm.clave',
                'm.nombre as materia',
                'ca.grupo',
                'ev.id_unidad',
                'ev.calificacion',
                'mr.materias_reprobadas',
                DB::raw("CASE
                    WHEN mr.materias_reprobadas = 1 THEN 'verde'
                    WHEN mr.materias_reprobadas = 2 THEN 'amarillo'
                    ELSE 'rojo'
                END as semaforo")
            )
            ->get();

        return $this->agregarSeguimientoAEstrategias($periodoId, $carreraId, $alumnos);
    }

    private function obtenerAlumnosParaCorte($periodoId, $carreraId, $materiaId, $grupo, $unidadId = null)
    {
        $subMaterias = $this->subconsultaMateriasReprobadas($periodoId, $carreraId);

        $query = DB::table('eva_carga_academica as ca')
            ->join('gnral_alumnos as a', 'a.id_alumno', '=', 'ca.id_alumno')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->leftJoin('cal_evaluaciones as ev', function ($join) use ($unidadId) {
                $join->on('ev.id_carga_academica', '=', 'ca.id_carga_academica');
                if ($unidadId) {
                    $join->where('ev.id_unidad', '=', $unidadId);
                }
            })
            ->leftJoin(DB::raw('(' . $subMaterias->toSql() . ') as mr'), 'mr.id_alumno', '=', 'ca.id_alumno')
            ->mergeBindings($subMaterias)
            ->where('ca.id_periodo', $periodoId)
            ->where('r.id_carrera', $carreraId)
            ->where('ca.id_materia', $materiaId)
            ->where('ca.grupo', $grupo);

        $alumnos = $query
            ->groupBy('ca.id_alumno', 'ca.id_carga_academica', 'mr.materias_reprobadas')
            ->orderBy('a.apaterno')
            ->orderBy('a.amaterno')
            ->orderBy('a.nombre')
            ->select(
                'ca.id_alumno',
                'ca.id_carga_academica',
                DB::raw('MIN(ev.calificacion) as calificacion'),
                DB::raw('MAX(CASE WHEN ev.calificacion < ' . self::CALIFICACION_MINIMA_APROBATORIA . ' THEN 1 ELSE 0 END) as reprobado'),
                DB::raw('COALESCE(mr.materias_reprobadas, 0) as materias_reprobadas')
            )
            ->get();

        foreach ($alumnos as $alumno) {
            $alumno->semaforo = $this->resolverSemaforo((int) $alumno->materias_reprobadas);
        }

        return $alumnos;
    }

    private function subconsultaMateriasReprobadas($periodoId, $carreraId)
    {
        return DB::table('eva_carga_academica as ca2')
            ->join('gnral_materias as m2', 'm2.id_materia', '=', 'ca2.id_materia')
            ->join('gnral_reticulas as r2', 'r2.id_reticula', '=', 'm2.id_reticula')
            ->join('cal_evaluaciones as ev2', 'ev2.id_carga_academica', '=', 'ca2.id_carga_academica')
            ->where('ca2.id_periodo', $periodoId)
            ->where('r2.id_carrera', $carreraId)
            ->where('ev2.calificacion', '<', self::CALIFICACION_MINIMA_APROBATORIA)
            ->groupBy('ca2.id_alumno')
            ->select(
                'ca2.id_alumno',
                DB::raw('COUNT(DISTINCT ca2.id_materia) as materias_reprobadas')
            );
    }

    private function agregarSeguimientoAEstrategias($periodoId, $carreraId, $alumnos)
    {
        if ($alumnos->isEmpty()) {
            return $alumnos;
        }

        $alumnoIds = $alumnos->pluck('id_alumno')->unique()->values()->all();

        $estrategias = DB::table('ar_estrategias_reprobacion')
            ->where('id_periodo', $periodoId)
            ->where('id_carrera', $carreraId)
            ->whereIn('id_alumno', $alumnoIds)
            ->orderBy('id_ar_estrategia', 'desc')
            ->get()
            ->unique('id_alumno')
            ->keyBy('id_alumno');

        $estrategiaIds = $estrategias->pluck('id_ar_estrategia')->unique()->values()->all();
        $evidencias = collect();

        if (!empty($estrategiaIds)) {
            $evidencias = DB::table('ar_evidencias_reprobacion')
                ->whereIn('id_ar_estrategia', $estrategiaIds)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy('id_ar_estrategia')
                ->map(function ($items) {
                    return $items->first();
                });
        }

        foreach ($alumnos as $alumno) {
            $estrategia = $estrategias->get($alumno->id_alumno);

            $alumno->id_ar_estrategia = null;
            $alumno->estado_estrategia = null;
            $alumno->estrategia_registrada = null;
            $alumno->seguimiento_registrado = null;
            $alumno->responsable_texto = null;
            $alumno->fecha_compromiso = null;
            $alumno->fecha_seguimiento = null;
            $alumno->evidencia_ruta = null;
            $alumno->evidencia_nombre = null;

            if ($estrategia) {
                $alumno->id_ar_estrategia = $estrategia->id_ar_estrategia;
                $alumno->estado_estrategia = $estrategia->estado;
                $alumno->estrategia_registrada = $estrategia->estrategia;
                $alumno->seguimiento_registrado = $estrategia->seguimiento;
                $alumno->responsable_texto = $estrategia->responsable_texto;
                $alumno->fecha_compromiso = $estrategia->fecha_compromiso;
                $alumno->fecha_seguimiento = $estrategia->fecha_seguimiento;

                $evidencia = $evidencias->get($estrategia->id_ar_estrategia);

                if ($evidencia) {
                    $alumno->evidencia_ruta = $evidencia->ruta_archivo;
                    $alumno->evidencia_nombre = $evidencia->nombre_original;
                }
            }
        }

        return $alumnos;
    }

    private function contarMateriasReprobadasAlumno($periodoId, $carreraId, $alumnoId)
    {
        return (int) DB::table('eva_carga_academica as ca')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->where('ca.id_periodo', $periodoId)
            ->where('r.id_carrera', $carreraId)
            ->where('ca.id_alumno', $alumnoId)
            ->where('ev.calificacion', '<', self::CALIFICACION_MINIMA_APROBATORIA)
            ->distinct('ca.id_materia')
            ->count('ca.id_materia');
    }

    private function obtenerMateriasReprobadasAlumno($periodoId, $carreraId, $alumnoId)
    {
        return DB::table('eva_carga_academica as ca')
            ->join('gnral_materias as m', 'm.id_materia', '=', 'ca.id_materia')
            ->join('gnral_reticulas as r', 'r.id_reticula', '=', 'm.id_reticula')
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->where('ca.id_periodo', $periodoId)
            ->where('r.id_carrera', $carreraId)
            ->where('ca.id_alumno', $alumnoId)
            ->where('ev.calificacion', '<', self::CALIFICACION_MINIMA_APROBATORIA)
            ->groupBy('ca.id_materia', 'ca.id_carga_academica', 'ev.id_unidad', 'ev.calificacion')
            ->select('ca.id_materia', 'ca.id_carga_academica', 'ev.id_unidad', 'ev.calificacion')
            ->get();
    }

    private function resolverSemaforo($materiasReprobadas)
    {
        if ($materiasReprobadas <= 0) {
            return 'sin_riesgo';
        }

        if ($materiasReprobadas === 1) {
            return 'verde';
        }

        if ($materiasReprobadas === 2) {
            return 'amarillo';
        }

        return 'rojo';
    }
}
