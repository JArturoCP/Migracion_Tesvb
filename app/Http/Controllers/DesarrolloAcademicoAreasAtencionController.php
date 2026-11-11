<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

class DesarrolloAcademicoAreasAtencionController extends Controller
{
    /**
     * Pantalla de Desarrollo Académico para configurar áreas de atención.
     *
     * Ajuste importante:
     * Un área puede tener más de un responsable activo en el mismo periodo.
     * Por eso ya no se desactivan responsables anteriores al agregar uno nuevo.
     */
    public function index(Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $this->asegurarAreasBase();

        $periodos = DB::table('gnral_periodos')
            ->select('id_periodo', 'periodo')
            ->orderBy('id_periodo', 'desc')
            ->get();

        // La primera carga utiliza el periodo que incluye la fecha del sistema,
        // nunca simplemente el registro con mayor ID. Se conserva la consulta histórica explícita.
        $periodoActual = $this->obtenerPeriodoActual($periodos);
        $periodoSolicitado = $request->query('id_periodo');
        $periodoSeleccionado = $periodoActual;
        if ($periodoSolicitado !== null && $periodoSolicitado !== '') {
            foreach ($periodos as $periodo) {
                if ((int) $periodo->id_periodo === (int) $periodoSolicitado) {
                    $periodoSeleccionado = $periodo->id_periodo;
                    break;
                }
            }
        }

        $areaAbierta = filter_var($request->query('area_abierta'), FILTER_VALIDATE_INT, array('options' => array('min_range' => 1))) ?: null;

        $areas = DB::table('ar_areas_atencion')
            ->where('activo', 1)
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();

        $responsables = array();
        $horarios = array();
        $conteoResponsables = array();

        foreach ($areas as $area) {
            $listaResponsables = collect();

            if ($periodoSeleccionado) {
                $listaResponsables = DB::table('ar_area_responsables_periodo as arp')
                    ->join('gnral_personales as p', 'p.id_personal', '=', 'arp.id_personal')
                    ->where('arp.id_area_atencion', $area->id_area_atencion)
                    ->where('arp.id_periodo', $periodoSeleccionado)
                    ->where('arp.activo', 1)
                    ->select(
                        'arp.id_area_responsable_periodo',
                        'arp.id_area_atencion',
                        'arp.id_periodo',
                        'arp.id_personal',
                        'arp.rol_area',
                        'arp.activo',
                        'p.nombre',
                        'p.correo',
                        'p.clave',
                        'p.rfc'
                    )
                    ->orderBy('arp.rol_area')
                    ->orderBy('p.nombre')
                    ->get();

                foreach ($listaResponsables as $responsable) {
                    $horarios[$responsable->id_area_responsable_periodo] = DB::table('ar_area_responsable_horarios')
                        ->where('id_area_responsable_periodo', $responsable->id_area_responsable_periodo)
                        ->where('activo', 1)
                        ->orderBy('dia_semana')
                        ->orderBy('hora_inicio')
                        ->get();
                }
            }

            $responsables[$area->id_area_atencion] = $listaResponsables;
            $conteoResponsables[$area->id_area_atencion] = count($listaResponsables);
        }

        return view('desarrollo_academico.areas_atencion.index', compact(
            'periodos',
            'periodoSeleccionado',
            'periodoActual',
            'areaAbierta',
            'areas',
            'responsables',
            'horarios',
            'conteoResponsables'
        ));
    }

    /**
     * Búsqueda AJAX de personal para asignar uno o varios responsables.
     */
    public function buscarPersonal(Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return response()->json(array('items' => array()), 403);
        }

        $term = trim($request->get('term', ''));

        if (strlen($term) < 2) {
            return response()->json(array('items' => array()));
        }

        $items = DB::table('gnral_personales')
            ->where(function ($q) use ($term) {
                $like = '%' . $term . '%';
                $q->where('nombre', 'LIKE', $like)
                    ->orWhere('correo', 'LIKE', $like)
                    ->orWhere('rfc', 'LIKE', $like)
                    ->orWhere('clave', 'LIKE', $like);
            })
            ->select('id_personal', 'nombre', 'correo', 'clave', 'rfc')
            ->orderBy('nombre')
            ->limit(25)
            ->get();

