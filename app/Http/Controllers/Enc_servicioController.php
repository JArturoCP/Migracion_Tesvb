<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class Enc_servicioController extends Controller
{
    public function agregar_periodo_year(){
        Session::put('historial_enc_s',0);
         $year =  date("Y");
         $total_periodos=DB::selectOne('SELECT COUNT(id_periodo_serv)contar from enc_periodo_servicio where year= ?', [$year]);
         $total_periodos=$total_periodos->contar;
       //  dd($total_periodos);

       $periodos= DB::select('SELECT *from enc_periodo_servicio where year= ?', [$year]);

     return view("encuestas_satisfacion_cliente.servicio_social.periodos_servicio_social",compact('year','total_periodos','periodos'));
    }
    public function termino_encuesta_servicio($id_periodo_serv){
       $registro=DB::selectOne('SELECT * FROM `enc_periodo_servicio` WHERE `id_periodo_serv` = ?', [$id_periodo_serv]);
        return view("encuestas_satisfacion_cliente.servicio_social.terminar_periodo",compact('registro'));
    }
    public function guardar_termino_encuesta_servicio(Request $request){
      //  dd($request);
        $id_periodo_serv= $request->input("id_periodo_serv");
        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_servicio` WHERE `id_periodo_serv` = ?', [$id_periodo_serv]);
     //  dd($periodo);
        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_servicio_social')
            ->where('id_estado', 0)
            ->where('year', $periodo->year)
            ->where('mes', $periodo->mes)
            ->update([
                'id_estado'=>3,
                'fecha_encuesta'=>$fecha_actual,
                //'fecha_registro'=>$fecha,
            ]);

        DB:: table('enc_periodo_servicio')
            ->where('id_periodo_serv', $id_periodo_serv)
            ->update([
                'id_estado'=>1,
                'fecha_liberacion'=>$fecha_actual,
                //'fecha_registro'=>$fecha,
            ]);
        return back();
    }
public function registrar_periodo_year(Request $request){
    $year= $request->input("year");
    $mes= $request->input("mes");
    $fecha_actual =  date("Y-m-d H:i:s");

    DB:: table('enc_periodo_servicio')->insert([
        'year' => $year,
        'mes' => $mes,
        'fecha_registro' => $fecha_actual
    ]);
    return back();
}


    public function index($mes,$year){

        $encuestas_enviadas=DB::selectOne('SELECT COUNT(id_servicio) contar   FROM enc_servicio_social
        WHERE id_estado = 0 AND mes = ? AND year = ? ', [$mes, $year]);
        $encuestas_enviadas=$encuestas_enviadas->contar;

        $encuestas_contestadas=DB::selectOne('SELECT COUNT(id_servicio) contar   FROM enc_servicio_social
        WHERE id_estado = 1 AND mes = ? AND year = ? ', [$mes, $year]);

        $encuestas_contestadas=$encuestas_contestadas->contar;

        $encuestas_rechazadas =DB::selectOne('SELECT COUNT(id_servicio) contar   FROM enc_servicio_social
        WHERE id_estado = 3 AND mes = ? AND year = ? ', [$mes, $year]);

        $encuestas_rechazadas=$encuestas_rechazadas->contar;

        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_servicio`
        WHERE `year` = ? AND `mes` = ?', [$year, $mes]);

        //dd($mes);
     //   $nombre_periodo = Session::get('nombre_periodo');
        $carreras=DB::table('gnral_carreras')
            ->where('gnral_carreras.id_carrera','!=',9)
            ->where('gnral_carreras.id_carrera','!=',11)
            ->where('gnral_carreras.id_carrera','!=',15)
            ->select('gnral_carreras.*')
            ->get();
        $mostrar=0;
            return view('encuestas_satisfacion_cliente.servicio_social.encuesta_carrera_servicio',
            compact('carreras','mostrar','mes','year','encuestas_enviadas',
                'encuestas_contestadas','encuestas_rechazadas','periodo'));

    }
    public function ver_enc_serv_alum_terminado($id_carrera,$mes,$year){



        $encuestas_contestadas=DB::selectOne('SELECT COUNT(enc_servicio_social.id_servicio) contar
        FROM enc_servicio_social, gnral_alumnos
        WHERE  enc_servicio_social.id_estado = 1 AND enc_servicio_social.mes = ? AND year = ?
        and enc_servicio_social.id_alumno = gnral_alumnos.id_alumno and gnral_alumnos.id_carrera = ? ', [$mes, $year, $id_carrera]);
        $encuestas_contestadas=$encuestas_contestadas->contar;

        $encuestas_rechazadas =DB::selectOne('SELECT COUNT(enc_servicio_social.id_servicio) contar
        FROM enc_servicio_social, gnral_alumnos
        WHERE  enc_servicio_social.id_estado = 3 AND enc_servicio_social.mes = ? AND year = ?
        and enc_servicio_social.id_alumno = gnral_alumnos.id_alumno and gnral_alumnos.id_carrera = ? ', [$mes, $year, $id_carrera]);
        $encuestas_rechazadas=$encuestas_rechazadas->contar;

        $carrera=DB::selectOne('SELECT gnral_carreras.* from gnral_carreras where gnral_carreras.id_carrera = ?', [$id_carrera]);


        $encuestas=DB::select('SELECT gnral_alumnos.id_alumno, gnral_alumnos.cuenta,
        gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno,enc_servicio_social.id_servicio
        FROM enc_servicio_social, gnral_alumnos
        WHERE  enc_servicio_social.id_estado = 1 AND enc_servicio_social.mes = ? AND year = ?
        and enc_servicio_social.id_alumno = gnral_alumnos.id_alumno and gnral_alumnos.id_carrera = ?
         ORDER BY `gnral_alumnos`.`apaterno` ASC,`gnral_alumnos`.`amaterno` ASC,`gnral_alumnos`.`nombre` ASC
        ', [$mes, $year, $id_carrera]);

      //  dd($encuestas);

        return view('encuestas_satisfacion_cliente.servicio_social.alumnos_periodo_terminado',
            compact('carrera', 'encuestas_contestadas','encuestas_rechazadas','encuestas','mes','year','id_carrera'));


    }
    public function ver_encuesta_servicio_alumno($id_carrera,$mes,$year){
        $periodo=Session::get('periodo_actual');

        $alumnos= DB::select('SELECT gnral_alumnos.id_alumno, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno
      from gnral_alumnos, eva_validacion_de_cargas where gnral_alumnos.id_alumno = eva_validacion_de_cargas.id_alumno and gnral_alumnos.id_carrera = ?
      and eva_validacion_de_cargas.id_periodo = ? and gnral_alumnos.id_alumno NOT in(SELECT id_alumno FROM enc_servicio_social)
ORDER BY `gnral_alumnos`.`apaterno` ASC,`gnral_alumnos`.`amaterno` ASC,`gnral_alumnos`.`nombre` ASC', [$id_carrera, $periodo]);
        //dd($alumnos);

        $registros_encuestas= DB::select('SELECT enc_servicio_social.*, gnral_alumnos.cuenta,
        gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno
        from gnral_alumnos,enc_servicio_social WHERE gnral_alumnos.id_alumno = enc_servicio_social.id_alumno and gnral_alumnos.id_carrera = ?
        and  enc_servicio_social.mes = ? AND enc_servicio_social.year = ?', [$id_carrera, $mes, $year]);


//dd($registros_encuestas);
      $carrera=DB::selectOne('SELECT gnral_carreras.* from gnral_carreras where gnral_carreras.id_carrera = ?', [$id_carrera]);


//dd($alumnos_array);

        return view('encuestas_satisfacion_cliente.servicio_social.encuesta_alumnos_servicio',compact('carrera','alumnos','registros_encuestas','mes','year'));
    }
    public function enc_servicio_datos_alumn($id_alumno){
        $alumno=DB::selectOne('SELECT gnral_alumnos.id_alumno, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno
        from gnral_alumnos where gnral_alumnos.id_alumno = ?', [$id_alumno]);
        //dd($alumno);
        return view('encuestas_satisfacion_cliente.servicio_social.datos_alumno',compact('alumno'));
    }
    public function envio_encuesta_estudiante_servicio(Request $request,$mes,$year){

        //dd($request);
        $id_alumno= $request->input("id_alumno");
        $fecha =  date("Y-m-d");
        DB:: table('enc_servicio_social')->insert([
            'id_alumno' => $id_alumno,
            'fecha_registro' => $fecha,
            'mes' => $mes,
            'year'=>$year
        ]);
        return back();

    }
    public function ver_carreras_encuesta_residencia($id_periodo){


        $carreras=DB::table('gnral_carreras')
            ->where('gnral_carreras.id_carrera','!=',9)
            ->where('gnral_carreras.id_carrera','!=',11)
            ->where('gnral_carreras.id_carrera','!=',15)
            ->select('gnral_carreras.*')
            ->get();
        $mostrar=0;
        return view('encuestas_satisfacion_cliente.residencia.encuesta_carrera_residencia',compact('carreras','mostrar'));
    }
    public function ver_encuesta_residencia_alumno($id_carrera){

        $periodo = Session::get('periodo_actual');

        $anteproyectos = DB::select('
        SELECT resi_asesores.id_anteproyecto
        FROM resi_asesores, resi_promedio_general_residencia
        WHERE resi_asesores.id_anteproyecto = resi_promedio_general_residencia.id_anteproyecto
        AND resi_asesores.id_periodo = ?
        AND resi_asesores.id_carrera = ?
    ', [$periodo, $id_carrera]);

        $array_dat = [];

        foreach ($anteproyectos as $anteproyecto){

            $datos_alumno = DB::selectOne('
            SELECT gnral_alumnos.id_alumno, gnral_alumnos.cuenta,
            gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno
            FROM gnral_alumnos, resi_anteproyecto
            WHERE gnral_alumnos.id_alumno = resi_anteproyecto.id_alumno
            AND resi_anteproyecto.id_anteproyecto = ?
        ', [$anteproyecto->id_anteproyecto]);

            $contar_encuesta = DB::selectOne('
            SELECT COUNT(id_residencia_profesional) contar
            FROM enc_residencia_profesional
            WHERE id_alumno = ?
        ', [$datos_alumno->id_alumno]);

            // 🔥 Evita duplicados
            if ($contar_encuesta->contar == 0 &&
                !collect($array_dat)->contains('id_alumno', $datos_alumno->id_alumno)
            ) {
                $array_dat[] = [
                    'id_alumno' => $datos_alumno->id_alumno,
                    'cuenta' => $datos_alumno->cuenta,
                    'nombre' => $datos_alumno->nombre." ".$datos_alumno->apaterno." ".$datos_alumno->amaterno
                ];
            }
        }

        // Registros que ya contestaron
        $registros_encuestas = DB::select('
        SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre,
               gnral_alumnos.apaterno, gnral_alumnos.amaterno,
               enc_residencia_profesional.*
        FROM gnral_alumnos, enc_residencia_profesional
        WHERE gnral_alumnos.id_alumno = enc_residencia_profesional.id_alumno
        AND enc_residencia_profesional.id_periodo = ?
    ', [$periodo]);

        $carrera = DB::selectOne('SELECT * FROM gnral_carreras WHERE id_carrera = ?', [$id_carrera]);

        return view(
            'encuestas_satisfacion_cliente.residencia.encuesta_alumnos_residencia',
            compact('array_dat','carrera','registros_encuestas','id_carrera')
        );
    }
    public function enc_residencia_datos_alumn($id_alumno){
          $alumno=DB::selectOne('select gnral_alumnos.id_alumno, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno
          from gnral_alumnos where gnral_alumnos.id_alumno = ? ', [$id_alumno]);

          return view('encuestas_satisfacion_cliente.residencia.dato_alumno_residencia',compact('alumno'));
    }
    public function envio_encuesta_estudiante_residencia(Request $request){
        $id_alumno= $request->input("id_alumno");
        $periodo=Session::get('periodo_actual');
        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_residencia_profesional')->insert([
            'id_alumno' => $id_alumno,
            'id_periodo'=> $periodo,
            'fecha_registro'=>$fecha_actual
        ]);
        return back();

    }
    public function encuesta_servicio_social(){
        $id_usuario = Session::get('usuario_alumno');
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_usuario = ?', [$id_usuario]);
        $id_alumno=$alumno->id_alumno;
        $encuesta=DB::selectOne('SELECT * FROM `enc_servicio_social` WHERE `id_alumno` = ?', [$id_alumno]);

        $estado_encuesta= $encuesta->id_estado;

        return view('encuestas_satisfacion_cliente.servicio_social.encuesta_alumno_servicio',compact('encuesta','estado_encuesta','id_alumno'));
    }
    public function guardar_encuesta_servicio(Request  $request,$id_alumno){
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_alumno = ?', [$id_alumno]);
        $id_alumno=$alumno->id_alumno;

        $pregunta1 = $request->input("pregunta1");
        $pregunta2 = $request->input("pregunta2");
        $pregunta3 = $request->input("pregunta3");
        $pregunta4 = $request->input("pregunta4");
        $pregunta5 = $request->input("pregunta5");
        $pregunta6 = $request->input("pregunta6");
        $pregunta7 = $request->input("pregunta7");
        $pregunta8 = $request->input("pregunta8");
        $pregunta9 = $request->input("pregunta9");
        $pregunta10 = $request->input("pregunta10");
        $comentario = $request->input("comentario");

        if($comentario == null){
            $comentario = "";
        }else{
            $comentario = $request->input("comentario");
        }


        $fecha_actual =  date("Y-m-d H:i:s");
       // $fecha =  date("Y-m-d");

        DB:: table('enc_servicio_social')
            ->where('id_alumno', $id_alumno)
            ->update([
                'id_tipo_encuesta'=>4,
                'cal_preg_1'=>$pregunta1,
                'cal_preg_2'=>$pregunta2,
                'cal_preg_3'=>$pregunta3,
                'cal_preg_4'=>$pregunta4,
                'cal_preg_5'=>$pregunta5,
                'cal_preg_6'=>$pregunta6,
                'cal_preg_7'=>$pregunta7,
                'cal_preg_8'=>$pregunta8,
                'cal_preg_9'=>$pregunta9,
                'cal_preg_10'=>$pregunta10,
                'comentario'=>$comentario,
                'fecha_encuesta'=>$fecha_actual,
                'id_estado'=>1,
                //'fecha_registro'=>$fecha,
            ]);
        return redirect('/inicio');

    }
    public function encuesta_residencia(){
        $id_usuario = Session::get('usuario_alumno');
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_usuario = ?', [$id_usuario]);
        $id_alumno=$alumno->id_alumno;
        $encuesta=DB::selectOne('SELECT * FROM `enc_residencia_profesional` WHERE `id_alumno` = ?', [$id_alumno]);

        $estado_encuesta= $encuesta->id_estado;

        return view('encuestas_satisfacion_cliente.residencia.encuesta_alumno_residencia',compact('encuesta','estado_encuesta','id_alumno'));

    }
    public function guardar_encuesta_residencia(Request  $request,$id_alumno){
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_alumno = ?', [$id_alumno]);
        $id_alumno=$alumno->id_alumno;

        $pregunta1 = $request->input("pregunta1");
        $pregunta2 = $request->input("pregunta2");
        $pregunta3 = $request->input("pregunta3");
        $pregunta4 = $request->input("pregunta4");
        $pregunta5 = $request->input("pregunta5");
        $pregunta6 = $request->input("pregunta6");
        $pregunta7 = $request->input("pregunta7");
        $pregunta8 = $request->input("pregunta8");
        $pregunta9 = $request->input("pregunta9");
        $pregunta10 = $request->input("pregunta10");
        $comentario = $request->input("comentario");

        if($comentario == null){
            $comentario = "";
        }else{
            $comentario = $request->input("comentario");
        }


        $fecha_actual =  date("Y-m-d H:i:s");
        $fecha =  date("Y-m-d");

        DB:: table('enc_residencia_profesional')
            ->where('id_alumno', $id_alumno)
            ->update([
                'id_tipo_encuesta'=>5,
                'cal_preg_1'=>$pregunta1,
                'cal_preg_2'=>$pregunta2,
                'cal_preg_3'=>$pregunta3,
                'cal_preg_4'=>$pregunta4,
                'cal_preg_5'=>$pregunta5,
                'cal_preg_6'=>$pregunta6,
                'cal_preg_7'=>$pregunta7,
                'cal_preg_8'=>$pregunta8,
                'cal_preg_9'=>$pregunta9,
                'cal_preg_10'=>$pregunta10,
                'comentario'=>$comentario,
                'fecha_encuesta'=>$fecha_actual,
                'id_estado'=>1,
                'fecha_registro'=>$fecha,
            ]);
        return redirect('/inicio');

    }
    public function ingresar_encuesta_mantenimiento(){

        $personales=DB::select('SELECT * FROM `gnral_personales` ORDER BY `gnral_personales`.`nombre` ASC');

        $servicios= DB::select('SELECT gnral_personales.nombre, enc_servicio_mantenimiento.* from gnral_personales, enc_servicio_mantenimiento
        where gnral_personales.id_personal = enc_servicio_mantenimiento.id_personal and enc_servicio_mantenimiento.id_estado in (1,0)');

        return redirect('/encuestas_satisfaccion/periodo_mantenimiento');
    }
    public function guardar_registro_mantemiento_computo(Request $request,$mes,$year){
        $id_personal = $request->input("selectPersonal");
        $servicio = $request->input("servicio");
        $fecha_s = $request->input("fecha_s");

        DB:: table('enc_servicio_mantenimiento')->insert([
            'id_personal' => $id_personal,
            'year' => $year,
            'mes' => $mes,
            'fecha_solicita' =>$fecha_s,
            'servicio_solicita' => $servicio
        ]);
        return back();
    }
    public function notificacion_enviar_enc_mantenimiento($id_servicio_mantenimiento){
      $personal=DB::selectOne('SELECT gnral_personales.nombre, enc_servicio_mantenimiento.* from gnral_personales, enc_servicio_mantenimiento
        where gnral_personales.id_personal = enc_servicio_mantenimiento.id_personal and enc_servicio_mantenimiento.id_servicio_mantenimiento = ?', [$id_servicio_mantenimiento]);

        return view('encuestas_satisfacion_cliente.computo.datos_personal',compact('personal'));
    }
    public function guardar_envio_enc_mante(Request $request){
        $id_servicio_mantenimiento = $request->input("id_servicio_mantenimiento");

        DB:: table('enc_servicio_mantenimiento')
            ->where('id_servicio_mantenimiento', $id_servicio_mantenimiento)
            ->update([
                'id_tipo_encuesta'=>6,
                'id_estado'=>1
            ]);
        return back();
    }
    public function ver_enc_terminada($id_servicio){

        $servicio=DB::selectOne('SELECT * FROM `enc_servicio_social` WHERE `id_servicio` = ?', [$id_servicio]);
       // dd($servicio);
        $nombre_estudiante=DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE `id_alumno` = ?', [$servicio->id_alumno]);

       // dd($servicio);
        //dd($nombre_estudiante);

        return view('encuestas_satisfacion_cliente.servicio_social.encuesta_servicio_social_admin',compact('servicio','nombre_estudiante'));


    }
    public function ver_enc_resultados($mes,$year){
        $encuestas_contestadas=DB::select('SELECT  *FROM enc_servicio_social
        WHERE id_estado = 1 AND mes = ? AND year = ? ', [$mes, $year]);

        $preg1_excelente=0;
        $preg1_bueno=0;
        $preg1_regular=0;
        $preg1_malo=0;
        $preg1_muymalo=0;
        $preg1_resultado=0;

        $preg2_excelente=0;
        $preg2_bueno=0;
        $preg2_regular=0;
        $preg2_malo=0;
        $preg2_muymalo=0;
        $preg2_resultado=0;

        $preg3_excelente=0;
        $preg3_bueno=0;
        $preg3_regular=0;
        $preg3_malo=0;
        $preg3_muymalo=0;
        $preg3_resultado=0;

        $preg4_excelente=0;
        $preg4_bueno=0;
        $preg4_regular=0;
        $preg4_malo=0;
        $preg4_muymalo=0;
        $preg4_resultado=0;

        $preg5_excelente=0;
        $preg5_bueno=0;
        $preg5_regular=0;
        $preg5_malo=0;
        $preg5_muymalo=0;
        $preg5_resultado=0;

        $preg6_excelente=0;
        $preg6_bueno=0;
        $preg6_regular=0;
        $preg6_malo=0;
        $preg6_muymalo=0;
        $preg6_resultado=0;

        $preg7_excelente=0;
        $preg7_bueno=0;
        $preg7_regular=0;
        $preg7_malo=0;
        $preg7_muymalo=0;
        $preg7_resultado=0;

        $preg8_excelente=0;
        $preg8_bueno=0;
        $preg8_regular=0;
        $preg8_malo=0;
        $preg8_muymalo=0;
        $preg8_resultado=0;

        $preg9_excelente=0;
        $preg9_bueno=0;
        $preg9_regular=0;
        $preg9_malo=0;
        $preg9_muymalo=0;
        $preg9_resultado=0;

        $preg10_excelente=0;
        $preg10_bueno=0;
        $preg10_regular=0;
        $preg10_malo=0;
        $preg10_muymalo=0;
        $preg10_resultado=0;




          $excelente=0;
          $bueno=0;
          $regular=0;
          $malo=0;
          $muy_malo=0;
        foreach ($encuestas_contestadas as $encuesta)
        {
            if($encuesta->cal_preg_1 == 5){
                $excelente++;
                $preg1_excelente++;

            }elseif($encuesta->cal_preg_1 == 4){
                $bueno++;
                $preg1_bueno++;

            }
            elseif($encuesta->cal_preg_1 == 3){
                $regular++;
                $preg1_regular++;
            }
            elseif($encuesta->cal_preg_1 == 2){
                $malo++;
                $preg1_malo++;
            }
            elseif($encuesta->cal_preg_1 == 1){
                $muy_malo++;
                $preg1_muymalo++;
            }

            if($encuesta->cal_preg_2 == 5){
                $excelente++;
                $preg2_excelente++;

            }elseif($encuesta->cal_preg_2 == 4){
                $bueno++;
                $preg2_bueno++;
            }
            elseif($encuesta->cal_preg_2 == 3){
                $regular++;
                $preg2_regular++;
            }
            elseif($encuesta->cal_preg_2 == 2){
                $malo++;
                $preg2_malo++;
            }
            elseif($encuesta->cal_preg_2 == 1){
                $muy_malo++;
                $preg2_muymalo++;
            }

            if($encuesta->cal_preg_3 == 5){
                $excelente++;
                $preg3_excelente++;

            }elseif($encuesta->cal_preg_3 == 4){
                $bueno++;
                $preg3_bueno++;

            }
            elseif($encuesta->cal_preg_3 == 3){
                $regular++;
                $preg3_regular++;
            }
            elseif($encuesta->cal_preg_3 == 2){
                $malo++;
                $preg3_malo++;
            }
            elseif($encuesta->cal_preg_3 == 1){
                $muy_malo++;
                $preg3_muymalo++;
            }

            if($encuesta->cal_preg_4 == 5){
                $excelente++;
                $preg4_excelente++;

            }elseif($encuesta->cal_preg_4 == 4){
                $bueno++;
                $preg4_bueno++;
            }
            elseif($encuesta->cal_preg_4 == 3){
                $regular++;
                $preg4_regular++;
            }
            elseif($encuesta->cal_preg_4 == 2){
                $malo++;
                $preg4_malo++;
            }
            elseif($encuesta->cal_preg_4 == 1){
                $muy_malo++;
                $preg4_muymalo++;
            }

            if($encuesta->cal_preg_5 == 5){
                $excelente++;
                $preg5_excelente++;

            }elseif($encuesta->cal_preg_5 == 4){
                $bueno++;
                $preg5_bueno++;
            }
            elseif($encuesta->cal_preg_5 == 3){
                $regular++;
                $preg5_regular++;
            }
            elseif($encuesta->cal_preg_5 == 2){
                $malo++;
                $preg5_malo++;
            }
            elseif($encuesta->cal_preg_5 == 1){
                $muy_malo++;
                $preg5_muymalo++;
            }

            if($encuesta->cal_preg_6 == 5){
                $excelente++;
                $preg6_excelente++;

            }elseif($encuesta->cal_preg_6 == 4){
                $bueno++;
                $preg6_bueno++;
            }
            elseif($encuesta->cal_preg_6 == 3){
                $regular++;
                $preg6_regular++;

            }
            elseif($encuesta->cal_preg_6 == 2){
                $malo++;
                $preg6_malo++;
            }
            elseif($encuesta->cal_preg_6 == 1){
                $muy_malo++;
                $preg6_muymalo++;
            }

            if($encuesta->cal_preg_7 == 5){
                $excelente++;
                $preg7_excelente++;

            }elseif($encuesta->cal_preg_7 == 4){
                $bueno++;
                $preg7_bueno++;
            }
            elseif($encuesta->cal_preg_7 == 3){
                $regular++;
                $preg7_regular++;
            }
            elseif($encuesta->cal_preg_7 == 2){
                $malo++;
                $preg7_malo++;
            }
            elseif($encuesta->cal_preg_7 == 1){
                $muy_malo++;
                $preg7_muymalo++;
            }

            if($encuesta->cal_preg_8 == 5){
                $excelente++;
                $preg8_excelente++;

            }elseif($encuesta->cal_preg_8 == 4){
                $bueno++;
                $preg8_bueno++;
            }
            elseif($encuesta->cal_preg_8 == 3){
                $regular++;
                $preg8_regular++;
            }
            elseif($encuesta->cal_preg_8 == 2){
                $malo++;
                $preg8_malo++;
            }
            elseif($encuesta->cal_preg_8 == 1){
                $muy_malo++;
                $preg8_muymalo++;
            }

            if($encuesta->cal_preg_9 == 5){
                $excelente++;
                $preg9_excelente++;

            }elseif($encuesta->cal_preg_9 == 4){
                $bueno++;
                $preg9_bueno++;
            }
            elseif($encuesta->cal_preg_9 == 3){
                $regular++;
                $preg9_regular++;
            }
            elseif($encuesta->cal_preg_9 == 2){
                $malo++;
                $preg9_malo++;
            }
            elseif($encuesta->cal_preg_9 == 1){
                $muy_malo++;
                $preg9_muymalo++;
            }

            if($encuesta->cal_preg_10 == 5){
                $excelente++;
                $preg10_excelente++;

            }elseif($encuesta->cal_preg_10 == 4){
                $bueno++;
                $preg10_bueno++;
            }
            elseif($encuesta->cal_preg_10 == 3){
                $regular++;
                $preg10_regular++;
            }
            elseif($encuesta->cal_preg_10 == 2){
                $malo++;
                $preg10_malo++;
            }
            elseif($encuesta->cal_preg_10 == 1){
                $muy_malo++;
                $preg10_muymalo++;
            }

        }





        $preg1_resultado=  $preg1_excelente+$preg1_bueno+ $preg1_regular+$preg1_malo+ $preg1_muymalo;
        if($preg1_excelente == 0){
            $por_excelente1=0;
        }else{
            $por_excelente1= ($preg1_excelente/$preg1_resultado)*100;
        }
        if($preg1_bueno == 0){
            $por_bueno1=0;
        }else{
            $por_bueno1= ($preg1_bueno/$preg1_resultado)*100;
        }
        if($preg1_regular == 0){
            $por_regular1=0;
        }else{
            $por_regular1= ($preg1_regular/$preg1_resultado)*100;
        }
        if($preg1_malo == 0){
            $por_malo1=0;
        }else{
            $por_malo1= ($preg1_malo/$preg1_resultado)*100;
        }
        if($preg1_muymalo == 0){
            $por_muy_malo1=0;
        }else{
            $por_muy_malo1= ($preg1_muymalo/$preg1_resultado)*100;
        }

        $preg2_resultado=  $preg2_excelente+$preg2_bueno+ $preg2_regular+ $preg2_malo+ $preg2_muymalo;
        if($preg2_excelente == 0){
            $por_excelente2=0;
        }else{
            $por_excelente2= ($preg2_excelente/$preg2_resultado)*100;
        }
        if($preg2_bueno == 0){
            $por_bueno2=0;
        }else{
            $por_bueno2= ($preg2_bueno/$preg2_resultado)*100;
        }
        if($preg2_regular == 0){
            $por_regular2=0;
        }else{
            $por_regular2= ($preg2_regular/$preg2_resultado)*100;
        }
        if($preg2_malo == 0){
            $por_malo2=0;
        }else{
            $por_malo2= ($preg2_malo/$preg2_resultado)*100;
        }
        if($preg2_muymalo == 0){
            $por_muy_malo2=0;
        }else{
            $por_muy_malo2= ($preg2_muymalo/$preg2_resultado)*100;
        }

        $preg3_resultado=  $preg3_excelente+$preg3_bueno+ $preg3_regular+ $preg3_malo+ $preg3_muymalo;
        if($preg3_excelente == 0){
            $por_excelente3=0;
        }else{
            $por_excelente3= ($preg3_excelente/$preg3_resultado)*100;
        }
        if($preg3_bueno == 0){
            $por_bueno3=0;
        }else{
            $por_bueno3= ($preg3_bueno/$preg3_resultado)*100;
        }
        if($preg3_regular == 0){
            $por_regular3=0;
        }else{
            $por_regular3= ($preg3_regular/$preg3_resultado)*100;
        }
        if($preg3_malo == 0){
            $por_malo3=0;
        }else{
            $por_malo3= ($preg3_malo/$preg3_resultado)*100;
        }
        if($preg3_muymalo == 0){
            $por_muy_malo3=0;
        }else{
            $por_muy_malo3= ($preg3_muymalo/$preg3_resultado)*100;
        }
        $preg4_resultado=  $preg4_excelente+$preg4_bueno+ $preg4_regular+ $preg4_malo+ $preg4_muymalo;
        if($preg4_excelente == 0){
            $por_excelente4=0;
        }else{
            $por_excelente4= ($preg4_excelente/$preg4_resultado)*100;
        }
        if($preg4_bueno == 0){
            $por_bueno4=0;
        }else{
            $por_bueno4= ($preg4_bueno/$preg4_resultado)*100;
        }
        if($preg4_regular == 0){
            $por_regular4=0;
        }else{
            $por_regular4= ($preg4_regular/$preg4_resultado)*100;
        }
        if($preg4_malo == 0){
            $por_malo4=0;
        }else{
            $por_malo4= ($preg4_malo/$preg4_resultado)*100;
        }
        if($preg4_muymalo == 0){
            $por_muy_malo4=0;
        }else{
            $por_muy_malo4= ($preg4_muymalo/$preg4_resultado)*100;
        }

        $preg5_resultado=  $preg5_excelente+$preg5_bueno+ $preg5_regular+ $preg5_malo+ $preg5_muymalo;
        if($preg5_excelente == 0){
            $por_excelente5=0;
        }else{
            $por_excelente5= ($preg5_excelente/$preg5_resultado)*100;
        }
        if($preg5_bueno == 0){
            $por_bueno5=0;
        }else{
            $por_bueno5= ($preg5_bueno/$preg5_resultado)*100;
        }
        if($preg5_regular == 0){
            $por_regular5=0;
        }else{
            $por_regular5= ($preg5_regular/$preg5_resultado)*100;
        }
        if($preg5_malo == 0){
            $por_malo5=0;
        }else{
            $por_malo5= ($preg5_malo/$preg5_resultado)*100;
        }
        if($preg5_muymalo == 0){
            $por_muy_malo5=0;
        }else{
            $por_muy_malo5= ($preg5_muymalo/$preg5_resultado)*100;
        }
        $preg6_resultado=  $preg6_excelente+$preg6_bueno+ $preg6_regular+ $preg6_malo+ $preg6_muymalo;
        if($preg6_excelente == 0){
            $por_excelente6=0;
        }else{
            $por_excelente6= ($preg6_excelente/$preg6_resultado)*100;
        }
        if($preg6_bueno == 0){
            $por_bueno6=0;
        }else{
            $por_bueno6= ($preg6_bueno/$preg6_resultado)*100;
        }
        if($preg6_regular == 0){
            $por_regular6=0;
        }else{
            $por_regular6= ($preg6_regular/$preg6_resultado)*100;
        }
        if($preg6_malo == 0){
            $por_malo6=0;
        }else{
            $por_malo6= ($preg6_malo/$preg6_resultado)*100;
        }
        if($preg6_muymalo == 0){
            $por_muy_malo6=0;
        }else{
            $por_muy_malo6= ($preg6_muymalo/$preg6_resultado)*100;
        }
        $preg7_resultado=  $preg7_excelente+$preg7_bueno+ $preg7_regular+ $preg7_malo+ $preg7_muymalo;
        if($preg7_excelente == 0){
            $por_excelente7=0;
        }else{
            $por_excelente7= ($preg7_excelente/$preg7_resultado)*100;
        }
        if($preg7_bueno == 0){
            $por_bueno7=0;
        }else{
            $por_bueno7= ($preg7_bueno/$preg7_resultado)*100;
        }
        if($preg7_regular == 0){
            $por_regular7=0;
        }else{
            $por_regular7= ($preg7_regular/$preg7_resultado)*100;
        }
        if($preg7_malo == 0){
            $por_malo7=0;
        }else{
            $por_malo7= ($preg7_malo/$preg7_resultado)*100;
        }
        if($preg7_muymalo == 0){
            $por_muy_malo7=0;
        }else{
            $por_muy_malo7= ($preg7_muymalo/$preg7_resultado)*100;
        }

        $preg8_resultado=  $preg8_excelente+$preg8_bueno+ $preg8_regular+ $preg8_malo+ $preg8_muymalo;
        if($preg8_excelente == 0){
            $por_excelente8=0;
        }else{
            $por_excelente8= ($preg8_excelente/$preg8_resultado)*100;
        }
        if($preg8_bueno == 0){
            $por_bueno8=0;
        }else{
            $por_bueno8= ($preg8_bueno/$preg8_resultado)*100;
        }
        if($preg8_regular == 0){
            $por_regular8=0;
        }else{
            $por_regular8= ($preg8_regular/$preg8_resultado)*100;
        }
        if($preg8_malo == 0){
            $por_malo8=0;
        }else{
            $por_malo8= ($preg8_malo/$preg8_resultado)*100;
        }
        if($preg8_muymalo == 0){
            $por_muy_malo8=0;
        }else{
            $por_muy_malo8= ($preg8_muymalo/$preg8_resultado)*100;
        }

        $preg9_resultado=  $preg9_excelente+$preg9_bueno+ $preg9_regular+ $preg9_malo+ $preg9_muymalo;
        if($preg9_excelente == 0){
            $por_excelente9=0;
        }else{
            $por_excelente9= ($preg9_excelente/$preg9_resultado)*100;
        }
        if($preg9_bueno == 0){
            $por_bueno9=0;
        }else{
            $por_bueno9= ($preg9_bueno/$preg9_resultado)*100;
        }
        if($preg9_regular == 0){
            $por_regular9=0;
        }else{
            $por_regular9= ($preg9_regular/$preg9_resultado)*100;
        }
        if($preg9_malo == 0){
            $por_malo9=0;
        }else{
            $por_malo9= ($preg9_malo/$preg9_resultado)*100;
        }
        if($preg9_muymalo == 0){
            $por_muy_malo9=0;
        }else{
            $por_muy_malo9= ($preg9_muymalo/$preg9_resultado)*100;
        }

        $preg10_resultado=  $preg10_excelente+$preg10_bueno+ $preg10_regular+ $preg10_malo+ $preg10_muymalo;
        if($preg10_excelente == 0){
            $por_excelente10=0;
        }else{
            $por_excelente10= ($preg10_excelente/$preg10_resultado)*100;
        }
        if($preg10_bueno == 0){
            $por_bueno10=0;
        }else{
            $por_bueno10= ($preg10_bueno/$preg10_resultado)*100;
        }
        if($preg10_regular == 0){
            $por_regular10=0;
        }else{
            $por_regular10= ($preg10_regular/$preg10_resultado)*100;
        }
        if($preg10_malo == 0){
            $por_malo10=0;
        }else{
            $por_malo10= ($preg10_malo/$preg10_resultado)*100;
        }
        if($preg10_muymalo == 0){
            $por_muy_malo10=0;
        }else{
            $por_muy_malo10= ($preg10_muymalo/$preg10_resultado)*100;
        }


        $resultado=$excelente+$bueno+$regular+$malo+$muy_malo;
        if($excelente == 0){
            $por_excelente=0;
        }else{
            $por_excelente= ($excelente/$resultado)*100;
        }
        if($bueno == 0){
            $por_bueno=0;
        }else{
            $por_bueno= ($bueno/$resultado)*100;
        }
        if($regular == 0){
            $por_regular=0;
        }else{
            $por_regular= ($regular/$resultado)*100;
        }
        if($malo == 0){
            $por_malo=0;
        }else{
            $por_malo= ($malo/$resultado)*100;
        }

        if($muy_malo == 0){
            $por_muy_malo=0;
        }else{
            $por_muy_malo= ($muy_malo/$resultado)*100;
        }
       $excelente_bueno=$por_excelente+$por_bueno;

        return view('encuestas_satisfacion_cliente.servicio_social.graficas_porcentajes_servicio',
            compact('excelente','bueno','regular','malo','muy_malo','por_excelente','por_bueno','por_regular','por_malo','por_muy_malo','excelente_bueno','mes','year',
                'por_excelente1','por_bueno1','por_regular1','por_malo1','por_muy_malo1',
                'por_excelente2','por_bueno2','por_regular2','por_malo2','por_muy_malo2',
                'por_excelente3','por_bueno3','por_regular3','por_malo3','por_muy_malo3',
                'por_excelente4','por_bueno4','por_regular4','por_malo4','por_muy_malo4',
                'por_excelente5','por_bueno5','por_regular5','por_malo5','por_muy_malo5',
                'por_excelente6','por_bueno6','por_regular6','por_malo6','por_muy_malo6',
                'por_excelente7','por_bueno7','por_regular7','por_malo7','por_muy_malo7',
                'por_excelente8','por_bueno8','por_regular8','por_malo8','por_muy_malo8',
                'por_excelente9','por_bueno9','por_regular9','por_malo9','por_muy_malo9',
                'por_excelente10','por_bueno10','por_regular10','por_malo10','por_muy_malo10',

                'preg1_excelente','preg1_bueno','preg1_regular','preg1_malo','preg1_muymalo',
                'preg2_excelente','preg2_bueno','preg2_regular','preg2_malo','preg2_muymalo',
                'preg3_excelente','preg3_bueno','preg3_regular','preg3_malo','preg3_muymalo',
                'preg4_excelente','preg4_bueno','preg4_regular','preg4_malo','preg4_muymalo',
                'preg5_excelente','preg5_bueno','preg5_regular','preg5_malo','preg5_muymalo',
                'preg6_excelente','preg6_bueno','preg6_regular','preg6_malo','preg6_muymalo',
                'preg7_excelente','preg7_bueno','preg7_regular','preg7_malo','preg7_muymalo',
                'preg8_excelente','preg8_bueno','preg8_regular','preg8_malo','preg8_muymalo',
                'preg9_excelente','preg9_bueno','preg9_regular','preg9_malo','preg9_muymalo',
                'preg10_excelente','preg10_bueno','preg10_regular','preg10_malo','preg10_muymalo'

            ));



    }
    public function agregar_periodo_year_residencia()
    {
        $periodo = Session::get('periodo_actual');

        $periodo_resi = DB::selectOne('SELECT count(id_periodo_residencia) contar
         FROM enc_periodo_residencia where id_periodo = ?', [$periodo]);

        $estado_periodo = $periodo_resi->contar;
        $nombre_periodo = DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = ?', [$periodo]);

        $nom_periodo_resi = DB::selectOne('SELECT *FROM enc_periodo_residencia where id_periodo = ?', [$periodo]);

        $contar_enc_enviadas = DB::selectOne('SELECT COUNT(id_residencia_profesional) contar FROM enc_residencia_profesional
         WHERE id_periodo = ? and id_estado = 0', [$periodo]);

        $contar_enc_contestadas = DB::selectOne('SELECT COUNT(id_residencia_profesional) contar FROM enc_residencia_profesional
         WHERE id_periodo = ? and id_estado = 1', [$periodo]);

      $contar_enc_rechazadas=DB::selectOne('SELECT COUNT(id_residencia_profesional) contar FROM enc_residencia_profesional
         WHERE id_periodo = ? and id_estado = 3', [$periodo]);





        return view('encuestas_satisfacion_cliente.residencia.periodo_encuesta_residencia',compact('estado_periodo','nombre_periodo','nom_periodo_resi',
        'contar_enc_enviadas','contar_enc_contestadas','contar_enc_rechazadas'));

    }
    public  function guardar_periodo_year_residencia(Request $request){

        $id_periodo = $request->input("id_periodo");

        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_periodo_residencia')->insert([
            'id_periodo' => $id_periodo,
            'fecha_registro' =>$fecha_actual,

        ]);
        return back();
    }
    public function termino_encuesta_residencia($id_periodo_residencia){

     $periodo=DB::selectOne('SELECT gnral_periodos.periodo,enc_periodo_residencia.* from gnral_periodos, enc_periodo_residencia
     where gnral_periodos.id_periodo = enc_periodo_residencia.id_periodo
     and enc_periodo_residencia.id_periodo_residencia = ? ', [$id_periodo_residencia]);

        return view('encuestas_satisfacion_cliente.residencia.terminar_periodo_resi',compact('periodo'));
    }
    public function guardar_termino_encuesta_residencia(Request $request){

        $id_periodo_residencia = $request->input("id_periodo_residencia");
        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_residencia` WHERE `id_periodo_residencia` = ?', [$id_periodo_residencia]);
        $fecha_actual =  date("Y-m-d H:i:s");
        DB:: table('enc_residencia_profesional')
            ->where('id_periodo', $periodo->id_periodo)
            ->where('id_estado', 0)
            ->update([
                'id_estado'=>3
            ]);
        DB:: table('enc_periodo_residencia')
            ->where('id_periodo_residencia', $id_periodo_residencia)
            ->update([
                'id_estado'=>1,
                'fecha_termino'=>$fecha_actual
            ]);
        return back();
    }
    public function ver_enc_contestadas_residencia($id_periodo_residencia){
        $periodo=DB::selectOne('SELECT gnral_periodos.periodo,enc_periodo_residencia.* from gnral_periodos, enc_periodo_residencia
     where gnral_periodos.id_periodo = enc_periodo_residencia.id_periodo
     and enc_periodo_residencia.id_periodo_residencia = ? ', [$id_periodo_residencia]);

        $carreras=DB::table('gnral_carreras')
            ->where('gnral_carreras.id_carrera','!=',9)
            ->where('gnral_carreras.id_carrera','!=',11)
            ->where('gnral_carreras.id_carrera','!=',15)
            ->select('gnral_carreras.*')
            ->get();
        $mostrar=0;

        return view('encuestas_satisfacion_cliente.residencia.carreras_enc_autorizadas',
            compact('carreras','mostrar','periodo'));
    }
    public function ver_enc_contestadas_resi_alum($id_carrera,$id_periodo_residencia){

        $periodo=DB::selectOne('SELECT gnral_periodos.periodo, enc_periodo_residencia.*
        from gnral_periodos, enc_periodo_residencia where gnral_periodos.id_periodo = enc_periodo_residencia.id_periodo
        and enc_periodo_residencia.id_periodo_residencia = ?', [$id_periodo_residencia]);


        $alumnos=DB::select('SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno,
        gnral_alumnos.amaterno,enc_residencia_profesional.*
        from gnral_alumnos,enc_residencia_profesional where gnral_alumnos.id_alumno = enc_residencia_profesional.id_alumno and
        enc_residencia_profesional.id_periodo = ? and enc_residencia_profesional.id_estado = 1', [$periodo->id_periodo]);

         $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = ?', [$id_carrera]);

        return view('encuestas_satisfacion_cliente.residencia.alumnos_enc_autorizada', compact('periodo','alumnos','carrera','id_carrera','id_periodo_residencia'));

    }
    public function ver_enc_alumno_contestada($id_residencia_profesional){

        $encuesta_alumno=DB::selectOne('SELECT gnral_alumnos.id_carrera,gnral_alumnos.cuenta, gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno,
        gnral_alumnos.amaterno, enc_residencia_profesional.*,gnral_carreras.nombre carrera  FROM enc_residencia_profesional, gnral_alumnos,
        gnral_carreras WHERE gnral_carreras.id_carrera = gnral_alumnos.id_carrera and  gnral_alumnos.id_alumno = enc_residencia_profesional.id_alumno
        and  enc_residencia_profesional.id_residencia_profesional = ?', [$id_residencia_profesional]);

        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_residencia` WHERE `id_periodo` = ?', [$encuesta_alumno->id_periodo]);

        return view('encuestas_satisfacion_cliente.residencia.enc_alumno_contestada', compact('encuesta_alumno','periodo'));


    }
    public function ver_enc_carreras_res_residencia($id_periodo_residencia){
        $periodo=DB::selectOne('SELECT gnral_periodos.periodo, enc_periodo_residencia.*
        from gnral_periodos, enc_periodo_residencia where gnral_periodos.id_periodo = enc_periodo_residencia.id_periodo
        and enc_periodo_residencia.id_periodo_residencia = ?', [$id_periodo_residencia]);


        $encuestas_contestadas=DB::select('SELECT * FROM `enc_residencia_profesional` WHERE `id_periodo` = ? AND `id_estado` = 1', [$periodo->id_periodo]);
       // dd($encuestas_contestadas);
        $preg1_excelente=0;
        $preg1_bueno=0;
        $preg1_regular=0;
        $preg1_malo=0;
        $preg1_muymalo=0;
        $preg1_resultado=0;

        $preg2_excelente=0;
        $preg2_bueno=0;
        $preg2_regular=0;
        $preg2_malo=0;
        $preg2_muymalo=0;
        $preg2_resultado=0;

        $preg3_excelente=0;
        $preg3_bueno=0;
        $preg3_regular=0;
        $preg3_malo=0;
        $preg3_muymalo=0;
        $preg3_resultado=0;

        $preg4_excelente=0;
        $preg4_bueno=0;
        $preg4_regular=0;
        $preg4_malo=0;
        $preg4_muymalo=0;
        $preg4_resultado=0;

        $preg5_excelente=0;
        $preg5_bueno=0;
        $preg5_regular=0;
        $preg5_malo=0;
        $preg5_muymalo=0;
        $preg5_resultado=0;

        $preg6_excelente=0;
        $preg6_bueno=0;
        $preg6_regular=0;
        $preg6_malo=0;
        $preg6_muymalo=0;
        $preg6_resultado=0;

        $preg7_excelente=0;
        $preg7_bueno=0;
        $preg7_regular=0;
        $preg7_malo=0;
        $preg7_muymalo=0;
        $preg7_resultado=0;

        $preg8_excelente=0;
        $preg8_bueno=0;
        $preg8_regular=0;
        $preg8_malo=0;
        $preg8_muymalo=0;
        $preg8_resultado=0;

        $preg9_excelente=0;
        $preg9_bueno=0;
        $preg9_regular=0;
        $preg9_malo=0;
        $preg9_muymalo=0;
        $preg9_resultado=0;

        $preg10_excelente=0;
        $preg10_bueno=0;
        $preg10_regular=0;
        $preg10_malo=0;
        $preg10_muymalo=0;
        $preg10_resultado=0;




        $excelente=0;
        $bueno=0;
        $regular=0;
        $malo=0;
        $muy_malo=0;
        foreach ($encuestas_contestadas as $encuesta)
        {
            if($encuesta->cal_preg_1 == 5){
                $excelente++;
                $preg1_excelente++;

            }elseif($encuesta->cal_preg_1 == 4){
                $bueno++;
                $preg1_bueno++;

            }
            elseif($encuesta->cal_preg_1 == 3){
                $regular++;
                $preg1_regular++;
            }
            elseif($encuesta->cal_preg_1 == 2){
                $malo++;
                $preg1_malo++;
            }
            elseif($encuesta->cal_preg_1 == 1){
                $muy_malo++;
                $preg1_muymalo++;
            }

            if($encuesta->cal_preg_2 == 5){
                $excelente++;
                $preg2_excelente++;

            }elseif($encuesta->cal_preg_2 == 4){
                $bueno++;
                $preg2_bueno++;
            }
            elseif($encuesta->cal_preg_2 == 3){
                $regular++;
                $preg2_regular++;
            }
            elseif($encuesta->cal_preg_2 == 2){
                $malo++;
                $preg2_malo++;
            }
            elseif($encuesta->cal_preg_2 == 1){
                $muy_malo++;
                $preg2_muymalo++;
            }

            if($encuesta->cal_preg_3 == 5){
                $excelente++;
                $preg3_excelente++;

            }elseif($encuesta->cal_preg_3 == 4){
                $bueno++;
                $preg3_bueno++;

            }
            elseif($encuesta->cal_preg_3 == 3){
                $regular++;
                $preg3_regular++;
            }
            elseif($encuesta->cal_preg_3 == 2){
                $malo++;
                $preg3_malo++;
            }
            elseif($encuesta->cal_preg_3 == 1){
                $muy_malo++;
                $preg3_muymalo++;
            }

            if($encuesta->cal_preg_4 == 5){
                $excelente++;
                $preg4_excelente++;

            }elseif($encuesta->cal_preg_4 == 4){
                $bueno++;
                $preg4_bueno++;
            }
            elseif($encuesta->cal_preg_4 == 3){
                $regular++;
                $preg4_regular++;
            }
            elseif($encuesta->cal_preg_4 == 2){
                $malo++;
                $preg4_malo++;
            }
            elseif($encuesta->cal_preg_4 == 1){
                $muy_malo++;
                $preg4_muymalo++;
            }

            if($encuesta->cal_preg_5 == 5){
                $excelente++;
                $preg5_excelente++;

            }elseif($encuesta->cal_preg_5 == 4){
                $bueno++;
                $preg5_bueno++;
            }
            elseif($encuesta->cal_preg_5 == 3){
                $regular++;
                $preg5_regular++;
            }
            elseif($encuesta->cal_preg_5 == 2){
                $malo++;
                $preg5_malo++;
            }
            elseif($encuesta->cal_preg_5 == 1){
                $muy_malo++;
                $preg5_muymalo++;
            }

            if($encuesta->cal_preg_6 == 5){
                $excelente++;
                $preg6_excelente++;

            }elseif($encuesta->cal_preg_6 == 4){
                $bueno++;
                $preg6_bueno++;
            }
            elseif($encuesta->cal_preg_6 == 3){
                $regular++;
                $preg6_regular++;

            }
            elseif($encuesta->cal_preg_6 == 2){
                $malo++;
                $preg6_malo++;
            }
            elseif($encuesta->cal_preg_6 == 1){
                $muy_malo++;
                $preg6_muymalo++;
            }

            if($encuesta->cal_preg_7 == 5){
                $excelente++;
                $preg7_excelente++;

            }elseif($encuesta->cal_preg_7 == 4){
                $bueno++;
                $preg7_bueno++;
            }
            elseif($encuesta->cal_preg_7 == 3){
                $regular++;
                $preg7_regular++;
            }
            elseif($encuesta->cal_preg_7 == 2){
                $malo++;
                $preg7_malo++;
            }
            elseif($encuesta->cal_preg_7 == 1){
                $muy_malo++;
                $preg7_muymalo++;
            }

            if($encuesta->cal_preg_8 == 5){
                $excelente++;
                $preg8_excelente++;

            }elseif($encuesta->cal_preg_8 == 4){
                $bueno++;
                $preg8_bueno++;
            }
            elseif($encuesta->cal_preg_8 == 3){
                $regular++;
                $preg8_regular++;
            }
            elseif($encuesta->cal_preg_8 == 2){
                $malo++;
                $preg8_malo++;
            }
            elseif($encuesta->cal_preg_8 == 1){
                $muy_malo++;
                $preg8_muymalo++;
            }

            if($encuesta->cal_preg_9 == 5){
                $excelente++;
                $preg9_excelente++;

            }elseif($encuesta->cal_preg_9 == 4){
                $bueno++;
                $preg9_bueno++;
            }
            elseif($encuesta->cal_preg_9 == 3){
                $regular++;
                $preg9_regular++;
            }
            elseif($encuesta->cal_preg_9 == 2){
                $malo++;
                $preg9_malo++;
            }
            elseif($encuesta->cal_preg_9 == 1){
                $muy_malo++;
                $preg9_muymalo++;
            }

            if($encuesta->cal_preg_10 == 5){
                $excelente++;
                $preg10_excelente++;

            }elseif($encuesta->cal_preg_10 == 4){
                $bueno++;
                $preg10_bueno++;
            }
            elseif($encuesta->cal_preg_10 == 3){
                $regular++;
                $preg10_regular++;
            }
            elseif($encuesta->cal_preg_10 == 2){
                $malo++;
                $preg10_malo++;
            }
            elseif($encuesta->cal_preg_10 == 1){
                $muy_malo++;
                $preg10_muymalo++;
            }

        }





        $preg1_resultado=  $preg1_excelente+$preg1_bueno+ $preg1_regular+$preg1_malo+ $preg1_muymalo;
        if($preg1_excelente == 0){
            $por_excelente1=0;
        }else{
            $por_excelente1= ($preg1_excelente/$preg1_resultado)*100;
        }
        if($preg1_bueno == 0){
            $por_bueno1=0;
        }else{
            $por_bueno1= ($preg1_bueno/$preg1_resultado)*100;
        }
        if($preg1_regular == 0){
            $por_regular1=0;
        }else{
            $por_regular1= ($preg1_regular/$preg1_resultado)*100;
        }
        if($preg1_malo == 0){
            $por_malo1=0;
        }else{
            $por_malo1= ($preg1_malo/$preg1_resultado)*100;
        }
        if($preg1_muymalo == 0){
            $por_muy_malo1=0;
        }else{
            $por_muy_malo1= ($preg1_muymalo/$preg1_resultado)*100;
        }

        $preg2_resultado=  $preg2_excelente+$preg2_bueno+ $preg2_regular+ $preg2_malo+ $preg2_muymalo;
        if($preg2_excelente == 0){
            $por_excelente2=0;
        }else{
            $por_excelente2= ($preg2_excelente/$preg2_resultado)*100;
        }
        if($preg2_bueno == 0){
            $por_bueno2=0;
        }else{
            $por_bueno2= ($preg2_bueno/$preg2_resultado)*100;
        }
        if($preg2_regular == 0){
            $por_regular2=0;
        }else{
            $por_regular2= ($preg2_regular/$preg2_resultado)*100;
        }
        if($preg2_malo == 0){
            $por_malo2=0;
        }else{
            $por_malo2= ($preg2_malo/$preg2_resultado)*100;
        }
        if($preg2_muymalo == 0){
            $por_muy_malo2=0;
        }else{
            $por_muy_malo2= ($preg2_muymalo/$preg2_resultado)*100;
        }

        $preg3_resultado=  $preg3_excelente+$preg3_bueno+ $preg3_regular+ $preg3_malo+ $preg3_muymalo;
        if($preg3_excelente == 0){
            $por_excelente3=0;
        }else{
            $por_excelente3= ($preg3_excelente/$preg3_resultado)*100;
        }
        if($preg3_bueno == 0){
            $por_bueno3=0;
        }else{
            $por_bueno3= ($preg3_bueno/$preg3_resultado)*100;
        }
        if($preg3_regular == 0){
            $por_regular3=0;
        }else{
            $por_regular3= ($preg3_regular/$preg3_resultado)*100;
        }
        if($preg3_malo == 0){
            $por_malo3=0;
        }else{
            $por_malo3= ($preg3_malo/$preg3_resultado)*100;
        }
        if($preg3_muymalo == 0){
            $por_muy_malo3=0;
        }else{
            $por_muy_malo3= ($preg3_muymalo/$preg3_resultado)*100;
        }
        $preg4_resultado=  $preg4_excelente+$preg4_bueno+ $preg4_regular+ $preg4_malo+ $preg4_muymalo;
        if($preg4_excelente == 0){
            $por_excelente4=0;
        }else{
            $por_excelente4= ($preg4_excelente/$preg4_resultado)*100;
        }
        if($preg4_bueno == 0){
            $por_bueno4=0;
        }else{
            $por_bueno4= ($preg4_bueno/$preg4_resultado)*100;
        }
        if($preg4_regular == 0){
            $por_regular4=0;
        }else{
            $por_regular4= ($preg4_regular/$preg4_resultado)*100;
        }
        if($preg4_malo == 0){
            $por_malo4=0;
        }else{
            $por_malo4= ($preg4_malo/$preg4_resultado)*100;
        }
        if($preg4_muymalo == 0){
            $por_muy_malo4=0;
        }else{
            $por_muy_malo4= ($preg4_muymalo/$preg4_resultado)*100;
        }

        $preg5_resultado=  $preg5_excelente+$preg5_bueno+ $preg5_regular+ $preg5_malo+ $preg5_muymalo;
        if($preg5_excelente == 0){
            $por_excelente5=0;
        }else{
            $por_excelente5= ($preg5_excelente/$preg5_resultado)*100;
        }
        if($preg5_bueno == 0){
            $por_bueno5=0;
        }else{
            $por_bueno5= ($preg5_bueno/$preg5_resultado)*100;
        }
        if($preg5_regular == 0){
            $por_regular5=0;
        }else{
            $por_regular5= ($preg5_regular/$preg5_resultado)*100;
        }
        if($preg5_malo == 0){
            $por_malo5=0;
        }else{
            $por_malo5= ($preg5_malo/$preg5_resultado)*100;
        }
        if($preg5_muymalo == 0){
            $por_muy_malo5=0;
        }else{
            $por_muy_malo5= ($preg5_muymalo/$preg5_resultado)*100;
        }
        $preg6_resultado=  $preg6_excelente+$preg6_bueno+ $preg6_regular+ $preg6_malo+ $preg6_muymalo;
        if($preg6_excelente == 0){
            $por_excelente6=0;
        }else{
            $por_excelente6= ($preg6_excelente/$preg6_resultado)*100;
        }
        if($preg6_bueno == 0){
            $por_bueno6=0;
        }else{
            $por_bueno6= ($preg6_bueno/$preg6_resultado)*100;
        }
        if($preg6_regular == 0){
            $por_regular6=0;
        }else{
            $por_regular6= ($preg6_regular/$preg6_resultado)*100;
        }
        if($preg6_malo == 0){
            $por_malo6=0;
        }else{
            $por_malo6= ($preg6_malo/$preg6_resultado)*100;
        }
        if($preg6_muymalo == 0){
            $por_muy_malo6=0;
        }else{
            $por_muy_malo6= ($preg6_muymalo/$preg6_resultado)*100;
        }
        $preg7_resultado=  $preg7_excelente+$preg7_bueno+ $preg7_regular+ $preg7_malo+ $preg7_muymalo;
        if($preg7_excelente == 0){
            $por_excelente7=0;
        }else{
            $por_excelente7= ($preg7_excelente/$preg7_resultado)*100;
        }
        if($preg7_bueno == 0){
            $por_bueno7=0;
        }else{
            $por_bueno7= ($preg7_bueno/$preg7_resultado)*100;
        }
        if($preg7_regular == 0){
            $por_regular7=0;
        }else{
            $por_regular7= ($preg7_regular/$preg7_resultado)*100;
        }
        if($preg7_malo == 0){
            $por_malo7=0;
        }else{
            $por_malo7= ($preg7_malo/$preg7_resultado)*100;
        }
        if($preg7_muymalo == 0){
            $por_muy_malo7=0;
        }else{
            $por_muy_malo7= ($preg7_muymalo/$preg7_resultado)*100;
        }

        $preg8_resultado=  $preg8_excelente+$preg8_bueno+ $preg8_regular+ $preg8_malo+ $preg8_muymalo;
        if($preg8_excelente == 0){
            $por_excelente8=0;
        }else{
            $por_excelente8= ($preg8_excelente/$preg8_resultado)*100;
        }
        if($preg8_bueno == 0){
            $por_bueno8=0;
        }else{
            $por_bueno8= ($preg8_bueno/$preg8_resultado)*100;
        }
        if($preg8_regular == 0){
            $por_regular8=0;
        }else{
            $por_regular8= ($preg8_regular/$preg8_resultado)*100;
        }
        if($preg8_malo == 0){
            $por_malo8=0;
        }else{
            $por_malo8= ($preg8_malo/$preg8_resultado)*100;
        }
        if($preg8_muymalo == 0){
            $por_muy_malo8=0;
        }else{
            $por_muy_malo8= ($preg8_muymalo/$preg8_resultado)*100;
        }

        $preg9_resultado=  $preg9_excelente+$preg9_bueno+ $preg9_regular+ $preg9_malo+ $preg9_muymalo;
        if($preg9_excelente == 0){
            $por_excelente9=0;
        }else{
            $por_excelente9= ($preg9_excelente/$preg9_resultado)*100;
        }
        if($preg9_bueno == 0){
            $por_bueno9=0;
        }else{
            $por_bueno9= ($preg9_bueno/$preg9_resultado)*100;
        }
        if($preg9_regular == 0){
            $por_regular9=0;
        }else{
            $por_regular9= ($preg9_regular/$preg9_resultado)*100;
        }
        if($preg9_malo == 0){
            $por_malo9=0;
        }else{
            $por_malo9= ($preg9_malo/$preg9_resultado)*100;
        }
        if($preg9_muymalo == 0){
            $por_muy_malo9=0;
        }else{
            $por_muy_malo9= ($preg9_muymalo/$preg9_resultado)*100;
        }

        $preg10_resultado=  $preg10_excelente+$preg10_bueno+ $preg10_regular+ $preg10_malo+ $preg10_muymalo;
        if($preg10_excelente == 0){
            $por_excelente10=0;
        }else{
            $por_excelente10= ($preg10_excelente/$preg10_resultado)*100;
        }
        if($preg10_bueno == 0){
            $por_bueno10=0;
        }else{
            $por_bueno10= ($preg10_bueno/$preg10_resultado)*100;
        }
        if($preg10_regular == 0){
            $por_regular10=0;
        }else{
            $por_regular10= ($preg10_regular/$preg10_resultado)*100;
        }
        if($preg10_malo == 0){
            $por_malo10=0;
        }else{
            $por_malo10= ($preg10_malo/$preg10_resultado)*100;
        }
        if($preg10_muymalo == 0){
            $por_muy_malo10=0;
        }else{
            $por_muy_malo10= ($preg10_muymalo/$preg10_resultado)*100;
        }


        $resultado=$excelente+$bueno+$regular+$malo+$muy_malo;
        if($excelente == 0){
            $por_excelente=0;
        }else{
            $por_excelente= ($excelente/$resultado)*100;
        }
        if($bueno == 0){
            $por_bueno=0;
        }else{
            $por_bueno= ($bueno/$resultado)*100;
        }
        if($regular == 0){
            $por_regular=0;
        }else{
            $por_regular= ($regular/$resultado)*100;
        }
        if($malo == 0){
            $por_malo=0;
        }else{
            $por_malo= ($malo/$resultado)*100;
        }

        if($muy_malo == 0){
            $por_muy_malo=0;
        }else{
            $por_muy_malo= ($muy_malo/$resultado)*100;
        }
        $excelente_bueno=$por_excelente+$por_bueno;

        return view('encuestas_satisfacion_cliente.residencia.graficas_porcentajes_resi',
            compact('excelente','bueno','regular','malo','muy_malo','por_excelente',
                'por_bueno','por_regular','por_malo','por_muy_malo','excelente_bueno',
                'por_excelente1','por_bueno1','por_regular1','por_malo1','por_muy_malo1',
                'por_excelente2','por_bueno2','por_regular2','por_malo2','por_muy_malo2',
                'por_excelente3','por_bueno3','por_regular3','por_malo3','por_muy_malo3',
                'por_excelente4','por_bueno4','por_regular4','por_malo4','por_muy_malo4',
                'por_excelente5','por_bueno5','por_regular5','por_malo5','por_muy_malo5',
                'por_excelente6','por_bueno6','por_regular6','por_malo6','por_muy_malo6',
                'por_excelente7','por_bueno7','por_regular7','por_malo7','por_muy_malo7',
                'por_excelente8','por_bueno8','por_regular8','por_malo8','por_muy_malo8',
                'por_excelente9','por_bueno9','por_regular9','por_malo9','por_muy_malo9',
                'por_excelente10','por_bueno10','por_regular10','por_malo10','por_muy_malo10',

                'preg1_excelente','preg1_bueno','preg1_regular','preg1_malo','preg1_muymalo',
                'preg2_excelente','preg2_bueno','preg2_regular','preg2_malo','preg2_muymalo',
                'preg3_excelente','preg3_bueno','preg3_regular','preg3_malo','preg3_muymalo',
                'preg4_excelente','preg4_bueno','preg4_regular','preg4_malo','preg4_muymalo',
                'preg5_excelente','preg5_bueno','preg5_regular','preg5_malo','preg5_muymalo',
                'preg6_excelente','preg6_bueno','preg6_regular','preg6_malo','preg6_muymalo',
                'preg7_excelente','preg7_bueno','preg7_regular','preg7_malo','preg7_muymalo',
                'preg8_excelente','preg8_bueno','preg8_regular','preg8_malo','preg8_muymalo',
                'preg9_excelente','preg9_bueno','preg9_regular','preg9_malo','preg9_muymalo',
                'preg10_excelente','preg10_bueno','preg10_regular','preg10_malo','preg10_muymalo','periodo'

            ));



    }
    public function historial_periodo_year(){
        $year_historial = DB::select('SELECT year FROM enc_periodo_servicio GROUP by year');

        return view('encuestas_satisfacion_cliente.servicio_social.menu_historial',compact('year_historial'));

    }
    public function menu_historial_servicio_s_year($year){
        Session::put('historial_enc_s',1);
        $total_periodos=DB::selectOne('SELECT COUNT(id_periodo_serv)contar from enc_periodo_servicio where year= ?', [$year]);
        $total_periodos=$total_periodos->contar;
        //  dd($total_periodos);

        $periodos= DB::select('SELECT *from enc_periodo_servicio where year= ?', [$year]);

        return view("encuestas_satisfacion_cliente.servicio_social.periodos_servicio_social",compact('year','total_periodos','periodos'));

    }
    public function historial_periodo_year_residencia(){
        abort(501, 'Funcionalidad no disponible.');
    }

}
