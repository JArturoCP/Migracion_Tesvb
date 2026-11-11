<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Mail;
use Session;

class Ti_calendario_estudianteController extends Controller
{
    public function index()
    {
        dd("hola");
    }

    public function editar_titulo_cedula()
    {
        $profesores = DB::select('
            SELECT 
                gnral_personales.id_personal,
                gnral_personales.nombre,
                gnral_personales.cedula,
                abreviaciones_prof.id_abreviacion_prof,
                abreviaciones.titulo
            FROM ti_jurado_alumno
            INNER JOIN gnral_personales
                ON ti_jurado_alumno.id_personal = gnral_personales.id_personal
            INNER JOIN abreviaciones_prof
                ON gnral_personales.id_personal = abreviaciones_prof.id_personal
            INNER JOIN abreviaciones
                ON abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
            GROUP BY gnral_personales.id_personal
        ');

        $abreviaciones = DB::select('
            SELECT *
            FROM abreviaciones
            ORDER BY titulo ASC
        ');

        return view(
            'titulacion.jefe_titulacion.editar_titulo_cedula',
            compact('profesores', 'abreviaciones')
        );
    }

    public function guardar_agregar_titulo(Request $request)
    {
        $this->validate($request, [
            'nombre_titulo' => 'required',
        ]);

        DB::table('abreviaciones')->insert([
            'titulo' => $request->input('nombre_titulo'),
        ]);

        return back();
    }

    public function editar_titulo_profesor($id_abreviacion_prof)
    {
        $profesor = DB::selectOne('
            SELECT 
                gnral_personales.nombre,
                abreviaciones_prof.*,
                abreviaciones.titulo
            FROM gnral_personales
            INNER JOIN abreviaciones_prof
                ON abreviaciones_prof.id_personal = gnral_personales.id_personal
            INNER JOIN abreviaciones
                ON abreviaciones_prof.id_abreviacion = abreviaciones.id_abreviacion
            WHERE abreviaciones_prof.id_abreviacion_prof = ?
        ', [$id_abreviacion_prof]);

        $abreviaciones = DB::select('
            SELECT *
            FROM abreviaciones
            ORDER BY titulo ASC
        ');

        return view(
            'titulacion.jefe_titulacion.modal_edicion_titulo_profesor',
            compact('profesor', 'abreviaciones')
        );
    }

    public function guardar_editar_titulo_profesor(Request $request)
    {
        $this->validate($request, [
            'id_abreviacion_prof' => 'required',
            'id_abreviacion' => 'required',
        ]);

        DB::table('abreviaciones_prof')
            ->where(
                'id_abreviacion_prof',
                $request->input('id_abreviacion_prof')
            )
            ->update([
                'id_abreviacion' => $request->input('id_abreviacion'),
            ]);

        return back();
    }

    public function edita_cedula($id_personal)
    {
        $profesor = DB::table('gnral_personales')
            ->where('id_personal', $id_personal)
            ->first();

        return view(
            'titulacion.jefe_titulacion.modal_editar_cedula_jurado',
            compact('profesor')
        );
    }

    public function guardar_editar_cedula_profesor(Request $request)
    {
        $this->validate($request, [
            'id_personal' => 'required',
            'cedula' => 'required',
        ]);

        DB::table('gnral_personales')
            ->where('id_personal', $request->input('id_personal'))
            ->update([
                'cedula' => $request->input('cedula'),
            ]);

        return back();
    }

    public function calendario_estudiantes_autorizado()
    {
        $estado_consulta_dia = 0;

        return view(
            'titulacion.jefe_titulacion.consultar_dia',
            compact('estado_consulta_dia')
        );
    }

    public function calendario_estudiantes_autorizado_dia($fecha_dia)
    {
        /*
        |--------------------------------------------------------------------------
        | IMPORTANTE
        |--------------------------------------------------------------------------
        | $fecha_dia viene directamente de la ruta.
        | NO se elimina ni se cambia de nombre.
        |--------------------------------------------------------------------------
        */

        // Guardamos la fecha original para las consultas a BD.
        $fecha_consulta = date('d-m-Y', strtotime($fecha_dia));


        /*
        |--------------------------------------------------------------------------
        | HORARIOS
        |--------------------------------------------------------------------------
        */

        $horas = DB::table('ti_horarios_dias')->get();

        /*
        |--------------------------------------------------------------------------
        | SALA 1 Y SALA 2
        |--------------------------------------------------------------------------
        */

        $registros = DB::table('ti_fecha_jurado_alumn')
            ->join(
                'ti_reg_datos_alum',
                'ti_fecha_jurado_alumn.id_alumno',
                '=',
                'ti_reg_datos_alum.id_alumno'
            )
            ->join(
                'gnral_carreras',
                'ti_reg_datos_alum.id_carrera',
                '=',
                'gnral_carreras.id_carrera'
            )
            ->select(
                'gnral_carreras.nombre as carrera',
                'ti_reg_datos_alum.no_cuenta',
                'ti_reg_datos_alum.nombre_al',
                'ti_reg_datos_alum.apaterno',
                'ti_reg_datos_alum.amaterno',
                'ti_reg_datos_alum.id_carrera',
                'ti_fecha_jurado_alumn.*'
            )
            ->where(
                'ti_fecha_jurado_alumn.fecha_titulacion',
                $fecha_consulta
            )
            ->where(
                'ti_fecha_jurado_alumn.id_estado_enviado',
                4
            )
            ->orderBy(
                'ti_fecha_jurado_alumn.id_horarios_dias'
            )
            ->get();

        $sala1 = [];
        $sala2 = [];

        /*
        |--------------------------------------------------------------------------
        | OBTENER JURADOS
        |--------------------------------------------------------------------------
        */

        foreach ($registros as $dia) {

            $jurados = DB::table('ti_jurado_alumno')
                ->join(
                    'gnral_personales',
                    'ti_jurado_alumno.id_personal',
                    '=',
                    'gnral_personales.id_personal'
                )
                ->join(
                    'abreviaciones_prof',
                    'gnral_personales.id_personal',
                    '=',
                    'abreviaciones_prof.id_personal'
                )
                ->join(
                    'abreviaciones',
                    'abreviaciones_prof.id_abreviacion',
                    '=',
                    'abreviaciones.id_abreviacion'
                )
                ->select(
                    'ti_jurado_alumno.id_tipo_jurado',
                    'gnral_personales.nombre',
                    'abreviaciones.titulo'
                )
                ->where(
                    'ti_jurado_alumno.id_alumno',
                    $dia->id_alumno
                )
                ->get();

            $presidente = '';
            $secretario = '';
            $vocal = '';
            $suplente = '';

            foreach ($jurados as $jurado) {

                $nombre = trim(
                    $jurado->titulo . ' ' . $jurado->nombre
                );

                switch ($jurado->id_tipo_jurado) {

                    case 1:
                        $presidente = $nombre;
                        break;

                    case 2:
                        $secretario = $nombre;
                        break;

                    case 3:
                        /*
                        | En tu código original el vocal y el suplente
                        | utilizaban ambos id_tipo_jurado = 3.
                        |
                        | Aquí conservamos esa lógica:
                        | el primer registro tipo 3 será vocal
                        | y el segundo será suplente.
                        */

                        if ($vocal === '') {
                            $vocal = $nombre;
                        } else {
                            $suplente = $nombre;
                        }

                        break;
                }
            }

            $datos_alumno = [
                'id_fecha_jurado_alumn' => $dia->id_fecha_jurado_alumn,
                'no_cuenta'             => $dia->no_cuenta,
                'nombre_al'             => $dia->nombre_al,
                'apaterno'              => $dia->apaterno,
                'amaterno'              => $dia->amaterno,
                'id_horarios_dias'      => $dia->id_horarios_dias,
                'carrera'               => $dia->carrera,
                'fecha_titulacion'      => $dia->fecha_titulacion,
                'id_sala'               => $dia->id_sala,
                'presidente'            => $presidente,
                'secretario'            => $secretario,
                'vocal'                 => $vocal,
                'suplente'              => $suplente,
            ];

            if ($dia->id_sala == 1) {
                $sala1[] = $datos_alumno;
            }

            if ($dia->id_sala == 2) {
                $sala2[] = $datos_alumno;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HORARIOS OCUPADOS
        |--------------------------------------------------------------------------
        */

        $horarios_ocupados = [];

        foreach ($sala1 as $registro) {
            $horarios_ocupados[] =
                $registro['id_horarios_dias'] . '-' .
                $registro['id_sala'];
        }

        foreach ($sala2 as $registro) {
            $horarios_ocupados[] =
                $registro['id_horarios_dias'] . '-' .
                $registro['id_sala'];
        }

        /*
        |--------------------------------------------------------------------------
        | FORMATO DE FECHA PARA MOSTRAR EN LA VISTA
        |--------------------------------------------------------------------------
        |
        | MUY IMPORTANTE:
        | La variable sigue llamándose $fecha_dia porque tu Blade
        | consultar_dia.blade.php la está utilizando.
        |--------------------------------------------------------------------------
        */

        $fecha_dia = date(
            'd-m-Y',
            strtotime($fecha_consulta)
        );

        /*
        |--------------------------------------------------------------------------
        | ESTADO
        |--------------------------------------------------------------------------
        */

        $estado_consulta_dia = 1;

        /*
        |--------------------------------------------------------------------------
        | VISTA
        |--------------------------------------------------------------------------
        */

        return view(
            'titulacion.jefe_titulacion.consultar_dia',
            compact(
                'estado_consulta_dia',
                'sala1',
                'horas',
                'fecha_dia',
                'sala2',
                'horarios_ocupados'
            )
        );
    }

    public function guardar_editar_registro_calendario(Request $request)
    {
        $request->validate([
            'id_fecha_jurado_alumn' => 'required|integer',
            'fecha_titulacion'      => 'required|date',
            'id_sala'               => 'required|integer',
            'id_horarios_dias'      => 'required|integer',
        ]);

        $fecha = date(
            'd-m-Y',
            strtotime($request->input('fecha_titulacion'))
        );

        $id = $request->input('id_fecha_jurado_alumn');
        $sala = $request->input('id_sala');
        $horario = $request->input('id_horarios_dias');

        $tabla = 'ti_fecha_jurado_alumn';

        /*
        |--------------------------------------------------------------------------
        | COMPROBAR CONFLICTO
        |--------------------------------------------------------------------------
        */

        $conflicto = DB::table($tabla)
            ->where('fecha_titulacion', $fecha)
            ->where('id_sala', $sala)
            ->where('id_horarios_dias', $horario)
            ->where(
                'id_fecha_jurado_alumn',
                '!=',
                $id
            )
            ->exists();

        if ($conflicto) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Este horario y sala ya están ocupados para esa fecha.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | ACTUALIZAR
        |--------------------------------------------------------------------------
        */

        DB::table($tabla)
            ->where(
                'id_fecha_jurado_alumn',
                $id
            )
            ->update([
                'fecha_titulacion' => $fecha,
                'id_sala' => $sala,
                'id_horarios_dias' => $horario,
            ]);

        /*
        |--------------------------------------------------------------------------
        | REGRESAR AL DÍA ACTUALIZADO
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'calendario_estudiantes_autorizado_dia',
                [
                    'fecha_dia' => $fecha
                ]
            )
            ->with(
                'success',
                'Registro actualizado correctamente.'
            );
    }
}
