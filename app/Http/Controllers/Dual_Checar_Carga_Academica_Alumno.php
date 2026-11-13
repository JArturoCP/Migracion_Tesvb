<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CargaAcademica;
use App\Alumnos;
use App\Periodos;
use App\ValidacionCarga;
use Session;

class Dual_Checar_Carga_Academica_Alumno extends Controller
{
    /**
     * ============================================================
     * MOSTRAR CARGA ACADÉMICA DEL ALUMNO
     * ============================================================
     */
    public function index()
    {
        $periodo = Session::get('periodo_actual');
        $usuario = Session::get('usuario');
        /*dd($usuario);*/
        // Obtener alumno mediante su cuenta
        $id_alu = DB::selectOne('SELECT id_alumno  FROM gnral_alumnos  WHERE id_alumno = ?', [$usuario]);
        //dd($id_alu);

        if ($id_alu == null) {
            $color = 1;
            $mensage_carga = 'No se encontró información del alumno.';
            return view( 'duales.dual_mensages',compact('mensage_carga', 'color')
            );
        }

        $id_alu = $id_alu->id_alumno;
//dd($id_alu);
        /*
         * IMPORTANTE:
         * Este valor identifica que estamos en la vista del alumno/jefe
         * que captura la carga.
         *
         * NO SE UTILIZA PARA VALIDAR CRÉDITOS.
         */
        $usuario = 1;

        // Buscar validación de carga
        $des = DB::selectOne('SELECT *  FROM eva_validacion_de_cargas  WHERE id_alumno = ?  AND id_periodo = ?', [$id_alu, $periodo]);

        $datos_carga = array();

        if ($des == null) {

            $color = 1;
            $mensage_carga = 'Tu carga académica no ha sido dada de alta';

            return view( 'duales.dual_mensages',compact('mensage_carga', 'color')
            );
        }

        $re = $des->descripcion;

        $validaciones = DB::select('SELECT estado_validacion, descripcion FROM eva_validacion_de_cargas   WHERE id_alumno = ? AND id_periodo = ? ',[$id_alu,$periodo]);

        /*
         * ============================================================
         * CARGA ACADÉMICA
         * ============================================================
         */
        $consulta1 = DB::select(
            'SELECT
                eva_carga_academica.id_carga_academica,
                gnral_materias.clave,
                gnral_materias.nombre,
                gnral_materias.id_materia,
                gnral_materias.id_semestre,
                gnral_materias.creditos,
                eva_status_materia.nombre_status,
                eva_tipo_curso.nombre_curso,
                eva_carga_academica.grupo

            FROM gnral_materias,
                 eva_status_materia,
                 eva_tipo_curso,
                 gnral_grupos,
                 eva_carga_academica,
                 gnral_periodos,
                 gnral_alumnos

            WHERE eva_carga_academica.id_materia = gnral_materias.id_materia
            AND eva_carga_academica.id_status_materia = eva_status_materia.id_status_materia
            AND eva_carga_academica.id_tipo_curso = eva_tipo_curso.id_tipo_curso
            AND eva_carga_academica.id_periodo = gnral_periodos.id_periodo
            AND eva_carga_academica.grupo = gnral_grupos.id_grupo
            AND eva_carga_academica.id_alumno = gnral_alumnos.id_alumno
            AND eva_status_materia.id_status_materia = 1
            AND gnral_periodos.id_periodo = ?
            AND eva_carga_academica.id_alumno = ?', [$periodo, $id_alu]
        );

        foreach ($consulta1 as $cons) {

            $dat['id_carga_academica'] = $cons->id_carga_academica;
            $dat['clave'] = $cons->clave;
            $dat['nombre'] = $cons->nombre;
            $dat['id_materia'] = $cons->id_materia;
            $dat['id_semestre'] = $cons->id_semestre;
            $dat['creditos'] = $cons->creditos;
            $dat['nombre_status'] = $cons->nombre_status;
            $dat['nombre_curso'] = $cons->nombre_curso;
            $dat['grupo'] = $cons->grupo;

            $profesor = array();

            $profesores = DB::select(
                'SELECT DISTINCT
                    gnral_materias.id_materia,
                    gnral_materias.nombre,
                    gnral_horarios.id_horario_profesor,
                    gnral_reticulas.clave,
                    gnral_personales.nombre docente,
                    abreviaciones.titulo

                FROM gnral_horarios,
                     gnral_horas_profesores,
                     gnral_materias_perfiles,
                     gnral_materias,
                     gnral_personales,
                     gnral_periodo_carreras,
                     gnral_reticulas,
                     abreviaciones_prof,
                     abreviaciones

                WHERE gnral_periodo_carreras.id_periodo = ?
                AND gnral_horarios.id_periodo_carrera = gnral_periodo_carreras.id_periodo_carrera
                AND gnral_horarios.id_personal = gnral_personales.id_personal
                AND gnral_horas_profesores.id_horario_profesor = gnral_horarios.id_horario_profesor
                AND gnral_horas_profesores.id_materia_perfil = gnral_materias_perfiles.id_materia_perfil
                AND gnral_materias_perfiles.id_materia = gnral_materias.id_materia
                AND gnral_materias.id_reticula = gnral_reticulas.id_reticula
                AND gnral_horas_profesores.grupo = ?
                AND gnral_personales.id_personal = abreviaciones_prof.id_personal
                AND abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
                AND gnral_materias.id_materia = ?', [$periodo, $cons->grupo, $cons->id_materia]
            );

            foreach ($profesores as $prof) {

                $pro['nombre_profesor'] = $prof->docente;
                $pro['titulo'] = $prof->titulo;

                array_push($profesor, $pro);
            }

            $dat['profesores'] = $profesor;

            array_push($datos_carga, $dat);
        }

        /*
         * ============================================================
         * TOTAL DE CRÉDITOS
         *
         * SOLO SE MUESTRA.
         * YA NO SE UTILIZA PARA BLOQUEAR EL ENVÍO.
         * ============================================================
         */
        $suma = 0;
        $suma_materias = 0;
        $mater = 0;

        foreach ($consulta1 as $cons) {

            $mater++;

            if ($cons->id_materia != 2258) {

                $suma += $cons->creditos;
                $suma_materias++;
            }
        }

        /*
         * Se conserva la variable para no romper la vista,
         * pero ya NO se utiliza como validación.
         */
        if ($suma > 38) {
            $creditoss = 1;
        } elseif ($suma < 0) {
            $creditoss = 2;
        } else {
            $creditoss = 3;
        }

        $cuenta_y_nom = " ";

        /*
         * Si no tiene materias
         */
        if ($mater == 0) {

            $color = 1;
            $mensage_carga = 'Tu carga académica no ha sido dada de alta';

            return view(
                'duales.dual_mensages',
                compact('mensage_carga', 'color')
            );
        }

        /*
         * ============================================================
         * ADEUDOS
         *
         * SE CONSERVA LA VALIDACIÓN DE ADEUDOS.
         * ============================================================
         */
        $adeudo_departamento = DB::selectOne(
            'SELECT COUNT(id_adeudo_departamento) AS adeudo
             FROM adeudo_departamento
             WHERE id_alumno = ?', [$id_alu]
        );

        $adeudo_departamento = $adeudo_departamento->adeudo;

        if ($adeudo_departamento == 0) {

            $adeudo = 0;
            $departamento_carrera = "";

        } else {

            $adeudo = 1;
            $departamento_carrera = array();

            $adeudo_dep = DB::select(
                'SELECT
                    gnral_unidad_administrativa.nom_departamento,
                    adeudo_departamento.comentario

                 FROM adeudo_departamento,
                      gnral_unidad_administrativa

                 WHERE adeudo_departamento.id_alumno = ?
                 AND gnral_unidad_administrativa.id_unidad_admin =
                     adeudo_departamento.id_departamento', [$id_alu]
            );

            foreach ($adeudo_dep as $ade) {

                $nombrea['nombre'] = $ade->nom_departamento;
                $nombrea['comentario'] = $ade->comentario;

                array_push($departamento_carrera, $nombrea);
            }

            /*
             * Centro de Información
             */
            $adeudo_informacion = DB::selectOne(
                'SELECT COUNT(id_adeudo_departamento) AS contar
                 FROM adeudo_departamento
                 WHERE id_alumno = ?
                 AND id_departamento = 50', [$id_alu]
            );

            if ($adeudo_informacion->contar > 0) {

                $informacion = DB::select(
                    'SELECT *
                     FROM adeudo_departamento
                     WHERE id_alumno = ?
                     AND id_departamento = 50', [$id_alu]
                );

                foreach ($informacion as $info) {

                    $nombre_info['nombre'] = "CENTRO DE INFORMACIÓN";
                    $nombre_info['comentario'] = $info->comentario;

                    array_push(
                        $departamento_carrera,
                        $nombre_info
                    );
                }
            }

            /*
             * Bolsa de Trabajo
             */
            $adeudo_bolsa = DB::selectOne(
                'SELECT COUNT(id_adeudo_departamento) AS contar
                 FROM adeudo_departamento
                 WHERE id_alumno = ?
                 AND id_departamento = 100', [$id_alu]
            );

            if ($adeudo_bolsa->contar > 0) {

                $bolsa = DB::select(
                    'SELECT *
                     FROM adeudo_departamento
                     WHERE id_alumno = ?
                     AND id_departamento = 100', [$id_alu]
                );

                foreach ($bolsa as $bolsa_item) {

                    $nombre_bolsa['nombre'] =
                        "BOLSA DE TRABAJO Y SEGUIMIENTO DE EGRESADOS";

                    $nombre_bolsa['comentario'] =
                        $bolsa_item->comentario;

                    array_push(
                        $departamento_carrera,
                        $nombre_bolsa
                    );
                }
            }
        }

        return view(
            'duales.checar_carga_academica',
            compact(
                'validaciones',
                'usuario',
                're',
                'suma',
                'cuenta_y_nom',
                'creditoss',
                'id_alu',
                'datos_carga',
                'adeudo',
                'departamento_carrera'
            )
        );
    }

