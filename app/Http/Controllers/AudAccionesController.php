<?php

namespace App\Http\Controllers;

use App\AudAcciones;
use App\AudAuditorias;
use App\AudEvidencia;
use App\AudInforme;
use App\AudNota;
use App\AudPlanAccion;
use App\GnralPersonales;
use App\AudResponsableAcciones;
use App\ValidacionCarga;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AudAccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id_personal = Session::get("id_perso");

        $controlAccionesCorrectivas = $this->obtenerControlAccionesCorrectivas();
        $moduloAccionesCerrado = $controlAccionesCorrectivas ? ((int) $controlAccionesCorrectivas->cerrado === 1) : false;
        $mensajeCierreAcciones = $controlAccionesCorrectivas && !empty($controlAccionesCorrectivas->mensaje_cierre)
            ? $controlAccionesCorrectivas->mensaje_cierre
            : 'El sistema fue cerrado. Contacte al líder.';

        if ($moduloAccionesCerrado) {
            $datos_nota = collect();

            return view('auditorias.notas_auditorias', compact(
                'id_personal',
                'datos_nota',
                'moduloAccionesCerrado',
                'mensajeCierreAcciones'
            ));
        }

        $datos_nota =AudResponsableAcciones::getDataResponsable()
            ->where('audresponsable_acciones.id_personal', $id_personal)
            ->select('aud_auditoria.criterio', 'aud_notas.punto_proceso', 'aud_notas.resultado','aud_notas.id_notas',
                'aud_notas.id_clasificacion','aud_notas.observaciones','audresponsable_acciones.observaciones as observaciones_responsable','audresponsable_acciones.observaciones_lider as observaciones_lideres','audresponsable_acciones.id_responsable','audresponsable_acciones.estado','aud_notas.clave_nota')
            ->get()
            /*->groupBy(function ($item) {
                return explode('-', $item->clave_nota)[0] . '-' . explode('-', $item->clave_nota)[1]; // ejemplo: 2025-1
            })*/
            // Opción más segura
            ->groupBy(function ($item) {
                $parts = explode('-', $item->clave_nota);
                return count($parts) >= 2 ? $parts[0] . '-' . $parts[1] : $item->clave_nota;
            })
            ->sortKeys();
        //dd($datos_nota);




        return view('auditorias.notas_auditorias', compact(
            'id_personal',
            'datos_nota',
            'moduloAccionesCerrado',
            'mensajeCierreAcciones'
        ));

        //return view ('auditorias.no_conformidad_acciones_correctivas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'id_notas' => 'required',
            'id_clasificacion' => 'required',
            'id_personal' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        AudAcciones::create([
            'id_notas' => $request->id_notas,
            'id_clasificacion' => $request->id_clasificacion,
            'id_personal' => $request->id_personal,
        ]);


        return redirect()->back()->withSuccess('Registro de Acciones Exitoso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AudAcciones  $audAcciones
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_responsable)
    {
        //dd($id_responsable);

        if ($this->moduloAccionesCorrectivasCerrado()) {
            return redirect()
                ->to(url("auditorias/notas_auditorias/"))
                ->with('error', $this->mensajeCierreAccionesCorrectivas());
        }

        $asignacion=AudResponsableAcciones::find($id_responsable);

        if($asignacion->estado==null) {
            $asignacion->estado = 1;
            $asignacion->save();
        }


        $evidenciaValida=AudEvidencia::all();

        $personas = GnralPersonales::orderBy('nombre')->get();
        //dd($personas);


        $datos_nota =AudResponsableAcciones::getDataResponsable()
            ->where('audresponsable_acciones.id_responsable', $id_responsable)
            ->select('aud_auditoria.criterio', 'aud_notas.punto_proceso', 'aud_notas.resultado','aud_notas.id_notas','aud_notas.id_clasificacion','aud_notas.observaciones')
            ->get();


        return view ('auditorias.acciones_correctivas', compact('datos_nota','personas','asignacion','evidenciaValida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AudAcciones  $audAcciones
     * @return \Illuminate\Http\Response
     */
    public function edit(AudAcciones $audAcciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudAcciones  $audAcciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $audAcciones)
    {

        if ($this->moduloAccionesCorrectivasCerrado()) {
            return redirect()
                ->to(url("auditorias/notas_auditorias/"))
                ->with('error', $this->mensajeCierreAccionesCorrectivas());
        }

        $id_responsable=AudResponsableAcciones::find($audAcciones);
        $id_responsable->analisis=$request->analisis;
        $id_responsable->estado=3;
        $id_responsable->viable = $request->has('viable') ? 1 : 0;
        $id_responsable->actualizacion_riesgos=$request->actulizacion_riesgos;//1 o 0
        //$id_responsable->cambios_sistema=$request->motivo_actualizacion_riesgos;
        //$id_responsable->valor_actr=$request->cambios_sistemaOE;
        //$id_responsable->valor_cambios=$request->motivo_cambios_sistemaOE;
        $id_responsable->valor_actr = $request->motivo_actualizacion_riesgos; // texto
        $id_responsable->cambios_sistema = $request->cambios_sistemaOE; // 1 o 0
        $id_responsable->valor_cambios = $request->motivo_cambios_sistemaOE; // texto
        $id_responsable->requiere_accion = $request->requiere_accion;
        $id_responsable->requiere_correccion = $request->requiere_correccion;
        $id_responsable->accion_correctiva = $request->accion_correctiva;
        $id_responsable->causa_raiz = $request->causa_raiz;
        $id_responsable->save();

        // 1. Plan de acciones para clasificación == 1 (TIPO 1)
        if ($request->has('acciones_plan')) {
            $ids = $request->input('id_plan_accion', []);

            for ($i = 0; $i < count($request->acciones_plan); $i++) {
                if (
                    !empty($request->acciones_plan[$i]) &&
                    !empty($request->personal_implementar_plan[$i]) &&
                    !empty($request->fecha_implementar_plan[$i]) &&
                    !empty($request->personal_revisar_plan[$i]) &&
                    !empty($request->fecha_verificacion_plan[$i]) &&
                    !empty($request->medio_verificacion_plan[$i])
                ) {
                    $data = [
                        "id_responsable" => $id_responsable->id_responsable,
                        "acciones" => $request->acciones_plan[$i],
                        "id_responsable_implantar" => $request->personal_implementar_plan[$i],
                        "fecha_implantar_accion" => $request->fecha_implementar_plan[$i],
                        "id_responsable_revisar" => $request->personal_revisar_plan[$i],
                        "fecha_verificacion" => $request->fecha_verificacion_plan[$i],
                        "id_evidencia" => $request->medio_verificacion_plan[$i],
                        "estado" => 0,
                        "tipo" => 1, // ACCIONES
                    ];

                    if (isset($ids[$i]) && !empty($ids[$i])) {
                        // CORRECCIÓN AQUÍ: Usamos withTrashed() y validamos que exista
                        $accion = \App\AudPlanAccion::withTrashed()->find($ids[$i]);
                        if($accion) {
                            if ($accion->trashed()) {
                                $accion->restore(); // <--- RESTAURAR
                            }
                            $accion->update($data);
                        }
                    } else {
                        AudPlanAccion::create($data);
                    }
                }
            }
        }

        // 2. Programa de correcciones para clasificación == 1 (TIPO 2)
        if ($request->has('acciones_correcciones')) {
            $ids = $request->input('id_correccion_accion', []);

            for ($i = 0; $i < count($request->acciones_correcciones); $i++) {
                if (
                    !empty($request->acciones_correcciones[$i]) &&
                    !empty($request->personal_implementar_correccion[$i]) &&
                    !empty($request->fecha_implementar_correccion[$i]) &&
                    !empty($request->personal_revisar_correccion[$i]) &&
                    !empty($request->fecha_verificacion_correccion[$i]) &&
                    !empty($request->medio_verificacion_correccion[$i])
                ) {
                    $data = [
                        "id_responsable" => $id_responsable->id_responsable,
                        "acciones" => $request->acciones_correcciones[$i],
                        "id_responsable_implantar" => $request->personal_implementar_correccion[$i],
                        "fecha_implantar_accion" => $request->fecha_implementar_correccion[$i],
                        "id_responsable_revisar" => $request->personal_revisar_correccion[$i],
                        "fecha_verificacion" => $request->fecha_verificacion_correccion[$i],
                        "id_evidencia" => $request->medio_verificacion_correccion[$i],
                        "estado" => 0,
                        "tipo" => 2, // CORRECCIONES
                    ];

                    if (isset($ids[$i]) && !empty($ids[$i])) {
                        // CORRECCIÓN AQUÍ
                        $accion = \App\AudPlanAccion::withTrashed()->find($ids[$i]);
                        if($accion) {
                            if ($accion->trashed()) {
                                $accion->restore(); // <--- RESTAURAR
                            }
                            $accion->update($data);
                        }
                    } else {
                        AudPlanAccion::create($data);
                    }
                }
            }
        }

        // 3. Programa de oportunidades para clasificación == 2 (TIPO 3)
        if ($request->has('acciones_oportunidades')) {
            $ids = $request->input('id_oportunidad_accion', []);

            for ($i = 0; $i < count($request->acciones_oportunidades); $i++) {
                if (
                    !empty($request->acciones_oportunidades[$i]) &&
                    !empty($request->personal_implementar_oportunidades[$i]) &&
                    !empty($request->fecha_implementar_oportunidades[$i]) &&
                    !empty($request->personal_revisar_oportunidades[$i]) &&
                    !empty($request->fecha_verificacion_oportunidades[$i]) &&
                    !empty($request->medio_verificacion_oportunidades[$i])
                ) {
                    $data = [
                        "id_responsable" => $id_responsable->id_responsable,
                        "acciones" => $request->acciones_oportunidades[$i],
                        "id_responsable_implantar" => $request->personal_implementar_oportunidades[$i],
                        "fecha_implantar_accion" => $request->fecha_implementar_oportunidades[$i],
                        "id_responsable_revisar" => $request->personal_revisar_oportunidades[$i],
                        "fecha_verificacion" => $request->fecha_verificacion_oportunidades[$i],
                        "id_evidencia" => $request->medio_verificacion_oportunidades[$i],
                        "estado" => 0,
                        "tipo" => 3, // OPORTUNIDADES
                    ];

                    if (isset($ids[$i]) && !empty($ids[$i])) {
                        // CORRECCIÓN AQUÍ
                        $accion = \App\AudPlanAccion::withTrashed()->find($ids[$i]);
                        if($accion) {
                            if ($accion->trashed()) {
                                $accion->restore(); // <--- RESTAURAR
                            }
                            $accion->update($data);
                        }
                    } else {
                        AudPlanAccion::create($data);
                    }
                }
            }
        }
        //dd($request->all());

        return redirect()->to(url("auditorias/notas_auditorias/"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudAcciones  $audAcciones
     * @return \Illuminate\Http\Response
     */

    private function obtenerControlAccionesCorrectivas()
    {
        try {
            return DB::table('aud_control_modulos')
                ->where('clave_modulo', 'acciones_correctivas')
                ->whereNull('deleted_at')
                ->first();
        } catch (\Exception $e) {
            return null;
        }
    }

    private function moduloAccionesCorrectivasCerrado()
    {
        $control = $this->obtenerControlAccionesCorrectivas();

        return $control ? ((int) $control->cerrado === 1) : false;
    }

    private function mensajeCierreAccionesCorrectivas()
    {
        $control = $this->obtenerControlAccionesCorrectivas();

        if ($control && !empty($control->mensaje_cierre)) {
            return $control->mensaje_cierre;
        }

        return 'El sistema fue cerrado. Contacte al líder.';
    }

    public function destroy(AudAcciones $audAcciones)
    {
        //
    }
}
