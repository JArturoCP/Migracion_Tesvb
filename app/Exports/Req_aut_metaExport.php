<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
//use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class Req_aut_metaExport implements FromView
{
    protected $id_presupuesto;
    public function __construct($id_presupuesto,$id_meta){
        $this->id_presupuesto=$id_presupuesto;
        $this->id_meta = $id_meta;

    }
    public function view():View
    {
        $proyecto= DB::selectOne('SELECT pres_presupuesto_anteproyecto.*,pres_proyectos.nombre_proyecto from pres_presupuesto_anteproyecto, pres_proyectos
       WHERE pres_presupuesto_anteproyecto.id_proyecto = pres_proyectos.id_proyecto and pres_presupuesto_anteproyecto.id_presupuesto = ? ', [$this->id_presupuesto]);
        $etiqueta=DB::selectOne('SELECT * FROM `etiqueta` WHERE `id_etiqueta` = 1');


        ///presupuesto del proyecto del anteproyecto
        /* $presupuesto_ante_proy=DB::select('SELECT pres_fuentes_financiamiento.*, pres_capitulos.capitulo from
    pres_fuentes_financiamiento, pres_capitulos where pres_fuentes_financiamiento.id_capitulo = pres_capitulos.id_capitulo
     and pres_fuentes_financiamiento.id_presupuesto_ante = '.$id_presupuesto.' ORDER BY `pres_fuentes_financiamiento`.`id_capitulo` ASC');
         */

        $capitulos=DB::select('SELECT * FROM `pres_capitulos` ORDER BY `pres_capitulos`.`id_capitulo` ASC ');
        $array_cap=array();
        foreach ($capitulos as $capitulo){
            $cap['id_capitulo']=$capitulo->id_capitulo;
            $cap['capitulo']=$capitulo->capitulo;
            $presupuesto_ante_proy=DB::selectOne('SELECT pres_fuentes_financiamiento.*, pres_capitulos.capitulo from
               pres_fuentes_financiamiento, pres_capitulos where pres_fuentes_financiamiento.id_capitulo = pres_capitulos.id_capitulo and
                pres_capitulos.id_capitulo= ?
                and pres_fuentes_financiamiento.id_presupuesto_ante = ? ORDER BY `pres_fuentes_financiamiento`.`id_capitulo` ASC', [$capitulo->id_capitulo, $this->id_presupuesto]);

            if($presupuesto_ante_proy == null){
                $cap['id_fuente_financiamiento'] = 0;
                $cap['id_presupuesto_ante'] = 0;
                $cap['presupuesto_estatal'] = 0;
                $cap['presupuesto_federal'] = 0;
                $cap['presupuesto_propios'] = 0;
                $cap['total_presupuesto'] = 0;
                $cap['financiamiento_estatal'] = 0;
                $cap['financiamiento_federal'] =0;
                $cap['financiamiento_propios'] = 0;
                $cap['total_financiamiento'] = 0;
            }else {
                $cap['id_fuente_financiamiento'] = $presupuesto_ante_proy->id_fuente_financiamiento;
                $cap['id_presupuesto_ante'] = $presupuesto_ante_proy->id_presupuesto_ante;
                $cap['presupuesto_estatal'] = $presupuesto_ante_proy->presupuesto_estatal;
                $cap['presupuesto_federal'] = $presupuesto_ante_proy->presupuesto_federal;
                $cap['presupuesto_propios'] = $presupuesto_ante_proy->presupuesto_propios;
                $cap['total_presupuesto'] = $presupuesto_ante_proy->total_presupuesto;
                $cap['financiamiento_estatal'] = $presupuesto_ante_proy->financiamiento_estatal;
                $cap['financiamiento_federal'] = $presupuesto_ante_proy->financiamiento_federal;
                $cap['financiamiento_propios'] = $presupuesto_ante_proy->financiamiento_propios;
                $cap['total_financiamiento'] = $presupuesto_ante_proy->total_financiamiento;
            }

            array_push($array_cap,$cap);

        }




/////////777///////7
        $presupuesto_proyecto=DB::select('SELECT *  FROM `pres_fuentes_financiamiento`
        WHERE `id_presupuesto_ante` = ?  and total_presupuesto >0
        ORDER BY `pres_fuentes_financiamiento`.`id_capitulo` ASC', [$this->id_presupuesto]);

        $array_capitulos=array();
        $suma_total_capitulo=0;
        $contar_numero_partida=0;
        foreach($presupuesto_proyecto as $presupuesto){

            $contar_partida=DB::selectOne('SELECT count(id_partida_pres)contar from pres_partida_pres WHERE id_capitulo = ?', [$presupuesto->id_capitulo]);

            if($contar_partida->contar == 0){

            }else{
                $contar_partida=$contar_partida->contar;
                $contar_numero_partida=$contar_numero_partida+1;
                $dat_cap['contar_partidas']=$contar_partida;
                $dat_cap['contar_numero_partida']=$contar_numero_partida;
                $dat_cap['id_fuente_financiamiento']=$presupuesto->id_fuente_financiamiento;
                $dat_cap['id_presupuesto_ante']=$presupuesto->id_presupuesto_ante;
                $dat_cap['id_capitulo']=$presupuesto->id_capitulo;
                $dat_cap['presupuesto_estatal']=$presupuesto->presupuesto_estatal;
                $dat_cap['presupuesto_federal']=$presupuesto->presupuesto_federal;
                $dat_cap['presupuesto_propios']=$presupuesto->presupuesto_propios;
                $dat_cap['total_presupuesto']=$presupuesto->total_presupuesto;
                $dat_cap['financiamiento_estatal']=$presupuesto->financiamiento_estatal;
                $dat_cap['financiamiento_federal']=$presupuesto->financiamiento_federal;
                $dat_cap['financiamiento_propios']=$presupuesto->financiamiento_propios;
                $dat_cap['total_financiamiento']=$presupuesto->total_financiamiento;

                $partidas=DB::select('SELECT pres_partida_pres.* from pres_partida_pres
               WHERE id_capitulo = ? ORDER BY `clave_presupuestal` ASC', [$presupuesto->id_capitulo]);


                $array_partidas=array();
                foreach ($partidas as $partida){
                    $dat_p['id_partida_pres']= $partida->id_partida_pres;
                    $dat_p['id_capitulo']= $partida->id_capitulo;
                    $dat_p['nombre_partida']= $partida->nombre_partida;
                    $dat_p['clave_presupuestal']= $partida->clave_presupuestal;

                    $meses=DB::select('SELECT * FROM `pres_mes` ORDER BY `id_mes` ASC');
                    $array_meses=array();
                    $suma_total_mes=0;
                    foreach ($meses as $mes){
                        $dat_meses['id_mes']=$mes->id_mes;
                        $dat_meses['mes']=$mes->mes;
                        $requisiciones=DB::select('SELECT pres_actividades_req_ante.* from pres_actividades_req_ante,
                       pres_req_mat_ante where pres_actividades_req_ante.id_proyecto = ? and pres_actividades_req_ante.id_partida_pres = ?
                       and pres_actividades_req_ante.id_mes  = ? and pres_actividades_req_ante.id_autorizacion= 4 and pres_actividades_req_ante.id_meta = ?
                        and pres_req_mat_ante.id_req_mat_ante = pres_actividades_req_ante.id_req_mat_ante and  pres_req_mat_ante.year_requisicion= ? ', [$proyecto->id_proyecto, $partida->id_partida_pres, $mes->id_mes, $this->id_meta, $proyecto->year]);


                        $suma_req1=0;
                        $array_req=array();
                        foreach ($requisiciones as $requisicion){
                            $suma_req=DB::selectOne('SELECT SUM(importe) suma_material from pres_reg_material_req_ante WHERE id_actividades_req_ante = ?', [$requisicion->id_actividades_req_ante]);

                            if($suma_req== null ){
                                $dat_req['id_actividades_req_ante']=$requisicion->id_actividades_req_ante;
                                $dat_req['id_req_mat_ante']=$requisicion->id_req_mat_ante;
                                $dat_req['id_partida_pres']=$requisicion->id_partida_pres;

                                $dat_req['suma_importe_material']=0;
                            }else{
                                $dat_req['id_actividades_req_ante']=$requisicion->id_actividades_req_ante;
                                $dat_req['id_req_mat_ante']=$requisicion->id_req_mat_ante;
                                $dat_req['id_partida_pres']=$requisicion->id_partida_pres;
                                $dat_req['suma_importe_material']=$suma_req->suma_material;

                                $suma_req1=$suma_req1+$suma_req->suma_material;
                            }
                            array_push($array_req,$dat_req);

                        }


                        $dat_meses['requisiciones']=$array_req;
                        $dat_meses['suma_req_mes']=$suma_req1;
                        $suma_total_mes=$suma_total_mes+$suma_req1;
                        array_push($array_meses,$dat_meses);
                    }

                    $dat_p['array_meses']=$array_meses;
                    $dat_p['suma_presupuestal_year']=$suma_total_mes;
                    $suma_total_capitulo=$suma_total_capitulo+$suma_total_mes;
                    array_push($array_partidas,$dat_p);

                }
                $dat_cap['array_partidas']=$array_partidas;
                $dat_cap['suma_total_capitulo']=$suma_total_capitulo;
                array_push($array_capitulos,$dat_cap);
            }
        }
        //////////////////
        $array_part_ant=array();
        foreach ( $array_capitulos as $cap){
            $dat['numero_partida']=$cap['contar_numero_partida'];

            $contar_part=0;
            foreach ($cap['array_partidas'] as $partida){
                $contar_part=$contar_part+1;
            }
            $dat['conteo_partida']=$contar_part;
            array_push($array_part_ant,$dat);
        }
        $meta=DB::selectOne('SELECT * FROM `pres_metas` WHERE `id_meta` = ?', [$this->id_meta]);
        $id_presupuesto=$this->id_presupuesto;

//dd($proyecto);
        //dd($presupuesto_ante_proy);
        return view('departamento_finanzas.exceles.excel_anteproyecto_aut_meta',compact('id_presupuesto','array_cap','array_capitulos','etiqueta','proyecto','meta'));


    }
}
