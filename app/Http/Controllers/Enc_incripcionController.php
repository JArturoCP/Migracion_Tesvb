<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Enc_incripcionController extends Controller
{
    public function encuesta_incripcion(){

        return view('encuestas_satisfacion_cliente.inscripcion.encuesta_inscripcion');
    }
    public function enviar_encuesta_incripcion(Request $request){
        //dd($request);
        $id_usuario = Session::get('usuario_alumno');
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_usuario ='.$id_usuario.'');
        $id_alumno=$alumno->id_alumno;
        $id_carrera=$alumno->id_carrera;

        $periodo=Session::get('periodo_actual');

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

        if($pregunta10 == 1){
            $motivo = $request->input("motivo");
        }
        else{
            $motivo="";
        }
        $pregunta11 = $request->input("pregunta11");
        $comentario= $request->input("comentario");
        if($comentario == null){
            $comentario= "";
        }else{
            $comentario= $request->input("comentario");
        }

        $fecha_actual =  date("Y-m-d H:i:s");
        $fecha =  date("Y-m-d");


        DB:: table('enc_incripcion')
            ->where('id_alumno', $id_alumno)
            ->where('id_periodo', $periodo)
            ->update([
                'id_carrera'=>$id_carrera,
                'id_tipo_encuesta'=>1,
                'fecha_encuesta'=>$fecha_actual,
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
                'comentario_res_preg_10'=>$motivo,
                'cal_preg_11'=>$pregunta11,
                'comentario'=>$comentario,
                'fecha_registro'=>$fecha,
                'id_estado'=>1
            ]);
        return redirect('/inicio');
    }
    public function encuesta_reincripcion(){
        return view('encuestas_satisfacion_cliente.reinscripcion.encuesta_reinscripcion');
    }
    public function enviar_encuesta_reinscripcion(Request $request){
        $id_usuario = Session::get('usuario_alumno');
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_usuario ='.$id_usuario.'');
        $id_alumno=$alumno->id_alumno;
        $id_carrera=$alumno->id_carrera;

        $periodo=Session::get('periodo_actual');

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

        if($pregunta10 == 1){
            $motivo = $request->input("motivo");
        }
        else{
            $motivo="";
        }
        $pregunta11 = $request->input("pregunta11");
        $comentario= $request->input("comentario");
        if($comentario == null){
            $comentario= "";
        }else{
            $comentario= $request->input("comentario");
        }

        $fecha_actual =  date("Y-m-d H:i:s");
        $fecha =  date("Y-m-d");

        DB:: table('enc_reinscripcion')
            ->where('id_alumno', $id_alumno)
            ->where('id_periodo', $periodo)
            ->update([
                'id_carrera'=>$id_carrera,
                'id_tipo_encuesta'=>1,
                'fecha_encuesta'=>$fecha_actual,
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
                'comentario_res_preg_10'=>$motivo,
                'cal_preg_11'=>$pregunta11,
                'comentario'=>$comentario,
                'fecha_registro'=>$fecha,
                'id_estado'=>1
            ]);
        return redirect('/inicio');
    }
public function enviar_encuesta_estudiante_titulacion(){
    Session::put('historial_enc_t',0);
        $year =  date("Y");
        $total_periodos=DB::selectOne('SELECT count(id_periodo_titulacion) contar from enc_periodo_titulacion where year='.$year.'');
        $total_periodos=$total_periodos->contar;

       $periodos= DB::select('SELECT * FROM enc_periodo_titulacion WHERE  year ='.$year.'');

       return view("encuestas_satisfacion_cliente.titulacion.periodos_titulacion",compact('year','total_periodos','periodos'));
}
public function registrar_periodo_year_titulacion(Request $request){
    $year= $request->input("year");
    $mes= $request->input("mes");
    $fecha_actual =  date("Y-m-d H:i:s");

    DB:: table('enc_periodo_titulacion')->insert([
        'year' => $year,
        'mes' => $mes,
        'fecha_registro' => $fecha_actual
    ]);
    return back();

}



    public function enviar_enc_carreras_ti($mes,$year){
      //  dd($mes);
        if ($mes == 1) {
           $encuestas_enviadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 0 AND mes = '.$mes.' AND year = '.$year.' ');

            $encuestas_autorizadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 1 AND mes = '.$mes.' AND year = '.$year.'');

            $encuestas_rechazadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 3 AND mes = '.$mes.' AND year = '.$year.'');





        }
        else{
            $encuestas_enviadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 0 AND mes = '.$mes.' AND year = '.$year.' ');

            $encuestas_autorizadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 1 AND mes = '.$mes.' AND year = '.$year.'');

            $encuestas_rechazadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 3 AND mes = '.$mes.' AND year = '.$year.'');

        }

        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera != 9 and id_carrera != 11 and id_carrera != 15');
        return view('encuestas_satisfacion_cliente.titulacion.carreras',compact('carreras',
            'year','mes','encuestas_enviadas','encuestas_autorizadas','encuestas_rechazadas'));
    }
    public function termino_encuesta_titulacion($id_periodo_titulacion){

        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_titulacion` WHERE `id_periodo_titulacion` = '.$id_periodo_titulacion.' ');

        return view('encuestas_satisfacion_cliente.titulacion.partials_terminar_periodo', compact('periodo'));

    }

    public function guardar_termino_encuesta_titulacion(Request $request){
        $id_periodo_titulacion= $request->input("id_periodo_titulacion");

        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_titulacion` WHERE `id_periodo_titulacion` = '.$id_periodo_titulacion.' ');
        $fecha_actual =  date("Y-m-d H:i:s");

        $encuestas_enviadas=DB::select('SELECT *FROM enc_titulacion 
           WHERE id_estado = 0 AND mes = '.$periodo->mes.' AND year = '.$periodo->year.' ');

        foreach($encuestas_enviadas as $encuesta){
            DB:: table('enc_titulacion')
                ->where('id_titulacion',$encuesta->id_titulacion)
                ->update([
                    'id_estado'=>3
                ]);
        }

        DB:: table('enc_periodo_titulacion')
            ->where('id_periodo_titulacion',$id_periodo_titulacion)
            ->update([
                'fecha_liberacion'=>$fecha_actual,
                'id_estado'=>1
            ]);
        return back();

    }
    public function enc_contestadas_carreras_ti($mes,$year){
        if ($mes == 1) {
            $encuestas_enviadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 0 AND mes = '.$mes.' AND year = '.$year.' ');

            $encuestas_autorizadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 1 AND mes = '.$mes.' AND year = '.$year.'');

            $encuestas_rechazadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 3 AND mes = '.$mes.' AND year = '.$year.'');

        }
        else{
            $encuestas_enviadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 0 AND mes = '.$mes.' AND year = '.$year.' ');

            $encuestas_autorizadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 1 AND mes = '.$mes.' AND year = '.$year.'');

            $encuestas_rechazadas=DB::selectOne('SELECT count(id_titulacion)contar FROM enc_titulacion 
           WHERE id_estado = 3 AND mes = '.$mes.' AND year = '.$year.'');

        }


        $carreras=DB::select('SELECT * FROM gnral_carreras WHERE id_carrera != 9 and id_carrera != 11 and id_carrera != 15');

        return view('encuestas_satisfacion_cliente.titulacion.carreras_autorizadas',compact('carreras',
            'year','mes','encuestas_enviadas','encuestas_autorizadas','encuestas_rechazadas'));
    }
    public function enc_est_ti_carrera_termino($id_carrera,$mes,$year){
        if ($mes == 1){
           $alumnos= DB::select('SELECT  gnral_alumnos.cuenta, gnral_alumnos.nombre,
           gnral_alumnos.apaterno,gnral_alumnos.amaterno,enc_titulacion.* from gnral_alumnos,enc_titulacion 
           where gnral_alumnos.id_alumno = enc_titulacion.id_alumno and enc_titulacion.id_carrera = '.$id_carrera.' 
             and enc_titulacion.mes = '.$mes.' and enc_titulacion.year = '.$year.' and enc_titulacion.id_estado = 1');
        }
        else{
            $alumnos= DB::select('SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre,
           gnral_alumnos.apaterno,gnral_alumnos.amaterno,enc_titulacion.* from gnral_alumnos,enc_titulacion 
           where gnral_alumnos.id_alumno = enc_titulacion.id_alumno and enc_titulacion.id_carrera = '.$id_carrera.' 
             and enc_titulacion.mes = '.$mes.' and enc_titulacion.year = '.$year.' and enc_titulacion.id_estado = 1');

        }
         //dd($alumnos);

        $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` ='.$id_carrera.'');
//dd($mes);
        return view('encuestas_satisfacion_cliente.titulacion.carrera_alumno_termino',compact('alumnos','carrera','year','mes'));

    }
    public function enc_est_ti_alumno_termino($id_titulacion){

        $registro=DB::selectOne('SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno,
        gnral_alumnos.amaterno,enc_titulacion.* from gnral_alumnos,enc_titulacion where gnral_alumnos.id_alumno = enc_titulacion.id_alumno
        and enc_titulacion.id_titulacion ='.$id_titulacion.' ');
      //  dd($registro);

        return view('encuestas_satisfacion_cliente.titulacion.encuesta_contestada',compact('registro'));


    }

    public function encuesta_estudiante_titulacion_carrera($id_carrera,$year,$mes)
    {
        /*
        if ($mes == 1){
            $ene = '01-01-' . $year;
            $jul = '31-06-' . $year;
        $alumnos = DB::select("SELECT ti_reg_datos_alum.no_cuenta, ti_reg_datos_alum.nombre_al, ti_reg_datos_alum.apaterno, 
       ti_reg_datos_alum.amaterno, ti_reg_datos_alum.id_alumno, ti_fecha_jurado_alumn.fecha_titulacion from ti_reg_datos_alum, ti_datos_alumno_reg_dep, ti_fecha_jurado_alumn
       WHERE ti_reg_datos_alum.id_alumno = ti_datos_alumno_reg_dep.id_alumno and ti_datos_alumno_reg_dep.id_liberado_titulado=1
       and ti_reg_datos_alum.id_carrera = $id_carrera and ti_fecha_jurado_alumn.id_alumno = ti_reg_datos_alum.id_alumno 
       and STR_TO_DATE(ti_fecha_jurado_alumn.fecha_titulacion, '%d-%m-%Y') >= STR_TO_DATE('$ene', '%d-%m-%Y')   
      and STR_TO_DATE(ti_fecha_jurado_alumn.fecha_titulacion, '%d-%m-%Y') <= STR_TO_DATE('$jul', '%d-%m-%Y')  
       ORDER BY STR_TO_DATE(ti_fecha_jurado_alumn.fecha_titulacion,'%d-%m-%Y') ASC");


        $registro_titulacion = array();
        foreach ($alumnos as $alumno) {
            $dat['no_cuenta'] = $alumno->no_cuenta;
            $dat['nombre'] = $alumno->nombre_al . " " . $alumno->apaterno . " " . $alumno->amaterno;
            $dat['id_alumno'] = $alumno->id_alumno;

            $estado_reg_enc = DB::selectOne('SELECT count(id_titulacion)contar from enc_titulacion
             where id_alumno = ' . $alumno->id_alumno . ' ');
            if ($estado_reg_enc->contar == 0) {
                $dat['estado_encuesta'] = 0; // no se le a enviado la encuesta
            } else {
                $reg_enc = DB::selectOne('SELECT *from enc_titulacion where id_alumno = ' . $alumno->id_alumno . '');
                if ($reg_enc->id_estado == 0) {
                    $dat['estado_encuesta'] = 1; // envio de encuesta
                } else if ($reg_enc->id_estado == 1) {
                    $dat['estado_encuesta'] = 2; // encuesta contestada
                } else {
                    $dat['estado_encuesta'] = 3; //encuesta no contestada
                }

            }
            array_push($registro_titulacion, $dat);
        }
    }
        else{
            $agos = '01-07-' . $year;
            $sep = '31-12-' . $year;
            $alumnos = DB::select("SELECT ti_reg_datos_alum.no_cuenta, ti_reg_datos_alum.nombre_al, ti_reg_datos_alum.apaterno, 
       ti_reg_datos_alum.amaterno, ti_reg_datos_alum.id_alumno, ti_fecha_jurado_alumn.fecha_titulacion from ti_reg_datos_alum, ti_datos_alumno_reg_dep, ti_fecha_jurado_alumn
       WHERE ti_reg_datos_alum.id_alumno = ti_datos_alumno_reg_dep.id_alumno and ti_datos_alumno_reg_dep.id_liberado_titulado=1
       and ti_reg_datos_alum.id_carrera = $id_carrera and ti_fecha_jurado_alumn.id_alumno = ti_reg_datos_alum.id_alumno 
       and STR_TO_DATE(ti_fecha_jurado_alumn.fecha_titulacion, '%d-%m-%Y') >= STR_TO_DATE('$agos', '%d-%m-%Y')   
      and STR_TO_DATE(ti_fecha_jurado_alumn.fecha_titulacion, '%d-%m-%Y') <= STR_TO_DATE('$sep', '%d-%m-%Y')  
       ORDER BY STR_TO_DATE(ti_fecha_jurado_alumn.fecha_titulacion,'%d-%m-%Y') ASC;");


            $registro_titulacion = array();
            foreach ($alumnos as $alumno) {
                $dat['no_cuenta'] = $alumno->no_cuenta;
                $dat['nombre'] = $alumno->nombre_al . " " . $alumno->apaterno . " " . $alumno->amaterno;
                $dat['id_alumno'] = $alumno->id_alumno;

                $estado_reg_enc = DB::selectOne('SELECT count(id_titulacion)contar from enc_titulacion
             where id_alumno = ' . $alumno->id_alumno . ' ');
                if ($estado_reg_enc->contar == 0) {
                    $dat['estado_encuesta'] = 0; // no se le a enviado la encuesta
                } else {
                    $reg_enc = DB::selectOne('SELECT *from enc_titulacion where id_alumno = ' . $alumno->id_alumno . '');
                    if ($reg_enc->id_estado == 0) {
                        $dat['estado_encuesta'] = 1; // envio de encuesta
                    } else if ($reg_enc->id_estado == 1) {
                        $dat['estado_encuesta'] = 2; // encuesta contestada
                    } else {
                        $dat['estado_encuesta'] = 3; //encuesta no contestada
                    }

                }
                array_push($registro_titulacion, $dat);
            }

        }
        */
       // dd($registro_titulacion);
        $encuestas=DB::select('SELECT ti_reg_datos_alum.no_cuenta, ti_reg_datos_alum.nombre_al, ti_reg_datos_alum.apaterno, 
       ti_reg_datos_alum.amaterno,enc_titulacion.* from ti_reg_datos_alum, enc_titulacion where
       ti_reg_datos_alum.id_alumno = enc_titulacion.id_alumno and  
      ti_reg_datos_alum.id_carrera = '.$id_carrera.' and enc_titulacion.mes = '.$mes.' and year = '.$year.'');
       // dd($encuestas);

        $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` ='.$id_carrera.'');

        return view('encuestas_satisfacion_cliente.titulacion.carrera_alumno',compact('encuestas','carrera','year','mes'));

    }
    public function enviar_encuesta_titulacion($id_alumno){
      $alumno = DB::selectOne('SELECT ti_reg_datos_alum.no_cuenta, ti_reg_datos_alum.nombre_al, ti_reg_datos_alum.apaterno, 
       ti_reg_datos_alum.amaterno, ti_reg_datos_alum.id_alumno from ti_reg_datos_alum, ti_datos_alumno_reg_dep, ti_fecha_jurado_alumn
      WHERE ti_reg_datos_alum.id_alumno = ti_datos_alumno_reg_dep.id_alumno and ti_datos_alumno_reg_dep.id_alumno = ti_fecha_jurado_alumn.id_alumno
        and ti_reg_datos_alum.id_alumno ='.$id_alumno.'');

      return view('encuestas_satisfacion_cliente.titulacion.dato_alumno',compact('alumno'));

    }
    public function envio_encuesta_estudiante_titulacion(Request $request){
      //  dd($request);
        $mes= $request->input("mes");
        $year= $request->input("year");
        $id_alumno= $request->input("id_alumno");
        $alumno = DB::selectOne('SELECT * FROM `gnral_alumnos` WHERE `id_alumno` = '.$id_alumno.'');

        $hoy = date("Y-m-d H:i:s");

        DB:: table('enc_titulacion')->insert([
            'id_alumno' => $id_alumno,
            'id_carrera' => $alumno->id_carrera,
            'year' => $year,
            'mes' => $mes,
            'id_tipo_encuesta' =>3,
            'fecha_registro' =>$hoy
        ]);
        return back();

    }
    public function contestar_encuesta_alumno(){
        $id_usuario = Session::get('usuario_alumno');
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_usuario ='.$id_usuario.'');
        $id_alumno=$alumno->id_alumno;
       // $encuesta=DB::selectOne('SELECT * FROM `enc_titulacion` WHERE `id_alumno` ='.$id_alumno.'');



        return view('encuestas_satisfacion_cliente.titulacion.encuesta_alumno_ti',compact('id_alumno'));
    }
    public function guardar_encuesta_titulacion(Request $request, $id_alumno){
        $alumno = DB::selectOne('SELECT  *from gnral_alumnos where id_alumno ='.$id_alumno.'');
        $id_alumno=$alumno->id_alumno;
        $id_carrera=$alumno->id_carrera;

        $datos_jurado= DB::selectOne('SELECT * FROM `ti_fecha_jurado_alumn` WHERE `id_alumno` ='.$id_alumno.'');
        $mes  =substr($datos_jurado->fecha_titulacion, 3,2);
        $year  =substr($datos_jurado->fecha_titulacion, 6,4);

        if($mes <= 6)
        {
            $mes=1;

        }else{
            $mes=2;
        }


      //  $periodo=Session::get('periodo_actual');

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
        $pregunta11 = $request->input("pregunta11");
        $pregunta12 = $request->input("pregunta12");
        $pregunta13 = $request->input("pregunta13");
        $pregunta14 = $request->input("pregunta14");
        $pregunta15 = $request->input("pregunta15");

        $comentario = $request->input("comentario");
       // dd($comentario);

        $fecha_actual =  date("Y-m-d H:i:s");
        $fecha =  date("Y-m-d");



        DB:: table('enc_titulacion')
            ->insert([
                'id_alumno' => $id_alumno,
                'id_carrera'=>$id_carrera,
                'id_tipo_encuesta'=>3,
                'fecha_encuesta'=>$fecha_actual,
                'resp_preg4'=>$pregunta1,
                'resp_preg5'=>$pregunta2,
                'resp_preg6'=>$pregunta3,
                'resp_preg7'=>$pregunta4,
                'resp_preg8'=>$pregunta5,
                'resp_preg9'=>$pregunta6,
                'resp_preg10'=>$pregunta7,
                'resp_preg11'=>$pregunta8,
                'resp_preg12'=>$pregunta9,
                'resp_preg13'=>$pregunta10,
                'resp_preg14'=>$pregunta11,
                'resp_preg15'=>$pregunta12,
                'resp_preg16'=>$pregunta13,
                'resp_preg17'=>$pregunta14,
                'resp_preg18'=>$pregunta15,
                'comentario_adicional'=>$comentario,
                'id_estado'=>1,
                'year' => $year,
                'mes' => $mes,
                'fecha_registro' => $fecha_actual
            ]);
        return redirect('/titulacion/registro_jurado');

    }
    public function encuesta_incripcion_periodo(){
        $periodo=Session::get('periodo_actual');
        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');
      //  dd($periodo);

        $estado_periodo= DB::selectOne('select count(id_periodo_periodo) contar from enc_periodo_terminado where id_periodo ='.$periodo.' ');
        $encuestas_enviadas=DB::selectOne('SELECT count(id_alumno) contar from enc_incripcion where id_periodo= '.$periodo.' and id_estado = 1');
        $encuesta_no_enviadas=DB::selectOne('SELECT count(id_alumno) contar from enc_incripcion where id_periodo= '.$periodo.' and id_estado =0');
        $encuestas_rechazadas=DB::selectOne('SELECT count(id_alumno) contar from enc_incripcion where id_periodo= '.$periodo.' and id_estado =3');
        // dd($estado_periodo);
        if($estado_periodo->contar == 0){
          $estado_periodo_periodo=0;

        }else{
            $estado_periodo_periodo=1;
        }
        return view('encuestas_satisfacion_cliente.inscripcion.periodo_encuestas',compact('periodo_nom','estado_periodo_periodo','encuestas_enviadas','encuesta_no_enviadas','encuestas_rechazadas'));

    }
    public function envio_periodo_terminado(Request $request){

        $periodo=Session::get('periodo_actual');
        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_periodo_terminado')->insert([
            'id_periodo' => $periodo,
            'fecha_registro' => $fecha_actual,
            'id_estado' => 1,
        ]);

        DB:: table('enc_incripcion')
            ->where('id_estado',0)
            ->update([
                'fecha_encuesta'=>$fecha_actual,
                'id_estado'=>3
            ]);
        return back();

    }
    public function ver_resultados_enc_incripcion(){
        $periodo=Session::get('periodo_actual');

        $encuestas_enviadas=DB::select('SELECT *from enc_incripcion where id_periodo= '.$periodo.' and id_estado = 1');

        $excelente1=0;
        $buena1=0;
        $regular1=0;
        $mala1=0;

        $excelente2=0;
        $buena2=0;
        $regular2=0;
        $mala2=0;

        $excelente3=0;
        $buena3=0;
        $regular3=0;
        $mala3=0;

        $excelente4=0;
        $buena4=0;
        $regular4=0;
        $mala4=0;

        $excelente5=0;
        $buena5=0;
        $regular5=0;
        $mala5=0;

        $excelente6=0;
        $buena6=0;
        $regular6=0;
        $mala6=0;

        $excelente7=0;
        $buena7=0;
        $regular7=0;
        $mala7=0;

        $excelente8=0;
        $buena8=0;
        $regular8=0;
        $mala8=0;

        $excelente9=0;
        $buena9=0;
        $regular9=0;
        $mala9=0;
/*
        $excelente10=0;
        $buena10=0;
        $regular10=0;
        $mala10=0;
*/
        $excelente11=0;
        $buena11=0;
        $regular11=0;
        $mala11=0;


        foreach ($encuestas_enviadas as $encuesta){

            if($encuesta->cal_preg_1 == 4){
                $excelente1++;
            }elseif($encuesta->cal_preg_1 == 3){
                $buena1++;
            }elseif($encuesta->cal_preg_1 == 2){
                $regular1++;
            }
            elseif($encuesta->cal_preg_1 == 1){
                $mala1++;
            }

            if($encuesta->cal_preg_2 == 4){
                $excelente2++;
            }elseif($encuesta->cal_preg_2 == 3){
                $buena2++;
            }elseif($encuesta->cal_preg_2 == 2){
                $regular2++;
            }
            elseif($encuesta->cal_preg_2 == 1){
                $mala2++;
            }

            if($encuesta->cal_preg_3 == 4){
                $excelente3++;
            }elseif($encuesta->cal_preg_3 == 3){
                $buena3++;
            }elseif($encuesta->cal_preg_3 == 2){
                $regular3++;
            }
            elseif($encuesta->cal_preg_3 == 1){
                $mala3++;
            }

            if($encuesta->cal_preg_4 == 4){
                $excelente4++;
            }elseif($encuesta->cal_preg_4 == 3){
                $buena4++;
            }elseif($encuesta->cal_preg_4 == 2){
                $regular4++;
            }
            elseif($encuesta->cal_preg_4 == 1){
                $mala4++;
            }

            if($encuesta->cal_preg_5 == 4){
                $excelente5++;
            }elseif($encuesta->cal_preg_5 == 3){
                $buena5++;
            }elseif($encuesta->cal_preg_5 == 2){
                $regular5++;
            }
            elseif($encuesta->cal_preg_5 == 1){
                $mala5++;
            }

            if($encuesta->cal_preg_6 == 4){
                $excelente6++;
            }elseif($encuesta->cal_preg_6 == 3){
                $buena6++;
            }elseif($encuesta->cal_preg_6 == 2){
                $regular6++;
            }
            elseif($encuesta->cal_preg_6 == 1){
                $mala6++;
            }

            if($encuesta->cal_preg_7 == 4){
                $excelente7++;
            }elseif($encuesta->cal_preg_7 == 3){
                $buena7++;
            }elseif($encuesta->cal_preg_7 == 2){
                $regular7++;
            }
            elseif($encuesta->cal_preg_7 == 1){
                $mala7++;
            }

            if($encuesta->cal_preg_8 == 4){
                $excelente8++;
            }elseif($encuesta->cal_preg_8 == 3){
                $buena8++;
            }elseif($encuesta->cal_preg_8 == 2){
                $regular8++;
            }
            elseif($encuesta->cal_preg_8 == 1){
                $mala8++;
            }

            if($encuesta->cal_preg_9 == 4){
                $excelente9++;
            }elseif($encuesta->cal_preg_9 == 3){
                $buena9++;
            }elseif($encuesta->cal_preg_9 == 2){
                $regular9++;
            }
            elseif($encuesta->cal_preg_9 == 1){
                $mala9++;
            }
/*
            if($encuesta->cal_preg_10 == 4){
                $excelente10++;
            }elseif($encuesta->cal_preg_10 == 3){
                $buena10++;
            }elseif($encuesta->cal_preg_10 == 2){
                $regular10++;
            }
            elseif($encuesta->cal_preg_10 == 1){
                $mala10++;
            }
*/
            if($encuesta->cal_preg_11 == 4){
                $excelente11++;
            }elseif($encuesta->cal_preg_11 == 3){
                $buena11++;
            }elseif($encuesta->cal_preg_11 == 2){
                $regular11++;
            }
            elseif($encuesta->cal_preg_11 == 1){
                $mala11++;
            }
        }
        $total_enc_preg1=$excelente1+$buena1+$regular1+$mala1;
        $total_enc_preg2=$excelente2+$buena2+$regular2+$mala2;
        $total_enc_preg3=$excelente3+$buena3+$regular3+$mala3;
        $total_enc_preg4=$excelente4+$buena4+$regular4+$mala4;
        $total_enc_preg5=$excelente5+$buena5+$regular5+$mala5;
        $total_enc_preg6=$excelente6+$buena6+$regular6+$mala6;
        $total_enc_preg7=$excelente7+$buena7+$regular7+$mala7;
        $total_enc_preg8=$excelente8+$buena8+$regular8+$mala8;
        $total_enc_preg9=$excelente9+$buena9+$regular9+$mala9;
        $total_enc_preg11=$excelente11+$buena11+$regular11+$mala11;

        $total_excelente=$excelente1+$excelente2+$excelente3+$excelente4+$excelente5+$excelente6+$excelente7+$excelente8+$excelente9+$excelente11;
        $total_buena=$buena1+$buena2+$buena3+$buena4+$buena5+$buena6+$buena7+$buena8+$buena9+$buena11;
        $total_regular=$regular1+$regular2+$regular3+$regular4+$regular5+$regular6+$regular7+$regular8+$regular9+$regular11;
        $total_mala=$mala1+$mala2+$mala3+$mala4+$mala5+$mala6+$mala7+$mala8+$mala9+$mala11;

        $total_total=$total_excelente+$total_buena+$total_regular+$total_mala;

        $periodo=Session::get('periodo_actual');
        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');

        return view('encuestas_satisfacion_cliente.inscripcion.graficas_inscripcion',compact('periodo_nom',
            'excelente1','buena1','regular1','mala1',
                     'excelente2','buena2','regular2','mala2',
                     'excelente3','buena3','regular3','mala3',
                     'excelente4','buena4','regular4','mala4',
                     'excelente5','buena5','regular5','mala5',
                     'excelente6','buena6','regular6','mala6',
                     'excelente7','buena7','regular7','mala7',
                     'excelente8','buena8','regular8','mala8',
                     'excelente9','buena9','regular9','mala9',
                     'excelente11','buena11','regular11','mala11',
                     'total_enc_preg1','total_enc_preg2','total_enc_preg3',
                     'total_enc_preg4','total_enc_preg5','total_enc_preg6',
                     'total_enc_preg7','total_enc_preg8','total_enc_preg9',
                      'total_enc_preg11','total_excelente','total_buena',
                      'total_regular','total_mala','total_total'
        ));
    }
    public  function encuesta_reincripcion_periodo(){
        $periodo=Session::get('periodo_actual');
        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');
        //  dd($periodo);

        $estado_periodo= DB::selectOne('select count(id_periodo_reins) contar from enc_periodo_terminado_reins where id_periodo ='.$periodo.' ');
        $encuestas_enviadas=DB::selectOne('SELECT count(id_alumno) contar from enc_reinscripcion where id_periodo= '.$periodo.' and id_estado = 1');
        $encuesta_no_enviadas=DB::selectOne('SELECT count(id_alumno) contar from enc_reinscripcion where id_periodo= '.$periodo.' and id_estado =0');
        $encuestas_rechazadas=DB::selectOne('SELECT count(id_alumno) contar from enc_reinscripcion where id_periodo= '.$periodo.' and id_estado =3');
        // dd($estado_periodo);
        if($estado_periodo->contar == 0){
            $estado_periodo_periodo=0;

        }else{
            $estado_periodo_periodo=1;
        }
        return view('encuestas_satisfacion_cliente.reinscripcion.periodo_encuestas',compact('periodo_nom','estado_periodo_periodo','encuestas_enviadas','encuesta_no_enviadas','encuestas_rechazadas'));

    }
    public function envio_periodo_ter_reins(Request $request){
    //    dd("hola");
        $periodo=Session::get('periodo_actual');
        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_periodo_terminado_reins')->insert([
            'id_periodo' => $periodo,
            'fecha_registro' => $fecha_actual,
            'id_estado' => 1,
        ]);

        DB:: table('enc_reinscripcion')
            ->where('id_estado',0)
            ->update([
                'fecha_encuesta'=>$fecha_actual,
                'id_estado'=>3
            ]);
        return back();
    }
    public function ver_resultados_enc_reincripcion(){
        $periodo=Session::get('periodo_actual');

        $encuestas_enviadas=DB::select('SELECT *from enc_reinscripcion where id_periodo= '.$periodo.' and id_estado = 1');

        $excelente1=0;
        $buena1=0;
        $regular1=0;
        $mala1=0;

        $excelente2=0;
        $buena2=0;
        $regular2=0;
        $mala2=0;

        $excelente3=0;
        $buena3=0;
        $regular3=0;
        $mala3=0;

        $excelente4=0;
        $buena4=0;
        $regular4=0;
        $mala4=0;

        $excelente5=0;
        $buena5=0;
        $regular5=0;
        $mala5=0;

        $excelente6=0;
        $buena6=0;
        $regular6=0;
        $mala6=0;

        $excelente7=0;
        $buena7=0;
        $regular7=0;
        $mala7=0;

        $excelente8=0;
        $buena8=0;
        $regular8=0;
        $mala8=0;

        $excelente9=0;
        $buena9=0;
        $regular9=0;
        $mala9=0;
        /*
                $excelente10=0;
                $buena10=0;
                $regular10=0;
                $mala10=0;
        */
        $excelente11=0;
        $buena11=0;
        $regular11=0;
        $mala11=0;


        foreach ($encuestas_enviadas as $encuesta){

            if($encuesta->cal_preg_1 == 4){
                $excelente1++;
            }elseif($encuesta->cal_preg_1 == 3){
                $buena1++;
            }elseif($encuesta->cal_preg_1 == 2){
                $regular1++;
            }
            elseif($encuesta->cal_preg_1 == 1){
                $mala1++;
            }

            if($encuesta->cal_preg_2 == 4){
                $excelente2++;
            }elseif($encuesta->cal_preg_2 == 3){
                $buena2++;
            }elseif($encuesta->cal_preg_2 == 2){
                $regular2++;
            }
            elseif($encuesta->cal_preg_2 == 1){
                $mala2++;
            }

            if($encuesta->cal_preg_3 == 4){
                $excelente3++;
            }elseif($encuesta->cal_preg_3 == 3){
                $buena3++;
            }elseif($encuesta->cal_preg_3 == 2){
                $regular3++;
            }
            elseif($encuesta->cal_preg_3 == 1){
                $mala3++;
            }

            if($encuesta->cal_preg_4 == 4){
                $excelente4++;
            }elseif($encuesta->cal_preg_4 == 3){
                $buena4++;
            }elseif($encuesta->cal_preg_4 == 2){
                $regular4++;
            }
            elseif($encuesta->cal_preg_4 == 1){
                $mala4++;
            }

            if($encuesta->cal_preg_5 == 4){
                $excelente5++;
            }elseif($encuesta->cal_preg_5 == 3){
                $buena5++;
            }elseif($encuesta->cal_preg_5 == 2){
                $regular5++;
            }
            elseif($encuesta->cal_preg_5 == 1){
                $mala5++;
            }

            if($encuesta->cal_preg_6 == 4){
                $excelente6++;
            }elseif($encuesta->cal_preg_6 == 3){
                $buena6++;
            }elseif($encuesta->cal_preg_6 == 2){
                $regular6++;
            }
            elseif($encuesta->cal_preg_6 == 1){
                $mala6++;
            }

            if($encuesta->cal_preg_7 == 4){
                $excelente7++;
            }elseif($encuesta->cal_preg_7 == 3){
                $buena7++;
            }elseif($encuesta->cal_preg_7 == 2){
                $regular7++;
            }
            elseif($encuesta->cal_preg_7 == 1){
                $mala7++;
            }

            if($encuesta->cal_preg_8 == 4){
                $excelente8++;
            }elseif($encuesta->cal_preg_8 == 3){
                $buena8++;
            }elseif($encuesta->cal_preg_8 == 2){
                $regular8++;
            }
            elseif($encuesta->cal_preg_8 == 1){
                $mala8++;
            }

            if($encuesta->cal_preg_9 == 4){
                $excelente9++;
            }elseif($encuesta->cal_preg_9 == 3){
                $buena9++;
            }elseif($encuesta->cal_preg_9 == 2){
                $regular9++;
            }
            elseif($encuesta->cal_preg_9 == 1){
                $mala9++;
            }
            /*
                        if($encuesta->cal_preg_10 == 4){
                            $excelente10++;
                        }elseif($encuesta->cal_preg_10 == 3){
                            $buena10++;
                        }elseif($encuesta->cal_preg_10 == 2){
                            $regular10++;
                        }
                        elseif($encuesta->cal_preg_10 == 1){
                            $mala10++;
                        }
            */
            if($encuesta->cal_preg_11 == 4){
                $excelente11++;
            }elseif($encuesta->cal_preg_11 == 3){
                $buena11++;
            }elseif($encuesta->cal_preg_11 == 2){
                $regular11++;
            }
            elseif($encuesta->cal_preg_11 == 1){
                $mala11++;
            }
        }
        $total_enc_preg1=$excelente1+$buena1+$regular1+$mala1;
        $total_enc_preg2=$excelente2+$buena2+$regular2+$mala2;
        $total_enc_preg3=$excelente3+$buena3+$regular3+$mala3;
        $total_enc_preg4=$excelente4+$buena4+$regular4+$mala4;
        $total_enc_preg5=$excelente5+$buena5+$regular5+$mala5;
        $total_enc_preg6=$excelente6+$buena6+$regular6+$mala6;
        $total_enc_preg7=$excelente7+$buena7+$regular7+$mala7;
        $total_enc_preg8=$excelente8+$buena8+$regular8+$mala8;
        $total_enc_preg9=$excelente9+$buena9+$regular9+$mala9;
        $total_enc_preg11=$excelente11+$buena11+$regular11+$mala11;

        $total_excelente=$excelente1+$excelente2+$excelente3+$excelente4+$excelente5+$excelente6+$excelente7+$excelente8+$excelente9+$excelente11;
        $total_buena=$buena1+$buena2+$buena3+$buena4+$buena5+$buena6+$buena7+$buena8+$buena9+$buena11;
        $total_regular=$regular1+$regular2+$regular3+$regular4+$regular5+$regular6+$regular7+$regular8+$regular9+$regular11;
        $total_mala=$mala1+$mala2+$mala3+$mala4+$mala5+$mala6+$mala7+$mala8+$mala9+$mala11;

        $total_total=$total_excelente+$total_buena+$total_regular+$total_mala;
        $periodo=Session::get('periodo_actual');
        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');
        return view('encuestas_satisfacion_cliente.reinscripcion.graficas_reinscripcion',compact('periodo_nom',
            'excelente1','buena1','regular1','mala1',
            'excelente2','buena2','regular2','mala2',
            'excelente3','buena3','regular3','mala3',
            'excelente4','buena4','regular4','mala4',
            'excelente5','buena5','regular5','mala5',
            'excelente6','buena6','regular6','mala6',
            'excelente7','buena7','regular7','mala7',
            'excelente8','buena8','regular8','mala8',
            'excelente9','buena9','regular9','mala9',
            'excelente11','buena11','regular11','mala11',
            'total_enc_preg1','total_enc_preg2','total_enc_preg3',
            'total_enc_preg4','total_enc_preg5','total_enc_preg6',
            'total_enc_preg7','total_enc_preg8','total_enc_preg9',
            'total_enc_preg11','total_excelente','total_buena',
            'total_regular','total_mala','total_total'
        ));
    }
public function carrera_enc_incripcion(){
    $carreras=DB::table('gnral_carreras')
        ->where('gnral_carreras.id_carrera','!=',9)
        ->where('gnral_carreras.id_carrera','!=',11)
        ->where('gnral_carreras.id_carrera','!=',15)
        ->select('gnral_carreras.*')
        ->get();
    $periodo=Session::get('periodo_actual');
    $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');

         return view('encuestas_satisfacion_cliente.inscripcion.carerras_inscripcion',compact('carreras','periodo_nom'));

}
    public function alumnos_enc_incripcion($id_carerra){

        $periodo=Session::get('periodo_actual');

     $estudiantes=DB::select('select enc_incripcion.*, gnral_alumnos.cuenta, gnral_alumnos.nombre,
    gnral_alumnos.apaterno, gnral_alumnos.amaterno FROM enc_incripcion, gnral_alumnos where 
    enc_incripcion.id_alumno = gnral_alumnos.id_alumno and enc_incripcion.id_periodo ='.$periodo.'  and enc_incripcion.id_estado = 1 and 
    gnral_alumnos.id_carrera='.$id_carerra.'');

     $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = '.$id_carerra.'');

        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');
        return view('encuestas_satisfacion_cliente.inscripcion.encuestas_carrera',compact('estudiantes','carrera','periodo_nom'));
    }
    public function enc_est_inscripcion($id_incripcion){

        $estudiante=DB::selectOne('select enc_incripcion.*, gnral_alumnos.cuenta, gnral_alumnos.nombre,
    gnral_alumnos.apaterno, gnral_alumnos.amaterno FROM enc_incripcion, gnral_alumnos where 
    enc_incripcion.id_alumno = gnral_alumnos.id_alumno and  enc_incripcion.id_incripcion = '.$id_incripcion.'');

        return view('encuestas_satisfacion_cliente.inscripcion.encuesta_contestada',compact('estudiante'));

    }
    public function ver_resultados_enc_ti($mes, $year){

       $encuestas=DB::select('SELECT * FROM `enc_titulacion` WHERE `id_estado` = 1 AND `mes` = '.$mes.' AND `year` ='.$year.' ');
//dd($encuestas);
       $preg4=0;
       $preg5=0;
       $preg6=0;
       $preg7=0;
       $preg8=0;
       $preg9=0;
       $preg10=0;
       $preg11=0;
       $preg12=0;
       $preg1212=0;
       $preg13=0;
       $preg14=0;
       $preg15=0;
       $preg16=0;
       $preg17=0;
       $preg18=0;
       $total_serv_rubro=0;
       $total_serv_satisfacion=0;
       $total_inf_rubro=0;
       $total_inf_satisfacion=0;
       $total_tiempo_rubro=0;
       $total_tiempo_satisfacion=0;
       $satisfacion_total=0;


       foreach ($encuestas as $encuesta){
           if($encuesta->resp_preg4 == 1){
               $preg4++;
               $total_inf_rubro++;
               $total_inf_satisfacion++;
           }
           else{
               $total_inf_rubro++;
           }

           if($encuesta->resp_preg5 == 1){
               $preg5++;
               $total_inf_rubro++;
               $total_inf_satisfacion++;
           }
           else{
               $total_inf_rubro++;
           }

           if($encuesta->resp_preg6 == 1){
               $preg6++;
               $total_inf_rubro++;
               $total_inf_satisfacion++;
           } else{
               $total_inf_rubro++;
           }

           if($encuesta->resp_preg7 == 1){
               $preg7++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }

           if($encuesta->resp_preg8 == 1){
               $preg8++;
               $total_inf_rubro++;
               $total_inf_satisfacion++;
           } else{
               $total_inf_rubro++;
           }

           if($encuesta->resp_preg9 == 5 || $encuesta->resp_preg9 == 4){
               $preg9++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }

           if($encuesta->resp_preg10 == 1){
               $preg10++;
               $total_inf_rubro++;
               $total_inf_satisfacion++;
           } else{
               $total_inf_rubro++;
           }
           if($encuesta->resp_preg11 == 1){
               $preg11++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }

           if($encuesta->resp_preg12 == 1 || $encuesta->resp_preg12 == 2 || $encuesta->resp_preg12 == 3){
               $preg12++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else if($encuesta->resp_preg12 == 4 || $encuesta->resp_preg12 == 5){
               $preg1212++;
               $total_serv_rubro++;
           }

           if($encuesta->resp_preg13 == 1){
               $preg13++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }
           if($encuesta->resp_preg14 == 1){
               $preg14++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }
           if($encuesta->resp_preg15 == 1 || $encuesta->resp_preg15 == 2 || $encuesta->resp_preg15 == 3){
               $preg15++;
               $total_tiempo_rubro++;
               $total_tiempo_satisfacion++;
           }else{
               $total_tiempo_rubro++;
           }
           if($encuesta->resp_preg16 == 1){
               $preg16++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }
           if($encuesta->resp_preg17 == 1){
               $preg17++;
               $total_inf_rubro++;
               $total_inf_satisfacion++;
           } else{
               $total_inf_rubro++;
           }
           if($encuesta->resp_preg18 == 1){
               $preg18++;
               $total_serv_rubro++;
               $total_serv_satisfacion++;
           }else{
               $total_serv_rubro++;
           }




       }


        if($total_inf_satisfacion != 0){
            $porcentaje_inf_sat=($total_inf_satisfacion/$total_inf_rubro)*100;
        }else{
            $porcentaje_inf_sat=0;
        }



        if($total_serv_satisfacion != 0){
            $porcentaje_serv_sat=($total_serv_satisfacion/$total_serv_rubro)*100;
        }else{
            $porcentaje_serv_sat=0;
        }



        if($total_tiempo_satisfacion != 0){
            $porcentaje_tiempo_sat=($total_tiempo_satisfacion/$total_tiempo_rubro)*100;
        }else{
            $porcentaje_tiempo_sat=0;
        }
        $satisfacion_total=($porcentaje_inf_sat+$porcentaje_serv_sat+$porcentaje_tiempo_sat)/3;



        return view('encuestas_satisfacion_cliente.titulacion.resultados_graficas',compact(
            'preg4','preg5','preg6','preg7','preg8','preg9','preg10','preg11',
            'preg12','preg13','preg14','preg15','preg16','preg17','preg18',
            'total_inf_satisfacion','total_inf_rubro','porcentaje_inf_sat',
            'total_serv_satisfacion','total_serv_rubro','porcentaje_serv_sat',
            'total_tiempo_satisfacion','total_tiempo_rubro','porcentaje_tiempo_sat',
            'satisfacion_total','year'
        ));

    }
    public function historial_encuesta_estudiante_titulacion(){

        $year_historial=DB::select('SELECT year FROM enc_periodo_titulacion GROUP by year');
        return view('encuestas_satisfacion_cliente.titulacion.menu_historial_encuesta',compact('year_historial'));

    }
    public function menu_historial_titulacion_year($year){
        Session::put('historial_enc_t',1);
        $total_periodos=DB::selectOne('SELECT count(id_periodo_titulacion) contar from enc_periodo_titulacion where year='.$year.'');
        $total_periodos=$total_periodos->contar;

        $periodos= DB::select('SELECT * FROM enc_periodo_titulacion WHERE  year ='.$year.'');

        return view("encuestas_satisfacion_cliente.titulacion.periodos_titulacion",compact('year','total_periodos','periodos'));

    }
    public function carrera_enc_reincripcion(){
        $carreras=DB::table('gnral_carreras')
            ->where('gnral_carreras.id_carrera','!=',9)
            ->where('gnral_carreras.id_carrera','!=',11)
            ->where('gnral_carreras.id_carrera','!=',15)
            ->select('gnral_carreras.*')
            ->get();
        $periodo=Session::get('periodo_actual');
        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');

        return view('encuestas_satisfacion_cliente.reinscripcion.carreras_reinscripcion',compact('carreras','periodo_nom'));

    }
    public function alumnos_enc_reincripcion($id_carrera){
        $periodo=Session::get('periodo_actual');

        $estudiantes=DB::select('select enc_reinscripcion.*, gnral_alumnos.cuenta, gnral_alumnos.nombre,
    gnral_alumnos.apaterno, gnral_alumnos.amaterno FROM enc_reinscripcion, gnral_alumnos where 
    enc_reinscripcion.id_alumno = gnral_alumnos.id_alumno and enc_reinscripcion.id_periodo ='.$periodo.'  and enc_reinscripcion.id_estado = 1 and 
    gnral_alumnos.id_carrera='.$id_carrera.'');

        $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` = '.$id_carrera.'');

        $periodo_nom=DB::selectOne('SELECT * FROM `gnral_periodos` WHERE `id_periodo` = '.$periodo.'');
        return view('encuestas_satisfacion_cliente.reinscripcion.encuestas_carrera',compact('estudiantes','carrera','periodo_nom'));
    }
    public function enc_est_reinscripcion($id_reinscripcion){
        $estudiante=DB::selectOne('select enc_reinscripcion.*, gnral_alumnos.cuenta, gnral_alumnos.nombre,
    gnral_alumnos.apaterno, gnral_alumnos.amaterno FROM enc_reinscripcion, gnral_alumnos where 
    enc_reinscripcion.id_alumno = gnral_alumnos.id_alumno and  enc_reinscripcion.id_reinscripcion = '.$id_reinscripcion.'');

        return view('encuestas_satisfacion_cliente.reinscripcion.encuesta_contestada',compact('estudiante'));

    }
}
