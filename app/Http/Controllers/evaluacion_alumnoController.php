<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Preguntas;
use App\Alumnos;
use App\Personal;
use App\materias;
use App\materias_perfil;
use App\Horarios;
use App\horas_profesor;
use App\grupos;
use App\PeriodosCarreras;
use App\Carreras;
use App\Periodos;
use App\CargaAcademica;
use App\ValidacionCarga;
use App\alumno_materias;
use App\Eva_docente_comentarios;

class evaluacion_alumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index()
{
    $docentes = 0;
    $docentes_especial = 0;
    $materiase = 0;
    $indice = 0;

    $periodo = Session::get('periodo_actual');
    $usuario = Session::get('usuario');
    $carrera = Session::get('carrera');

    // Obtener el identificador del alumno
    $id_alu = DB::selectOne(
        "SELECT id_alumno
         FROM gnral_alumnos
         WHERE cuenta = ?",
        [$usuario]
    );

    $id_alu = $id_alu->id_alumno;

    // Obtener el avance de evaluación
    $no_pregunta = DB::selectOne(
        "SELECT id, no_pregunta, estado_validacion
         FROM eva_validacion_de_cargas
         WHERE id_alumno = ?
         AND id_periodo = ?
         AND estado_validacion = 2",
        [$id_alu, $periodo]
    );

    $docentes = array();

