<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eva_Tutor;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Storage;
use Session;

class Tu_Eva_CordinadorInstitucionalController extends Controller
{
    public function index()
    {
        $carreras = DB::select('SELECT car.id_carrera, car.nombre FROM gnral_carreras car
                                /* Trae las carreras excepto ingles y clturales */
                                WHERE car.id_carrera NOT IN (9) 
                                AND car.id_carrera NOT IN (11) 
                                AND car.id_carrera NOT IN (15)');
        //dd($carreras);
        return view('tutorias.eva_tutorias.carreras_index',compact('carreras'));
    }

    public function estado()
    {
        $periodo=Session::get('periodo_actual');
        $per = DB::selectOne('SELECT p.estado FROM tu_eva_periodo p INNER JOIN gnral_periodos per ON per.id_periodo = p.id_periodo WHERE per.id_periodo = '.$periodo.' ');

        if ($per == null)
        {

            DB::insert('INSERT INTO `tu_eva_periodo` ( `id_periodo`, `estado`, `fecha_registro`)
              VALUES ( '.$periodo.' ,0,now())');

            return redirect('/tutorias/evaluacion_tutor/estado/');
        }
        else if ($per->estado == 0)
        {
            $estado = 'Activar evaluación';
        }
        else if ($per->estado == 1)
        {
            $estado = 'Estado de Evaluacion al Tutor: Activo';
        }
        else
        {
            $estado = 'Estado de Evaluacion al Tutor: Finalizado';
        }

        return view('tutorias.eva_tutorias.activacion_index', compact('per', 'estado'));
    }

    public  function activa()
    {
        $periodo=Session::get('periodo_actual');
        //dd("activa");
        $con = DB::selectOne('SELECT COUNT(p.id_eva_periodo) con FROM tu_eva_periodo p INNER JOIN gnral_periodos per ON per.id_periodo = p.id_periodo WHERE per.id_periodo = '.$periodo.'  ');
        if ($con->con == 0)
        {
            DB::insert('INSERT INTO tu_eva_periodo VALUES ( NULL, '.$periodo.' , true, now() ) ');
            return redirect('/tutorias/evaluacion_tutor/estado/');
        }
        else{
            DB::update('UPDATE tu_eva_periodo SET estado = 1 WHERE id_periodo = '.$periodo.' ');
            return redirect('/tutorias/evaluacion_tutor/estado/');
        }
    }

    public  function desactiva()
    {
        $periodo=Session::get('periodo_actual');
        //dd("desactiva");
        DB::update('UPDATE tu_eva_periodo SET estado = 2 WHERE id_periodo = '.$periodo.' ');
        DB::update('UPDATE tu_eva_periodo SET fecha_final_eva = now() WHERE id_periodo = '.$periodo.' ');
        return redirect('/tutorias/evaluacion_tutor/estado/');
    }

    public function carreras($id_carrera)
    {
        $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` ='.$id_carrera.'');
        $periodo=Session::get('periodo_actual');
        //dd($periodo);

        $tutores = DB::SELECT('SELECT exp_asigna_t.id_asigna_generacion,tu_grupo_s.id_grupo_semestre,
       car.nombre carrera, car.id_carrera, tu_grupo_t.descripcion grupo, gnral_p.nombre nombre_tutor,
       gnral_p.tipo_usuario tipo FROM tu_grupo_tutorias tu_grupo_t
                              INNER JOIN tu_grupo_semestre tu_grupo_s
                              ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                              INNER JOIN exp_asigna_tutor exp_asigna_t 
                              ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                              INNER JOIN gnral_personales gnral_p 
                              ON gnral_p.id_personal = exp_asigna_t.id_personal 
                              INNER JOIN gnral_jefes_periodos gnral_j 
                              ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                              INNER JOIN gnral_carreras car
                              ON car.id_carrera = gnral_j.id_carrera
                              WHERE gnral_j.id_periodo = '.$periodo.' AND car.id_carrera = '.$id_carrera.' ');

        return view('tutorias.eva_tutorias.cordinador_index',compact('tutores','id_carrera','carrera'));
    }

    public function resultados($id_grupo_semestre,$grupo,$carrera)
    {
        $periodo=Session::get('periodo_actual');

        $datos = DB::SELECT('SELECT exp_asigna_t.id_asigna_tutor,  tu_grupo_s.id_grupo_semestre,car.nombre carrera,car.id_carrera, tu_grupo_t.descripcion grupo, gnral_p.nombre nombre_tutor, gnral_p.tipo_usuario, 
                                ( (sum(gestion)*4)/ (COUNT(form.id_eva_resultado)*16) ) gestion , 
                                ( (sum(actitud)*4)/ (COUNT(form.id_eva_resultado)*28) ) actitud, 
                                ( (sum(disponibilidad_confianza)*4)/(COUNT(form.id_eva_resultado)*20) ) disponibilidad_confianza,
                                ( (sum(servicios_del_programa_de_tutoria)*4 )/( COUNT(form.id_eva_resultado)*24 ) )servicios_del_programa_de_tutoria,
                                ( (sum(tus_logros_y_avances)*4 )/( COUNT(form.id_eva_resultado)*36 ) ) tus_logros_y_avances
                                FROM tu_grupo_tutorias tu_grupo_t
                                INNER JOIN tu_grupo_semestre tu_grupo_s
                                ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                INNER JOIN exp_asigna_tutor exp_asigna_t 
                                ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                INNER JOIN gnral_personales gnral_p 
                                ON gnral_p.id_personal = exp_asigna_t.id_personal 
                                INNER JOIN gnral_jefes_periodos gnral_j 
                                ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                INNER JOIN gnral_carreras car
                                ON car.id_carrera = gnral_j.id_carrera
                                INNER JOIN tu_eva_resultados_formulario form
                                ON form.id_asigna_tutor=exp_asigna_t.id_asigna_tutor
                                WHERE tu_grupo_s.id_grupo_semestre = '.$id_grupo_semestre.' and gnral_j.id_periodo ='.$periodo.' ');
        //dd($datos);
        return view('tutorias.eva_tutorias.grafica_index',compact('datos') );
        //dd($datos);

    }

    public function resultados_cuestionario($id_grupo_semestre,$grupo,$carrera) 
    {
        //dd($id_grupo_semestre);
        $periodo=Session::get('periodo_actual');

        $datos1 = DB::SELECTONE('SELECT exp_asigna_t.id_asigna_tutor
                                FROM tu_grupo_tutorias tu_grupo_t
                                INNER JOIN tu_grupo_semestre tu_grupo_s
                                ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                INNER JOIN exp_asigna_tutor exp_asigna_t 
                                ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                INNER JOIN gnral_personales gnral_p 
                                ON gnral_p.id_personal = exp_asigna_t.id_personal 
                                INNER JOIN gnral_jefes_periodos gnral_j 
                                ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                INNER JOIN gnral_carreras car
                                ON car.id_carrera = gnral_j.id_carrera
                                WHERE tu_grupo_s.id_grupo_semestre = '.$id_grupo_semestre.' and gnral_j.id_periodo ='.$periodo.' ');
        
        $datos = DB::SELECT('SELECT * FROM tu_eva_autoevaluacion where  id_asigna_tutor = '.$datos1->id_asigna_tutor.' ');


        //$preguntas = DB::Select('SELECT * FROM tu_eva_formulario_tutor fo, tu_eva_cuestionario eva WHERE fo.id_eva_cuestionario=eva.id_eva_cuestionario and fo.id_asigna_tutor = '.$datos1->id_asigna_tutor.' ');
        $preguntas = DB::Select('SELECT * FROM tu_eva_formulario_tutor fo, tu_eva_cuestionario eva, tu_eva_calificacion_autoeva au WHERE fo.id_eva_cuestionario=eva.id_eva_cuestionario and au.id_calificacion = fo.calificacion  and fo.id_asigna_tutor = '.$datos1->id_asigna_tutor.' ORDER BY fo.id_eva_formulario_tutor ASC');
        $con = DB::Selectone('SELECT count(*)  x FROM tu_eva_formulario_tutor fo, tu_eva_cuestionario eva, tu_eva_calificacion_autoeva au WHERE fo.id_eva_cuestionario=eva.id_eva_cuestionario and au.id_calificacion = fo.calificacion  and fo.id_asigna_tutor = '.$datos1->id_asigna_tutor.' ');

        //dd($preguntas);
        //dd($datos);
        //dd($con);
        if($con->x == 0)
        {
            return view('tutorias.eva_autoeva_tutor.sin_registro');
        }
        else
        {
            return view('tutorias.eva_autoeva_tutor.auto_eva_grafica',compact('datos','preguntas'));
        }
            
    }

    public function registro($id_asigna_generacion,$id_carrera)
    {
        $periodo=Session::get('periodo_actual');
        $alumnos_registro = DB::select('SELECT CONCAT(alumno.nombre," ",alumno.apaterno," ",alumno.amaterno) nombre, alumno.cuenta FROM gnral_alumnos alumno
                                        INNER JOIN exp_asigna_alumnos asigna
                                        ON asigna.id_alumno = alumno.id_alumno
                                        WHERE asigna.id_asigna_generacion = '.$id_asigna_generacion.' AND asigna.id_asigna_alumno NOT IN (SELECT id_asigna_alumno FROM tu_eva_resultados_formulario)
                                        GROUP BY  alumno.cuenta');

        //dd($alumnos_registro);
        $tutor=DB::selectOne('SELECT gnral_personales.nombre, tu_grupo_tutorias.descripcion semestre 
                            from gnral_personales, exp_asigna_tutor, tu_grupo_semestre, tu_grupo_tutorias WHERE
                            gnral_personales.id_personal = exp_asigna_tutor.id_personal  and tu_grupo_semestre.id_asigna_tutor = exp_asigna_tutor.id_asigna_tutor 
                            and tu_grupo_semestre.id_grupo_tutorias = tu_grupo_tutorias.id_grupo_tutorias and exp_asigna_tutor.id_asigna_generacion='.$id_asigna_generacion.'');
        $carrera=DB::selectOne('SELECT * FROM `gnral_carreras` WHERE `id_carrera` ='.$id_carrera.'');
        return view('tutorias.eva_tutorias.registro_index',compact('alumnos_registro','tutor','carrera','id_carrera') );
    }

    public function tutores_sin_registro() 
    {
        $periodo = Session::get('periodo_actual');

        $tutores = DB::SELECT('SELECT gnral_p.nombre nombre_tutor  FROM tu_grupo_tutorias tu_grupo_t
                                INNER JOIN tu_grupo_semestre tu_grupo_s
                                ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                INNER JOIN exp_asigna_tutor exp_asigna_t 
                                ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                INNER JOIN gnral_personales gnral_p 
                                ON gnral_p.id_personal = exp_asigna_t.id_personal 
                                INNER JOIN gnral_jefes_periodos gnral_j 
                                ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                INNER JOIN gnral_carreras car
                                ON car.id_carrera = gnral_j.id_carrera
                                where gnral_j.id_periodo = '.$periodo.'  and exp_asigna_t.id_asigna_tutor  not in (Select id_asigna_tutor from tu_eva_autoevaluacion )
                                GROUP BY gnral_p.nombre');
        //dd($tutores);

        return view('tutorias.eva_autoeva_tutor.tutores_sin_registro',compact('tutores'));

    }
    public function periodos($id_grupo_semestre,$grupo,$carrera)
    {
        $periodo = Session::get('periodo_actual');

        $datos1 = DB::SELECTONE('SELECT tu_grupo_s.id_grupo_semestre,exp_asigna_t.id_personal, exp_asigna_t.id_asigna_tutor, gnral_p.nombre nombre_tutor, car.nombre carrera,tu_grupo_t.descripcion grupo, now() fecha, gnral_p.tipo_usuario
                                FROM tu_grupo_tutorias tu_grupo_t
                                INNER JOIN tu_grupo_semestre tu_grupo_s
                                ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                INNER JOIN exp_asigna_tutor exp_asigna_t 
                                ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                INNER JOIN gnral_personales gnral_p 
                                ON gnral_p.id_personal = exp_asigna_t.id_personal 
                                INNER JOIN gnral_jefes_periodos gnral_j 
                                ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                INNER JOIN gnral_carreras car
                                ON car.id_carrera = gnral_j.id_carrera
                                WHERE tu_grupo_s.id_grupo_semestre = '.$id_grupo_semestre.' and gnral_j.id_periodo ='.$periodo.' ');
        $con_q = 'select count(*) con from tu_eva_fo17 where id_asigna_tutor = '.$datos1->id_asigna_tutor.' and per = 1 ';

        $con = DB::selectone($con_q);
        $con1 = $con->con;

        $id_usuario = Session::get('usuario_alumno');

        $id_usuario = Session::get('usuario_alumno');
        if ($id_usuario == $datos1->tipo_usuario ) 
            $igual = true;
        else
            $igual = false;

        return view('tutorias.eva_seguimiento_tu.periodos',compact('datos1','con1','igual'));
    }
 
    public function seguimiento($per,$id_grupo_semestre)
    {   
        $id_usuario = Session::get('usuario_alumno');
        //dd($per);
        $periodo = Session::get('periodo_actual');
        //dd($periodo);
        //dd($id_grupo_semestre);


        $datos1 = DB::SELECTONE('SELECT exp_asigna_t.id_asigna_tutor, gnral_p.nombre nombre_tutor, car.nombre carrera,tu_grupo_t.descripcion grupo, now() fecha, year(now()) ano, month(now()) mes, day(now()) dia
                                FROM tu_grupo_tutorias tu_grupo_t
                                INNER JOIN tu_grupo_semestre tu_grupo_s
                                ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                INNER JOIN exp_asigna_tutor exp_asigna_t 
                                ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                INNER JOIN gnral_personales gnral_p 
                                ON gnral_p.id_personal = exp_asigna_t.id_personal 
                                INNER JOIN gnral_jefes_periodos gnral_j 
                                ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                INNER JOIN gnral_carreras car
                                ON car.id_carrera = gnral_j.id_carrera
                                WHERE tu_grupo_s.id_grupo_semestre = '.$id_grupo_semestre.' and gnral_j.id_periodo ='.$periodo.' ');
        //dd($datos1);
        $con_q = 'select count(*) con from tu_eva_fo17 where id_asigna_tutor = '.$datos1->id_asigna_tutor.' and per = '.$per.' ';
        //dd($con_q);
        $con = DB::selectone($con_q);
        //dd($con);
        //dd("hola 1");
        if ($con->con == 0) {
            //dd('0');
            return view('tutorias.eva_seguimiento_tu.formato17',compact('datos1','per'));
        }
        else
        {
            //dd('2');
            $res = DB::selectone('select  id_fo17,id_asigna_tutor,per,IF(experiencia=1,"Si","No") experiencia,anos_tutor, IF(planeacion=1,"Si","No") planeacion,com_planeacion,fecha_establecida,fecha_final,(
                CASE 
                    WHEN tu.pregunta1 = 1 THEN "Mala"
                    WHEN tu.pregunta1 = 2 THEN "Regular"
                    WHEN tu.pregunta1 = 3 THEN "Buena"
                    WHEN tu.pregunta1 = 4 THEN "Muy buena"
                    WHEN tu.pregunta1 = 5 THEN "Excelente"
                END) pregunta1,
                (CASE 
                    WHEN tu.pregunta2 = 1 THEN "Mala"
                    WHEN tu.pregunta2 = 2 THEN "Regular"
                    WHEN tu.pregunta2 = 3 THEN "Buena"
                    WHEN tu.pregunta2 = 4 THEN "Muy buena"
                    WHEN tu.pregunta2 = 5 THEN "Excelente"
                END)pregunta2,
                (CASE 
                    WHEN tu.pregunta3 = 1 THEN "Mala"
                    WHEN tu.pregunta3 = 2 THEN "Regular"
                    WHEN tu.pregunta3 = 3 THEN "Buena"
                    WHEN tu.pregunta3 = 4 THEN "Muy buena"
                    WHEN tu.pregunta3 = 5 THEN "Excelente"
                END)pregunta3,
                (CASE 
                    WHEN tu.pregunta4 = 1 THEN "Mala"
                    WHEN tu.pregunta4 = 2 THEN "Regular"
                    WHEN tu.pregunta4 = 3 THEN "Buena"
                    WHEN tu.pregunta4 = 4 THEN "Muy buena"
                    WHEN tu.pregunta4 = 5 THEN "Excelente"
                END)pregunta4,
                (CASE
                    WHEN tu.pregunta5 = 1 THEN "Mala"
                    WHEN tu.pregunta5 = 2 THEN "Regular"
                    WHEN tu.pregunta5 = 3 THEN "Buena"
                    WHEN tu.pregunta5 = 4 THEN "Muy buena"
                    WHEN tu.pregunta5 = 5 THEN "Excelente"
                END)pregunta5,
                (CASE 
                    WHEN tu.pregunta6 = 1 THEN "Mala"
                    WHEN tu.pregunta6 = 2 THEN "Regular"
                    WHEN tu.pregunta6 = 3 THEN "Buena"
                    WHEN tu.pregunta6 = 4 THEN "Muy buena"
                    WHEN tu.pregunta6 = 5 THEN "Excelente"
                END)pregunta6,
                (CASE 
                    WHEN tu.pregunta7 = 1 THEN "Mala"
                    WHEN tu.pregunta7 = 2 THEN "Regular"
                    WHEN tu.pregunta7 = 3 THEN "Buena"
                    WHEN tu.pregunta7 = 4 THEN "Muy buena"
                    WHEN tu.pregunta7 = 5 THEN "Excelente"
                END)pregunta7,
                (CASE 
                    WHEN tu.pregunta8 = 1 THEN "Mala"
                    WHEN tu.pregunta8 = 2 THEN "Regular"
                    WHEN tu.pregunta8 = 3 THEN "Buena"
                    WHEN tu.pregunta8 = 4 THEN "Muy buena"
                    WHEN tu.pregunta8 = 5 THEN "Excelente"
                END)pregunta8,
                (CASE 
                    WHEN tu.pregunta9 = 1 THEN "Mala"
                    WHEN tu.pregunta9 = 2 THEN "Regular"
                    WHEN tu.pregunta9 = 3 THEN "Buena"
                    WHEN tu.pregunta9 = 4 THEN "Muy buena"
                    WHEN tu.pregunta9 = 5 THEN "Excelente"
                END)pregunta9,
                (CASE 
                    WHEN tu.pregunta10= 1 THEN "Mala"
                    WHEN tu.pregunta10 = 2 THEN "Regular"
                    WHEN tu.pregunta10 = 3 THEN "Buena"
                    WHEN tu.pregunta10 = 4 THEN "Muy buena"
                    WHEN tu.pregunta10 = 5 THEN "Excelente"
                END)pregunta10,
                comentario,fecha_registro  from tu_eva_fo17 tu where id_asigna_tutor = '.$datos1->id_asigna_tutor.' and per = '.$per.' ');
            /// id_fo17,id_asigna_tutor,id_asigna_cordinador,per,IF(experiencia=1,"Si","No") experiencia,anos_tutor, IF(planeacion=1,"Si","No") planeacion,com_planeacion,fecha_establecida,fecha_final,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6,pregunta7,pregunta8,pregunta9,pregunta10,comentario,fecha_registro
            
            //dd($res);

            return view('tutorias.eva_seguimiento_tu.resultado',compact('res','datos1'));
        }
        //dd($datos1);
        
    }
    public function seguimiento_guarda(Request $request)
    {
                                
        //dd($request);
        $this->validate($request,[
            "id_tiempo" => 'required',
            "anos" => 'required',
            "planeacion" => 'required',
            "ano_es" => 'required',
            "mes_es" => 'required',
            "dia_es" => 'required',
            "ano_re" => 'required',
            "mes_re" => 'required',
            "dia_re" => 'required',
            "pregunta1" => 'required',
            "pregunta2" => 'required',
            "pregunta3" => 'required',
            "pregunta4" => 'required',
            "pregunta5" => 'required',
            "pregunta6" => 'required',
            "pregunta7" => 'required',
            "pregunta8" => 'required',
            "pregunta9" => 'required',
            "pregunta10" => 'required',
        ]); 
        
        // INSERT INTO tu_eva_fo17 VALUES 
        // (NULL, {$request->id_asigna_tutor}, {$request->id_cordinador}, 
        // $request->per}, {$request->id_tiempo}, {$request->anos} , 
        // {$request->planeacion}, ' ' ,
        //  STR_TO_DATE('10 1 1000', '%d %m %Y'),
        //  STR_TO_DATE('20 2 2000', '%d %m %Y') , 
        // '5' , '5',
        // '5' , '5','5' , 
        // '5','5' , '5',
        // '5' , '5','com',now() )

        $query = ("  INSERT INTO tu_eva_fo17 VALUES 
        (NULL, {$request->id_asigna_tutor}, 
        '{$request->per}', '{$request->id_tiempo}', '{$request->anos}' , 
        '{$request->planeacion}', ' ' , 
        STR_TO_DATE('{$request->dia_es} {$request->mes_es} {$request->ano_es}','%d %m %Y'),
        STR_TO_DATE('{$request->dia_re} {$request->mes_re} {$request->ano_re}','%d %m %Y') , 
        '{$request->pregunta1}' , '{$request->pregunta2}',
        '{$request->pregunta3}' , '{$request->pregunta4}','{$request->pregunta5}' , 
        '{$request->pregunta6}','{$request->pregunta7}' , '{$request->pregunta8}',
        '{$request->pregunta9}' , '{$request->pregunta10}','{$request->comentarios}',now() ) ");

        //dd($query);

        DB::Insert($query);

        $con_q = 'select planeacion from tu_eva_fo17 where id_asigna_tutor = '.$request->id_asigna_tutor.' and per = '.$request->per.' ';
        //dd($con_q);
        $con = DB::selectone($con_q);
        //dd($con->planeacion);

        if ( $con->planeacion == 1 ) {
            //dd('1');
            return redirect()->back();
        }
        else
        {
            $come = DB::selectone('select * from tu_eva_fo17 where id_asigna_tutor = '.$request->id_asigna_tutor.' and per = '.$request->per.' ');
            return view('tutorias.eva_seguimiento_tu.com',compact('come'));
        }
        

    }
    public function com(Request $request)
    {
        $this->validate($request,[
            "comentarios" => 'required',
        ]); 
        //dd($request);
        $query = "UPDATE tu_eva_fo17 SET com_planeacion = '{$request->comentarios}' WHERE per = {$request->per} and id_asigna_tutor = {$request->id_asigna_tutor} ";
        //dd($query);
        DB::UPDATE($query);

        return redirect('/tutoras_evaluacion/resultado_tutorias_jefe/');
    }

    public function fo40()
    {
        $per1 = DB::selectOne("select (case
                                    when month(now()) = 03 then 'Enero-Marzo'
                                    when month(now()) = 04 then 'Enero-Marzo'
                                    when month(now()) = 05 then 'Enero-Marzo'
                                    when month(now()) = 06 then 'Abril-Mayo'
                                    when month(now()) = 07 then 'Abril-Mayo'
                                    when month(now()) = 08 then 'Abril-Mayo'
                                    
                                    when month(now()) = 09 then 'Sep-Nov'
                                    when month(now()) = 10 then 'Sep-Nov'
                                    when month(now()) = 11 then 'Sep-Nov'
                                    when month(now()) = 12 then 'Dic-Feb'
                                    when month(now()) = 01 then 'Dic-Feb'
                                    when month(now()) = 02 then 'Dic-Feb'
                                    end ) as per");

        $per2 = DB::selectOne("select (case
                                    when month(now()) + 3 = 03 then 'Enero-Marzo'
                                    when month(now()) + 2 = 04 then 'Enero-Marzo'
                                    when month(now()) + 1 = 05 then 'Enero-Marzo'
                                    when month(now()) + 3 = 06 then 'Abril-Mayo'
                                    when month(now()) + 2 = 07 then 'Abril-Mayo'
                                    when month(now()) + 1 = 08 then 'Abril-Mayo'
                                    
                                    when month(now()) + 3 = 09 then 'Sep-Nov'
                                    when month(now()) + 2 = 10 then 'Sep-Nov'
                                    when month(now()) + 1 = 11 then 'Sep-Nov'
                                    when month(now()) + 3 = 12 then 'Dic-Feb'
                                    when month(now()) + 2 = 01 then 'Dic-Feb'
                                    when month(now()) + 1 = 02 then 'Dic-Feb'
                                    end ) as per");

        $c = DB::selectOne('SELECT  IF(MONTH(CURRENT_DATE()) IN (3,11), 1, 0) AS c');
       /// $c = DB::selectOne('SELECT  IF(MONTH(CURRENT_DATE()) IN (3,11), 1, 0) AS c'); se modifico el 5 por el 3, que es correspondiente al mes de marzo
        //$c = DB::selectOne('SELECT  IF(MONTH(CURRENT_DATE()) IN (9), 1, 0) AS c');
        //dd($c);
        //dd('hola');
        $periodo=Session::get('periodo_actual');
        $existen = DB::Selectone("SELECT COUNT(*) con FROM tu_eva_fo40 WHERE periodo =  '{$periodo}' ");
        $con = [
            "con" => "1"
        ];
        if ($existen->con != 0){
            $con = DB::Selectone("SELECT con FROM tu_eva_fo40 WHERE periodo =  '{$periodo}' ");
            //dd($con);

            $per1 = DB::selectOne(" select res1 per from tu_eva_fo40 where periodo = '{$periodo}'  limit 1 ");
            $per2 = DB::selectOne(" select res2 per from tu_eva_fo40 where periodo = '{$periodo}'  limit 1 ");

            $c = DB::selectOne('SELECT  IF(MONTH(CURRENT_DATE()) IN (8, 2), 1, 0) AS c');

            //dd($per1);
        }
        if (empty($con)) {
            $con = [
                "con" => "0"
            ];
        }
        //dd($con);
        return view('tutorias.FO-40.periodo', compact('existen','per1','per2','con','periodo','c'));
    }

    public function fo_40()
    {
        $periodo=Session::get('periodo_actual');
        $id_usuario = Session::get('usuario_alumno');
        //dd($periodo);
        //dd($id_usuario);
        $cordinadores = DB::Select(" SELECT car.nombre carrera, per.*, cor.id_asigna_coordinador 
                                    FROM gnral_personales per
                                    INNER JOIN exp_asigna_coordinador cor
                                    ON cor.id_personal = per.id_personal
                                    INNER JOIN gnral_jefes_periodos je
                                    ON je.id_jefe_periodo = cor.id_jefe_periodo
                                    INNER JOIN gnral_carreras car
                                    ON car.id_carrera = je.id_carrera
                                    WHERE je.id_periodo = '{$periodo}'
                                    GROUP BY  car.nombre ");

        //dd($cordinadores);

        $existen = DB::Selectone("SELECT COUNT(*) con FROM tu_eva_fo40 WHERE periodo =  '{$periodo}' AND id_personal = '{$id_usuario}' ");
        //dd($existen);

        $per = DB::selectOne("select (case
                                    when month(now()) = 03 then 'Enero-Marzo'
                                    when month(now()) = 04 then 'Enero-Marzo'
                                    when month(now()) = 05 then 'Enero-Marzo'
                                    when month(now()) = 06 then 'Abril-Mayo'
                                    when month(now()) = 07 then 'Abril-Mayo'
                                    when month(now()) = 08 then 'Abril-Mayo'
                                    
                                    when month(now()) = 09 then 'Sep-Nov'
                                    when month(now()) = 10 then 'Sep-Nov'
                                    when month(now()) = 11 then 'Sep-Nov'
                                    when month(now()) = 12 then 'Dic-Feb'
                                    when month(now()) = 01 then 'Dic-Feb'
                                    when month(now()) = 02 then 'Dic-Feb'
                                    end ) as per");

        $per2 = DB::selectOne("select (case
                                    when month(now()) + 3 = 03 then 'Enero-Marzo'
                                    when month(now()) + 2 = 04 then 'Enero-Marzo'
                                    when month(now()) + 1 = 05 then 'Enero-Marzo'
                                    when month(now()) + 3 = 06 then 'Abril-Mayo'
                                    when month(now()) + 2 = 07 then 'Abril-Mayo'
                                    when month(now()) + 1 = 08 then 'Abril-Mayo'
                                    
                                    when month(now()) + 3 = 09 then 'Septiembre - Noviembre'
                                    when month(now()) + 2 = 10 then 'Septiembre - Noviembre'
                                    when month(now()) + 1 = 11 then 'Septiembre - Noviembre'
                                    when month(now()) + 3 = 12 then 'Diciembre - Febrero'
                                    when month(now()) + 2 = 01 then 'Diciembre - Febrero'
                                    when month(now()) + 1 = 02 then 'Diciembre - Febrero'
                                    end ) as per");
        //dd($per);
        if ($existen->con == 0)
        {
            $con = 0;
            $comentarios = '';
            //dd('entro');
            return view('tutorias.FO-40.index', compact('cordinadores','id_usuario', 'per','con','per2') );

        }
        else
        {
            $con = 1;
            $comentarios = DB::Select("SELECT com FROM tu_eva_fo40 WHERE periodo =  '{$periodo}' AND id_personal = '{$id_usuario}' ");
            $condicion = DB::selectone(" SELECT
                                        IF(se2 IS NOT NULL, 'Si', 'No') c
                                    FROM
                                        tu_eva_fo40
                                    WHERE
                                        periodo = '{$periodo}'  ");

            if ($condicion->c == 'Si') {
                //dd('pdf');
                $datos = DB::select(" select gc.nombre carrera,gp.nombre nombre,
                                                   (case
                                                       when f.se1 = 1 then 'Cumplió'
                                                       when f.se1 = 2 then 'No cumplió'
                                                       when f.se1 = 3 then 'Avance 75%'
                                                       when f.se1 = 4 then 'Avance 50%'
                                                       when f.se1 = 5 then 'Avance 25%'
                                                    end) se1,
                                                    (case
                                                       when f.se2 = 1 then 'Cumplió'
                                                       when f.se2 = 2 then 'No cumplió'
                                                       when f.se2 = 3 then 'Avance 75%'
                                                       when f.se2 = 4 then 'Avance 50%'
                                                       when f.se2 = 5 then 'Avance 25%'
                                                    end) se2,
                                                    concat(f.com,'  ',f.com2) com, res1, res2
                                            from tu_eva_fo40 f
                                            inner join exp_asigna_coordinador eac on f.id_asigna_coordinador = eac.id_asigna_coordinador
                                            inner join gnral_personales gp on eac.id_personal = gp.id_personal
                                            inner join gnral_jefes_periodos gjp on eac.id_jefe_periodo = gjp.id_jefe_periodo
                                            inner join gnral_carreras gc on gjp.id_carrera = gc.id_carrera
                                            where f.periodo =  '{$periodo}' ");
                //dd($datos);
                return view('tutorias.FO-40.resultados', compact('datos','periodo') );
                //dd($datos);
            }
            else{
                return view('tutorias.FO-40.index', compact('cordinadores','id_usuario', 'per','per2','con') );
            }
            //dd($comentarios);
        }
        //dd($con);
        return view('tutorias.FO-40.index', compact('cordinadores','id_usuario', 'per') );
        
    }
    public function fo_40_guarda(Request $request)
    {
        $periodo=Session::get('periodo_actual');
        //dd($request);
        $numeroElementos = count($request->id_asigna_coordinador);
        //dd($numeroElementos);
        $resultado = array($request->carrera, $request->se1, $request->se2, $request->com);

        $per = DB::selectOne("select (case
                                    when month(now()) = 03 then 'Enero-Marzo'
                                    when month(now()) = 04 then 'Enero-Marzo'
                                    when month(now()) = 05 then 'Enero-Marzo'
                                    when month(now()) = 06 then 'Abril-Mayo'
                                    when month(now()) = 07 then 'Abril-Mayo'
                                    when month(now()) = 08 then 'Abril-Mayo'
                                    
                                    when month(now()) = 09 then 'Sep-Nov'
                                    when month(now()) = 10 then 'Sep-Nov'
                                    when month(now()) = 11 then 'Sep-Nov'
                                    when month(now()) = 12 then 'Dic-Feb'
                                    when month(now()) = 01 then 'Dic-Feb'
                                    when month(now()) = 02 then 'Dic-Feb'
                                    end ) as per");

        $per2 = DB::selectOne("select (case
                                    when month(now()) + 3 = 03 then 'Enero-Marzo'
                                    when month(now()) + 2 = 04 then 'Enero-Marzo'
                                    when month(now()) + 1 = 05 then 'Enero-Marzo'
                                    when month(now()) + 3 = 06 then 'Abril-Mayo'
                                    when month(now()) + 2 = 07 then 'Abril-Mayo'
                                    when month(now()) + 1 = 08 then 'Abril-Mayo'
                                    
                                    when month(now()) + 5 = 09 then 'Sep-Nov'
                                    when month(now()) + 4 = 10 then 'Sep-Nov'
                                    when month(now()) + 3 = 11 then 'Sep-Nov'
                                    when month(now()) + 5 = 12 then 'Dic-Feb'
                                    when month(now()) + 4 = 01 then 'Dic-Feb'
                                    when month(now()) + 3 = 02 then 'Dic-Feb'
                                    end ) as per");

        if ($request->i == 1) {
            for ($i=0; $i < $numeroElementos  ; $i++) 
            { 
                DB::insert(" INSERT INTO tu_eva_fo40 VALUES (null, '{$periodo}','{$request->id_personal}', '{$request->id_asigna_coordinador[$i]}', '{$request->se1[$i]}', null,  '{$request->com[$i]}', '',now(),now(), '{$per->per}', '{$per2->per}', 1 ) ");
            }
            
        }
        if ($request->i == 2) {
            //dd($request);
            for ($i=0; $i < $numeroElementos  ; $i++) 
            { 
                DB::update(" UPDATE tu_eva_fo40 SET se2 = '{$request->se2[$i]}' ,com2 = '{$request->com[$i]}' ,fecha_registro2 = now(), con = 2 WHERE id_asigna_coordinador = '{$request->id_asigna_coordinador[$i]}' and periodo = '{$periodo}' ");
            }
        }
        return redirect('/tutorias/FO-40');
        //dd($resultado);
    }
}

