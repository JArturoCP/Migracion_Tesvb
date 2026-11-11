<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Session;
class Ingles_voucher_val_export implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function view(): View
    {
        $periodo_ingles=Session::get('periodo_ingles');
        $alumnos=DB::select('SELECT gnral_alumnos.cuenta, gnral_alumnos.nombre, gnral_alumnos.apaterno, gnral_alumnos.amaterno, in_voucher_pago.id_voucher, in_voucher_pago.id_usuario, in_voucher_pago.voucher, in_voucher_pago.linea_captura, in_voucher_pago.fecha_cambio, in_voucher_pago.id_estado_carga_voucher, in_voucher_pago.id_estado_valida_voucher, in_voucher_pago.id_periodo_ingles, in_voucher_pago.id_tipo_voucher
                            FROM users, gnral_alumnos, in_voucher_pago, in_periodos
                            WHERE users.id = gnral_alumnos.id_usuario
                            AND in_voucher_pago.id_usuario = users.id
                            AND in_voucher_pago.id_periodo_ingles = in_periodos.id_periodo_ingles
                            AND in_voucher_pago.id_periodo_ingles = '.$periodo_ingles.' 
                            and in_voucher_pago.estado_agregacion_excel = 1
                            AND in_voucher_pago.id_estado_valida_voucher = 2');
        return view('ingles.departamento.exportar_voucher_aceptados',compact('alumnos'));

    }
}
