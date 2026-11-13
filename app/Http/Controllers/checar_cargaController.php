<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\CargaAcademica;
use App\Alumnos;
use App\Periodos;
use App\ValidacionCarga;
use Session;

class checar_cargaController extends Controller
{
    public function index()
    {
        $cuenta_y_nom = " ";
        $usuario = 1;
        $puedeEnviar = false;

        $periodo = Session::get('periodo_actual');
        $usuario_session = Session::get('usuario');

        $datos_alumn = DB::selectOne('SELECT * FROM gnral_alumnos WHERE cuenta = ? ', [(string) ($usuario_session)]);
        $id_alu = $datos_alumn->id_alumno;
        $des = DB::selectOne('SELECT descripcion FROM eva_validacion_de_cargas WHERE id_alumno = ? AND id_periodo = ?', [$id_alu, $periodo]);

        if ($des == null) {
            $color = 1;
            $mensage_carga = 'Tu carga académica no ha sido dada de alta';
            return view('evaluacion_docente.Alumnos.mensages', compact('mensage_carga', 'color'));
        }

        $re = $des->descripcion;

        $validaciones = DB::select('SELECT estado_validacion, descripcion FROM eva_validacion_de_cargas WHERE id_alumno = ? AND id_periodo = ?', [$id_alu, $periodo]);

        $consulta = DB::select('SELECT eva_carga_academica.id_carga_academica,gnral_materias.clave,gnral_materias.nombre,
        gnral_materias.id_materia,gnral_materias.id_semestre,gnral_materias.creditos,eva_status_materia.nombre_status,eva_tipo_curso.nombre_curso,eva_carga_academica.grupo
        FROM gnral_materias
        JOIN eva_carga_academica ON eva_carga_academica.id_materia = gnral_materias.id_materia
        JOIN eva_status_materia ON eva_carga_academica.id_status_materia = eva_status_materia.id_status_materia
        JOIN eva_tipo_curso ON eva_carga_academica.id_tipo_curso = eva_tipo_curso.id_tipo_curso
        JOIN gnral_grupos ON eva_carga_academica.grupo = gnral_grupos.id_grupo
        JOIN gnral_periodos ON eva_carga_academica.id_periodo = gnral_periodos.id_periodo
        WHERE eva_status_materia.id_status_materia = 1
        AND gnral_periodos.id_periodo = ?
        AND eva_carga_academica.id_alumno = ?', [$periodo, $id_alu]);

        $datos_carga = [];

        foreach ($consulta as $cons) {

            $dat = [
                'id_carga_academica' => $cons->id_carga_academica,
                'clave' => $cons->clave,
                'nombre' => $cons->nombre,
                'id_materia' => $cons->id_materia,
                'id_semestre' => $cons->id_semestre,
                'creditos' => $cons->creditos,
                'nombre_status' => $cons->nombre_status,
                'nombre_curso' => $cons->nombre_curso,
                'grupo' => $cons->grupo,
            ];

            $profesores = DB::select('SELECT DISTINCT gnral_personales.nombre AS docente,abreviaciones.titulo
            FROM gnral_horarios
            JOIN gnral_horas_profesores ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
            JOIN gnral_materias_perfiles ON gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
            JOIN gnral_materias ON gnral_materias_perfiles.id_materia = gnral_materias.id_materia
            JOIN gnral_personales ON gnral_horarios.id_personal = gnral_personales.id_personal
            JOIN abreviaciones_prof ON gnral_personales.id_personal = abreviaciones_prof.id_personal
            JOIN abreviaciones ON abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
            JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
            WHERE gnral_periodo_carreras.id_periodo = ?
            AND gnral_horas_profesores.grupo = ?
            AND gnral_materias.id_materia = ?', [$periodo, $cons->grupo, $cons->id_materia]);

            $dat['profesores'] = $profesores;
            $datos_carga[] = $dat;
        }

        /* =========================
           CÁLCULO DE CRÉDITOS
           ========================= */

        $suma = 0;
        $suma_materias = 0;
        $mater = count($consulta);

        foreach ($consulta as $cons) {
            if ($cons->id_materia != 2258) {
                $suma += $cons->creditos;
                $suma_materias++;
            }
        }

        $especial = DB::selectOne('SELECT COUNT(*) AS curso FROM eva_carga_academica WHERE id_tipo_curso = 3 AND id_status_materia = 1 AND id_periodo = ? AND id_alumno = ?', [$periodo, $id_alu])->curso;

        /* =========================
           VALIDACIONES
           ========================= */

        if ($especial > 0) {
            if ($suma > 22) {
                $creditoss = 4;
            } elseif ($especial > 2) {
                $creditoss = 5;
            } elseif ($especial == 2 && $suma_materias > 2) {
                $creditoss = 6;
            } else {
                $creditoss = 7;
                $puedeEnviar = true;
            }

        } else {

            $registro_extra = DB::table('actualizar_creditos')
                ->where('id_alumno', $id_alu)
                ->first();

            if ($suma > 38) {
                $creditoss = 1;
                if ($registro_extra && $registro_extra->credito_max >= $suma) {
                    $creditoss = 3;
                    $puedeEnviar = true;
                }
            } elseif ($suma < 22) {
                $creditoss = 2;
            } else {
                $creditoss = 3;
                $puedeEnviar = true;
            }
        }

        if ($mater == 0) {
            $color = 1;
            $mensage_carga = 'Tu carga académica no ha sido dada de alta';
            return view('evaluacion_docente.Alumnos.mensages', compact('mensage_carga', 'color'));
        }


        /* dd([
             'suma' => $suma,
             'creditoss' => $creditoss,
             'puedeEnviar' => $puedeEnviar,
             'registro_extra' => $registro_extra ?? null
         ]);
 */

        return view('evaluacion_docente.Alumnos.checar_carga', compact('validaciones','usuario','re','suma','cuenta_y_nom','creditoss','id_alu','datos_carga','datos_alumn','puedeEnviar'));
    }


    /////////revicion de control escolar////////

    public function revicion($id)
    {
        $periodo = Session::get('periodo_actual');
        $usuario = 2;

        // Obtener la validación
        $validaciones = DB::select('SELECT eva_validacion_de_cargas.estado_validacion, eva_validacion_de_cargas.id_alumno, eva_validacion_de_cargas.id_periodo
        FROM eva_validacion_de_cargas WHERE eva_validacion_de_cargas.id = ? AND eva_validacion_de_cargas.id_periodo = ? ', [$id, $periodo]);

        if (empty($validaciones)) {
            return back()->withErrors('No se encontró la validación.');
        }

        $alumno = $validaciones[0]->id_alumno;
        $id_alumno = $alumno; // ✅ Línea que faltaba
        $periodo = $validaciones[0]->id_periodo;
        $ls = $validaciones[0]->estado_validacion;

        $datos_carga = [];

        // Consulta de materias del alumno
        $consulta = DB::select('SELECT eva_carga_academica.id_carga_academica, gnral_materias.clave, gnral_materias.nombre, gnral_materias.id_materia,
               gnral_materias.id_semestre, gnral_materias.creditos, eva_status_materia.nombre_status,
               eva_tipo_curso.nombre_curso, eva_carga_academica.grupo
        FROM gnral_materias, eva_status_materia, eva_tipo_curso, gnral_grupos, eva_carga_academica, gnral_periodos, gnral_alumnos
        WHERE eva_carga_academica.id_materia = gnral_materias.id_materia
          AND eva_carga_academica.id_status_materia = eva_status_materia.id_status_materia
          AND eva_carga_academica.id_tipo_curso = eva_tipo_curso.id_tipo_curso
          AND eva_carga_academica.id_periodo = gnral_periodos.id_periodo
          AND eva_carga_academica.grupo = gnral_grupos.id_grupo
          AND eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
          AND eva_status_materia.id_status_materia = 1
          AND gnral_periodos.id_periodo = ?
          AND eva_carga_academica.id_alumno = ?
    ', [$periodo, $alumno]);

//        dd($consulta);

        foreach ($consulta as $cons) {
            $dat['id_carga_academica'] = $cons->id_carga_academica;
            $dat['clave'] = $cons->clave;
            $dat['nombre'] = $cons->nombre;
            $dat['id_materia'] = $cons->id_materia;
            $dat['id_semestre'] = $cons->id_semestre;
            $dat['creditos'] = $cons->creditos;
            $dat['nombre_status'] = $cons->nombre_status;
            $dat['nombre_curso'] = $cons->nombre_curso;
            $dat['grupo'] = $cons->grupo;

            $profesor = [];

            $profesores = DB::select('SELECT DISTINCT gnral_materias.id_materia, gnral_materias.nombre, gnral_horarios.id_horario_profesor, gnral_reticulas.clave, gnral_personales.nombre docente, abreviaciones.titulo
            FROM gnral_horarios
            JOIN gnral_horas_profesores ON gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
            JOIN gnral_materias_perfiles ON gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
            JOIN gnral_materias ON gnral_materias_perfiles.id_materia = gnral_materias.id_materia
            JOIN gnral_personales ON gnral_horarios.id_personal = gnral_personales.id_personal
            JOIN abreviaciones_prof ON gnral_personales.id_personal = abreviaciones_prof.id_personal
            JOIN abreviaciones ON abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
            JOIN gnral_periodo_carreras ON gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
            JOIN gnral_reticulas ON gnral_materias.id_reticula = gnral_reticulas.id_reticula
            WHERE gnral_periodo_carreras.id_periodo = ? AND gnral_materias.id_materia = ? AND gnral_horas_profesores.grupo = ? ', [$periodo, $cons->id_materia, $cons->grupo]);
//dd($profesores);
            foreach ($profesores as $prof) {
                $pro = [];
                $pro['nombre_profesor'] = $prof->docente;
                $pro['titulo'] = $prof->titulo;
                $profesor[] = $pro;
            }

            $dat['profesores'] = $profesor;
            $datos_carga[] = $dat;
        }

        // Suma de créditos
        $suma = 0;
        foreach ($consulta as $cons) {
            if ($cons->id_materia != 2258) {
                $suma += $cons->creditos;
            }
        }

        // Información del alumno
        $cuenta_y_nom = DB::selectOne('SELECT cuenta, nombre, apaterno, amaterno FROM gnral_alumnos WHERE id_alumno = ? ', [$alumno]);

// Crear el texto y convertirlo a mayúsculas
        $cuenta_y_nom_text = "Número de cuenta: {$cuenta_y_nom->cuenta}     Nombre del alumno: {$cuenta_y_nom->apaterno} {$cuenta_y_nom->amaterno} {$cuenta_y_nom->nombre}";
        $cuenta_y_nom_text = mb_strtoupper($cuenta_y_nom_text);

// Asignar la variable correcta que pasarás a la vista
        $cuenta_y_nom = $cuenta_y_nom_text;


        // Adeudo
        $adeudo_departamento = DB::selectOne('SELECT COUNT(id_adeudo_departamento) AS adeudo FROM adeudo_departamento WHERE id_alumno = ?', [$alumno]);
        $adeudo_departamento = $adeudo_departamento->adeudo;

        if ($adeudo_departamento == 0) {
            $adeudo = 0;
            $departamento_carrera = "";
        } else {
            $adeudo = 1;
            $departamento_carrera = [];

            $adeudo_dep = DB::select('SELECT g.nom_departamento, a.comentario
            FROM adeudo_departamento a
            JOIN gnral_unidad_administrativa g ON g.id_unidad_admin = a.id_departamento
            WHERE a.id_alumno = ? ', [$alumno]);

            foreach ($adeudo_dep as $ade) {
                $departamento_carrera[] = ['nombre' => $ade->nom_departamento, 'comentario' => $ade->comentario];
            }

            // Centro de información
            $adeudo_informacion = DB::selectOne('SELECT COUNT(id_adeudo_departamento) AS contar FROM adeudo_departamento WHERE id_alumno = ? AND id_departamento = 50', [$alumno]);
            if ($adeudo_informacion->contar > 0) {
                $informacion = DB::select('SELECT * FROM adeudo_departamento WHERE id_alumno = ? AND id_departamento = 50', [$alumno]);
                foreach ($informacion as $info) {
                    $departamento_carrera[] = ['nombre' => 'CENTRO DE INFORMACIÓN', 'comentario' => $info->comentario];
                }
            }

            // Bolsa de trabajo
            $adeudo_bolsa = DB::selectOne('SELECT COUNT(id_adeudo_departamento) AS contar FROM adeudo_departamento WHERE id_alumno = ? AND id_departamento = 100', [$alumno]);
            if ($adeudo_bolsa->contar > 0) {
                $bolsa = DB::select('SELECT * FROM adeudo_departamento WHERE id_alumno = ? AND id_departamento = 100', [$alumno]);
                foreach ($bolsa as $b) {
                    $departamento_carrera[] = ['nombre' => 'BOLSA DE TRABAJO Y SEGUIMIENTO DE EGRESADOS', 'comentario' => $b->comentario];
                }
            }
        }

        // Estado semestre
        $estado_sem_act = DB::selectOne('SELECT COUNT(id_semestres_al) AS contar FROM eva_semestre_alumno WHERE id_alumno = ?', [$alumno]);
        $estado_sem_act = $estado_sem_act->contar;

        $periodos = DB::select('SELECT * FROM gnral_periodos WHERE id_periodo >= 13 ORDER BY id_periodo ASC');
        $semestres = DB::select('SELECT * FROM gnral_semestres ORDER BY id_semestre ASC');

        $datos_actu = DB::selectOne('SELECT s.descripcion AS semestre, p.periodo, e. * FROM eva_semestre_alumno e
        JOIN gnral_semestres s ON e.id_semestre = s.id_semestre
        JOIN gnral_periodos p ON e.id_periodo = p.id_periodo
        WHERE e.id_alumno = ? ', [$alumno]);
//dd($datos_actu);
        $limites_creditos = DB::table('actualizar_creditos')
            ->where('id_alumno', $alumno)
            ->where('id', $id)
            ->latest('id_act_credito')
            ->first();

        $puedeEnviar = false;
        $creditoss   = null;
        $re          = null;
        $id_alu      = $alumno;
        $datos_alumn = null;

        $estado = $validaciones[0]->estado_validacion;

        $re = $validaciones[0]->descripcion ?? '';
        $creditoss = 0;
        $datos_alumn = (object)[];


        $id_alu = $alumno;

        return view('evaluacion_docente.Alumnos.checar_carga', compact(
            'ls','datos_carga','validaciones','usuario','id_alumno','suma',
            'cuenta_y_nom','id','adeudo','departamento_carrera',
            'estado_sem_act','periodos','semestres','alumno','datos_actu',
            'limites_creditos','puedeEnviar','creditoss','re','id_alu','datos_alumn','estado'
        ));
    }
    public function insertarvarios($arreglo)

    {
        //dd("entro");

        $usuario = Session::get('usuario');
        $periodo=Session::get('periodo_actual');
        $datos=(explode(',',$arreglo));
        $checks = array();
        $radios = array();
        $ciclos=count($datos)/2;
        $grupo=DB::selectOne('SELECT gnral_alumnos.grupo FROM gnral_alumnos WHERE gnral_alumnos.cuenta=?', [(string) ($usuario)]);
        $grupo=$grupo->grupo;
        $status=1;///////el estado es 2 porque el proceso de validacion se hara en automatico
        $id_alu=DB::selectOne('SELECT gnral_alumnos.id_alumno FROM gnral_alumnos WHERE gnral_alumnos.cuenta=?', [(string) ($usuario)]);
        $id_alu=($id_alu->id_alumno);

        for ($i=0; $i <count($datos)/2 ; $i++)
        {
            $checks [$i] =$datos[$i];
            $radios [$i]=$datos[$i+count($datos)/2];
        }

        //   dd($checks);
        for ($i=0; $i <$ciclos ; $i++)
        {
            $verifica=DB::selectOne('SELECT * FROM eva_carga_academica WHERE id_materia= ? AND id_periodo = ? AND eva_carga_academica.id_alumno= ?', [$checks[$i], $periodo, $id_alu]);
            if($verifica==null)
            {
                $incercion=array(
                    'id_alumno'=>$id_alu,
                    'id_materia'=>$checks[$i],
                    'id_status_materia'=>$status,
                    'id_tipo_curso'=>$radios[$i],
                    'id_periodo'=>$periodo,
                    'grupo'=>$grupo,
                );
                $act=CargaAcademica::create($incercion);
            }
            else
            {
            }
        }

        $checar=DB::selectOne('SELECT * FROM eva_validacion_de_cargas WHERE id_alumno= ? AND eva_validacion_de_cargas.id_periodo= ?', [$id_alu, $periodo]);

        if($checar==null){
            $pregunta=0;
            $validacion=array(
                'id_alumno'=>$id_alu,
                'id_periodo'=>$periodo,
                'estado_validacion'=>0,
                'no_pregunta'=>$pregunta,
            );

            $asdfghj=ValidacionCarga::create($validacion);

            return redirect()->route('checar.index');

        }
        else{
            $upda=array(
                'id_alumno'=>$checar->id_alumno,
                'id_periodo'=>$checar->id_periodo,
                'estado_validacion'=>0,
                'descripcion'=>$checar->descripcion,
                'no_pregunta'=>$checar->no_pregunta,
            );
            ValidacionCarga::find($checar->id)->update($upda);
            return redirect()->route('checar.index');
        }

    }
    public function edit($id_carga_academica)
    {
        $id=0;
        $usuario = Session::get('usuario');
        $periodo=Session::get('periodo_actual');
        ////////////recargar los datos de la vista
        $id_alu=DB::selectOne('SELECT gnral_alumnos.id_alumno FROM gnral_alumnos WHERE gnral_alumnos.cuenta=?', [(string) ($usuario)]);
        $id_alu=($id_alu->id_alumno);
        //dd($id_alu);
        $usuarios=1;
        $des=DB::selectOne('SELECT eva_validacion_de_cargas.descripcion FROM eva_validacion_de_cargas WHERE eva_validacion_de_cargas.id_alumno=? AND eva_validacion_de_cargas.id_periodo= ?', [(string) ($id_alu), $periodo]);
        $datos_carga=array();
        if($des==null)
        {
            $color=1;
            $mensage_carga='Tu carga académica  no ha sido dada de alta';
            return view('evaluacion_docente.Alumnos.mensages',compact('mensage_carga','color'));
        }
        else
        {
            $re=($des->descripcion);
            $validaciones=DB::select('SELECT eva_validacion_de_cargas.estado_validacion,eva_validacion_de_cargas.descripcion FROM eva_validacion_de_cargas
            WHERE eva_validacion_de_cargas.id_alumno= ? AND eva_validacion_de_cargas.id_periodo= ?', [$id_alu, $periodo]);
            // $si=isset($validaciones->descripcion)?$si->descripcion:0;
            $consulta=DB::select('SELECT eva_carga_academica.id_carga_academica,gnral_materias.clave,gnral_materias.nombre,gnral_materias.id_materia,
            gnral_materias.id_semestre,gnral_materias.creditos,eva_status_materia.nombre_status, eva_tipo_curso.nombre_curso,eva_carga_academica.grupo
            FROM gnral_materias,eva_status_materia,eva_tipo_curso,gnral_grupos,eva_carga_academica,gnral_periodos,gnral_alumnos
            WHERE eva_carga_academica.id_materia=gnral_materias.id_materia
            AND eva_carga_academica.id_status_materia=eva_status_materia.id_status_materia AND eva_carga_academica.id_tipo_curso=eva_tipo_curso.id_tipo_curso
            AND eva_carga_academica.id_periodo=gnral_periodos.id_periodo AND eva_carga_academica.grupo=gnral_grupos.id_grupo
            AND eva_carga_academica.id_alumno=gnral_alumnos.id_alumno AND eva_status_materia.id_status_materia=1
            AND gnral_periodos.id_periodo= ? AND eva_carga_academica.id_alumno= ?', [$periodo, $id_alu]);

            foreach ($consulta as $cons) {
                $dat['id_carga_academica'] = $cons->id_carga_academica;
                $dat['clave'] = $cons->clave;
                $dat['nombre'] = $cons->nombre;
                $dat['id_materia'] = $cons->id_materia;
                $dat['id_semestre'] = $cons->id_semestre;
                $dat['creditos'] = $cons->creditos;
                $dat['nombre_status'] = $cons->nombre_status;
                $dat['nombre_curso'] = $cons->nombre_curso;
                $dat['grupo'] = $cons->grupo;

                $profesor=array();

                $profesores = DB::select('SELECT DISTINCT gnral_materias.id_materia, gnral_materias.nombre, gnral_horarios.id_horario_profesor, gnral_reticulas.clave,gnral_personales.nombre docente, abreviaciones.titulo
                FROM gnral_horarios,gnral_horas_profesores,gnral_materias_perfiles,gnral_materias,gnral_personales, gnral_periodo_carreras,gnral_reticulas, abreviaciones_prof, abreviaciones
                WHERE gnral_periodo_carreras.id_periodo= ? AND gnral_horarios.id_periodo_carrera=gnral_periodo_carreras.id_periodo_carrera
                AND gnral_horarios.id_personal=gnral_personales.id_personal AND gnral_horas_profesores.id_horario_profesor=gnral_horarios.id_horario_profesor
                AND gnral_horas_profesores.id_materia_perfil=gnral_materias_perfiles.id_materia_perfil AND gnral_materias_perfiles.id_materia=gnral_materias.id_materia
                AND gnral_materias.id_reticula = gnral_reticulas.id_reticula AND gnral_horas_profesores.grupo = ? AND gnral_personales.id_personal = abreviaciones_prof.id_personal
                AND abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion AND gnral_materias.id_materia = ?', [$periodo, $cons->grupo, $cons->id_materia]);

                foreach ($profesores as $prof){
                    $pro['nombre_profesor'] = $prof->docente;
                    $pro['titulo'] = $prof->titulo;
                    array_push($profesor,$pro);
                }
                $dat['profesores'] = $profesor;
                array_push($datos_carga, $dat);

            }
            $suma=0;
            foreach ($consulta as $cons){
                if($cons->id_materia != 2258) {
                    $suma = $suma + $cons->creditos;
                }
            }

            $consultaedit=DB::selectOne('SELECT * FROM eva_carga_academica WHERE eva_carga_academica.id_carga_academica= ?', [$id_carga_academica]);
            $sem=$consultaedit->id_materia;
            //dd($sem);
            $semestre=DB::selectOne('SELECT gnral_materias.id_semestre FROM gnral_materias WHERE gnral_materias.id_materia= ?', [$sem]);

            $sss = CargaAcademica::find($id_carga_academica);
            $usuarios=1;

            return view('evaluacion_docente.Alumnos.checar_carga',compact('datos_carga','usuario','re','validaciones','semestre','suma','id'))->with(['edit'=>true,'consultaedit'=>$sss]);
        }
    }
    public function enviarcarga($id){
        $periodo=Session::get('periodo_actual');

        DB::update('UPDATE eva_validacion_de_cargas SET estado_validacion = 1 WHERE id_alumno = ? AND id_periodo = ?', [$id, $periodo]);
        return redirect()->route('checar_carga.index');
    }
    public function enviarcargajefe($id){
        $periodo=Session::get('periodo_actual');

        DB::update('UPDATE eva_validacion_de_cargas SET estado_validacion = 100 WHERE id_alumno = ? AND id_periodo = ?', [$id, $periodo]);
        return redirect()->route('checar_carga.index');
    }

    public function update(Request $request, $id)
    {

//dd('update');
        $datos = array(

            'id_status_materia'=>$request->get('status'),
            'id_tipo_curso'=>$request->get('tipo'),
            'grupo'=>$request->get('grupo')

        );
        CargaAcademica::find($id)->update($datos);
        return redirect()->route('checar_carga.index');
    }

    public function destroy($id)
    {
        CargaAcademica::destroy($id);
        return redirect()->route('checar_carga.index');
    }



    public function editarlimitecreditos(Request $request)
    {
        $buscarCuenta = $request->input('buscar_cuenta');

        $alumnos = DB::table('gnral_alumnos as a')
            ->select(
                'a.id_alumno',
                'a.cuenta',
                'a.nombre',
                'a.apaterno',
                'a.amaterno',
                DB::raw('(
                SELECT id
                FROM eva_validacion_de_cargas e
                WHERE e.id_alumno = a.id_alumno
                ORDER BY e.id DESC
                LIMIT 1
            ) as id'),
                DB::raw('(
                SELECT credito_max
                FROM actualizar_creditos ac
                WHERE ac.id_alumno = a.id_alumno
                ORDER BY ac.id_act_credito DESC
                LIMIT 1
            ) as credito_max')
            )
            ->when($buscarCuenta, function ($query, $buscarCuenta) {
                $query->where('a.cuenta', 'like', "%{$buscarCuenta}%");
            })
            ->paginate(10)
            ->appends(['buscar_cuenta' => $buscarCuenta]);

        $credito_min = 22;


        return view(
            'evaluacion_docente.Alumnos.editar_limite_creditos',
            compact('alumnos', 'buscarCuenta', 'credito_min')
        );

    }


    public function actualizarLimiteCreditos(Request $request)
    {
        // 1️⃣ Validación de inputs
        $request->validate([
            'id_alumno'    => 'required|integer',
            'id'           => 'required|integer', // id de validación
            'min_creditos' => 'required|integer|min:0',
            'max_creditos' => 'required|integer|min:0',
        ]);

        // 2️⃣ Validación de que mínimo no supere máximo
        if ($request->min_creditos > $request->max_creditos) {
            return redirect()->back()
                ->withErrors([
                    'min_creditos' => '⚠️ El mínimo no puede ser mayor que el máximo.'
                ])
                ->withInput();
        }

        try {
            // 3️⃣ Verificar que el alumno exista
            $alumno = DB::table('gnral_alumnos')
                ->where('id_alumno', $request->id_alumno)
                ->first();

            if (!$alumno) {
                return redirect()->back()
                    ->withErrors(['id_alumno' => '⚠️ Alumno no existe.'])
                    ->withInput();
            }

            // 4️⃣ Verificar que exista la validación de carga
            $validacion = DB::table('eva_validacion_de_cargas')
                ->where('id', $request->id)
                ->where('id_alumno', $request->id_alumno)
                ->first();

            if (!$validacion) {
                return redirect()->back()
                    ->withErrors(['id' => '⚠️ La carga académica de este alumno aún no ha sido validada.'])
                    ->withInput();
            }

            // 5️⃣ Verificar si ya existe un registro en actualizar_creditos
            $registroExistente = DB::table('actualizar_creditos')
                ->where('id_alumno', $request->id_alumno)
                ->where('id', $request->id)
                ->first();

            if ($registroExistente) {
                // Actualizar el registro existente
                DB::table('actualizar_creditos')
                    ->where('id_act_credito', $registroExistente->id_act_credito)
                    ->update([
                        'credito_min' => $request->min_creditos,
                        'credito_max' => $request->max_creditos,
                    ]);
            } else {
                // Insertar nuevo registro
                DB::table('actualizar_creditos')->insert([
                    'id_alumno'   => $request->id_alumno,
                    'id'          => $request->id,
                    'credito_min' => $request->min_creditos,
                    'credito_max' => $request->max_creditos,
                ]);
            }

            return redirect()->back()
                ->with('success', 'Créditos actualizados correctamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors([
                    'db_error' => '⚠️ No se pudo actualizar los créditos: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    public function autorizarCargaDual($id) {
    $periodo = Session::get('periodo_actual');
    //dd($id);
    $actualizado = DB::update('UPDATE eva_validacion_de_cargas SET estado_validacion = 8 WHERE id = ? AND id_periodo = ? AND estado_validacion = 888',[$id, $periodo]);
    //dd($actualizado);
    if ($actualizado) {
        return redirect()->back()
            ->with('success', 'Carga académica DUAL autorizada correctamente.');
    }


    return redirect()->back()
        ->withErrors('No fue posible autorizar la carga académica DUAL.');
}




}
