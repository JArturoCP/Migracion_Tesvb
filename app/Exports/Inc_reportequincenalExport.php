<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Inc_reportequincenalExport implements FromView

{
    protected $id_articulo,$fecha_inicial,$fecha_final,$estado;

    public function __construct($id_articulo,$fecha_inicial,$fecha_final,$estado)
    {

        $this->id_articulo = $id_articulo;
        $this->fecha_inicial = $fecha_inicial;
        $this->fecha_final = $fecha_final;
        $this->estado= $estado;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $id_articulo = $this->id_articulo;
        $fecha_inicial = $this->fecha_inicial;
        $fecha_final = $this->fecha_final;
        $estado= $this->estado;

        if($id_articulo == 200){
            $articulos=DB::select("SELECT inc_articulos.id_articulo id,
       inc_articulos.nombre_articulo documento,
       gnral_personales.nombre servidor,
       inc_solicitudes.fecha_req fecha_i,
       '' fecha_f, inc_solicitudes.id_solicitud,
       gnral_personales.numero_empleado,
       1 estado,
       0 no_folio,
       0 no_fecha
       from 
        inc_solicitudes,inc_articulos, gnral_personales 
        where inc_solicitudes.id_articulo=inc_articulos.id_articulo 
        and inc_solicitudes.id_estado_solicitud=2
        and inc_solicitudes.id_personal=gnral_personales.id_personal 
        and  inc_solicitudes.fecha_req >='$fecha_inicial' and  inc_solicitudes.fecha_req <='$fecha_final' and 
        inc_articulos.id_articulo
        not in(2,8,11)
        union
      SELECT 
    inc_articulos.id_articulo id,
    inc_articulos.nombre_articulo documento , 
    gnral_personales.nombre servidor, 
    inc_solicitudes.fecha_invac fecha_i,
    inc_solicitudes.fecha_tervac fecha_f, 
    inc_solicitudes.id_solicitud ,
    gnral_personales.numero_empleado,
    1 estado,
    0 no_folio,
    0 no_fecha
FROM 
    inc_solicitudes
JOIN 
    inc_articulos ON inc_solicitudes.id_articulo = inc_articulos.id_articulo
JOIN 
    gnral_personales ON inc_solicitudes.id_personal = gnral_personales.id_personal
WHERE 
    inc_solicitudes.id_estado_solicitud = 2
    AND inc_articulos.id_articulo IN (2, 8, 11)
    AND (
        inc_solicitudes.fecha_invac BETWEEN '$fecha_inicial' AND '$fecha_final' 
        OR inc_solicitudes.fecha_tervac BETWEEN '$fecha_inicial' AND '$fecha_final'
    )  
        UNION
        SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       '' fecha_f,
       inc_evidencias.id_evid,
       gnral_personales.numero_empleado,
       2 estado,
       inc_evidencias.no_folio,
       inc_evidencias.no_fecha 
       from 
        inc_evidencias,inc_tipo_evidencia, gnral_personales 
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid 
        and inc_evidencias.no_fecha =1
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_personal=gnral_personales.id_personal 
        and  inc_evidencias.fecha_solicita >='$fecha_inicial' and  inc_evidencias.fecha_solicita <='$fecha_final'
        UNION 
        SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       inc_evidencias.fecha_solicita_2 fecha_f,
       inc_evidencias.id_evid,
       gnral_personales.numero_empleado,
       2 estado,
       inc_evidencias.no_folio,
       inc_evidencias.no_fecha
       from 
        inc_evidencias,inc_tipo_evidencia, gnral_personales 
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid 
        and inc_evidencias.no_fecha =2
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_personal=gnral_personales.id_personal 
        and    ((inc_evidencias.fecha_solicita >='$fecha_inicial' and  inc_evidencias.fecha_solicita_2 <='$fecha_final') OR
        (
        inc_evidencias.fecha_solicita BETWEEN '$fecha_inicial' AND '$fecha_final' 
        OR inc_evidencias.fecha_solicita_2 BETWEEN '$fecha_inicial' AND '$fecha_final'
    ))
ORDER BY `fecha_i` DESC");
//dd($articulos);

        }
        else{
            if($estado == 1) {

                if ($id_articulo == 2 || $id_articulo == 8 || $id_articulo == 11) {
                    //dd($articulos);
                    $articulos = DB::select("SELECT 
    inc_articulos.id_articulo id,
    inc_articulos.nombre_articulo documento , 
    gnral_personales.nombre servidor, 
    inc_solicitudes.fecha_invac fecha_i,inc_solicitudes.fecha_tervac fecha_f, 
    inc_solicitudes.id_solicitud ,gnral_personales.numero_empleado,1 estado,0 no_folio,0 no_fecha
FROM 
    inc_solicitudes
JOIN 
    inc_articulos ON inc_solicitudes.id_articulo = inc_articulos.id_articulo
JOIN 
    gnral_personales ON inc_solicitudes.id_personal = gnral_personales.id_personal
WHERE 
    inc_solicitudes.id_estado_solicitud = 2
    AND inc_articulos.id_articulo=$id_articulo
    AND (
        inc_solicitudes.fecha_invac BETWEEN '$fecha_inicial' AND '$fecha_final' 
        OR inc_solicitudes.fecha_tervac BETWEEN '$fecha_inicial' AND '$fecha_final'
    ) ORDER BY inc_solicitudes.fecha_invac DESC 
");


                } else {

                    $articulos = DB::select("SELECT inc_articulos.id_articulo id,
       inc_articulos.nombre_articulo documento,
       gnral_personales.nombre servidor,
       inc_solicitudes.fecha_req fecha_i,
       '' fecha_f, inc_solicitudes.id_solicitud,gnral_personales.numero_empleado,1 estado,0 no_folio,0 no_fecha from 
        inc_solicitudes,inc_articulos, gnral_personales 
        where inc_solicitudes.id_articulo=inc_articulos.id_articulo 
        and inc_solicitudes.id_estado_solicitud=2
        and inc_solicitudes.id_personal=gnral_personales.id_personal and
          inc_solicitudes.id_articulo=$id_articulo
        and  inc_solicitudes.fecha_req >='$fecha_inicial' and  inc_solicitudes.fecha_req <='$fecha_final' ORDER BY  inc_solicitudes.fecha_req DESC");

                }
            }else{

                $articulos=DB::select("SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       '' fecha_f, inc_evidencias.id_evid,gnral_personales.numero_empleado,2 estado,inc_evidencias.no_folio,inc_evidencias.no_fecha from 
        inc_evidencias,inc_tipo_evidencia, gnral_personales 
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid 
        and inc_evidencias.no_fecha =1
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_tipo_evid =$id_articulo
        and inc_evidencias.id_personal=gnral_personales.id_personal 
        and  inc_evidencias.fecha_solicita >='$fecha_inicial' and  inc_evidencias.fecha_solicita <='$fecha_final'
        UNION 
        SELECT inc_tipo_evidencia.id_tipo_evid id,
       inc_tipo_evidencia.nombre_evidencia documento,
       gnral_personales.nombre servidor,
       inc_evidencias.fecha_solicita fecha_i,
       inc_evidencias.fecha_solicita_2 fecha_f, inc_evidencias.id_evid,gnral_personales.numero_empleado,2 estado,inc_evidencias.no_folio,inc_evidencias.no_fecha from 
        inc_evidencias,inc_tipo_evidencia, gnral_personales 
        where inc_evidencias.id_tipo_evid=inc_tipo_evidencia.id_tipo_evid 
        and inc_evidencias.no_fecha =2
           and inc_evidencias.id_autorizado =2
        and inc_evidencias.id_tipo_evid =$id_articulo
        and inc_evidencias.id_personal=gnral_personales.id_personal 
        and    ((inc_evidencias.fecha_solicita >='$fecha_inicial' and  inc_evidencias.fecha_solicita_2 <='$fecha_final') OR
        (
        inc_evidencias.fecha_solicita BETWEEN '$fecha_inicial' AND '$fecha_final' 
        OR inc_evidencias.fecha_solicita_2 BETWEEN '$fecha_inicial' AND '$fecha_final'
    ))  
ORDER BY `fecha_i` DESC");

            }

        }
        //dd($articulos);
        //dd($fecha);


        return view('incidencias.excel_reporte_quincenal', compact('articulos', 'fecha_inicial','fecha_final','id_articulo','estado'));

    }
}
