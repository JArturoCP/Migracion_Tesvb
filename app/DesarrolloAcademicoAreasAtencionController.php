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
     * Pantalla principal para Desarrollo Académico:
     * asignar responsables por área/periodo y capturar horarios de atención.
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

        $periodoSeleccionado = $request->get('id_periodo');

        if (!$periodoSeleccionado && count($periodos) > 0) {
            $periodoSeleccionado = $periodos[0]->id_periodo;
        }

        $areas = DB::table('ar_areas_atencion')
            ->whereIn('nombre', array('Enfermería', 'Psicología', 'Pedagogía'))
            ->orderBy('orden')
            ->orderBy('nombre')
            ->get();

        $responsables = array();
        $horarios = array();

        foreach ($areas as $area) {
            $responsable = null;
            $listaHorarios = array();

            if ($periodoSeleccionado) {
                $responsable = DB::table('ar_area_responsables_periodo as arp')
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
                        'p.nombre',
                        'p.correo',
                        'p.clave'
                    )
                    ->orderBy('arp.id_area_responsable_periodo', 'desc')
                    ->first();

                if ($responsable) {
                    $listaHorarios = DB::table('ar_area_responsable_horarios')
                        ->where('id_area_responsable_periodo', $responsable->id_area_responsable_periodo)
                        ->where('activo', 1)
                        ->orderBy('dia_semana')
                        ->orderBy('hora_inicio')
                        ->get();
                }
            }

            $responsables[$area->id_area_atencion] = $responsable;
            $horarios[$area->id_area_atencion] = $listaHorarios;
        }

        return view('desarrollo_academico.areas_atencion.index', compact(
            'periodos',
            'periodoSeleccionado',
            'areas',
            'responsables',
            'horarios'
        ));
    }

    /**
     * Búsqueda AJAX de personal para asignar responsable.
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
            ->limit(20)
            ->get();

        return response()->json(array('items' => $items));
    }

    /**
     * Guardar responsable por área y periodo.
     * Para mantener un responsable vigente por área/periodo, se desactivan anteriores.
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
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $request->get('id_periodo')))
                ->withErrors($validator)
                ->withInput();
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idArea = (int) $request->get('id_area_atencion');
        $idPersonal = (int) $request->get('id_personal');
        $rolArea = trim($request->get('rol_area'));

        $area = DB::table('ar_areas_atencion')
            ->where('id_area_atencion', $idArea)
            ->whereIn('nombre', array('Enfermería', 'Psicología', 'Pedagogía'))
            ->first();

        if (!$area) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
                ->with('error', 'El área seleccionada no es válida.');
        }

        $personal = DB::table('gnral_personales')
            ->where('id_personal', $idPersonal)
            ->first();

        if (!$personal) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
                ->with('error', 'El personal seleccionado no existe.');
        }

        $ahora = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            DB::table('ar_area_responsables_periodo')
                ->where('id_area_atencion', $idArea)
                ->where('id_periodo', $idPeriodo)
                ->where('activo', 1)
                ->update(array(
                    'activo' => 0,
                    'updated_at' => $ahora,
                ));

            $existente = DB::table('ar_area_responsables_periodo')
                ->where('id_area_atencion', $idArea)
                ->where('id_periodo', $idPeriodo)
                ->where('id_personal', $idPersonal)
                ->where('rol_area', $rolArea)
                ->first();

            if ($existente) {
                DB::table('ar_area_responsables_periodo')
                    ->where('id_area_responsable_periodo', $existente->id_area_responsable_periodo)
                    ->update(array(
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
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
                ->with('error', 'No se pudo guardar el responsable: ' . $e->getMessage());
        }

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
            ->with('success', 'Responsable asignado correctamente para ' . $area->nombre . '.');
    }

    /**
     * Agregar horario de atención para el responsable vigente.
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
            'cupo' => 'required|integer|min:1|max:50',
        ));

        if ($validator->fails()) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $request->get('id_periodo')))
                ->withErrors($validator)
                ->withInput();
        }

        $idPeriodo = (int) $request->get('id_periodo');
        $idResponsablePeriodo = (int) $request->get('id_area_responsable_periodo');
        $diaSemana = (int) $request->get('dia_semana');
        $horaInicio = $request->get('hora_inicio');
        $horaFin = $request->get('hora_fin');
        $lugar = trim($request->get('lugar'));
        $cupo = (int) $request->get('cupo');

        if ($horaInicio >= $horaFin) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
                ->with('error', 'La hora de fin debe ser mayor que la hora de inicio.');
        }

        $responsable = DB::table('ar_area_responsables_periodo')
            ->where('id_area_responsable_periodo', $idResponsablePeriodo)
            ->where('id_periodo', $idPeriodo)
            ->where('activo', 1)
            ->first();

        if (!$responsable) {
            return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
                ->with('error', 'No existe responsable activo para agregar horario.');
        }

        $ahora = date('Y-m-d H:i:s');

        DB::table('ar_area_responsable_horarios')->insert(array(
            'id_area_responsable_periodo' => $responsable->id_area_responsable_periodo,
            'id_area_atencion' => $responsable->id_area_atencion,
            'id_periodo' => $responsable->id_periodo,
            'id_personal' => $responsable->id_personal,
            'dia_semana' => $diaSemana,
            'hora_inicio' => $horaInicio,
            'hora_fin' => $horaFin,
            'lugar' => $lugar,
            'cupo' => $cupo,
            'activo' => 1,
            'created_at' => $ahora,
            'updated_at' => $ahora,
        ));

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
            ->with('success', 'Horario agregado correctamente.');
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

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
            ->with('success', 'Horario desactivado correctamente.');
    }

    public function desactivarResponsable($id, Request $request)
    {
        if (!$this->usuarioEsDesarrolloAcademico()) {
            return redirect('/home')->with('error', 'No tienes permiso para administrar áreas de atención.');
        }

        $idPeriodo = $request->get('id_periodo');

        DB::table('ar_area_responsables_periodo')
            ->where('id_area_responsable_periodo', $id)
            ->update(array(
                'activo' => 0,
                'updated_at' => date('Y-m-d H:i:s'),
            ));

        return redirect()->route('desarrollo_academico.areas_atencion.index', array('id_periodo' => $idPeriodo))
            ->with('success', 'Responsable desactivado correctamente.');
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
                'nombre' => 'Pedagogía',
                'descripcion' => 'Área de atención pedagógica para estudiantes canalizados.',
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
