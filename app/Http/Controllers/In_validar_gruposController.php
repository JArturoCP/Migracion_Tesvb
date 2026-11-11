<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class In_validar_gruposController extends Controller
{
    public function index(){

        $periodo_ingles = Session::get('periodo_ingles');
        $cuenta_niveles = DB::table('in_hrs_ingles_profesor')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_hrs_ingles_profesor.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_hrs_ingles_profesor.id_grupo')
            ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
            ->select(DB::raw('count(in_hrs_ingles_profesor.id_profesor) as total'))
            ->get();
        $cuenta_niveles = $cuenta_niveles[0]->total;
        // dd($cuenta_niveles);
        if ($cuenta_niveles == 0) {
            $cuenta_niveles = 0;
            $profesores=0;

        }
        else{
            $cuenta_niveles=1;
            $profesores = DB::table('in_hrs_ingles_profesor')
                ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_hrs_ingles_profesor.id_nivel')
                ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_hrs_ingles_profesor.id_grupo')
                ->join('in_profesores_ingles', 'in_profesores_ingles.id_profesores', '=', 'in_hrs_ingles_profesor.id_profesor')
                ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                ->select('in_profesores_ingles.*')
                ->groupBy('in_profesores_ingles.id_profesores')
                ->orderBy('in_profesores_ingles.apellido_paterno', 'ASC')
                ->orderBy( 'in_profesores_ingles.apellido_materno', 'ASC')
                ->orderBy('in_profesores_ingles.nombre', 'ASC')
                ->get();

        }
        return view('ingles.departamento.profesores_validar_grupos', compact('profesores', 'cuenta_niveles'));
    }
    public function desactivar_grupos_profesor($id_profesor){
        $nombre_profesor=DB::selectOne('SELECT * FROM `in_profesores_ingles` WHERE `id_profesores` = '.$id_profesor.'');

        $periodo_ingles = Session::get('periodo_ingles');
        $cuenta_niveles = DB::table('in_hrs_ingles_profesor')
            ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_hrs_ingles_profesor.id_nivel')
            ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_hrs_ingles_profesor.id_grupo')
            ->where('in_hrs_ingles_profesor.id_profesor', '=', $id_profesor)
            ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
            ->select(DB::raw('count(in_hrs_ingles_profesor.id_profesor) as total'))
            ->get();
        $cuenta_niveles = $cuenta_niveles[0]->total;
        if ($cuenta_niveles == 0) {
            $cuenta_niveles = 0;

        } else {
            $cuenta_niveles = 1;
            $niveles = DB::table('in_hrs_ingles_profesor')
                ->join('in_niveles_ingles', 'in_niveles_ingles.id_niveles_ingles', '=', 'in_hrs_ingles_profesor.id_nivel')
                ->join('in_grupo_ingles', 'in_grupo_ingles.id_grupo_ingles', '=', 'in_hrs_ingles_profesor.id_grupo')
                ->where('in_hrs_ingles_profesor.id_profesor', '=', $id_profesor)
                ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                ->where('in_niveles_ingles.id_niveles_ingles', '<', 11)
                ->select('in_niveles_ingles.descripcion as nivel', 'in_grupo_ingles.descripcion as grupo', 'in_hrs_ingles_profesor.*')
                ->orderBy('in_niveles_ingles.id_niveles_ingles', 'ASC')
                ->orderBy('in_grupo_ingles.id_grupo_ingles', 'ASC')
                ->get();
        }

        return view('ingles.departamento.desactivacion_grupos', compact('niveles', 'cuenta_niveles','nombre_profesor'));

    }
    public function desactivar_grupo_prof($id_nivel,$id_grupo){

        $periodo_ingles = Session::get('periodo_ingles');
        $fec=date("Y-m-d H:i");

        DB::table('in_hrs_ingles_profesor')
            ->where('id_periodo',$periodo_ingles)
            ->where('id_nivel',$id_nivel)
            ->where('id_grupo',$id_grupo)
            ->update(['id_estado' =>1,'fecha_activacion'=>$fec]);
        return back();

    }
    public function activar_grupo_prof($id_nivel,$id_grupo){

        $periodo_ingles = Session::get('periodo_ingles');
        $fec=date("Y-m-d H:i");

        DB::table('in_hrs_ingles_profesor')
            ->where('id_periodo',$periodo_ingles)
            ->where('id_nivel',$id_nivel)
            ->where('id_grupo',$id_grupo)
            ->update(['id_estado' =>0,'fecha_activacion'=>$fec]);
        return back();
    }
    public function agregar_usuarios_grupo_prof($id_nivel,$id_grupo){

        $periodo_ingles = Session::get('periodo_ingles');
        $maximo=DB::selectOne('SELECT * FROM `in_maximo_grupo_ingles` WHERE `id_periodo_ingles` = '.$periodo_ingles.'');
        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera != 9  and id_carrera != 15');
        $semestres=DB::select('SELECT * FROM `gnral_semestres`');
        $grupos=DB::select('SELECT * FROM `gnral_grupos` WHERE `id_grupo` < 4');

        $estado=0;

        return view('ingles.departamento.agregar_usuarios_grupos',compact('maximo','carreras','semestres','grupos','estado','id_nivel','id_grupo'));


    }
    public function consultar_usuarios_grupo_prof($id_nivel,$id_grupo,$id_carrera,$id_semestre,$id_grupos_carrera){
        $periodo_ingles = Session::get('periodo_ingles');

        $estado_estudiantes=DB::selectOne('SELECT count(gnral_alumnos.id_alumno)contar FROM gnral_alumnos, in_voucher_pago where gnral_alumnos.id_usuario = in_voucher_pago.id_usuario 
        and in_voucher_pago.id_estado_valida_voucher=2 and in_voucher_pago.id_periodo_ingles='.$periodo_ingles.' and gnral_alumnos.id_carrera='.$id_carrera.' 
        and gnral_alumnos.id_semestre='.$id_semestre.' and gnral_alumnos.grupo='.$id_grupos_carrera.'');

        $estado_estudiantes=$estado_estudiantes->contar;

        $estudiantes=DB::select('SELECT gnral_alumnos.id_alumno, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno,
        gnral_alumnos.amaterno FROM gnral_alumnos, in_voucher_pago where gnral_alumnos.id_usuario = in_voucher_pago.id_usuario 
        and in_voucher_pago.id_estado_valida_voucher=2 and in_voucher_pago.id_periodo_ingles='.$periodo_ingles.' and gnral_alumnos.id_carrera='.$id_carrera.' 
        and gnral_alumnos.id_semestre='.$id_semestre.' and gnral_alumnos.grupo='.$id_grupos_carrera.' and gnral_alumnos.id_alumno 
        NOT IN (SELECT id_alumno from in_validar_carga where id_periodo='.$periodo_ingles.' and in_validar_carga.id_estado=2)');


        $estudiantes_inscritos=DB::select('SELECT gnral_alumnos.id_alumno, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno 
        FROM in_carga_academica_ingles, gnral_alumnos, in_validar_carga WHERE in_carga_academica_ingles.id_nivel ='.$id_nivel.' 
        AND in_carga_academica_ingles.id_grupo ='.$id_grupo.' AND in_carga_academica_ingles.id_periodo_ingles ='.$periodo_ingles.' 
        and gnral_alumnos.id_alumno = in_carga_academica_ingles.id_alumno and in_validar_carga.id_alumno=gnral_alumnos.id_alumno 
        and in_validar_carga.id_periodo=in_carga_academica_ingles.id_periodo_ingles  and in_validar_carga.id_estado=2 ');

        $total_est_ins=DB::selectOne('SELECT count(gnral_alumnos.id_alumno)contar
        FROM in_carga_academica_ingles, gnral_alumnos, in_validar_carga WHERE in_carga_academica_ingles.id_nivel ='.$id_nivel.' 
        AND in_carga_academica_ingles.id_grupo ='.$id_grupo.' AND in_carga_academica_ingles.id_periodo_ingles ='.$periodo_ingles.' 
        and gnral_alumnos.id_alumno = in_carga_academica_ingles.id_alumno and in_validar_carga.id_alumno=gnral_alumnos.id_alumno 
        and in_validar_carga.id_periodo=in_carga_academica_ingles.id_periodo_ingles and in_validar_carga.id_estado=2 ');

        $total_est_ins=$total_est_ins->contar;


        $periodo_ingles = Session::get('periodo_ingles');
        $maximo=DB::selectOne('SELECT * FROM `in_maximo_grupo_ingles` WHERE `id_periodo_ingles` = '.$periodo_ingles.'');
        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera != 9  and id_carrera != 15');
        $semestres=DB::select('SELECT * FROM `gnral_semestres`');
        $grupos=DB::select('SELECT * FROM `gnral_grupos` WHERE `id_grupo` < 4');

        $estado=1;
       // dd($estado);

        return view('ingles.departamento.agregar_usuarios_grupos',compact(
            'id_carrera','id_nivel','id_grupo','id_semestre','id_grupos_carrera',
            'estado_estudiantes','estudiantes',
            'estudiantes_inscritos','total_est_ins',
            'maximo','carreras','semestres',
            'grupos','estado','id_nivel','id_grupo'));




    }
    public function datos_usuario_ingles($id_alumno,$id_nivel,$id_grupo){

        $datos_alumno=DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE `id_alumno` ='.$id_alumno.'');
//dd( $datos_alumno);
        $periodo_ingles = Session::get('periodo_ingles');

        $periodo_actual = DB::table('in_periodos')
            ->where('id_periodo_ingles', '=',$periodo_ingles)
            ->where('estado_actual', '=',1)
            ->select(DB::raw('count(in_periodos.id_periodo_ingles) as estado_actual'))
            ->get();
        $periodo_actual=$periodo_actual[0]->estado_actual;
        $niveles=0;
        if($periodo_actual == 0)
        {

            $estado_periodo=0;
            $contar_disponibilidad=1; //disponibilidad de periodo
        }
        else {
            $estado_periodo=1;

            $datosalumno = DB::table('gnral_alumnos')
                ->where('id_usuario', '=', $datos_alumno->id_usuario)
                ->select('gnral_alumnos.*')
                ->get();
            $alumno = $datosalumno[0]->id_alumno;
            $enviado = DB::table('in_validar_carga')
                ->where('in_validar_carga.id_periodo', '=', $periodo_ingles)
                ->where('in_validar_carga.id_alumno', '=', $alumno)
                ->where('in_validar_carga.id_estado', '=', 2)
                ->select(DB::raw('count(in_validar_carga.id_validar_carga) as total'))
                ->get();
            $enviado = $enviado[0]->total;

            $contar_disponibilidad = DB::table('in_hrs_ingles_profesor')
                ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                ->select(DB::raw('count(in_hrs_ingles_profesor.id_nivel) as total'))
                ->get();

            $contar_disponibilidad = $contar_disponibilidad[0]->total;

            if ($contar_disponibilidad == 0) {
                $contar_disponibilidad = 0;
            } else {

                $contar_disponibilidad = 2;

                $contar_pr = DB::table('in_carga_academica_ingles')
                    ->join('in_validar_carga', 'in_validar_carga.id_alumno', '=', 'in_carga_academica_ingles.id_alumno')
                    ->join('in_evaluar_calificacion', 'in_evaluar_calificacion.id_carga_ingles', '=', 'in_carga_academica_ingles.id_carga_ingles')
                    ->where('in_carga_academica_ingles.id_alumno', '=', $alumno)
                    ->where('in_validar_carga.id_estado', '=', 2)
                    ->where('in_evaluar_calificacion.id_unidad', '=', 4)
                    ->select(DB::raw('count(in_carga_academica_ingles.id_carga_ingles) as total'))
                    ->get();
                $contar_pr = $contar_pr[0]->total;


                if ($contar_pr == 0) {
                    $niveles = DB::table('in_niveles_ingles')
                        ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                        ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                        ->select('in_hrs_ingles_profesor.id_nivel', 'in_niveles_ingles.descripcion')
                        ->groupBy('in_hrs_ingles_profesor.id_nivel')
                        ->orderBy('in_hrs_ingles_profesor.id_nivel', 'ASC')
                        ->get();


                } else {
                    $carga_anterior = DB::table('in_carga_academica_ingles')
                        ->join('in_evaluar_calificacion', 'in_evaluar_calificacion.id_carga_ingles', '=', 'in_carga_academica_ingles.id_carga_ingles')
                        ->join('in_validar_carga', 'in_validar_carga.id_alumno', '=', 'in_carga_academica_ingles.id_alumno')
                        ->where('in_carga_academica_ingles.id_alumno', '=', $alumno)
                        ->where('in_validar_carga.id_estado', '=', 2)
                        ->where('in_evaluar_calificacion.id_unidad', '=', 4)
                        ->select(DB::raw('max(in_carga_academica_ingles.id_carga_ingles) as id_carga'))
                        ->get();

                    $carga_anterior = $carga_anterior[0]->id_carga;

                    $unidad1 = DB::table('in_evaluar_calificacion')
                        ->where('in_evaluar_calificacion.id_carga_ingles', '=', $carga_anterior)
                        ->where('in_evaluar_calificacion.id_unidad', '=', 1)
                        ->select('in_evaluar_calificacion.calificacion as unidad1')
                        ->get();
                    $unidad1=$unidad1[0]->unidad1;
                    $unidad2 = DB::table('in_evaluar_calificacion')
                        ->where('in_evaluar_calificacion.id_carga_ingles', '=', $carga_anterior)
                        ->where('in_evaluar_calificacion.id_unidad', '=', 2)
                        ->select('in_evaluar_calificacion.calificacion as unidad2')
                        ->get();
                    $unidad2=$unidad2[0]->unidad2;
                    $unidad3 = DB::table('in_evaluar_calificacion')
                        ->where('in_evaluar_calificacion.id_carga_ingles', '=', $carga_anterior)
                        ->where('in_evaluar_calificacion.id_unidad', '=', 3)
                        ->select('in_evaluar_calificacion.calificacion as unidad3')
                        ->get();
                    $unidad3=$unidad3[0]->unidad3;
                    $unidad4 = DB::table('in_evaluar_calificacion')
                        ->where('in_evaluar_calificacion.id_carga_ingles', '=', $carga_anterior)
                        ->where('in_evaluar_calificacion.id_unidad', '=', 4)
                        ->select('in_evaluar_calificacion.calificacion as unidad4')
                        ->get();
                    $unidad4=$unidad4[0]->unidad4;
                    $promedio=($unidad1+$unidad2+$unidad3+$unidad4)/4;
                    $promedio=round($promedio);


                    $carga_academica=DB::selectOne('SELECT * FROM `in_carga_academica_ingles` WHERE `id_carga_ingles` ='.$carga_anterior.'');
                    // dd($carga_academica);

                    if($carga_academica->id_periodo_ingles < 18)
                    {
                        if($promedio < 80)
                        {

                            $baja = DB::table('in_carga_academica_ingles')
                                ->where('in_carga_academica_ingles.id_carga_ingles', '=', $carga_anterior)
                                ->select('in_carga_academica_ingles.*')
                                ->get();
                            $baja_alumno=$baja[0]->estado_nivel+1;


                            if($baja_alumno == 5){
                                $contar_disponibilidad=4;
                            }
                            else{
                                $nivel=$baja[0]->id_nivel;
                                $niveles = DB::table('in_niveles_ingles')
                                    ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                                    ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                                    ->where('in_hrs_ingles_profesor.id_nivel', '=', $nivel)
                                    ->select(DB::raw('count(in_hrs_ingles_profesor.id_nivel) as total'))
                                    ->get();
                                //dd($nivel);
                                if($niveles[0]->total == 0){

                                    $contar_disponibilidad=3;
                                }
                                else{

                                    $niveles = DB::table('in_niveles_ingles')
                                        ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                                        ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                                        ->where('in_hrs_ingles_profesor.id_nivel', '=', $nivel)
                                        ->select('in_hrs_ingles_profesor.id_nivel', 'in_niveles_ingles.descripcion')
                                        ->groupBy('in_hrs_ingles_profesor.id_nivel')
                                        ->orderBy('in_hrs_ingles_profesor.id_nivel', 'ASC')
                                        ->get();


                                }

                            }

                        }
                        else{
                            $nivel_anterior = DB::table('in_carga_academica_ingles')
                                ->where('in_carga_academica_ingles.id_carga_ingles', '=', $carga_anterior)
                                ->select('in_carga_academica_ingles.*')
                                ->get();
                            $nivel_siguiente=$nivel_anterior[0]->id_nivel+1;

                            $niveles = DB::table('in_niveles_ingles')
                                ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                                ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                                ->where('in_hrs_ingles_profesor.id_nivel', '=', $nivel_siguiente)
                                ->select('in_hrs_ingles_profesor.id_nivel', 'in_niveles_ingles.descripcion')
                                ->groupBy('in_hrs_ingles_profesor.id_nivel')
                                ->orderBy('in_hrs_ingles_profesor.id_nivel', 'ASC')
                                ->get();


                        }
                    }else{
                        if($promedio < 70)
                        {

                            $baja = DB::table('in_carga_academica_ingles')
                                ->where('in_carga_academica_ingles.id_carga_ingles', '=', $carga_anterior)
                                ->select('in_carga_academica_ingles.*')
                                ->get();
                            $baja_alumno=$baja[0]->estado_nivel+1;


                            if($baja_alumno == 5){
                                $contar_disponibilidad=4;
                            }
                            else{
                                $nivel=$baja[0]->id_nivel;
                                $niveles = DB::table('in_niveles_ingles')
                                    ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                                    ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                                    ->where('in_hrs_ingles_profesor.id_nivel', '=', $nivel)
                                    ->select(DB::raw('count(in_hrs_ingles_profesor.id_nivel) as total'))
                                    ->get();
                                //dd($nivel);
                                if($niveles[0]->total == 0){

                                    $contar_disponibilidad=3;
                                }
                                else{

                                    $niveles = DB::table('in_niveles_ingles')
                                        ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                                        ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                                        ->where('in_hrs_ingles_profesor.id_nivel', '=', $nivel)
                                        ->select('in_hrs_ingles_profesor.id_nivel', 'in_niveles_ingles.descripcion')
                                        ->groupBy('in_hrs_ingles_profesor.id_nivel')
                                        ->orderBy('in_hrs_ingles_profesor.id_nivel', 'ASC')
                                        ->get();


                                }

                            }

                        }
                        else{
                            $nivel_anterior = DB::table('in_carga_academica_ingles')
                                ->where('in_carga_academica_ingles.id_carga_ingles', '=', $carga_anterior)
                                ->select('in_carga_academica_ingles.*')
                                ->get();
                            $nivel_siguiente=$nivel_anterior[0]->id_nivel+1;

                            $niveles = DB::table('in_niveles_ingles')
                                ->join('in_hrs_ingles_profesor', 'in_hrs_ingles_profesor.id_nivel', '=', 'in_niveles_ingles.id_niveles_ingles')
                                ->where('in_hrs_ingles_profesor.id_periodo', '=', $periodo_ingles)
                                ->where('in_hrs_ingles_profesor.id_nivel', '=', $nivel_siguiente)
                                ->select('in_hrs_ingles_profesor.id_nivel', 'in_niveles_ingles.descripcion')
                                ->groupBy('in_hrs_ingles_profesor.id_nivel')
                                ->orderBy('in_hrs_ingles_profesor.id_nivel', 'ASC')
                                ->get();
                        }

                    }

                }


            }
        }

        $contar_estado = count($niveles);



        return view('ingles.departamento.datos_usuario', compact('datos_alumno','contar_disponibilidad','id_nivel','id_grupo','estado_periodo','contar_estado','niveles'));

    }
    public function reg_datos_usuario_ingles(Request $request,$id_nivel,$id_grupo){
        $id_alumno = $request->input("id_alumno");



    }
}