    /**
     * ============================================================
     * REVISIÓN DE CONTROL ESCOLAR
     * ============================================================
     */
    public function revision_carga($id_alumno) {
        $creditoss = 0;
        $periodo = Session::get('periodo_actual');
        $usuario = 2;
        $validaciones=DB::select('SELECT eva_validacion_de_cargas.estado_validacion,eva_validacion_de_cargas.descripcion, eva_validacion_de_cargas.id_alumno, eva_validacion_de_cargas.id
        FROM eva_validacion_de_cargas WHERE eva_validacion_de_cargas.id_alumno= ? AND eva_validacion_de_cargas.id_periodo= ?',[$id_alumno,$periodo]);
        //dd($validaciones);
        if (count($validaciones) == 0) {
            return redirect()->back()->with(
                'error',
                'No existe una validación para este alumno.'
            );
        }

        $alumno = $validaciones[0]->id_alumno;
        //dd($alumno);
        $id = $validaciones[0]->id;
        //dd($id);
        $ls = $validaciones[0]->estado_validacion;

        /*
         * ============================================================
         * CARGA ACADÉMICA
         * ============================================================
         */
        $datos_carga = array();

        $consulta1 = DB::select(
            'SELECT
                eva_carga_academica.id_carga_academica,
                gnral_materias.clave,
                gnral_materias.nombre,
                gnral_materias.id_materia,
                gnral_materias.id_semestre,
                gnral_materias.creditos,
                eva_status_materia.nombre_status,
                eva_tipo_curso.nombre_curso,
                eva_carga_academica.grupo

             FROM gnral_materias,
                  eva_status_materia,
                  eva_tipo_curso,
                  gnral_grupos,
                  eva_carga_academica,
                  gnral_periodos,
                  gnral_alumnos

             WHERE eva_carga_academica.id_materia = gnral_materias.id_materia
             AND eva_carga_academica.id_status_materia =
                 eva_status_materia.id_status_materia
             AND eva_carga_academica.id_tipo_curso =
                 eva_tipo_curso.id_tipo_curso
             AND eva_carga_academica.id_periodo =
                 gnral_periodos.id_periodo
             AND eva_carga_academica.grupo =
                 gnral_grupos.id_grupo
             AND eva_carga_academica.id_alumno =
                 gnral_alumnos.id_alumno
             AND eva_status_materia.id_status_materia = 1
             AND gnral_periodos.id_periodo = ?
             AND eva_carga_academica.id_alumno = ?', [$periodo, $alumno]
        );

        foreach ($consulta1 as $cons) {

            $dat['id_carga_academica'] =
                $cons->id_carga_academica;

            $dat['clave'] = $cons->clave;
            $dat['nombre'] = $cons->nombre;
            $dat['id_materia'] = $cons->id_materia;
            $dat['id_semestre'] = $cons->id_semestre;
            $dat['creditos'] = $cons->creditos;
            $dat['nombre_status'] = $cons->nombre_status;
            $dat['nombre_curso'] = $cons->nombre_curso;
            $dat['grupo'] = $cons->grupo;

            $profesor = array();

            $profesores = DB::select(
                'SELECT DISTINCT
                    gnral_materias.id_materia,
                    gnral_materias.nombre,
                    gnral_horarios.id_horario_profesor,
                    gnral_reticulas.clave,
                    gnral_personales.nombre docente,
                    abreviaciones.titulo

                 FROM gnral_horarios,
                      gnral_horas_profesores,
                      gnral_materias_perfiles,
                      gnral_materias,
                      gnral_personales,
                      gnral_periodo_carreras,
                      gnral_reticulas,
                      abreviaciones_prof,
                      abreviaciones

                 WHERE gnral_periodo_carreras.id_periodo = ?
                 AND gnral_horarios.id_periodo_carrera =
                     gnral_periodo_carreras.id_periodo_carrera
                 AND gnral_horarios.id_personal =
                     gnral_personales.id_personal
                 AND gnral_horas_profesores.id_horario_profesor =
                     gnral_horarios.id_horario_profesor
                 AND gnral_horas_profesores.id_materia_perfil =
                     gnral_materias_perfiles.id_materia_perfil
                 AND gnral_materias_perfiles.id_materia =
                     gnral_materias.id_materia
                 AND gnral_materias.id_reticula =
                     gnral_reticulas.id_reticula
                 AND gnral_horas_profesores.grupo = ?
                 AND gnral_personales.id_personal =
                     abreviaciones_prof.id_personal
                 AND abreviaciones_prof.id_abreviacion =
                     abreviaciones.id_abreviacion
                 AND gnral_materias.id_materia =
                     ?', [$periodo, $cons->grupo, $cons->id_materia]
            );

            foreach ($profesores as $prof) {

                $pro['nombre_profesor'] = $prof->docente;
                $pro['titulo'] = $prof->titulo;

                array_push($profesor, $pro);
            }

            $dat['profesores'] = $profesor;

            array_push($datos_carga, $dat);
        }

        /*
         * TOTAL CRÉDITOS
         * Solo informativo.
         */
        $suma = 0;

        foreach ($consulta1 as $cons) {

            if ($cons->id_materia != 2258) {
                $suma += $cons->creditos;
            }
        }

        if ($suma > 38) {
            $creditoss = 1;
        } elseif ($suma < 0) {
            $creditoss = 2;
        } else {
            $creditoss = 3;
        }

        /*
         * ============================================================
         * DATOS DEL ALUMNO
         * ============================================================
         */
        $cuenta = DB::selectOne(
            'SELECT
                cuenta,
                nombre,
                apaterno,
                amaterno

             FROM gnral_alumnos

             WHERE id_alumno = ?', [$alumno]
        );

        $cuenta_y_nom =
            "Número de cuenta: " . $cuenta->cuenta .
            "     Nombre del alumno: " .
            $cuenta->apaterno . " " .
            $cuenta->amaterno . " " .
            $cuenta->nombre;

        $cuenta_y_nom = mb_strtoupper($cuenta_y_nom);

        /*
         * ============================================================
         * ADEUDOS
         * ============================================================
         */
        $adeudo_departamento = DB::selectOne(
            'SELECT COUNT(id_adeudo_departamento) AS adeudo
             FROM adeudo_departamento
             WHERE id_alumno = ?', [$alumno]
        );

        if ($adeudo_departamento->adeudo == 0) {

            $adeudo = 0;
            $departamento_carrera = array();

        } else {

            $adeudo = 1;
            $departamento_carrera = array();

            $adeudo_dep = DB::select(
                'SELECT
                    gnral_unidad_administrativa.nom_departamento,
                    adeudo_departamento.comentario

                 FROM adeudo_departamento,
                      gnral_unidad_administrativa

                 WHERE adeudo_departamento.id_alumno = ?
                 AND gnral_unidad_administrativa.id_unidad_admin =
                     adeudo_departamento.id_departamento', [$alumno]
            );

            foreach ($adeudo_dep as $ade) {

                $nombrea['nombre'] =
                    $ade->nom_departamento;

                $nombrea['comentario'] =
                    $ade->comentario;

                array_push(
                    $departamento_carrera,
                    $nombrea
                );
            }

            /*
             * Centro de Información
             */
            $informacion = DB::select(
                'SELECT *
                 FROM adeudo_departamento
                 WHERE id_alumno = ?
                 AND id_departamento = 50', [$alumno]
            );

            foreach ($informacion as $info) {

                $nombre_info['nombre'] =
                    "CENTRO DE INFORMACIÓN";

                $nombre_info['comentario'] =
                    $info->comentario;

                array_push(
                    $departamento_carrera,
                    $nombre_info
                );
            }

            /*
             * Bolsa de Trabajo
             */
            $bolsa = DB::select(
                'SELECT *
                 FROM adeudo_departamento
                 WHERE id_alumno = ?
                 AND id_departamento = 100', [$alumno]
            );

            foreach ($bolsa as $bolsa_item) {

                $nombre_bolsa['nombre'] =
                    "BOLSA DE TRABAJO Y SEGUIMIENTO DE EGRESADOS";

                $nombre_bolsa['comentario'] =
                    $bolsa_item->comentario;

                array_push(
                    $departamento_carrera,
                    $nombre_bolsa
                );
            }
        }

        /*
         * ============================================================
         * SEMESTRE
         * ============================================================
         */
        $estado_sem_act = DB::selectOne(
            'SELECT COUNT(id_semestres_al) AS contar
             FROM eva_semestre_alumno
             WHERE id_alumno = ?', [$alumno]
        );

        $estado_sem_act = $estado_sem_act->contar;

        $periodos = DB::select(
            'SELECT *
             FROM gnral_periodos
             WHERE id_periodo >= 13
             ORDER BY id_periodo ASC'
        );

        $semestres = DB::select(
            'SELECT *
             FROM gnral_semestres
             ORDER BY id_semestre ASC'
        );

        $datos_actu = DB::selectOne(
            'SELECT
                gnral_semestres.descripcion semestre,
                gnral_periodos.periodo,
                eva_semestre_alumno.*

             FROM gnral_semestres,
                  gnral_periodos,
                  eva_semestre_alumno

             WHERE eva_semestre_alumno.id_alumno = ?
             AND eva_semestre_alumno.id_periodo =
                 gnral_periodos.id_periodo
             AND eva_semestre_alumno.id_semestre =
                 gnral_semestres.id_semestre', [$alumno]
        );

        return view(
            'duales.checar_carga_academica',
            compact(
                'ls',
                'datos_carga',
                'validaciones',
                'usuario',
                'id_alumno',
                'suma',
                'cuenta_y_nom',
                'adeudo',
                'departamento_carrera',
                'estado_sem_act',
                'periodos',
                'semestres',
                'alumno',
                'datos_actu',
                'creditoss',
                'id'
            )
        );
    }

    /**
     * ============================================================
     * INSERTAR MATERIAS
     * ============================================================
     */
    public function insertarvarios($arreglo)
    {
        $usuario = Session::get('usuario');
        $periodo = Session::get('periodo_actual');

        $datos = explode(',', $arreglo);

        $checks = array();
        $radios = array();

        $ciclos = count($datos) / 2;

        $grupo = DB::selectOne(
            'SELECT grupo
             FROM gnral_alumnos
             WHERE cuenta = ?', [$usuario]
        );

        $grupo = $grupo->grupo;

        $status = 1;

        $id_alu = DB::selectOne(
            'SELECT id_alumno
             FROM gnral_alumnos
             WHERE cuenta = ?', [$usuario]
        );

        $id_alu = $id_alu->id_alumno;

        for ($i = 0; $i < $ciclos; $i++) {

            $checks[$i] = $datos[$i];

            $radios[$i] =
                $datos[$i + $ciclos];
        }

        for ($i = 0; $i < $ciclos; $i++) {

            $verifica = DB::selectOne(
                'SELECT *
                 FROM eva_carga_academica

                 WHERE id_materia = ?
                 AND id_periodo = ?
                 AND id_alumno = ?', [$checks[$i], $periodo, $id_alu]
            );

            if ($verifica == null) {

                $incercion = array(
                    'id_alumno' => $id_alu,
                    'id_materia' => $checks[$i],
                    'id_status_materia' => $status,
                    'id_tipo_curso' => $radios[$i],
                    'id_periodo' => $periodo,
                    'grupo' => $grupo,
                );

                CargaAcademica::create($incercion);
            }
        }

        $checar = DB::selectOne(
            'SELECT *
             FROM eva_validacion_de_cargas

             WHERE id_alumno = ?
             AND id_periodo = ?', [$id_alu, $periodo]
        );

        if ($checar == null) {

            $validacion = array(
                'id_alumno' => $id_alu,
                'id_periodo' => $periodo,
                'estado_validacion' => 0,
                'no_pregunta' => 0,
            );

            ValidacionCarga::create($validacion);

        } else {

            $upda = array(
                'id_alumno' => $checar->id_alumno,
                'id_periodo' => $checar->id_periodo,
                'estado_validacion' => 0,
                'descripcion' => $checar->descripcion,
                'no_pregunta' => $checar->no_pregunta,
            );

            ValidacionCarga::find($checar->id)->update($upda);
        }

        return redirect()->route('checar_carga_academica.index');
    }

    /**
     * ============================================================
     * ENVIAR CARGA A SERVICIOS ESCOLARES
     *
     * NO VALIDA CRÉDITOS.
     * SÍ VALIDA ADEUDOS.
     * ============================================================
     */
    public function enviarcarga($id)
    {
        $periodo = Session::get('periodo_actual');

        /*
         * Buscar adeudos
         */
        $adeudo = DB::selectOne( 'SELECT COUNT(id_adeudo_departamento) AS total  FROM adeudo_departamento WHERE id_alumno = ?', [$id] );

        /*
         * ============================================================
         * TIENE ADEUDO
         * ============================================================
         */
        if ($adeudo != null && $adeudo->total > 0) {

            return redirect('/duales/checar_carga_academica')
        ->with(
            'success',
            'La carga académica fue enviada correctamente a Servicios Escolares.'
        );
        }

        /*
         * ============================================================
         * SIN ADEUDO
         *
         * 888 = enviada a Servicios Escolares
         * ============================================================
         */
        DB::update( 'UPDATE eva_validacion_de_cargas  SET estado_validacion = 888 WHERE id_alumno = ?  AND id_periodo = ?', [$id, $periodo] );

         return redirect('/duales/checar_carga_academica')
        ->with(
            'success',
            'La carga académica fue enviada correctamente a Servicios Escolares.'
        );
    }

    /**
     * ============================================================
     * EDITAR CARGA
     * ============================================================
     */
    public function edit($id_carga_academica)
    {
        return redirect()->route(
            'checar_carga_academica.index'
        );
    }

    /**
     * ============================================================
     * ACTUALIZAR
     * ============================================================
     */
    public function update(Request $request, $id)
    {
        $datos = array(
            'id_status_materia' =>
                $request->get('status'),

            'id_tipo_curso' =>
                $request->get('tipo'),

            'grupo' =>
                $request->get('grupo')
        );

        CargaAcademica::find($id)->update($datos);

        return redirect()->route(
            'checar_carga_academica.index'
        );
    }

    /**
     * ============================================================
     * ELIMINAR
     * ============================================================
     */
    public function destroy($id)
    {
        CargaAcademica::destroy($id);

        return redirect()->route(
            'checar_carga_academica.index'
        );
    }
}