    if ($no_pregunta == null) {

        $color = 1;
        $mensage_carga = 'Tu carga académica no ha sido dada de alta';

        return view(
            'evaluacion_docente.Alumnos.mensages',
            compact('mensage_carga', 'color')
        );

    } else {

        $estado_estudiante = DB::selectOne(
            "SELECT COUNT(id) AS contar
             FROM eva_validacion_de_cargas
             WHERE id_alumno = ?
             AND id_periodo = ?
             AND estado_validacion = 2",
            [$id_alu, $periodo]
        );

        $estado_estudiante = $estado_estudiante->contar;

        if ($estado_estudiante == 0) {

            $estado_est_dual = DB::selectOne(
                "SELECT COUNT(id) AS contar
                 FROM eva_validacion_de_cargas
                 WHERE id_alumno = ?
                 AND id_periodo = ?
                 AND estado_validacion = 8",
                [$id_alu, $periodo]
            );

            if ($estado_est_dual->contar == 0) {
                return view('evaluacion_docente.Alumnos.mensaje_modi_carga');
            } else {
                return view('evaluacion_docente.Alumnos.mensaje_dual');
            }

        } else {

            $no = $no_pregunta->no_pregunta;
            $id_tabla = $no_pregunta->id;
            $estado = $no_pregunta->estado_validacion;

            $num = 10;

            /*
             * Pregunta inicial
             */
            if ($no == 0) {

                $id_pregunta = 1;
                $pregunta = 1;

                $pre = DB::selectOne(
                    "SELECT no_pregunta, descripcion
                     FROM eva_pregunta
                     WHERE no_pregunta = ?",
                    [$pregunta]
                );

                // Consultar los docentes que corresponden a la carga del alumno
                $docentes = DB::select(
                    "SELECT DISTINCT
                        gnral_personales.nombre,
                        gnral_materias.nombre AS materias,
                        gnral_horas_profesores.grupo,
                        gnral_horas_profesores.id_hrs_profesor,
                        gnral_materias.id_semestre,
                        gnral_materias.especial
                    FROM gnral_alumnos,
                         gnral_personales,
                         gnral_materias,
                         gnral_materias_perfiles,
                         gnral_horarios,
                         gnral_horas_profesores,
                         gnral_periodo_carreras,
                         gnral_carreras,
                         gnral_periodos,
                         eva_carga_academica,
                         eva_validacion_de_cargas
                    WHERE gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
                    AND gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
                    AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
                    AND gnral_horarios.id_personal = gnral_personales.id_personal
                    AND gnral_materias_perfiles.id_materia = gnral_materias.id_materia
                    AND gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
                    AND gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
                    AND gnral_periodos.id_periodo = ?
                    AND eva_carga_academica.id_status_materia = 1
                    AND eva_carga_academica.id_periodo = gnral_periodos.id_periodo
                    AND eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
                    AND eva_carga_academica.id_materia = gnral_materias.id_materia
                    AND gnral_alumnos.cuenta = ?
                    AND eva_carga_academica.grupo = gnral_horas_profesores.grupo
                    AND eva_validacion_de_cargas.id_alumno = gnral_alumnos.id_alumno
                    AND eva_validacion_de_cargas.id_periodo = gnral_periodos.id_periodo
                    AND eva_validacion_de_cargas.estado_validacion = 2",
                    [$periodo, $usuario]
                );

                $docentes_especial = 0;
                $condicion = 0;
                $materiase = 0;

            }

            /*
             * Preguntas de la 1 a la 48
             */
            if ($no < 49 && $no >= 1) {

                $pre = DB::selectOne(
                    "SELECT no_pregunta, descripcion
                     FROM eva_pregunta
                     WHERE no_pregunta = ?",
                    [$no]
                );

                $pregunta = $pre->descripcion;
                $id_pregunta = $pre->no_pregunta;

                $docentes_especial = 0;
                $condicion = 0;
                $materiase = 0;

            }

            /*
             * Evaluación finalizada
             */
            if ($no == 49) {

                $condicion = 0;

                $id_pregunta = 49;
                $pregunta = "Evaluacion Finalizada";

            }

            /*
             * CONSULTA ÚNICA DE PROFESORES
             *
             * Antes estaba repetida en las tres condiciones:
             * pregunta 0, preguntas 1-48 y pregunta 49.
             */
            if ($no >= 0 && $no <= 49) {

                $profesores = DB::select(
                    "SELECT DISTINCT
                        hrs_rhps.id_hrs_profesor,
                        gnral_personales.id_personal,
                        gnral_personales.id_personal AS indice,
                        gnral_personales.nombre AS p,
                        gnral_materias.id_materia,
                        gnral_materias.nombre AS ma,
                        gnral_grupos.grupo,
                        eva_alumno_materias.id_alumno_materia
                    FROM gnral_personales,
                         gnral_horas_profesores,
                         gnral_materias,
                         gnral_carreras,
                         gnral_horarios,
                         gnral_materias_perfiles,
                         gnral_grupos,
                         gnral_periodo_carreras,
                         gnral_periodos,
                         hrs_rhps,
                         eva_alumno_materias
                    WHERE gnral_personales.id_personal = gnral_horarios.id_personal
                    AND gnral_personales.id_personal = gnral_materias_perfiles.id_personal
                    AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
                    AND gnral_horarios.id_horario_profesor = gnral_horas_profesores.id_horario_profesor
                    AND gnral_horas_profesores.grupo = gnral_grupos.id_grupo
                    AND gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
                    AND gnral_materias_perfiles.id_materia = gnral_materias.id_materia
                    AND gnral_periodo_carreras.id_carrera = gnral_carreras.id_carrera
                    AND gnral_periodo_carreras.id_periodo = gnral_periodos.id_periodo
                    AND gnral_periodo_carreras.id_periodo = ?
                    AND hrs_rhps.id_hrs_profesor = gnral_horas_profesores.id_hrs_profesor
                    AND eva_alumno_materias.cuenta = ?
                    AND eva_alumno_materias.id_hrs_profesor = hrs_rhps.id_hrs_profesor",
                    [$periodo, $usuario]
                );

                /*
                 * Numerar profesores solamente cuando
                 * la evaluación ya inició.
                 */
                if ($no >= 1) {

                    $num = count($profesores);

                    for ($i = 0; $i < $num; $i++) {
                        $profesores[$i]->indice = $i + 1;
                    }

                }

            }

            return view(
                'evaluacion_docente.Alumnos.evaluacion_docente',
                compact(
                    'condicion',
                    'materiase',
                    'docentes_especial',
                    'id_pregunta',
                    'pregunta',
                    'id_tabla',
                    'no',
                    'estado',
                    'docentes',
                    'profesores',
                    'indice',
                    'num'
                )
            );

        }
    }
}
    public function insertar(Request $request, $arreglo)
    {
        //dd($arreglo);



        $usuario = Session::get('usuario');
        $datos=(explode(',',$arreglo));//
        $num=count($datos);//obtiene el numero de elementos del arreglo
        $numm=$num-2;//
        $mitad=$numm/2;
        //  dd($mitad);
        $pregunta=$datos[0];//se obtiene el numero de la pregunta
        $tabla=$datos[1];//se obtiene el id_de la tabala para saber que elemento modificar


        $datoss=array(

            'no_pregunta'=>$pregunta,

        );

        ValidacionCarga::find($tabla)->update($datoss);//modificacion de la tabla en el campo no_pregunta

        $tabla_a_insertar=$pregunta-1;//al valor de la pregunta se le resta 1 para saber en que tabla insertara

        for ($i=0; $i<$mitad ; $i++) //ciclo conforme al numero de docentes evaluados
        {


            DB::insert('insert into p'.(int) $tabla_a_insertar.' (id_alumno_materia, valor) values (?, ?)', [$datos[$i+2],$datos[$i+($mitad+2)]]);

        }


        return redirect()->route('evaluacion_alumno.index');
    }
    public function insertaralumno_materia(Request $request, $arreglo)
    {
        //dd($arreglo);
        $usuario = Session::get('usuario');
        $datos=(explode(',',$arreglo));


        $num=count($datos);
        $numm=$num-2;
        // dd($numm);


        $pregunta=$datos[0];

        $tabla=$datos[1];
        //dd($tabla);

        $datoss=array(

            'no_pregunta'=>$pregunta,

        );

        ValidacionCarga::find($tabla)->update($datoss);


        for ($i=2; $i<$num ; $i++)
        {

            $arrayName = array('cuenta' =>$usuario,
                'id_hrs_profesor'=>$datos[$i],

            );
            $act=alumno_materias::create($arrayName);


        }



        //   validacion_de_cargas::find($id)->update($datos);
        return redirect()->route('evaluacion_alumno.index');
    }

    public function guardar_comentario(Request $request)
    {
        $this->validate($request, [
            'id_alumno_materia' => 'required|array',
            'comments' => 'required|array',
        ]);

        $comentarios = $request->input('comments');
        $id_alumno_materias = $request->input('id_alumno_materia');

        foreach ($id_alumno_materias as $index => $id_alumno_materia) {
            DB::table('eva_docente_comentarios')->insert([
                'id_alumno_materia' => $id_alumno_materia,
                'comentario' => $comentarios[$index] ?? '', // evita error si falta índice
            ]);
        }

        return response()->json(['success' => true]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
