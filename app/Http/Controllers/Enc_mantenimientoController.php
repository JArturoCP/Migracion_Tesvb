<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class Enc_mantenimientoController extends Controller
{
    public function index(){
        Session::put('historial_enc_c',0);
        $year =  date("Y");
        $total_periodos=DB::selectOne('SELECT count(id_periodo_mantenimiento)contar from enc_periodo_mantenimiento where year ='.$year.'');
        $total_periodos=$total_periodos->contar;
        //  dd($total_periodos);

        $periodos= DB::select('SELECT *from enc_periodo_mantenimiento where year='.$year.'');

        return view('encuestas_satisfacion_cliente.computo.periodos_mantenimiento', compact('year','total_periodos','periodos'));
    }
    public function registrar_periodo_mantenimiento_year(Request $request){
        $year= $request->input("year");
        $mes= $request->input("mes");
        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_periodo_mantenimiento')->insert([
            'year' => $year,
            'mes' => $mes,
            'fecha_registro' => $fecha_actual
        ]);
        return back();
    }
    public function ver_encuestas_mant($mes,$year){

        $mantenimientos = DB::select('SELECT gnral_personales.nombre, enc_servicio_mantenimiento.* from gnral_personales, enc_servicio_mantenimiento 
        where gnral_personales.id_personal = enc_servicio_mantenimiento.id_personal and enc_servicio_mantenimiento.year = '.$year.'
        and enc_servicio_mantenimiento.mes = '.$mes.' ORDER BY `enc_servicio_mantenimiento`.`id_servicio_mantenimiento` ASC');


        $personales=DB::select('SELECT * FROM `gnral_personales` ORDER BY `gnral_personales`.`nombre` ASC');

        $estado_periodo=DB::selectOne('SELECT count(id_periodo_mantenimiento) contar 
        from enc_periodo_mantenimiento where year = '.$year.' and mes= '.$mes.' and id_estado = 1');

        return view('encuestas_satisfacion_cliente.computo.personal_tec', compact('year','mes','mantenimientos','personales','estado_periodo'));
    }
    public function eliminar_enc_mantenimiento($id_servicio_mantenimiento){

        $mantenimiento=DB::selectOne('SELECT gnral_personales.nombre, enc_servicio_mantenimiento.* 
        from gnral_personales, enc_servicio_mantenimiento where gnral_personales.id_personal = enc_servicio_mantenimiento.id_personal
        and enc_servicio_mantenimiento.id_servicio_mantenimiento ='.$id_servicio_mantenimiento.' ');

        return view('encuestas_satisfacion_cliente.computo.eliminar_mantenimiento', compact('mantenimiento'));

    }
    public function guardar_eliminacion_enc_mante(Request $request){
        $id_servicio_mantenimiento= $request->input("id_servicio_mantenimiento");

        DB::delete('DELETE FROM enc_servicio_mantenimiento WHERE id_servicio_mantenimiento='.$id_servicio_mantenimiento.' ');

        return back();

    }
    public function datos_terminar_periodo($id_periodo_mantenimiento){
     $periodo=DB::selectOne('SELECT * FROM `enc_periodo_mantenimiento` WHERE `id_periodo_mantenimiento` ='.$id_periodo_mantenimiento.'');

        return view('encuestas_satisfacion_cliente.computo.termino_periodo', compact('periodo'));

    }
    public function guardar_termino_encuesta_mantenimiento(Request $request){
        $id_periodo_mantenimiento= $request->input("id_periodo_mantenimiento");

        $periodo=DB::selectOne('SELECT * FROM `enc_periodo_mantenimiento` WHERE `id_periodo_mantenimiento` = '.$id_periodo_mantenimiento.'');
        //  dd($periodo);
        $fecha_actual =  date("Y-m-d H:i:s");

        DB:: table('enc_servicio_mantenimiento')
            ->where('id_estado', 1)
            ->where('year', $periodo->year)
            ->where('mes', $periodo->mes)
            ->update([
                'id_estado'=>3,
                'fecha_encuesta'=>$fecha_actual,
                //'fecha_registro'=>$fecha,
            ]);

        DB:: table('enc_periodo_mantenimiento')
            ->where('id_periodo_mantenimiento', $id_periodo_mantenimiento)
            ->update([
                'id_estado'=>1,
                'fecha_liberacion'=>$fecha_actual,
                //'fecha_registro'=>$fecha,
            ]);
        return back();

    }
    public function ver_resultado_mantenimiento($mes,$year){

        $encuestas=DB::select('SELECT *from enc_servicio_mantenimiento where year = '.$year.' and mes='.$mes.' and id_estado =2');

        $preg_1_malo=0;
        $preg_1_regular=0;
        $preg_1_bueno=0;
        $preg_1_muy_bueno=0;
        $preg_1_excelente=0;

        $preg_2_malo=0;
        $preg_2_regular=0;
        $preg_2_bueno=0;
        $preg_2_muy_bueno=0;
        $preg_2_excelente=0;

        $preg_3_malo=0;
        $preg_3_regular=0;
        $preg_3_bueno=0;
        $preg_3_muy_bueno=0;
        $preg_3_excelente=0;

        $preg_4_malo=0;
        $preg_4_regular=0;
        $preg_4_bueno=0;
        $preg_4_muy_bueno=0;
        $preg_4_excelente=0;



        $total_malo =0;
        $total_regular =0;
        $total_bueno =0;
        $total_regular =0;
        $total_muy_bueno =0;
        $total_excelente =0;
        $total_encuestas=0;

        foreach($encuestas as $encuesta){
            $total_encuestas++;
            if($encuesta->cal_preg_1 ==1){
                $preg_1_malo++;
            }
            if($encuesta->cal_preg_1 ==2){
                $preg_1_regular++;
            }
            if($encuesta->cal_preg_1 ==3){
                $preg_1_bueno++;
            }
            if($encuesta->cal_preg_1 ==4){
                $preg_1_muy_bueno++;
            }
            if($encuesta->cal_preg_1 ==5){
                $preg_1_excelente++;
            }

            if($encuesta->cal_preg_2 ==1){
                $preg_2_malo++;
            }
            if($encuesta->cal_preg_2 ==2){
                $preg_2_regular++;
            }
            if($encuesta->cal_preg_2 ==3){
                $preg_2_bueno++;
            }
            if($encuesta->cal_preg_2 ==4){
                $preg_2_muy_bueno++;
            }
            if($encuesta->cal_preg_2 ==5){
                $preg_2_excelente++;
            }

            if($encuesta->cal_preg_3 ==1){
                $preg_3_malo++;
            }
            if($encuesta->cal_preg_3 ==2){
                $preg_3_regular++;
            }
            if($encuesta->cal_preg_3 ==3){
                $preg_3_bueno++;
            }
            if($encuesta->cal_preg_3 ==4){
                $preg_3_muy_bueno++;
            }
            if($encuesta->cal_preg_3 ==5){
                $preg_3_excelente++;
            }


            if($encuesta->cal_preg_4 ==1){
                $preg_4_malo++;
            }
            if($encuesta->cal_preg_4 ==2){
                $preg_4_regular++;
            }
            if($encuesta->cal_preg_4 ==3){
                $preg_4_bueno++;
            }
            if($encuesta->cal_preg_4 ==4){
                $preg_4_muy_bueno++;
            }
            if($encuesta->cal_preg_4 ==5){
                $preg_4_excelente++;
            }

        }
        $total_preg_1=( $preg_1_malo *1)+($preg_1_regular*2)+($preg_1_bueno*3)+($preg_1_muy_bueno*4)+($preg_1_excelente*5);
        $total_preg_2=( $preg_2_malo *1)+($preg_2_regular*2)+($preg_2_bueno*3)+($preg_2_muy_bueno*4)+($preg_2_excelente*5);
        $total_preg_3=( $preg_3_malo *1)+($preg_3_regular*2)+($preg_3_bueno*3)+($preg_3_muy_bueno*4)+($preg_3_excelente*5);
        $total_preg_4=( $preg_4_malo *1)+($preg_4_regular*2)+($preg_4_bueno*3)+($preg_4_muy_bueno*4)+($preg_4_excelente*5);

        $total_malo=( $preg_1_malo *1)+( $preg_2_malo *1)+( $preg_3_malo *1)+( $preg_4_malo *1);
        $total_regular=($preg_1_regular*2)+($preg_2_regular*2)+($preg_3_regular*2)+($preg_4_regular*2);
        $total_bueno =($preg_1_bueno*3)+($preg_2_bueno*3)+($preg_3_bueno*3)+($preg_4_bueno*3);
        $total_muy_bueno =($preg_1_muy_bueno*4)+($preg_2_muy_bueno*4)+($preg_3_muy_bueno*4)+($preg_4_muy_bueno*4);
        $total_excelente = ($preg_1_excelente*5)+($preg_2_excelente*5)+($preg_3_excelente*5)+($preg_4_excelente*5);

        $resultado_final=$total_malo+$total_regular+$total_bueno+$total_muy_bueno+$total_excelente;
        //dd($preg_1_excelente);

        return view('encuestas_satisfacion_cliente.computo.resultados_graficas',
            compact('total_encuestas','preg_1_malo','preg_2_malo','preg_3_malo','preg_4_malo'
            ,'preg_1_regular','preg_2_regular','preg_3_regular','preg_4_regular'
            ,'preg_1_bueno','preg_2_bueno','preg_3_bueno','preg_4_bueno'
            ,'preg_1_muy_bueno','preg_2_muy_bueno','preg_3_muy_bueno','preg_4_muy_bueno'
            ,'preg_1_excelente','preg_2_excelente','preg_3_excelente','preg_4_excelente',
            'total_preg_1','total_preg_2','total_preg_3','total_preg_4','total_malo','total_regular','total_bueno','total_muy_bueno','total_excelente',
            'resultado_final','year','mes'));


    }
    public function menu_historial_mantenimiento(){
        Session::put('historial_enc_c',1);
        $year_historial=DB::select('SELECT year from enc_periodo_mantenimiento group by year');


            return view('encuestas_satisfacion_cliente.computo.menu_historial', compact('year_historial'));

    }
    public function menu_historial_mantenimiento_year($year){

        $total_periodos=DB::selectOne('SELECT count(id_periodo_mantenimiento)contar from enc_periodo_mantenimiento where year ='.$year.'');
        $total_periodos=$total_periodos->contar;
        //  dd($total_periodos);

        $periodos= DB::select('SELECT *from enc_periodo_mantenimiento where year='.$year.'');

        return view('encuestas_satisfacion_cliente.computo.periodos_mantenimiento', compact('year','total_periodos','periodos'));

    }
    public function ver_enc_mantenimiento($id_servicio_mantenimieento){
        $mantenimiento=DB::selectOne('SELECT gnral_personales.nombre, enc_servicio_mantenimiento.* 
        from gnral_personales, enc_servicio_mantenimiento where gnral_personales.id_personal = enc_servicio_mantenimiento.id_personal
        and enc_servicio_mantenimiento.id_servicio_mantenimiento ='.$id_servicio_mantenimieento.' ');
      //  dd($mantenimiento);

 return view('encuestas_satisfacion_cliente.computo.modal_ver_encuesta', compact('mantenimiento'));

    }



}
