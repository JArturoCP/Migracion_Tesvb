<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();

    Schema::table('gnral_alumnos', function (Blueprint $tabla) {
        foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $columna) {
            $tabla->string($columna)->nullable();
        }
    });
    Schema::create('enc_periodo_titulacion', function (Blueprint $tabla) {
        $tabla->increments('id_periodo_titulacion');
        $tabla->integer('year');
        $tabla->integer('mes');
        $tabla->integer('id_estado')->default(0);
        $tabla->dateTime('fecha_registro')->nullable();
        $tabla->dateTime('fecha_liberacion')->nullable();
    });
    Schema::create('enc_titulacion', function (Blueprint $tabla) {
        $tabla->increments('id_titulacion');
        foreach (['id_alumno', 'id_carrera', 'mes', 'year', 'id_estado'] as $columna) {
            $tabla->integer($columna);
        }
        foreach (range(4, 18) as $numero) {
            $tabla->integer('resp_preg'.$numero)->nullable();
        }
        $tabla->integer('id_tipo_encuesta')->nullable();
        $tabla->dateTime('fecha_registro')->nullable();
        $tabla->dateTime('fecha_encuesta')->nullable();
        $tabla->string('comentario_adicional')->nullable();
    });
});

it('consulta encuestas de titulación por año, carrera y alumno', function () {
    $this->actingAs(EscenariosPanel::preparar('titulacion', []));
    $this->withSession(['historial_enc_t' => 1]);

    DB::table('enc_periodo_titulacion')->insert(['year' => 2026, 'mes' => 2]);
    DB::table('gnral_carreras')->insert(['id_carrera' => 21, 'nombre' => 'Carrera de prueba']);
    DB::table('gnral_alumnos')->insert(['id_alumno' => 31, 'id_carrera' => 21, 'cuenta' => 'DEMO31', 'nombre' => 'Estudiante de prueba']);
    DB::table('enc_titulacion')->insert([
        'id_titulacion' => 51, 'id_alumno' => 31, 'id_carrera' => 21, 'mes' => 2, 'year' => 2026, 'id_estado' => 1,
        'resp_preg4' => 2, 'resp_preg9' => 5, 'resp_preg15' => 3, 'comentario_adicional' => 'Comentario de prueba',
    ]);

    $base = '/encuestas_satisfaccion/';
    $periodos = $base.'menu_historial_titulacion_year/2026';
    $programas = $base.'enc_contestadas_carreras_ti/2/2026';
    $listado = $base.'enc_est_ti_carrera_termino/21/2/2026';
    $detalle = $base.'enc_est_ti_alumno_termino/51';

    $this->get($base.'historial_encuesta_estudiante_titulacion')->assertOk()->assertSee($periodos);
    $this->get($programas)->assertOk()->assertSee('data-panel-contenido', false)->assertSee($periodos)->assertSee($listado);
    $this->get($listado)->assertOk()->assertSee('Julio de 2026')->assertSee('DEMO31')->assertSee($detalle);
    $this->get($detalle)->assertOk()->assertSee($listado)->assertSee('Comentario de prueba')
        ->assertSee('Muy importante')->assertSee('Adecuado')->assertSee('Sin respuesta')->assertDontSee('name="pregunta1"', false);
});

