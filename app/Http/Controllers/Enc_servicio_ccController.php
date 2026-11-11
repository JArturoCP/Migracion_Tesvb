<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class Enc_servicio_ccController extends Controller
{
    public function registro_enc_mante_usuario(){

        $id_usuario = Session::get('usuario_alumno');


        $persona=DB::selectOne('SELECT * FROM `gnral_personales` WHERE `tipo_usuario` ='.$id_usuario.'');


       $encuestas_mantenimiento=DB::select('SELECT *  FROM `enc_servicio_mantenimiento` WHERE `id_personal` = '.$persona->id_personal.' AND `id_estado` = 1');

       $historial=DB::select('SELECT *  FROM `enc_servicio_mantenimiento` WHERE `id_personal` = '.$persona->id_personal.' AND `id_estado` = 2');

       return view('encuestas_satisfacion_cliente.computo.registro_encuestas', compact('encuestas_mantenimiento','historial'));
    }
    public function contestar_encuesta($id_servicio_mantenimieento){
       $mantenimiento=DB::selectOne('SELECT *  FROM `enc_servicio_mantenimiento` WHERE `id_servicio_mantenimiento` ='.$id_servicio_mantenimieento.'');
     //  dd($mantenimiento);
       return view('encuestas_satisfacion_cliente.computo.encuesta_mantenimiento',compact('mantenimiento'));
    }
    public function enviar_encuesta_mantenimiento(Request  $request, $id_servicio_mantenimiento){
        $pregunta1 = $request->input("pregunta1");
        $pregunta2 = $request->input("pregunta2");
        $pregunta3 = $request->input("pregunta3");
        $pregunta4 = $request->input("pregunta4");
        $sugerencias = $request->input("sugerencias");

        if($sugerencias == null){
            $sugerencias="";
        }else{
            $sugerencias=$sugerencias;
        }
        $fecha_actual =  date("Y-m-d H:i:s");
        $fecha =  date("Y-m-d");


        DB:: table('enc_servicio_mantenimiento')
            ->where('id_servicio_mantenimiento', $id_servicio_mantenimiento)
            ->update([
                'fecha_encuesta'=>$fecha,
                'cal_preg_1'=>$pregunta1,
                'cal_preg_2'=>$pregunta2,
                'cal_preg_3'=>$pregunta3,
                'cal_preg_4'=>$pregunta4,
                'sugerencias'=>$sugerencias,
                'id_estado'=>2,
                'fecha_registro'=>$fecha_actual,
            ]);
            return back();

    }
}