        return response()->json(array('items' => $items));
    }

    /**
     * Alta dinámica de áreas de atención.
     *
     * No se crean tablas nuevas. Cualquier área activa con requiere_citas = 1
     * queda disponible automáticamente como área operativa para canalizaciones
     * y citas en PIASE.
     */
    public function guardarArea(Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'nullable|integer',
            'nombre' => 'required|string|max:150',
            'descripcion' => 'nullable|string|max:500',
            'orden' => 'nullable|integer|min:1|max:999',
        ), array(
            'nombre.required' => 'Captura el nombre del área de atención.',
            'nombre.max' => 'El nombre del área no debe exceder 150 caracteres.',
        ));

        $idPeriodo = (int) $request->get('id_periodo');

        if ($validator->fails()) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->withErrors($validator)
                ->withInput();
        }

        $nombre = $this->limpiarTextoArea($request->get('nombre'));
        $descripcion = trim((string) $request->get('descripcion'));
        $orden = (int) $request->get('orden');
        if ($orden <= 0) {
            $orden = 90;
        }

        if ($nombre == '') {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'Captura el nombre del área de atención.');
        }

        if ($this->esAreaPedagogiaGeneral($nombre)) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'El nombre Pedagogía está reservado para Pedagogía general. Para citas usa Pedagogía para estudiantes u otra área operativa.');
        }

        $requiereCitas = $request->has('requiere_citas') ? 1 : 0;
        $requiereActividades = $request->has('requiere_actividades') ? 1 : 0;
        $manejaDatosSensibles = $request->has('maneja_datos_sensibles') ? 1 : 0;
        $ahora = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            $existente = DB::table('ar_areas_atencion')
                ->whereRaw('LOWER(TRIM(nombre)) = LOWER(TRIM(?))', array($nombre))
                ->first();

            if ($existente) {
                $idAreaGuardada = $existente->id_area_atencion;
                DB::table('ar_areas_atencion')
                    ->where('id_area_atencion', $existente->id_area_atencion)
                    ->update(array(
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'activo' => 1,
                        'requiere_citas' => $requiereCitas,
                        'requiere_actividades' => $requiereActividades,
                        'maneja_datos_sensibles' => $manejaDatosSensibles,
                        'orden' => $orden,
                        'updated_at' => $ahora,
                    ));
            } else {
                $idAreaGuardada = DB::table('ar_areas_atencion')->insertGetId(array(
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'activo' => 1,
                    'requiere_citas' => $requiereCitas,
                    'requiere_actividades' => $requiereActividades,
                    'maneja_datos_sensibles' => $manejaDatosSensibles,
                    'orden' => $orden,
                    'created_at' => $ahora,
                    'updated_at' => $ahora,
                ));
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'No se pudo guardar el área: ' . $e->getMessage());
        }

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $idAreaGuardada))
            ->with('success', 'Área de atención guardada correctamente. Si requiere citas, ya puede tener responsables, horarios y canalizaciones en PIASE.');
    }

    /**
     * Desactivación lógica de áreas dinámicas.
     * Conserva el historial de casos, canalizaciones, citas y actividades.
     */
    public function desactivarArea($id, Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $area = DB::table('ar_areas_atencion')
            ->where('id_area_atencion', $id)
            ->first();

        if (!$area) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'No se encontró el área seleccionada.');
        }

        if ($this->esAreaPedagogiaGeneral($area->nombre)) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'Pedagogía general no se puede desactivar porque coordina PIASE.');
        }

        DB::beginTransaction();
        try {
            DB::table('ar_areas_atencion')
                ->where('id_area_atencion', $id)
                ->update(array(
                    'activo' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

            DB::table('ar_area_responsables_periodo')
                ->where('id_area_atencion', $id)
                ->update(array(
                    'activo' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

            DB::table('ar_area_responsable_horarios')
                ->where('id_area_atencion', $id)
                ->update(array(
                    'activo' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'No se pudo desactivar el área: ' . $e->getMessage());
        }

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
            ->with('success', 'Área desactivada correctamente. El historial de atención permanece guardado.');
    }

    /**
     * Agregar responsable por área y periodo.
     *
     * Ajuste: ya NO desactiva responsables previos. Permite varios responsables
     * activos por área/periodo, evitando duplicar al mismo personal en la misma área.
     */
    public function guardarResponsable(Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_area_atencion' => 'required|integer',
            'id_personal' => 'required|integer',
            'rol_area' => 'required|string|max:50',
        ));

        if ($validator->fails()) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $request->get('id_periodo'), 'area_abierta' => $request->get('area_abierta')))
                ->withErrors($validator)
                ->withInput();
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idArea = (int) $request->get('id_area_atencion');
        $idPersonal = (int) $request->get('id_personal');
        $rolArea = trim($request->get('rol_area'));

        $area = DB::table('ar_areas_atencion')
            ->where('id_area_atencion', $idArea)
            ->where('activo', 1)
            ->first();

        if (!$area) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'El área seleccionada no es válida.');
        }

        $personal = DB::table('gnral_personales')
            ->where('id_personal', $idPersonal)
            ->first();

        if (!$personal) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'El personal seleccionado no existe.');
        }

        $ahora = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            $existenteMismoPersonal = DB::table('ar_area_responsables_periodo')
                ->where('id_area_atencion', $idArea)
                ->where('id_periodo', $idPeriodo)
                ->where('id_personal', $idPersonal)
                ->first();

            if ($existenteMismoPersonal) {
                DB::table('ar_area_responsables_periodo')
                    ->where('id_area_responsable_periodo', $existenteMismoPersonal->id_area_responsable_periodo)
                    ->update(array(
                        'rol_area' => $rolArea,
                        'activo' => 1,
                        'updated_at' => $ahora,
                    ));
            } else {
                DB::table('ar_area_responsables_periodo')->insert(array(
                    'id_area_atencion' => $idArea,
                    'id_periodo' => $idPeriodo,
                    'id_personal' => $idPersonal,
                    'rol_area' => $rolArea,
                    'activo' => 1,
                    'created_at' => $ahora,
                    'updated_at' => $ahora,
                ));
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'No se pudo guardar el responsable: ' . $e->getMessage());
        }

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
            ->with('success', 'Responsable agregado correctamente para ' . $area->nombre . '. El área puede tener más de un responsable activo.');
    }

    /**
     * Agregar horario de atención para un responsable específico.
     */
    public function guardarHorario(Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $validator = Validator::make($request->all(), array(
            'id_periodo' => 'required|integer',
            'id_area_responsable_periodo' => 'required|integer',
            'dia_semana' => 'required|integer|min:1|max:7',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'lugar' => 'nullable|string|max:150',
        ));

        if ($validator->fails()) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $request->get('id_periodo'), 'area_abierta' => $request->get('area_abierta')))
                ->withErrors($validator)
                ->withInput();
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idResponsablePeriodo = (int) $request->get('id_area_responsable_periodo');
        $diaSemana = (int) $request->get('dia_semana');
        $horaInicio = $this->normalizarHoraCerrada($request->get('hora_inicio'));
        $horaFin = $this->normalizarHoraCerrada($request->get('hora_fin'));
        $lugar = trim($request->get('lugar'));

        if (!$horaInicio || !$horaFin) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'El horario debe capturarse en horas completas, por ejemplo 09:00 - 10:00.');
        }

        if (!$this->horaCerradaValida($horaInicio) || !$this->horaCerradaValida($horaFin)) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'Solo se permiten horas completas dentro del rango de 07:00 a 20:00.');
        }

        if ($horaInicio >= $horaFin) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'La hora de fin debe ser mayor que la hora de inicio.');
        }

        $responsable = DB::table('ar_area_responsables_periodo')
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_periodo', $idPeriodo)
            ->where('activo', 1)
            ->first();

        if (!$responsable) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'No existe responsable activo para agregar horario.');
        }

        $areaResponsable = DB::table('ar_areas_atencion')
            ->where('id_area_atencion', $responsable->id_area_atencion)
            ->where('activo', 1)
            ->first();

        if (!$areaResponsable) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'El área del responsable no está activa.');
        }

        if ((int) $areaResponsable->requiere_citas !== 1) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'El área ' . $this->nombreVisualArea($areaResponsable->nombre) . ' no requiere citas, por lo que no debe capturar horarios.');
        }

        $ahora = date('Y-m-d H:i:s');

        $datosHorario = array(
            'id_area_responsable_periodo' => $responsable->id_area_responsable_periodo,
            'id_area_atencion' => $responsable->id_area_atencion,
            'id_periodo' => $responsable->id_periodo,
            'id_personal' => $responsable->id_personal,
            'dia_semana' => $diaSemana,
            'hora_inicio' => $horaInicio,
            'hora_fin' => $horaFin,
            'lugar' => $lugar,
            'activo' => 1,
            'created_at' => $ahora,
            'updated_at' => $ahora,
        );

        // Compatibilidad con instalaciones que ya tenían la columna cupo:
        // ya no se captura en pantalla. Cada bloque completo de horario equivale a una cita para un estudiante.
        if ($this->columnaExiste('ar_area_responsable_horarios', 'cupo')) {
            $datosHorario['cupo'] = 1;
        }

        DB::table('ar_area_responsable_horarios')->insert($datosHorario);

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
            ->with('success', 'Horario agregado correctamente para el responsable seleccionado.');
    }

    public function desactivarHorario($id, Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $idPeriodo = $request->get('id_periodo');

        DB::table('ar_area_responsable_horarios')
            ->where('id_area_responsable_horario', $id)
            ->update(array(
                'activo' => 0,
                'updated_at' => date('Y-m-d H:i:s'),
            ));

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
            ->with('success', 'Horario desactivado correctamente.');
    }

    public function desactivarResponsable($id, Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $idPeriodo = $request->get('id_periodo');

        DB::beginTransaction();
        try {
            DB::table('ar_area_responsables_periodo')
                ->where('id_area_responsable_periodo', $id)
                ->update(array(
                    'activo' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

            DB::table('ar_area_responsable_horarios')
                ->where('id_area_responsable_periodo', $id)
                ->update(array(
                    'activo' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
                ->with('error', 'No se pudo desactivar el responsable: ' . $e->getMessage());
        }

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo, 'area_abierta' => $request->get('area_abierta')))
            ->with('success', 'Responsable y sus horarios fueron desactivados correctamente.');
    }

    /**
     * Determina el periodo calendario vigente a partir del texto institucional:
     * por ejemplo "AGOSTO - DICIEMBRE 2026" o "ENERO - JUNIO 2027".
     * Si no hay coincidencia, no se selecciona un periodo histórico arbitrario.
     */
    private function obtenerPeriodoActual($periodos)
    {
        $hoy = \Carbon\Carbon::today(config('app.timezone'));
        $meses = array(
            'ENERO' => 1, 'FEBRERO' => 2, 'MARZO' => 3, 'ABRIL' => 4,
            'MAYO' => 5, 'JUNIO' => 6, 'JULIO' => 7, 'AGOSTO' => 8,
            'SEPTIEMBRE' => 9, 'SETIEMBRE' => 9, 'OCTUBRE' => 10,
            'NOVIEMBRE' => 11, 'DICIEMBRE' => 12
        );
        foreach ($periodos as $periodo) {
            $etiqueta = strtoupper(trim(strtr((string) $periodo->periodo, array(
                'Á'=>'A','É'=>'E','Í'=>'I','Ó'=>'O','Ú'=>'U',
                'á'=>'A','é'=>'E','í'=>'I','ó'=>'O','ú'=>'U'
            ))));
            if (!preg_match('/\b(20\d{2})\b/', $etiqueta, $anioEncontrado)) {
                continue;
            }
            $anio = (int) $anioEncontrado[1];
            // Capturar los meses en el orden en que aparecen en el nombre,
            // no en el orden del catálogo de meses.
            preg_match_all('/\b(?:ENERO|FEBRERO|MARZO|ABRIL|MAYO|JUNIO|JULIO|AGOSTO|SEPTIEMBRE|SETIEMBRE|OCTUBRE|NOVIEMBRE|DICIEMBRE)\b/', $etiqueta, $coincidencias);
            if (count($coincidencias[0]) < 2) {
                continue;
            }
            $inicio = $meses[$coincidencias[0][0]];
            $fin = $meses[$coincidencias[0][1]];
            $anioInicio = $inicio > $fin ? $anio - 1 : $anio;
            $desde = \Carbon\Carbon::create($anioInicio, $inicio, 1, 0, 0, 0);
            $hasta = \Carbon\Carbon::create($anio, $fin, 1, 0, 0, 0)->endOfMonth();
            if ($hoy->between($desde, $hasta)) {
                return $periodo->id_periodo;
            }
        }
        return null;
    }

    private function normalizarHoraCerrada($hora)
    {
        $hora = trim((string) $hora);

        if (preg_match('/^(\d{1,2}):00$/', $hora, $m)) {
            return sprintf('%02d:00:00', (int) $m[1]);
        }

        if (preg_match('/^(\d{1,2}):00:00$/', $hora, $m)) {
            return sprintf('%02d:00:00', (int) $m[1]);
        }

        return null;
    }

    private function horaCerradaValida($hora)
    {
        if (!preg_match('/^(\d{2}):00:00$/', (string) $hora, $m)) {
            return false;
        }

        $horaEntera = (int) $m[1];

        return $horaEntera >= 7 && $horaEntera <= 20;
    }

    private function limpiarTextoArea($texto)
    {
        $texto = trim((string) $texto);
        $texto = preg_replace('/\s+/u', ' ', $texto);
        return $texto;
    }

    private function normalizarNombreArea($nombre)
    {
        return strtolower(trim(strtr((string) $nombre, array(
            'Á' => 'a', 'É' => 'e', 'Í' => 'i', 'Ó' => 'o', 'Ú' => 'u',
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
            'Ñ' => 'n', 'ñ' => 'n'
        ))));
    }

    private function esAreaPedagogiaGeneral($nombre)
    {
        return $this->normalizarNombreArea($nombre) === 'pedagogia';
    }

    private function nombreVisualArea($nombre)
    {
        if ($this->esAreaPedagogiaGeneral($nombre)) {
            return 'Pedagogía general';
        }

        return $nombre;
    }

    private function columnaExiste($tabla, $columna)
    {
        return DB::table('information_schema.COLUMNS')
            ->where('TABLE_SCHEMA', DB::raw('DATABASE()'))
            ->where('TABLE_NAME', $tabla)
            ->where('COLUMN_NAME', $columna)
            ->exists();
    }

    private function usuarioEsDesarrolloAcademico()
    {
        if (Session::has('desa')) {
            return true;
        }

        if (Auth::guest()) {
            return false;
        }

        $usuario = Auth::user();
        $correo = isset($usuario->email) ? trim(strtolower($usuario->email)) : '';

        $personal = DB::table('gnral_personales')
            ->where(function ($q) use ($usuario, $correo) {
                if ($usuario && isset($usuario->id)) {
                    $q->where('tipo_usuario', $usuario->id);
                }

                if ($correo != '') {
                    $q->orWhereRaw('LOWER(TRIM(correo)) = ?', array($correo));
                }
            })
            ->first();

        if (!$personal) {
            return false;
        }

        if (isset($personal->id_departamento) && in_array((int) $personal->id_departamento, array(2, 4))) {
            return true;
        }

        if ($correo == 'des.academico@vbravo.tecnm.mx') {
            return true;
        }

        return false;
    }

    private function asegurarAreasBase()
    {
        $areas = array(
            array(
                'nombre' => 'Pedagogía',
                'descripcion' => 'Área coordinadora general de PIASE. Recibe la canalización inicial desde tutoría y administra el seguimiento institucional.',
                'requiere_citas' => 0,
                'requiere_actividades' => 1,
                'maneja_datos_sensibles' => 0,
                'orden' => 10,
            ),
            array(
                'nombre' => 'Enfermería',
                'descripcion' => 'Área de atención médica/enfermería para estudiantes canalizados.',
                'requiere_citas' => 1,
                'requiere_actividades' => 0,
                'maneja_datos_sensibles' => 0,
                'orden' => 20,
            ),
            array(
                'nombre' => 'Psicología',
                'descripcion' => 'Área de atención psicológica para estudiantes canalizados.',
                'requiere_citas' => 1,
                'requiere_actividades' => 0,
                'maneja_datos_sensibles' => 1,
                'orden' => 30,
            ),
            array(
                'nombre' => 'Pedagogía para estudiantes',
                'descripcion' => 'Área operativa de atención pedagógica directa a estudiantes mediante citas y actividades.',
                'requiere_citas' => 1,
                'requiere_actividades' => 1,
                'maneja_datos_sensibles' => 0,
                'orden' => 40,
            ),
        );

        foreach ($areas as $area) {
            $existe = DB::table('ar_areas_atencion')
                ->where('nombre', $area['nombre'])
                ->first();

            if ($existe) {
                DB::table('ar_areas_atencion')
                    ->where('id_area_atencion', $existe->id_area_atencion)
                    ->update(array(
                        'activo' => 1,
                        'requiere_citas' => $area['requiere_citas'],
                        'requiere_actividades' => $area['requiere_actividades'],
                        'maneja_datos_sensibles' => $area['maneja_datos_sensibles'],
                        'orden' => $area['orden'],
                        'updated_at' => date('Y-m-d H:i:s'),
                    ));
            } else {
                DB::table('ar_areas_atencion')->insert(array(
                    'nombre' => $area['nombre'],
                    'descripcion' => $area['descripcion'],
                    'activo' => 1,
                    'requiere_citas' => $area['requiere_citas'],
                    'requiere_actividades' => $area['requiere_actividades'],
                    'maneja_datos_sensibles' => $area['maneja_datos_sensibles'],
                    'orden' => $area['orden'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ));
            }
        }
    }
}