it('gestiona los periodos de titulación y conserva la consulta por carrera y los resultados', function () {
    $this->actingAs(EscenariosPanel::preparar('titulacion', []));
    Schema::create('ti_reg_datos_alum', function (Blueprint $tabla) {
        $tabla->integer('id_alumno');
        $tabla->integer('id_carrera');
        foreach (['no_cuenta', 'nombre_al', 'apaterno', 'amaterno'] as $columna) {
            $tabla->string($columna);
        }
    });
    DB::table('gnral_carreras')->insert(['id_carrera' => 21, 'nombre' => 'Carrera de prueba']);
    DB::table('ti_reg_datos_alum')->insert([
        'id_alumno' => 31, 'id_carrera' => 21, 'no_cuenta' => 'DEMO31',
        'nombre_al' => 'Estudiante', 'apaterno' => 'de', 'amaterno' => 'prueba',
    ]);
    $encuesta = ['id_alumno' => 31, 'id_carrera' => 21, 'mes' => 2, 'year' => 2026];
    DB::table('enc_titulacion')->insert($encuesta + ['id_titulacion' => 51, 'id_estado' => 1, 'resp_preg15' => 3]);
    DB::table('enc_titulacion')->insert($encuesta + ['id_titulacion' => 52, 'id_estado' => 0]);
    DB::table('enc_titulacion')->insert(array_replace($encuesta, ['id_titulacion' => 53, 'mes' => 1, 'id_estado' => 0]));

    $base = '/encuestas_satisfaccion/';
    $periodos = $base.'menu_historial_titulacion_year/2026';
    $listado = $base.'encuesta_estudiante_titulacion_carrera/21/2026/2';
    $resultados = $base.'ver_resultados_enc_ti/2/2026';

    $this->get($periodos)->assertOk()->assertSee('Sin periodos registrados')->assertSee('Agregar periodo');
    $this->from($periodos)->post($base.'registrar_periodo_year_titulacion', ['year' => 2026, 'mes' => 2])->assertRedirect($periodos);
    $this->get($periodos)->assertOk()->assertSee('data-panel-contenido', false)
        ->assertSee($base.'termino_encuesta_titulacion/1')->assertDontSee($resultados);
    $this->get($base.'termino_encuesta_titulacion/1')->assertOk()->assertSee('name="id_periodo_titulacion" value="1"', false);
    $this->get($base.'enviar_enc_carreras_ti/2/2026')->assertOk()->assertSee('Encuestas enviadas')->assertSee($listado);
    $this->get($listado)->assertOk()->assertSee('DEMO31')->assertSee('Estudiante de prueba')
        ->assertSee($base.'enc_est_ti_alumno_termino/51');
    $this->from($periodos)->post($base.'guardar_termino_encuesta_titulacion', ['id_periodo_titulacion' => 1])->assertRedirect($periodos);
    $this->assertDatabaseHas('enc_titulacion', ['id_titulacion' => 51, 'id_estado' => 1]);
    $this->assertDatabaseHas('enc_titulacion', ['id_titulacion' => 52, 'id_estado' => 3]);
    $this->assertDatabaseHas('enc_titulacion', ['id_titulacion' => 53, 'id_estado' => 0]);
    $this->get($periodos)->assertOk()->assertSee($resultados)->assertDontSee('Terminar el periodo');
    $this->get($resultados)->assertOk()->assertSee('Satisfacción total')->assertSee('100.00 %')
        ->assertSee('id="grafica-titulacion"', false)->assertDontSee('bootstrap.min.js', false);
});

it('renderiza las preguntas obligatorias y guarda las escalas originales de titulación', function () {
    Schema::table('users', function (Blueprint $tabla) {
        $tabla->integer('tipo_usuario')->nullable();
    });
    $usuario = EscenariosPanel::preparar('alumno', ['carrera_alumno' => 21]);
    $usuario->forceFill(['tipo_usuario' => 1])->save();
    $this->actingAs($usuario);
    $idAlumno = DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->value('id_alumno');
    Schema::create('ti_fecha_jurado_alumn', function (Blueprint $tabla) {
        $tabla->integer('id_alumno');
        $tabla->string('fecha_titulacion');
    });
    DB::table('ti_fecha_jurado_alumn')->insert(['id_alumno' => $idAlumno, 'fecha_titulacion' => '15/07/2026']);

    $accion = '/encuestas_satisfaccion/guardar_encuesta_titulacion/'.$idAlumno;
    $this->get('/encuestas_satisfaccion/contestar_encuesta_alumno')->assertOk()
        ->assertSee($accion)->assertSee('data-panel-envio', false)->assertDontSee('bootstrap.min.js', false)
        ->assertSee('name="pregunta6" id="pregunta6-5"', false)->assertSee('Muy importante')
        ->assertSee('name="pregunta12" id="pregunta12-3"', false)->assertSee('Adecuado')
        ->assertSee('name="pregunta15" id="pregunta15-1"', false)->assertSee('name="comentario"', false);

    $respuestas = ['comentario' => 'Comentario de prueba'];
    foreach (range(1, 15) as $numero) {
        $respuestas['pregunta'.$numero] = 1;
    }
    $respuestas['pregunta6'] = 5;
    $respuestas['pregunta12'] = 3;
    $this->post($accion, $respuestas)->assertRedirect('/titulacion/registro_jurado');
    $this->assertDatabaseHas('enc_titulacion', [
        'id_alumno' => $idAlumno, 'id_estado' => 1, 'mes' => 2, 'year' => 2026,
        'resp_preg4' => 1, 'resp_preg9' => 5, 'resp_preg15' => 3, 'resp_preg18' => 1,
        'comentario_adicional' => 'Comentario de prueba',
    ]);
});
