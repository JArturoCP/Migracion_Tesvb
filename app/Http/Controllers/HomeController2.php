<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Session;
class HomeController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adeudo=0;
        $departamento_carrera="";
        $palumno = session()->has('palumno') ? session()->has('palumno') : false;
        if($palumno == true){
            $id_usuario = Session::get('usuario_alumno');
            $id_alu = DB::selectOne('SELECT id_alumno from gnral_alumnos where id_usuario = ?', [$id_usuario]);
            $id_alu=$id_alu->id_alumno;

            $adeudo_departamento=DB::selectOne('SELECT COUNT(id_adeudo_departamento)adeudo
                        FROM adeudo_departamento WHERE id_alumno = ? ', [$id_alu]);
            $adeudo_departamento=$adeudo_departamento->adeudo;


            if( $adeudo_departamento ==0){
                $adeudo=0;
                $departamento_carrera="";
            }
            else{
                $adeudo=1;

                $departamento_carrera=array();
                $adeudo_dep=DB::select('SELECT gnral_unidad_administrativa.nom_departamento,
                                adeudo_departamento.comentario FROM adeudo_departamento,
                                gnral_unidad_administrativa WHERE adeudo_departamento.id_alumno = ?
                                and gnral_unidad_administrativa.id_unidad_admin=adeudo_departamento.id_departamento ', [$id_alu]);

                foreach($adeudo_dep as $ade)
                {
                    $nombrea['nombre']= $ade->nom_departamento;
                    $nombrea['comentario']= $ade->comentario;
                    array_push($departamento_carrera, $nombrea);
                }
                $adeudo_informacion=DB::selectOne('SELECT COUNT(id_adeudo_departamento) contar
                                from adeudo_departamento where id_alumno= ? and id_departamento=50', [$id_alu]);
                if($adeudo_informacion->contar >0)
                {
                    $informacion=DB::select('SELECT  *from adeudo_departamento where id_alumno= ? and id_departamento=50', [$id_alu]);
                    foreach ($informacion as $info) {
                        $nombre_info['nombre'] = "CENTRO DE INFORMACIÓN";
                        $nombre_info['comentario']=$info->comentario;
                        array_push($departamento_carrera, $nombre_info);
                    }

                }
                $adeudo_bolsa=DB::selectOne('SELECT COUNT(id_adeudo_departamento) contar
                                from adeudo_departamento where id_alumno= ? and id_departamento=100', [$id_alu]);
                if($adeudo_bolsa->contar >0)
                {
                    $bolsa=DB::select('SELECT  *from adeudo_departamento where id_alumno= ? and id_departamento=100', [$id_alu]);
                    foreach ($bolsa as $bolsa) {
                        $nombre_bolsa['nombre'] = "BOLSA DE TRABAJO Y SEGUIMIENTO DE EGRESADOS";
                        $nombre_bolsa['comentario']=$bolsa->comentario;
                        array_push($departamento_carrera, $nombre_bolsa);
                    }

                }


            }

            ////encuestas de satisfaccion al cliente
            $periodo=Session::get('periodo_actual');
            //estado encuesta de inscripcion
            $estado_inscripcion= DB::selectOne('SELECT count(id_incripcion) contar from enc_incripcion where id_alumno = ? and id_periodo = ?  and id_estado = 0', [$id_alu, $periodo]);
            $estado_inscripcion=$estado_inscripcion->contar;

            //estado encuesta de rescripcion
            $estado_reinscripcion= DB::selectOne('SELECT count(id_reinscripcion) contar from enc_reinscripcion where id_alumno = ? and id_periodo = ?  and id_estado = 0', [$id_alu, $periodo]);
            $estado_reinscripcion=$estado_reinscripcion->contar;

            //estado encuesta de servicio social
            $estado_servicio= DB::selectOne('SELECT count(id_servicio) contar from enc_servicio_social where id_alumno = ?   and id_estado = 0', [$id_alu]);
            $estado_servicio=$estado_servicio->contar;

            //estado encuesta de residencia
            $estado_residencia= DB::selectOne('SELECT count(id_alumno)contar from enc_residencia_profesional where id_alumno = ?   and id_estado = 0', [$id_alu]);
            $estado_residencia=$estado_residencia->contar;


///////////////////encuestas de inscripcion
            if($estado_inscripcion != 0 ){
                $estado_encuesta1=1;
                if($estado_inscripcion != 0){
                    $estado_inscripcion=1;
                }
            }else{
                $estado_encuesta1=0;
            }
            ///////////encuesta de reinscripcion
            if($estado_reinscripcion != 0 ){
                $estado_encuesta2=1;
                if($estado_reinscripcion != 0){
                    $estado_reinscripcion=1;
                }
            }else{
                $estado_encuesta2=0;
            }

            ///////////encuesta  servicio social
            if($estado_servicio != 0 ){
                $estado_encuesta3=1;
                if($estado_servicio != 0){
                    $estado_servicio=1;
                }
            }else{
                $estado_encuesta3=0;
            }

            ///////////encuesta  servicio social
            if($estado_residencia != 0 ){
                $estado_encuesta4=1;
                if($estado_residencia != 0){
                    $estado_residencia=1;
                }
            }else{
                $estado_encuesta4=0;
            }



        }else{
            $adeudo=0;
            $departamento_carrera="";
            $estado_encuesta1=0;
            $estado_encuesta2=0;
            $estado_encuesta3=0;
            $estado_encuesta4=0;
            $estado_inscripcion=0;
            $estado_reinscripcion=0;
            $estado_servicio=0;
            $estado_residencia=0;
        }

        //dd($departamento_carrera);

        $datosTutorReprobacion = $this->obtenerResumenTutorReprobacionPrincipal();
        $es_tutor_reprobacion = $datosTutorReprobacion['es_tutor'];
        $total_alumnos_reprobacion_tutor = $datosTutorReprobacion['total_alumnos_reprobacion'];
        $periodo_reprobacion_tutor = $datosTutorReprobacion['periodo'];
        $debug_tutor_reprobacion = $datosTutorReprobacion;

        return view('home_recargado', compact('adeudo','departamento_carrera','estado_encuesta1','estado_encuesta2',
            'estado_encuesta3','estado_encuesta4','estado_servicio', 'estado_inscripcion','estado_reinscripcion','estado_residencia',
            'es_tutor_reprobacion','total_alumnos_reprobacion_tutor','periodo_reprobacion_tutor','debug_tutor_reprobacion'));
    }


    /**
     * Detecta si el usuario autenticado es tutor para la pantalla principal.
     *
     * Se usan varias rutas de identificación porque el sistema guarda personal
     * tanto por gnral_personales.tipo_usuario como por correo y también en sesión.
     */
    private function obtenerResumenTutorReprobacionPrincipal()
    {
        $resultado = array(
            'es_tutor' => false,
            'total_alumnos_reprobacion' => 0,
            'periodo' => null,
            'id_personal' => null,
            'id_usuario' => Auth::id(),
            'correo' => null,
            'metodo_personal' => null,
            'motivo' => 'No evaluado',
        );

        $personal = $this->resolverPersonalTutorReprobacionPrincipal();

        if (!$personal) {
            $resultado['motivo'] = 'No se pudo resolver gnral_personales para el usuario autenticado';
            return $resultado;
        }

        $resultado['id_personal'] = $personal->id_personal;
        $resultado['metodo_personal'] = isset($personal->metodo_resolucion) ? $personal->metodo_resolucion : null;

        $asignacionTutor = DB::table('exp_asigna_tutor as et')
            ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
            ->where('et.id_personal', $personal->id_personal)
            ->whereNull('et.deleted_at')
            ->whereNull('eg.deleted_at')
            ->exists();

        if (!$asignacionTutor) {
            $resultado['motivo'] = 'El personal existe, pero no tiene asignación activa en exp_asigna_tutor';
            return $resultado;
        }

        $resultado['es_tutor'] = true;
        $resultado['motivo'] = 'SI ES TUTOR';

        $periodo = DB::table('exp_asigna_tutor as et')
            ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
            ->join('gnral_periodos as gp', 'gp.id_periodo', '=', 'jp.id_periodo')
            ->where('et.id_personal', $personal->id_personal)
            ->whereNull('et.deleted_at')
            ->whereNull('eg.deleted_at')
            ->select('gp.id_periodo', 'gp.periodo')
            ->groupBy('gp.id_periodo', 'gp.periodo')
            ->orderBy('gp.id_periodo', 'desc')
            ->first();

        $resultado['periodo'] = $periodo;

        if (!$periodo) {
            return $resultado;
        }

        $alumnos = DB::table('exp_asigna_tutor as et')
            ->join('exp_asigna_generacion as eg', 'eg.id_asigna_generacion', '=', 'et.id_asigna_generacion')
            ->join('exp_asigna_alumnos as ea', 'ea.id_asigna_generacion', '=', 'eg.id_asigna_generacion')
            ->join('gnral_jefes_periodos as jp', 'jp.id_jefe_periodo', '=', 'eg.id_jefe_periodo')
            ->join('eva_carga_academica as ca', function ($join) {
                $join->on('ca.id_alumno', '=', 'ea.id_alumno')
                    ->on('ca.id_periodo', '=', 'jp.id_periodo');
            })
            ->join('cal_evaluaciones as ev', 'ev.id_carga_academica', '=', 'ca.id_carga_academica')
            ->where('et.id_personal', $personal->id_personal)
            ->where('jp.id_periodo', $periodo->id_periodo)
            ->whereNull('et.deleted_at')
            ->whereNull('eg.deleted_at')
            ->whereNull('ea.deleted_at')
            ->where('ea.estado', 1)
            ->where('ev.calificacion', '<', 70)
            ->select('ea.id_alumno')
            ->distinct()
            ->get();

        $resultado['total_alumnos_reprobacion'] = $alumnos->count();

        return $resultado;
    }

    /**
     * Resuelve el id_personal del usuario actual.
     */
    private function resolverPersonalTutorReprobacionPrincipal()
    {
        $idPersonalSesion = Session::get('id_perso');

        if ($idPersonalSesion) {
            $personalSesion = DB::table('gnral_personales')
                ->where('id_personal', $idPersonalSesion)
                ->first();

            if ($personalSesion) {
                $personalSesion->metodo_resolucion = 'Session::get(id_perso)';
                return $personalSesion;
            }
        }

        $idUsuario = Auth::id();

        if (!$idUsuario) {
            return null;
        }

        $personalPorTipoUsuario = DB::table('gnral_personales')
            ->where('tipo_usuario', $idUsuario)
            ->first();

        if ($personalPorTipoUsuario) {
            $personalPorTipoUsuario->metodo_resolucion = 'gnral_personales.tipo_usuario = Auth::id()';
            return $personalPorTipoUsuario;
        }

        $usuario = DB::table('users')
            ->where('id', $idUsuario)
            ->first();

        if (!$usuario || !isset($usuario->email) || trim($usuario->email) == '') {
            return null;
        }

        $correo = trim(strtolower($usuario->email));

        $personalPorCorreo = DB::table('gnral_personales')
            ->whereRaw('LOWER(TRIM(correo)) = ?', array($correo))
            ->first();

        if ($personalPorCorreo) {
            $personalPorCorreo->metodo_resolucion = 'gnral_personales.correo = users.email';
            return $personalPorCorreo;
        }

        return null;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
