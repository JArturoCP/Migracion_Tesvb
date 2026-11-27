<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

it('consulta encuestas de titulación por año, carrera y alumno', function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    $this->actingAs(EscenariosPanel::preparar('titulacion', []));
    $this->withSession(['historial_enc_t' => 1]);

    Schema::table('gnral_alumnos', function (Blueprint $tabla) {
        foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $columna) {
            $tabla->string($columna)->nullable();
        }
    });
    Schema::create('enc_periodo_titulacion', function (Blueprint $tabla) {
        $tabla->increments('id_periodo_titulacion');
        $tabla->integer('year');
    });
    Schema::create('enc_titulacion', function (Blueprint $tabla) {
        $tabla->increments('id_titulacion');
        foreach (['id_alumno', 'id_carrera', 'mes', 'year', 'id_estado'] as $columna) {
            $tabla->integer($columna);
        }
        foreach (range(4, 18) as $numero) {
            $tabla->integer('resp_preg'.$numero)->nullable();
        }
        $tabla->string('comentario_adicional')->nullable();
    });

    DB::table('enc_periodo_titulacion')->insert(['year' => 2026]);
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
