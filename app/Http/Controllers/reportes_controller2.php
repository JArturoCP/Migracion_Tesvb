<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\FPDF as FPDF;
use Session;


class reportes_controller2 extends Controller
{

    public function index(Request $request,$id_profesor,$condi,$carre)
    {
        $periodo = Session::get('periodo_actual');
        if (!$periodo) {
    return redirect()->back()->with('error', 'No hay periodo activo');
}
//dd($hrs);
////////////////////////////////////////////////carreras y materias del docente
        if ($condi==3)
        {
            $datos=(explode(',',$id_profesor));
            $id_hrs=$datos[0];
            $id_profesor=$datos[4];/////para consultar con id_hrs_pro

//dd($id_profesor);
           $carreras = DB::select("SELECT DISTINCT gc.nombre AS carrera,gc.id_carrera
    FROM gnral_materias gm
    INNER JOIN gnral_materias_perfiles gmp ON gmp.id_materia = gm.id_materia
    INNER JOIN gnral_horas_profesores ghp ON ghp.id_materia_perfil = gmp.id_materia_perfil
    INNER JOIN gnral_horarios gh ON ghp.id_horario_profesor = gh.id_horario_profesor
    INNER JOIN gnral_periodo_carreras gpc ON gh.id_periodo_carrera = gpc.id_periodo_carrera
    INNER JOIN gnral_periodos gp ON gp.id_periodo = gpc.id_periodo
    INNER JOIN gnral_carreras gc ON gc.id_carrera = gpc.id_carrera
    INNER JOIN gnral_personales gper ON gper.id_personal = gh.id_personal
    INNER JOIN gnral_semestres gs ON gs.id_semestre = gm.id_semestre
    WHERE gp.id_periodo = ?
    AND gh.id_personal = ?
", [$periodo, $id_profesor]);

        }
        else
        {
        $carreras = DB::select('SELECT DISTINCT gc.nombre AS carrera, gc.id_carrera FROM gnral_materias gm
        INNER JOIN gnral_materias_perfiles gmp ON gmp.id_materia = gm.id_materia
        INNER JOIN gnral_horas_profesores ghp ON ghp.id_materia_perfil = gmp.id_materia_perfil
        INNER JOIN gnral_horarios gh ON ghp.id_horario_profesor = gh.id_horario_profesor
        INNER JOIN gnral_periodo_carreras gpc ON gh.id_periodo_carrera = gpc.id_periodo_carrera
        INNER JOIN gnral_periodos gp ON gp.id_periodo = gpc.id_periodo
        INNER JOIN gnral_carreras gc ON gc.id_carrera = gpc.id_carrera
        INNER JOIN gnral_personales gper ON gper.id_personal = gh.id_personal
        INNER JOIN gnral_semestres gs ON gs.id_semestre = gm.id_semestre
        WHERE gp.id_periodo = ?
        AND gh.id_personal = ?
    ', [$periodo, $id_profesor]);
        }
        $datos_carreras=array();
        foreach ($carreras as $carrera)
        {
            $nombre['nombre_carrera']=$carrera->carrera;
            $nombre['id_carrera']=$carrera->id_carrera;

    $materias = DB::select("
    SELECT DISTINCT
        ghp.id_hrs_profesor,
        gm.nombre AS mat,
        gc.nombre AS carrera,
        gc.id_carrera,
        CONCAT(gs.id_semestre,'0',ghp.grupo) AS grupo,
        gper.nombre AS nombrepro

    FROM gnral_materias gm
    INNER JOIN gnral_materias_perfiles gmp
        ON gmp.id_materia = gm.id_materia

    LEFT JOIN gnral_horas_profesores ghp
        ON ghp.id_materia_perfil = gmp.id_materia_perfil

    LEFT JOIN gnral_horarios gh
        ON ghp.id_horario_profesor = gh.id_horario_profesor

    LEFT JOIN gnral_periodo_carreras gpc
        ON gh.id_periodo_carrera = gpc.id_periodo_carrera

    LEFT JOIN gnral_periodos gp
        ON gp.id_periodo = gpc.id_periodo

    LEFT JOIN gnral_carreras gc
        ON gc.id_carrera = gpc.id_carrera

    LEFT JOIN gnral_semestres gs
        ON gm.id_semestre = gs.id_semestre

    LEFT JOIN gnral_personales gper
        ON gh.id_personal = gper.id_personal

    WHERE gp.id_periodo = ?
      AND gc.id_carrera = ?
      AND (gh.id_personal = ? OR gh.id_personal IS NULL)

    ORDER BY gm.nombre
", [$periodo, $carrera->id_carrera, $id_profesor]);
//dd($materias);
            $nombre_materias=array();
            foreach ($materias as $materia)
            {
                $nombrem['nombre_materia']=$materia->mat;
                $nombrem['nombre_grupo']=$materia->grupo;
                $nombrem['id_hrs']=$materia->id_hrs_profesor;
                $nombrem['idcarrera']=$materia->id_carrera;
                array_push($nombre_materias,$nombrem);
            }
            $nombre['materias']=$nombre_materias;
            array_push($datos_carreras, $nombre);
        }
        //////////////////////////////////////////////////////////////////////////////////////
        if($condi==1)
        {
            $id_materias=DB::select('select DISTINCT(gnral_horas_profesores.id_hrs_profesor),gnral_materias.nombre mat, gnral_carreras.nombre,
                            CONCAT(gnral_semestres.id_semestre ,"0",gnral_horas_profesores.grupo) grupo, gnral_personales.nombre nombrepro
                            from eva_calificaciones_pre, gnral_materias,gnral_materias_perfiles,gnral_horas_profesores,gnral_horarios,gnral_periodo_carreras,gnral_periodos,gnral_carreras,gnral_personales,gnral_semestres
                            where gnral_periodos.id_periodo= ?
                            and gnral_horarios.id_personal= ?
                            and gnral_periodo_carreras.id_periodo=gnral_periodos.id_periodo
                            and gnral_periodo_carreras.id_carrera=gnral_carreras.id_carrera
                            and gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                            and gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                            and gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                            and gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil
                            and gnral_horarios.id_personal=gnral_personales.id_personal
                            and gnral_materias.id_semestre=gnral_semestres.id_semestre
                            and eva_calificaciones_pre.id_hrs_profesor=gnral_horas_profesores.id_hrs_profesor
        and eva_calificaciones_pre.calificacion_p>0
', [$periodo, $id_profesor]);
            $grafica_condicion="GRÁFICA GENERAL";
//dd($id_materias);
            $g_carrera=0;
            $g_id_profesor=$id_profesor;
            $g_id_hrs=0;


        }
        if ($condi == 2)
{
    $id_materias = DB::select('SELECT DISTINCT ghp.id_hrs_profesor,gm.nombre AS mat,gc.nombre,
    CONCAT(gs.id_semestre,\'0\',ghp.grupo) AS grupo,
    gper.nombre AS nombrepro
        FROM gnral_horas_profesores ghp
        INNER JOIN gnral_horarios gh ON ghp.id_horario_profesor = gh.id_horario_profesor
        INNER JOIN gnral_periodo_carreras gpc ON gh.id_periodo_carrera = gpc.id_periodo_carrera
        INNER JOIN gnral_periodos gp ON gpc.id_periodo = gp.id_periodo
        INNER JOIN gnral_carreras gc ON gpc.id_carrera = gc.id_carrera
        INNER JOIN gnral_materias_perfiles gmp ON ghp.id_materia_perfil = gmp.id_materia_perfil
        INNER JOIN gnral_materias gm ON gmp.id_materia = gm.id_materia
        INNER JOIN gnral_semestres gs ON gm.id_semestre = gs.id_semestre
        INNER JOIN gnral_personales gper ON gh.id_personal = gper.id_personal
        WHERE gp.id_periodo = ?
        AND gh.id_personal = ?
        AND gc.id_carrera = ?
        ORDER BY gm.nombre
    ', [$periodo, $id_profesor, $carre]);

    $nombre_carrera = DB::selectOne('SELECT nombre FROM gnral_carreras WHERE id_carrera = ?', [$carre]);

    $grafica_condicion = $nombre_carrera->nombre;
    $g_carrera = $carre;
    $g_id_profesor = $id_profesor;
    $g_id_hrs = 0;
}

if ($condi == 3)
{
    $id_materias = DB::select('SELECT DISTINCT
            ghp.id_hrs_profesor,
            gm.nombre AS mat,
            gc.nombre,
            CONCAT(gs.id_semestre,\'0\',ghp.grupo) AS grupo,
            gper.nombre AS nombrepro
        FROM gnral_horas_profesores ghp
        INNER JOIN gnral_horarios gh ON ghp.id_horario_profesor = gh.id_horario_profesor
        INNER JOIN gnral_periodo_carreras gpc ON gh.id_periodo_carrera = gpc.id_periodo_carrera
        INNER JOIN gnral_periodos gp ON gpc.id_periodo = gp.id_periodo
        INNER JOIN gnral_carreras gc ON gpc.id_carrera = gc.id_carrera
        INNER JOIN gnral_materias_perfiles gmp ON ghp.id_materia_perfil = gmp.id_materia_perfil
        INNER JOIN gnral_materias gm ON gmp.id_materia = gm.id_materia
        INNER JOIN gnral_semestres gs ON gm.id_semestre = gs.id_semestre
        INNER JOIN gnral_personales gper ON gh.id_personal = gper.id_personal
        WHERE gp.id_periodo = ?
        AND gh.id_personal = ?
        ORDER BY gm.nombre
    ', [$periodo, $id_profesor]);

    if (empty($id_materias)) {
        return view('evaluacion_docente.Admin.mencamper', [
            'mensage' => "No hay materias para este docente en el periodo seleccionado"
        ]);
    }

    $grafica_condicion = $id_materias[0]->nombrepro;
    $g_carrera = 0;
    $g_id_profesor = $id_profesor;
    $g_id_hrs = 0;
}
  //  dd($id_materias);

//////////////////////////////VERIFICAR SI EXISTE REGISTRO DE EVALUACION EN EL PERIODO
        $suma=0.0;
        foreach ($id_materias as $id)
        {
            //$verifica=DB::selectOne('select * from eva_calificaciones_pre where eva_calificaciones_pre.id_hrs_profesor='.$id->id_hrs_profesor.'');
            $verifica = DB::selectOne("SELECT id_hrs_profesor
    FROM eva_calificaciones_pre
    WHERE id_hrs_profesor = ?
    LIMIT 1
", [$id->id_hrs_profesor]);
            if($verifica!=null)
            {
                $suma=$suma+1;
            }
        }
        if($suma==0)
        {
            //dd($id_materias);
            if($condi==2)
            {
                $mensage="No es posible el cambio de periodo cuando se tiene seleccionada una carrera en especifico";
                return view('evaluacion_docente.Admin.mencamper',compact('mensage','periodo'));
            }
            $mensage="No existe registro de Evaluación Docente en este periodo, porfavor seleccionar otro periodo";
            $url=$_SERVER["REQUEST_URI"];

            $periodo_funciona=$periodo;
            return view('evaluacion_docente.Admin.mencamper',compact('mensage','periodo_funciona'));
        }
        else
        {
            $profesor=$id_materias[0]->nombrepro;
            //dd($profesor);
        }
        $con_cri=DB::select("select*from eva_criterio");

        foreach ($con_cri as $cri)
        {
            $cantidad=DB::selectOne('select count(id_criterio) numero from eva_pregunta where eva_pregunta.id_criterio= ?', [$cri->id_criterio]);
            $arre_div_cri[]=$cantidad->numero;
        }
        $cadena="[";
        foreach ($id_materias as $mat)
        {
////////////////////////////////////calcular porcentaje de alumnos

            $total_alumnos_eva = DB::selectone('
    SELECT SUM(t.alumnos) AS alumnos
    FROM (
        SELECT COUNT(DISTINCT gnral_alumnos.id_alumno) AS alumnos
        FROM gnral_alumnos, gnral_personales, gnral_materias, gnral_materias_perfiles,
             gnral_horarios, gnral_horas_profesores, gnral_periodo_carreras, gnral_periodos,
             eva_carga_academica, eva_validacion_de_cargas
        WHERE gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
          AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
          AND gnral_horarios.id_personal = gnral_personales.id_personal
          AND gnral_materias_perfiles.id_materia = gnral_materias.id_materia
          AND gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
          AND gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
          AND gnral_horas_profesores.id_hrs_profesor = ?
          AND gnral_periodos.id_periodo = ?
          AND eva_carga_academica.id_periodo = gnral_periodos.id_periodo
          AND eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
          AND eva_carga_academica.id_materia = gnral_materias.id_materia
          AND eva_carga_academica.grupo = gnral_horas_profesores.grupo
          AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo
          AND eva_validacion_de_cargas.id_alumno = gnral_alumnos.id_alumno
          AND eva_validacion_de_cargas.estado_validacion = 2

        UNION

        SELECT COUNT(DISTINCT gnral_alumnos.id_alumno) AS alumnos
        FROM gnral_alumnos, gnral_personales, gnral_materias, gnral_materias_perfiles,
             gnral_horarios, gnral_horas_profesores, gnral_periodo_carreras, gnral_periodos,
             eva_carga_academica, eva_validacion_de_cargas
        WHERE gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
          AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
          AND gnral_horarios.id_personal = gnral_personales.id_personal
          AND gnral_materias_perfiles.id_materia = gnral_materias.id_materia
          AND gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
          AND gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
          AND gnral_horas_profesores.id_hrs_profesor = ?
          AND gnral_periodos.id_periodo = ?
          AND eva_carga_academica.id_periodo = gnral_periodos.id_periodo
          AND eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
          AND eva_carga_academica.id_materia = gnral_materias.id_materia
          AND eva_carga_academica.grupo = gnral_horas_profesores.grupo
          AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo
          AND eva_validacion_de_cargas.id_alumno = gnral_alumnos.id_alumno
          AND eva_validacion_de_cargas.estado_validacion != 2
          AND eva_validacion_de_cargas.no_pregunta = 49
    ) t
', [$mat->id_hrs_profesor, $periodo, $mat->id_hrs_profesor, $periodo]);
         $cantidad_de_alumnos_v = DB::selectone('SELECT COUNT(DISTINCT gnral_alumnos.id_alumno) AS alumnos
         FROM eva_alumno_materias
         JOIN gnral_alumnos ON gnral_alumnos.cuenta = eva_alumno_materias.cuenta
         JOIN eva_validacion_de_cargas ON eva_validacion_de_cargas.id_alumno = gnral_alumnos.id_alumno
         WHERE eva_alumno_materias.id_hrs_profesor = ?
         AND eva_validacion_de_cargas.no_pregunta = 49
         AND eva_validacion_de_cargas.id_periodo = ?', [$mat->id_hrs_profesor, $periodo]);

            //$cantidad_de_alumnos_v=["alumnos"=>count($cantidad_de_alumnos_v)];
           //dd($total_alumnos_eva,$cantidad_de_alumnos_v);
            $arreglodatos['materia']=$mat->mat." ".$mat->grupo;
            $arreglodatos['total']=$total_alumnos_eva->alumnos; //alumnos inscritos
            $arreglodatos['total_si']=$cantidad_de_alumnos_v->alumnos; // evaluaron
            $arregloevaluacion['materia']=$mat->mat." ".$mat->grupo;
            $arregloevaluacion['total']=$total_alumnos_eva->alumnos;
            $arregloevaluacion['total_si']=$cantidad_de_alumnos_v->alumnos;
            if($total_alumnos_eva->alumnos==0)
            {
                $porcentaje=0;
            }
            else
            {
                $porcentaje=(($cantidad_de_alumnos_v->alumnos*100)/$total_alumnos_eva->alumnos);
                $porcentaje=round($porcentaje*100)/100;
            }
            $arreglodatos['porcentaje']="".$porcentaje."%";
            $materia_por[]=$arreglodatos;
            $mat_evaluacion[]=$arregloevaluacion;
/////modificacion harlock
            // $consulta=DB::select('select* from eva_calificaciones_pre where eva_calificaciones_pre.id_hrs_profesor='.$mat->id_hrs_profesor.' and
            //eva_calificaciones_pre.id_periodo='.$periodo.'');
            $consulta=DB::select('select id_periodo,no_pregunta,calificacion_p,id_hrs_profesor,id_criterio from eva_calificaciones_pre where eva_calificaciones_pre.id_hrs_profesor= ? and  eva_calificaciones_pre.id_periodo= ? GROUP by id_periodo, no_pregunta,calificacion_p,id_hrs_profesor,id_criterio', [$mat->id_hrs_profesor, $periodo]);
            //dd($consulta);
            //DESCRIBE LA CALIFICACION DE LAS PREGUNTAS
            foreach ($consulta as $cons)
            {
                if($cons->calificacion_p>=0 && $cons->calificacion_p<3)
                {
                    $observacioncad=DB::selectOne('select eva_pregunta.recomendaciones from eva_pregunta where eva_pregunta.no_pregunta= ?', [$cons->no_pregunta]);
                    $cons->id_hrs_profesor=$observacioncad->recomendaciones;
                }
                else
                {
                    $observacioncad=DB::selectOne('select eva_pregunta.felicitaciones from eva_pregunta where eva_pregunta.no_pregunta= ?', [$cons->no_pregunta]);
                    $cons->id_hrs_profesor=$observacioncad->felicitaciones;
                }
            }
//OBTENER EL PROMEDIO DE CADA CRITERIO
            $criterios=DB::selectOne('select count(id_criterio) numero from eva_criterio');
            $suma=0;
            $contador_cri=0;
            $criterios=($criterios->numero);
            for ($i=1; $i <$criterios+1; $i++)
            {
                //i==1
                for ($j=0; $j<count($consulta) ; $j++)
                {
                    //si consulta en su posicion 0=1
                    if($consulta[($j)]->id_criterio==$i)
                    {
                        $suma=$suma+$consulta[$j]->calificacion_p;
                        $contador_cri=$contador_cri+1;

                    }
                }
                $arreglofinal[$i]=$suma;
                $numerode_cri[$i]=$contador_cri;
                if($numerode_cri[$i]==0)
                {
                    $promedio_criterios[$i]=0;
                }
                else
                {
                    //dd($numerode_cri);
                    $promedio_criterios[$i]=round($arreglofinal[$i]/$numerode_cri[$i],2);
                }
                $suma=0;
                $contador_cri=0;

            }
//dd($promedio_criterios);
///////////////////////////////////////////////////////////////////////////////////////////////
            $arreglo['nombre']=$mat->mat;
            $arreglo['calificacion_ps']=$consulta;
            $cadena.="{name:'".($mat->mat)." ".$mat->grupo."',";///////////////////////
            $cadena.="data:[";///////////////////////////////////////////////////
            // dd($arre_div_cri);
            for ($i=0; $i <count($arreglofinal) ; $i++)
            {
                $nu=$arreglofinal[$i+1]/$arre_div_cri[$i];
                $nu=round($nu*100)/100;
                $arreglofinal[$i+1]=$nu;
                //$nu=$arreglofinal[$i+1];
                $cadena.="$nu,";
            }
            $cadena.="]},";
            $arreglo['promedios']=$arreglofinal;
            $arreglo2[]=$arreglo;
        }
        $cadena.="]";
        ////////////////////////////////////////////////////////////////////
//dd($arreglo2);
////////todas las materias
////ciclo para saber cuantas preguntas seran
        //$arresumap= array();
//dd($consulta);
        for ($i=0; $i <count($consulta) ; $i++)
        {
            $arresumap[$i]=0;
        }
//ciclo para saber cuantos criterios seran
        for ($l=0; $l <$criterios ; $l++)
        {
            $arresumac[$l]=0;
        }
//dd($arresumac);
        foreach ($arreglo2 as $arre)
{
    foreach ($arre["calificacion_ps"] as $j => $item)
    {
        $valor = $item->calificacion_p;

        $arresumap[$j] = ($arresumap[$j] ?? 0) + $valor;

        // debug correcto
        //dd($valor);
    }

    foreach ($arre["promedios"] as $c => $valor)
    {
        $arresumac[$c] = ($arresumac[$c] ?? 0) + $valor;
    }
}
///divide las p entre el numero total de materias
        for ($i=0; $i <count($arresumap) ; $i++)
        {
            $arresumap[$i]=$arresumap[$i]/count($arreglo2);
        }



        for ($i=0; $i <count($arresumac) ; $i++)
        {
            $arresumac[$i]=$arresumac[$i]/count($arreglo2);
        }

//dd($arresumac);
///////////////////////////////////////////////////////////valor por cada pregunta/////////////////////////////////////////////////////////////

        $preguntas=DB::select('select eva_pregunta.id_criterio cri,eva_pregunta.no_pregunta, eva_pregunta.descripcion,eva_pregunta.id_criterio,eva_pregunta.descripcion observacion from eva_pregunta');
//dd($preguntas);
        $sum=0;
        for ($i=0; $i <count($preguntas) ; $i++) {

            $preguntas[$i]->id_criterio=$arresumap[$i];
            if($preguntas[$i]->id_criterio>=0 && $preguntas[$i]->id_criterio<3)

            {
                $ii=$i+1;
                $observacioncad=DB::selectOne('select eva_pregunta.recomendaciones from eva_pregunta where eva_pregunta.no_pregunta= ?', [$ii]);

                $preguntas[$i]->observacion=$observacioncad->recomendaciones;
            }
            else
            {
                $ii=$i+1;
                $observacioncad=DB::selectOne('select eva_pregunta.felicitaciones from eva_pregunta where eva_pregunta.no_pregunta= ?', [$ii]);

                $preguntas[$i]->observacion=$observacioncad->felicitaciones;
            }
            $sum=0;
        }
//dd($preguntas);

///////////////ordena prefuntas por el criterio

        $criterios=DB::select('select *from eva_criterio');
////////////////////////////////////////////////////llenar el arreglo con la calificacion del criterio

        $cicloscri=count($criterios);
        for ($i=0; $i <$cicloscri ; $i++)
        {

            $criterios[$i]->color=(round($arresumac[$i]*100)/100);
        }
//dd($criterios);

///////////////////////////////////////////////////

        $datos_preguntas=array(
        );
        $observacioncri="";
//dd($criterios);
        foreach ($criterios as $cri)
        {    $nombrep['id_criterio']=$cri->id_criterio;
            $nombrep['nombre_criterio']=$cri->nombre_criterio;


            $nombrep['calificacion']=$cri->color;

            if($cri->color>=0 && $cri->color<=1)
            {
                $observacioncri='No suficiente';
            }
            if($cri->color>=1.01 && $cri->color<=2)
            {
                $observacioncri='Suficiente';
            }
            if($cri->color>=2.01 && $cri->color<=3)
            {
                $observacioncri='Bien';
            }
            if($cri->color>=3.01 && $cri->color<=4)
            {
                $observacioncri='Muy Bien';
            }
            if($cri->color>=4.01 && $cri->color<=5)
            {
                $observacioncri='Excelente';
            }
            //dd($observacioncri);
            $nombrep['observacioncri']=$observacioncri;
            $cantidad=DB::selectOne('select count(id_criterio)pregunta from eva_pregunta where id_criterio= ?', [$cri->id_criterio]);
            $nombrep['cantidad']=$cantidad->pregunta+1;///////////////////calculando el numero de preguntas por criterio
            $preguntascri=DB::select('select eva_pregunta.descripcion, eva_pregunta.no_pregunta  FROM eva_criterio,eva_pregunta WHERE eva_criterio.id_criterio=eva_pregunta.id_criterio and
      eva_criterio.id_criterio= ?', [$cri->id_criterio]);
//dd($preguntascri);
            $arrpreguntas=array(
            );
            //dd($preguntascri);
            $cont_pregunta=0;
            $totalCriterio=0;
            foreach ($preguntascri as $precri)
            {
                //dd($preguntas);

                $nombremp['pregunta']=$precri->descripcion;
                $buscarp=($precri->no_pregunta-1);
                $nombremp['calificacion']=$preguntas[$buscarp]->id_criterio;
                //dd( $nombremp['calificacion']);
                $nombremp['calificacion']=round($nombremp['calificacion']*100)/100;/////redondear pregunta
                $nombremp['observacion']=$preguntas[$buscarp]->observacion;
                array_push($arrpreguntas,$nombremp);
                //  dd($arrpreguntas);
                $cont_pregunta++;
                $totalCriterio+=$preguntas[$buscarp]->id_criterio;
            }
            $nombrep['calificacion']=round($totalCriterio/$cont_pregunta,2);
            $nombrep['preguntas']=$arrpreguntas;
            array_push($datos_preguntas, $nombrep);
        }
//dd($datos_preguntas);
////////////////////////////PROMEDIO POR MATERIA///
//dd(count($arreglo2[0]["promedios"]));
        for ($i=0; $i < count($arreglo2); $i++)
        {
            $suma=0;
            $div=count($arreglo2[$i]["promedios"]);
            $promediosmat=$arreglo2[$i]["promedios"];
            foreach ($promediosmat as $prom)
            {
                $suma=$suma+$prom;
            }
            $prommat[]=$suma/$div;
            $materia_por[$i]['total_si']=$suma/$div;
            $materia_por[$i]['total_si']=round($materia_por[$i]['total_si']*100)/100;
            $mat_evaluacion[$i]['promedio']=$materia_por[$i]['total_si'];
        }
//////////////////////////////////////////////////PROMEDIO TOTAL
        $promedio_t=0;
        $conta=0;
        foreach ($datos_preguntas as $da)
        {
            $promedio_t=$promedio_t+$datos_preguntas[$conta]["calificacion"];
            $conta++;
        }
        $promedio_t=$promedio_t/count($numerode_cri);
        $descrip_t="";
        $promedio_t=round($promedio_t*100)/100;
        if($promedio_t>=0 && $promedio_t<=1)
        {
            $descrip_t='No suficiente';
        }
        if($promedio_t>=1.01 && $promedio_t<=2)
        {
            $descrip_t='Suficiente';
        }
        if($promedio_t>=2.01 && $promedio_t<=3)
        {
            $descrip_t='Bien';
        }
        if($promedio_t>=3.01 && $promedio_t<=4)
        {
            $descrip_t='Muy Bien';
        }
        if($promedio_t>=4.01 && $promedio_t<=5)
        {
            $descrip_t='Excelente';
        }
//dd($promedio_t);
        $rubros=DB::select('select eva_criterio.nombre_criterio rubros from eva_criterio');
        return view('evaluacion_docente.Admin.reportes2',compact('datos_preguntas','mat_evaluacion','descrip_t','promedio_t','profesor','g_id_hrs','g_id_profesor','g_carrera','condi','materia_por','id_profesor','rubros','arreglofinal','cadena','grafica_condicion','preguntas','criterios'))->with(['grafica1'=>true,'carreras'=>$datos_carreras,'preguntas2'=>$datos_preguntas]);

    }
}
