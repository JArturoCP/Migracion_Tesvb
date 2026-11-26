<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

it('mantiene el recorrido por periodo, carrera y respuestas en Servicio Social', function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    $this->actingAs(EscenariosPanel::preparar('residencias', []));
    $this->withSession(['historial_enc_s' => 1]);

    Schema::table('gnral_alumnos', function (Blueprint $tabla) {
        foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $columna) {
            $tabla->string($columna)->nullable();
        }
    });
    Schema::create('enc_periodo_servicio', function (Blueprint $tabla) {
        $tabla->increments('id_periodo_serv');
        $tabla->integer('mes');
        $tabla->integer('year');
        $tabla->integer('id_estado')->default(0);
        $tabla->string('fecha_registro')->nullable();
        $tabla->string('fecha_liberacion')->nullable();
    });
    Schema::table('enc_servicio_social', function (Blueprint $tabla) {
        $tabla->integer('mes')->nullable();
        $tabla->integer('year')->nullable();
        $tabla->string('fecha_registro')->nullable();
        $tabla->string('fecha_encuesta')->nullable();
        $tabla->string('comentario')->nullable();
        foreach (range(1, 10) as $numero) {
            $tabla->integer('cal_preg_'.$numero)->nullable();
        }
    });

    DB::table('enc_periodo_servicio')->insert(['mes' => 2, 'year' => 2026, 'id_estado' => 0]);
    DB::table('gnral_carreras')->insert(['id_carrera' => 21, 'nombre' => 'Carrera de prueba']);
    DB::table('gnral_alumnos')->insert(['id_alumno' => 31, 'id_carrera' => 21, 'cuenta' => 'DEMO31', 'nombre' => 'Estudiante', 'apaterno' => 'De', 'amaterno' => 'Prueba']);
    DB::table('gnral_alumnos')->insert(['id_alumno' => 32, 'id_carrera' => 21, 'cuenta' => 'DEMO32', 'nombre' => 'Estudiante pendiente']);
    DB::table('eva_validacion_de_cargas')->insert(['id_alumno' => 32, 'id_periodo' => session('periodo_actual')]);
    DB::table('enc_servicio_social')->insert(['id_servicio' => 51, 'id_alumno' => 31, 'mes' => 2, 'year' => 2026, 'id_estado' => 1, 'cal_preg_1' => 5, 'comentario' => 'Comentario de prueba']);

    $base = '/encuestas_satisfaccion/';
    $programas = $base.'ver_carreras_encuesta_servicio/2/2026';
    $listado = $base.'ver_enc_serv_alum_terminado/21/2/2026';
    $detalle = $base.'ver_enc_terminada/51';
    $periodos = $base.'agregar_periodo_year';
    $envios = $base.'ver_encuesta_servicio_alumno/21/2/2026';
    $this->get($periodos)->assertOk()->assertSee('id="form_agregar"', false)->assertSee('registrar_periodo_year');
    $this->from($periodos)->post($base.'registrar_periodo_year', ['mes' => 1, 'year' => 2026])->assertRedirect($periodos);
    $this->assertDatabaseHas('enc_periodo_servicio', ['mes' => 1, 'year' => 2026]);
    $this->get($base.'historial_periodo_year')->assertOk()->assertSee($base.'menu_historial_servicio_s_year/2026');
    $this->get($base.'menu_historial_servicio_s_year/2026')->assertOk()->assertSee($programas)
        ->assertSee('termino_encuesta_servicio/1')->assertDontSee('id="form_agregar"', false);
    $this->get($programas)->assertOk()->assertSee('Periodo abierto')->assertSee($base.'ver_encuesta_servicio_alumno/21/2/2026')
        ->assertDontSee('Ver resultados');
    $this->get($envios)->assertOk()->assertSee('DEMO31')->assertSee('DEMO32')
        ->assertSee('enc_servicio_datos_alumn/32')->assertSee('envio_encuesta_estudiante_servicio/2/2026');
    $this->get($base.'enc_servicio_datos_alumn/32')->assertOk()->assertSee('name="id_alumno" value="32"', false);
    $this->from($envios)->post($base.'envio_encuesta_estudiante_servicio/2/2026', ['id_alumno' => 32])->assertRedirect($envios);
    $this->assertDatabaseHas('enc_servicio_social', ['id_alumno' => 32, 'mes' => 2, 'year' => 2026]);
    DB::table('enc_servicio_social')->where('id_alumno', 32)->update(['id_estado' => 0]);

    $this->get($base.'termino_encuesta_servicio/1')->assertOk()->assertSee('name="id_periodo_serv" value="1"', false);
    $this->from($periodos)->post($base.'guardar_termino_encuesta_servicio', ['id_periodo_serv' => 1])->assertRedirect($periodos);
    $this->assertDatabaseHas('enc_servicio_social', ['id_alumno' => 32, 'id_estado' => 3]);
    $this->get($programas)->assertOk()->assertSee('Periodo terminado')->assertSee($listado)->assertSee($base.'ver_enc_resultados/2/2026')
        ->assertSee($base.'menu_historial_servicio_s_year/2026');
    $this->get($listado)->assertOk()->assertSee('Estudiante De Prueba')->assertSee('Julio de 2026')->assertSee($detalle);
    $this->get($detalle)->assertOk()->assertSee($listado)->assertSee('Excelente')->assertSee('Sin respuesta')
        ->assertSee('Comentario de prueba')->assertDontSee('name="pregunta1"', false);
});
