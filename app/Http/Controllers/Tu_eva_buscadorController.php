<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eva_Tutor;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Storage;
use Session;

class Tu_eva_buscadorController extends Controller
{
    public function  grupo($id_grupo_semestre){
        //dd($id_grupo_semestre);
        $id_usuario = Session::get('usuario_alumno');
        //dd($id_usuario);
        $periodo=Session::get('periodo_actual');
        $tutores = DB::SELECTone('SELECT exp_asigna_t.id_asigna_tutor, gnral_j.id_carrera FROM tu_grupo_tutorias tu_grupo_t
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
                              WHERE gnral_j.id_periodo = ? AND gnral_p.tipo_usuario =  ? AND tu_grupo_s.id_grupo_semestre = ? ', [$periodo, $id_usuario, $id_grupo_semestre]);

        $tutor = DB::SELECTONE('SELECT exp_asigna_t.id_asigna_generacion,tu_grupo_s.id_grupo_semestre,car.nombre carrera, car.id_carrera, tu_grupo_t.descripcion grupo, gnral_p.nombre nombre_tutor, gnral_p.tipo_usuario tipo FROM tu_grupo_tutorias tu_grupo_t
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
                            WHERE gnral_j.id_periodo = ? AND car.id_carrera = ? AND gnral_p.tipo_usuario =  ? ', [$periodo, $tutores->id_carrera, $id_usuario]);
        //dd($tutor);


        $datos_alumnos = DB::select('SELECT alumno.cuenta, CONCAT(alumno.nombre," ",alumno.apaterno," ",alumno.amaterno) nombre, alumno.genero, alumno.fecha_nac, (year(now())-year(alumno.fecha_nac)) edad, correo_al correo, alumno.edo_civil estado, alumno.discapacidad, ef.etnia_indigena
                                    FROM gnral_alumnos alumno
                                    INNER JOIN exp_asigna_alumnos asigna
                                    ON asigna.id_alumno = alumno.id_alumno
                                    inner join exp_datos_familiares ef
                                    on alumno.id_alumno = ef.id_alumno
                                    WHERE asigna.id_asigna_generacion = ?
                                    GROUP BY  alumno.cuenta', [$tutor->id_asigna_generacion]);

        //dd($datos_alumnos);
        $array = array(
            'estudiantes' =>$datos_alumnos,
        );
        //dd($array);
        $json = json_encode($datos_alumnos);

        return view('tutorias.eva_buscador.index',compact('datos_alumnos','json'));
        //dd($tutores);
    }
    public function index()
    {
        $id_usuario = Session::get('usuario_alumno');
        //dd($id_usuario);
        $periodo=Session::get('periodo_actual');
        //dd($periodo);

        $cuenta = DB::selectOne('SELECT count(*) as cuenta FROM tu_grupo_tutorias tu_grupo_t
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
                              WHERE gnral_j.id_periodo = ? AND gnral_p.tipo_usuario =  ? ', [$periodo, $id_usuario]);
        //dd($cuenta);

       ///dd($tutores);

        if ($cuenta->cuenta == 1){
            $tutores = DB::SELECTone('SELECT exp_asigna_t.id_asigna_tutor, gnral_j.id_carrera FROM tu_grupo_tutorias tu_grupo_t
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
                              WHERE gnral_j.id_periodo = ? AND gnral_p.tipo_usuario =  ?  ', [$periodo, $id_usuario]);

            $carreras = DB::selectOne('SELECT car.nombre FROM gnral_carreras car WHERE car.id_carrera = ? ', [$tutores->id_carrera]);
            //dd($carreras);




            $tutor = DB::SELECTONE('SELECT exp_asigna_t.id_asigna_generacion,tu_grupo_s.id_grupo_semestre,car.nombre carrera, car.id_carrera, tu_grupo_t.descripcion grupo, gnral_p.nombre nombre_tutor, gnral_p.tipo_usuario tipo FROM tu_grupo_tutorias tu_grupo_t
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
                            WHERE gnral_j.id_periodo = ? AND car.id_carrera = ? AND gnral_p.tipo_usuario =  ? ', [$periodo, $tutores->id_carrera, $id_usuario]);
            //dd($tutor);


            $datos_alumnos = DB::select('SELECT alumno.cuenta, CONCAT(alumno.nombre," ",alumno.apaterno," ",alumno.amaterno) nombre, alumno.genero, alumno.fecha_nac, (year(now())-year(alumno.fecha_nac)) edad, correo_al correo, alumno.edo_civil estado, alumno.discapacidad, ef.etnia_indigena
                                    FROM gnral_alumnos alumno
                                    INNER JOIN exp_asigna_alumnos asigna
                                    ON asigna.id_alumno = alumno.id_alumno
                                    inner join exp_datos_familiares ef
                                    on alumno.id_alumno = ef.id_alumno
                                    WHERE asigna.id_asigna_generacion = ?
                                    GROUP BY  alumno.cuenta', [$tutor->id_asigna_generacion]);

            //dd($datos_alumnos);
            $array = array(
                'estudiantes' =>$datos_alumnos,
            );
            //dd($array);
            $json = json_encode($datos_alumnos);
            return view('tutorias.eva_buscador.index',compact('datos_alumnos','json'));
        }
        else{
            $tutores = DB::SELECT('SELECT tu_grupo_s.id_grupo_semestre,car.nombre carrera, tu_grupo_t.descripcion grupo FROM tu_grupo_tutorias tu_grupo_t
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
                              WHERE gnral_j.id_periodo = ? AND gnral_p.tipo_usuario =  ?  ', [$periodo, $id_usuario]);
            //dd($tutores);
            return view('tutorias.eva_buscador.grupos',compact('tutores'));
        }

        //dd($json);
        //dd('hola');


    }
    public function index_cor_car()
    {
        $periodo = Session::get('periodo_actual');
        //dd($periodo);

        $datos = DB::select(' select c.id_carrera,c.nombre, sum(case when ga.genero = \'M\' then 1 else 1 end) total,
                                           sum(case when ga.genero = \'M\' then 1 else 0 end) t_m,
                                           sum(case when ga.genero = \'F\' then 1 else 0 end) t_f,
                                           sum(case when ga.discapacidad = \'2\' then 1 else 0 end) discapacidad,
                                           sum(case when ga.lengua = \'2\' then 1 else 0 end) lengua,
                                           sum(case when eg.no_hijos = \'1\' then 0 else 1 end) padres,
                                           sum(case when eg.beca = \'1\' then 1 else 0 end) beca,
                                           sum(case when edf.etnia_indigena = \'1\' then 1 else 0 end) etina
                                    from gnral_carreras c
                                    inner join gnral_jefes_periodos gjp on c.id_carrera = gjp.id_carrera
                                    inner join exp_asigna_generacion eag on gjp.id_jefe_periodo = eag.id_jefe_periodo
                                    inner join exp_asigna_alumnos eaa on eag.id_asigna_generacion = eaa.id_asigna_generacion
                                    inner join gnral_alumnos ga on ga.id_alumno = eaa.id_alumno
                                    inner join exp_generales eg on ga.id_alumno = eg.id_alumno
                                    inner join exp_datos_familiares edf on eg.id_alumno = edf.id_alumno
                                    where gjp.id_periodo = ? and ga.nombre in (select a.nombre from gnral_alumnos a
                                                                                inner join exp_asigna_alumnos e on a.id_alumno = e.id_alumno
                                                                                group by a.cuenta)
                                    group by c.nombre
                                    order by c.id_carrera asc  ', [$periodo]);

        //dd($datos);
        return view('tutorias.eva_buscador.cor_car',compact('datos'));
    }
    public function grupo_a($id_carrera)
    {
        //set_time_limit(120);
        if ($id_carrera == 0)
        {
            $id_usuario = Session::get('usuario_alumno');

            $carrera = DB::selectOne(' select gc.id_carrera
                                            from gnral_personales gp
                                            inner join exp_asigna_coordinador ec on gp.id_personal = ec.id_personal
                                            inner join exp_asigna_generacion eag on ec.id_jefe_periodo = eag.id_jefe_periodo
                                            inner join gnral_jefes_periodos gjp on eag.id_jefe_periodo = gjp.id_jefe_periodo
                                            inner join gnral_carreras gc on gjp.id_carrera = gc.id_carrera
                                            where gp.tipo_usuario = ?
                                            limit 1 ', [$id_usuario]);

            $id_carrera = $carrera->id_carrera;

        }
        $periodo = Session::get('periodo_actual');
        //dd($periodo);

        $datos = DB::select(' SELECT tu_grupo_t.descripcion grupo,tu_grupo_s.id_grupo_semestre,
                                           sum(case when ga.genero = \'M\' then 1 else 1 end) total,
                                           sum(case when ga.genero = \'M\' then 1 else 0 end) t_m,
                                           sum(case when ga.genero = \'F\' then 1 else 0 end) t_f,
                                           sum(case when ga.discapacidad = \'2\' then 1 else 0 end) discapacidad,
                                           sum(case when ga.lengua = \'2\' then 1 else 0 end) lengua,
                                           sum(case when eg.no_hijos = \'1\' then 0 else 1 end) padres,
                                           sum(case when eg.beca = \'1\' then 0 else 1 end)beca,
                                           sum(case when edf.etnia_indigena = \'1\' then 1 else 0 end) etina
                                    FROM tu_grupo_tutorias tu_grupo_t
                                    INNER JOIN tu_grupo_semestre tu_grupo_s
                                    ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                    INNER JOIN exp_asigna_tutor exp_asigna_t
                                    ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                    INNER JOIN gnral_jefes_periodos gnral_j
                                    ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                    INNER JOIN gnral_carreras car
                                    ON car.id_carrera = gnral_j.id_carrera
                                    inner join exp_asigna_alumnos eaa
                                    on exp_asigna_t.id_asigna_generacion = eaa.id_asigna_generacion
                                    inner join gnral_alumnos ga
                                    on eaa.id_alumno = ga.id_alumno
                                    inner join exp_generales eg
                                    on ga.id_alumno = eg.id_alumno
                                    inner join exp_datos_familiares edf
                                    on eaa.id_alumno = edf.id_alumno
                                    WHERE gnral_j.id_periodo = ? AND car.id_carrera = ?
                                    and ga.nombre in (select a.nombre from gnral_alumnos a
                                                    inner join exp_asigna_alumnos e
                                                    on a.id_alumno = e.id_alumno
                                                    group by a.cuenta)
                                    group by tu_grupo_s.id_grupo_semestre', [$periodo, $id_carrera]);

        //dd($datos);
        return view('tutorias.eva_buscador.grupos_car',compact('datos'));
        //dd($id_carrera);
    }
    public function grupos_tutor(){
        $id_usuario = Session::get('usuario_alumno');
        abort(501, 'Funcionalidad no disponible.');
    }
    public function busca_grupo($id_grupo_semestre){
        $periodo=Session::get('periodo_actual');

        if($id_grupo_semestre == 0)
        {
            $id_usuario = Session::get('usuario_alumno');
            //dd($id_usuario);
            $tutores = DB::SELECT('SELECT tu_grupo_s.id_grupo_semestre,car.nombre carrera, tu_grupo_t.descripcion grupo FROM tu_grupo_tutorias tu_grupo_t
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
                              WHERE gnral_j.id_periodo = ? AND gnral_p.tipo_usuario =  ?  ', [$periodo, $id_usuario]);

            return view('tutorias.eva_buscador.grupos_tutor',compact('tutores') );


        }
        $tutores = DB::SELECTone('SELECT exp_asigna_t.id_asigna_tutor, gnral_j.id_carrera FROM tu_grupo_tutorias tu_grupo_t
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
                              WHERE gnral_j.id_periodo = ? AND tu_grupo_s.id_grupo_semestre = ? ', [$periodo, $id_grupo_semestre]);

        //dd($tutores);

        $tutor = DB::SELECTONE('SELECT exp_asigna_t.id_asigna_generacion,tu_grupo_s.id_grupo_semestre,car.nombre carrera, car.id_carrera, tu_grupo_t.descripcion grupo, gnral_p.nombre nombre_tutor, gnral_p.tipo_usuario tipo FROM tu_grupo_tutorias tu_grupo_t
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
                            WHERE gnral_j.id_periodo = ? AND car.id_carrera = ? AND exp_asigna_t.id_asigna_tutor =  ? ', [$periodo, $tutores->id_carrera, $tutores->id_asigna_tutor]);
        //dd($tutor);

        $datos_alumnos = DB::select('SELECT alumno.cuenta, CONCAT(alumno.nombre," ",alumno.apaterno," ",alumno.amaterno) nombre, alumno.genero, alumno.fecha_nac, (year(now())-year(alumno.fecha_nac)) edad, correo_al correo, alumno.edo_civil estado, alumno.discapacidad, ef.etnia_indigena
                                    FROM gnral_alumnos alumno
                                    INNER JOIN exp_asigna_alumnos asigna
                                    ON asigna.id_alumno = alumno.id_alumno
                                    inner join exp_datos_familiares ef
                                    on alumno.id_alumno = ef.id_alumno
                                    WHERE asigna.id_asigna_generacion = ?
                                    GROUP BY  alumno.cuenta', [$tutor->id_asigna_generacion]);


        $datos_a = DB::selectOne(' SELECT tu_grupo_t.descripcion grupo,
                                           sum(case when ga.genero = \'M\' then 1 else 1 end) total,
                                           sum(case when ga.genero = \'M\' then 1 else 0 end) t_m,
                                           sum(case when ga.genero = \'F\' then 1 else 0 end) t_f,
                                           sum(case when ga.discapacidad = \'2\' then 1 else 0 end) discapacidad,
                                           sum(case when ga.lengua = \'2\' then 1 else 0 end) lengua,
                                           sum(case when eg.no_hijos = \'1\' then 0 else 1 end) padres,
                                           sum(case when eg.beca = \'1\' then 0 else 1 end)beca,
                                           sum(case when edf.etnia_indigena = \'1\' then 1 else 0 end) etina
                                    FROM tu_grupo_tutorias tu_grupo_t
                                    INNER JOIN tu_grupo_semestre tu_grupo_s
                                    ON tu_grupo_s.id_grupo_tutorias = tu_grupo_t.id_grupo_tutorias
                                    INNER JOIN exp_asigna_tutor exp_asigna_t
                                    ON exp_asigna_t.id_asigna_tutor = tu_grupo_s.id_asigna_tutor
                                    INNER JOIN gnral_jefes_periodos gnral_j
                                    ON gnral_j.id_jefe_periodo = exp_asigna_t.id_jefe_periodo
                                    INNER JOIN gnral_carreras car
                                    ON car.id_carrera = gnral_j.id_carrera
                                    inner join exp_asigna_alumnos eaa
                                    on exp_asigna_t.id_asigna_generacion = eaa.id_asigna_generacion
                                    inner join gnral_alumnos ga
                                    on eaa.id_alumno = ga.id_alumno
                                    inner join exp_generales eg
                                    on ga.id_alumno = eg.id_alumno
                                    inner join exp_datos_familiares edf
                                    on eaa.id_alumno = edf.id_alumno
                                    WHERE gnral_j.id_periodo = ? AND tu_grupo_s.id_grupo_semestre = ?
                                    and ga.nombre in (select a.nombre from gnral_alumnos a
                                                    inner join exp_asigna_alumnos e
                                                    on a.id_alumno = e.id_alumno
                                                    group by a.cuenta)
                                    group by tu_grupo_s.id_grupo_semestre', [$periodo, $id_grupo_semestre]);


        //dd($datos_a);
        $array = array(
            'estudiantes' =>$datos_alumnos,
        );
        //dd($array);
        $json = json_encode($datos_alumnos);
        //dd($datos_alumnos);

        return view('tutorias.eva_buscador.index',compact('datos_alumnos','json', 'datos_a'));
        //dd($tutores);
    }
    public function borrar(Request $request,$id_asigna_planeacion_tutor1 ){
        //dd($id_asigna_planeacion_tutor1);

        DB::delete(' DELETE FROM plan_asigna_planeacion_tutor WHERE id_asigna_planeacion_tutor = ?', [$id_asigna_planeacion_tutor1]);

    }


}
