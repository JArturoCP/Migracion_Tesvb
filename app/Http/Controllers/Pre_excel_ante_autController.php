<?php

namespace App\Http\Controllers;

use App\Exports\Ingles_voucher_val_export;
use App\Exports\Req_aut_anteExport;
use App\Exports\Req_aut_cap_antExport;
use App\Exports\Req_aut_inc_capExport;
use App\Exports\Req_aut_incompletoExport;
use App\Exports\Req_aut_mesExport;
use App\Exports\Req_aut_metaExport;
use App\Exports\Req_aut_inc_mesExport;
use App\Exports\Req_aut_inc_metaExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Session;
class Pre_excel_ante_autController extends Controller
{
    public function index($id_presupuesto){
        $proyecto=DB::selectOne('SELECT pres_proyectos.nombre_proyecto, pres_presupuesto_anteproyecto.* 
    from pres_proyectos, pres_presupuesto_anteproyecto where pres_proyectos.id_proyecto = pres_presupuesto_anteproyecto.id_proyecto 
    and pres_presupuesto_anteproyecto.id_presupuesto='.$id_presupuesto.'');
        ///dd($proyecto);

        return Excel::download(new Req_aut_anteExport($id_presupuesto), 'Anteproyecto_presupuesto_'.$proyecto->year.'.xlsx');
    }
    public function presupuesto_capitulo_ant_excel($id_fuente_financiamiento){
        $fuente_financiamiento=DB::select('SELECT  pres_fuentes_financiamiento.* from 
        pres_fuentes_financiamiento where id_fuente_financiamiento ='.$id_fuente_financiamiento.'');

        $proyecto = DB::selectOne('SELECT pres_presupuesto_anteproyecto.*,pres_proyectos.nombre_proyecto from pres_presupuesto_anteproyecto, pres_proyectos
       WHERE pres_presupuesto_anteproyecto.id_proyecto = pres_proyectos.id_proyecto and pres_presupuesto_anteproyecto.id_presupuesto =' . $fuente_financiamiento[0]->id_presupuesto_ante . ' ');

     // dd($proyecto);
        return Excel::download(new Req_aut_cap_antExport($id_fuente_financiamiento), 'Anteproyecto_presupuesto_cap_'.$proyecto->year.'.xlsx');
    }
    public function  presupuesto_mes_ant_excel($id_presupuesto,$id_mes){
        $proyecto = DB::selectOne('SELECT pres_presupuesto_anteproyecto.*,pres_proyectos.nombre_proyecto from pres_presupuesto_anteproyecto, pres_proyectos
       WHERE pres_presupuesto_anteproyecto.id_proyecto = pres_proyectos.id_proyecto and pres_presupuesto_anteproyecto.id_presupuesto =' . $id_presupuesto. ' ');

        return Excel::download(new Req_aut_mesExport($id_presupuesto,$id_mes), 'Anteproyecto_presupuesto_mes_'.$proyecto->year.'.xlsx');

    }
    public function presupuesto_metas_ant_excel($id_presupuesto, $id_meta)
    {
        $proyecto=DB::selectOne('SELECT pres_proyectos.nombre_proyecto, pres_presupuesto_anteproyecto.* 
    from pres_proyectos, pres_presupuesto_anteproyecto where pres_proyectos.id_proyecto = pres_presupuesto_anteproyecto.id_proyecto 
    and pres_presupuesto_anteproyecto.id_presupuesto='.$id_presupuesto.'');

        return Excel::download(new Req_aut_metaExport($id_presupuesto,$id_meta), 'Anteproyecto_presupuesto_meta_'.$proyecto->year.'.xlsx');

    }
    public function presupuesto_ant_excel_incompleto($id_presupuesto){
        $proyecto = DB::selectOne('SELECT pres_proyectos.nombre_proyecto, pres_presupuesto_anteproyecto.* 
        from pres_proyectos, pres_presupuesto_anteproyecto where pres_proyectos.id_proyecto = pres_presupuesto_anteproyecto.id_proyecto 
        and pres_presupuesto_anteproyecto.id_presupuesto=' . $id_presupuesto . '');

        return Excel::download(new Req_aut_incompletoExport($id_presupuesto), 'Anteproyecto_presupuesto_inc_'.$proyecto->year.'.xlsx');

    }
    public function pres_capitulo_ant_excel_inc($id_fuente_financiamiento){


        $fuente_financiamiento = DB::select('SELECT  pres_fuentes_financiamiento.* from 
     pres_fuentes_financiamiento where id_fuente_financiamiento =' . $id_fuente_financiamiento . '');


        $proyecto = DB::selectOne('SELECT pres_presupuesto_anteproyecto.*,pres_proyectos.nombre_proyecto from pres_presupuesto_anteproyecto, pres_proyectos
       WHERE pres_presupuesto_anteproyecto.id_proyecto = pres_proyectos.id_proyecto and pres_presupuesto_anteproyecto.id_presupuesto =' . $fuente_financiamiento[0]->id_presupuesto_ante . ' ');


        return Excel::download(new Req_aut_inc_capExport($id_fuente_financiamiento), 'Anteproyecto_presupuesto_inc_cap_'.$proyecto->year.'.xlsx');

    }
    public function pre_mes_ant_excel_inc($id_presupuesto,$id_mes){
        $proyecto = DB::selectOne('SELECT pres_presupuesto_anteproyecto.*,pres_proyectos.nombre_proyecto from pres_presupuesto_anteproyecto, pres_proyectos
       WHERE pres_presupuesto_anteproyecto.id_proyecto = pres_proyectos.id_proyecto and pres_presupuesto_anteproyecto.id_presupuesto =' . $id_presupuesto . ' ');


        return Excel::download(new Req_aut_inc_mesExport($id_presupuesto,$id_mes), 'Anteproyecto_presupuesto_inc_mes_'.$proyecto->year.'.xlsx');

    }
    public function presupuesto_metas_ant_excel_inc($id_presupuesto,$id_meta){
        $proyecto=DB::selectOne('SELECT pres_proyectos.nombre_proyecto, pres_presupuesto_anteproyecto.* 
    from pres_proyectos, pres_presupuesto_anteproyecto where pres_proyectos.id_proyecto = pres_presupuesto_anteproyecto.id_proyecto 
    and pres_presupuesto_anteproyecto.id_presupuesto='.$id_presupuesto.'');

        return Excel::download(new Req_aut_inc_metaExport($id_presupuesto,$id_meta), 'Anteproyecto_presupuesto_inc_meta_'.$proyecto->year.'.xlsx');

    }

}
