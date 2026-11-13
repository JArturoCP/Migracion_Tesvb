<?php

namespace App\Http\Controllers;

use App\Exports\Ingles_historial_cal_export;
use App\Exports\Ingles_voucher_val_export;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class excell_voucherController extends Controller
{
    public function index()
    {
        Excel::create("voucher",function ($excel)
        {

            $periodo_ingles=Session::get('periodo_ingles');


                $excel->sheet('voucher_pago', function($sheet) use($periodo_ingles)
                {
                    $alumnos=DB::select('SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno, in_voucher_pago.id_voucher, in_voucher_pago.id_usuario, in_voucher_pago.voucher, in_voucher_pago.linea_captura, in_voucher_pago.fecha_cambio, in_voucher_pago.id_estado_carga_voucher, in_voucher_pago.id_estado_valida_voucher, in_voucher_pago.id_periodo_ingles, in_voucher_pago.id_tipo_voucher
                            FROM users, gnral_alumnos, in_voucher_pago, in_periodos
                            WHERE users.id = gnral_alumnos.id_usuario
                            AND in_voucher_pago.id_usuario = users.id
                            AND in_voucher_pago.id_periodo_ingles = in_periodos.id_periodo_ingles
                            AND in_voucher_pago.id_periodo_ingles = ?
                            AND in_voucher_pago.id_estado_valida_voucher = 1', [$periodo_ingles]);


                    $sheet->loadView('ingles.departamento.exportar_voucher_ingles',compact('alumnos'));
                    $sheet->setOrientation('landscape');


                });



                //dd($array_carreras);

        })->export('xlsx');
    }
    /*
    public function exportar_excell_voucher_aceptado(){
        Excel::create("voucher",function ($excel)
        {

            $periodo_ingles=Session::get('periodo_ingles');


            $excel->sheet('voucher_pago', function($sheet) use($periodo_ingles)
            {
                $alumnos=DB::select('SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno, in_voucher_pago.id_voucher, in_voucher_pago.id_usuario, in_voucher_pago.voucher, in_voucher_pago.linea_captura, in_voucher_pago.fecha_cambio, in_voucher_pago.id_estado_carga_voucher, in_voucher_pago.id_estado_valida_voucher, in_voucher_pago.id_periodo_ingles, in_voucher_pago.id_tipo_voucher
                            FROM users, gnral_alumnos, in_voucher_pago, in_periodos
                            WHERE users.id = gnral_alumnos.id_usuario
                            AND in_voucher_pago.id_usuario = users.id
                            AND in_voucher_pago.id_periodo_ingles = in_periodos.id_periodo_ingles
                            AND in_voucher_pago.id_periodo_ingles = '.$periodo_ingles.'
                            and in_voucher_pago.estado_agregacion_excel = 1
                            AND in_voucher_pago.id_estado_valida_voucher = 2');


                $sheet->loadView('ingles.departamento.exportar_voucher_aceptados',compact('alumnos'));
                $sheet->setOrientation('landscape');


            });



            //dd($array_carreras);

        })->export('xlsx');
    }
*/
    public function exportar_excell_voucher_aceptado(){


            $periodo_ingles=Session::get('periodo_ingles');
            $nombre_perido=DB::selectOne('SELECT * FROM `in_periodos` WHERE `id_periodo_ingles` = ?', [$periodo_ingles]);
            //dd($nombre_perido);
            $nombre=$nombre_perido->periodo_ingles;






        return Excel::download(new Ingles_voucher_val_export, $nombre.'.xlsx');



    }



}
