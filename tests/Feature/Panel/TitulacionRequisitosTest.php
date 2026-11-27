<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

it('muestra los expedientes de titulación en la pestaña que corresponde a su estado', function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    $this->actingAs(EscenariosPanel::preparar('titulacion', []));

    Schema::table('gnral_alumnos', function (Blueprint $tabla) {
        foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $campo) {
            $tabla->string($campo)->nullable();
        }
    });
    Schema::create('ti_descuentos_alum', function (Blueprint $tabla) {
        $tabla->integer('id_alumno');
    });
    Schema::create('ti_requisitos_titulacion', function (Blueprint $tabla) {
        $tabla->integer('id_alumno');
        $tabla->integer('id_estado_enviado');
        $tabla->integer('id_liberado_titulado')->default(0);
        $tabla->string('correo_electronico');
        $tabla->dateTime('fecha_registro');
    });

    DB::table('gnral_carreras')->insert([
        ['id_carrera' => 21, 'nombre' => 'Carrera de prueba'],
        ['id_carrera' => 22, 'nombre' => 'Carrera sin expedientes'],
    ]);

    foreach ([31 => 1, 32 => 2, 33 => 3, 34 => 4, 35 => 4] as $id => $estado) {
        DB::table('gnral_alumnos')->insert([
            'id_alumno' => $id, 'id_carrera' => 21, 'cuenta' => 'DEMO'.$id,
            'nombre' => 'Estudiante', 'apaterno' => 'De', 'amaterno' => 'Prueba',
        ]);
        DB::table('ti_descuentos_alum')->insert(['id_alumno' => $id]);
        DB::table('ti_requisitos_titulacion')->insert([
            'id_alumno' => $id, 'id_estado_enviado' => $estado, 'id_liberado_titulado' => (int) ($id === 35),
            'correo_electronico' => 'alumno'.$id.'@example.test', 'fecha_registro' => '2026-11-01 12:00:00',
        ]);
    }

    $base = '/titulacion/';
    $revision = $base.'autorizar_alumnos_doc_requisitos/21';
    $modificacion = $base.'proceso_modificacion_doc_requisitos/21';
    $autorizados = $base.'autorizados_doc_requisitos/21';

    $this->get($base.'autorizar_doc_requisitos')->assertOk()->assertSee('data-panel-contenido', false)
        ->assertSee('Carrera de prueba')->assertSee($revision);
    $this->get($revision)->assertOk()->assertSee('DEMO31')->assertSee('DEMO33')->assertDontSee('DEMO32')
        ->assertSee($base.'revisar_doc_requisitos/31')->assertSee('Autorizar modificación')
        ->assertSee($modificacion)->assertSee($autorizados)->assertDontSee('bootstrap.min.js', false);
    $this->get($modificacion)->assertOk()->assertSee('DEMO32')->assertDontSee('DEMO31')
        ->assertSee('aria-current="page"', false);
    $this->get($autorizados)->assertOk()->assertSee('DEMO34')->assertDontSee('DEMO35')
        ->assertSee($base.'ver_documentacion_autorizada/34')->assertSee($base.'pdf_requisitos_tramite_titulacion/34');
    $this->get($base.'autorizar_alumnos_doc_requisitos/22')->assertOk()->assertSee('Sin expedientes por autorizar');

    $this->get($base.'revisar_doc_requisitos/31')->assertOk()
        ->assertSee('data-panel-contenido', false)->assertSee('DEMO31')->assertSee($revision)
        ->assertSee('id="confirmar-revision-documento"', false)
        ->assertSee('v-on:click="guardarRevision"', false)
        ->assertSee('id="registrar-constancia-adeudo"', false)
        ->assertSee('id="confirmar-envio-correcciones"', false)
        ->assertSee('id="confirmar-autorizacion-documentacion"', false)
        ->assertSee($base.'documentacion_alumno/31')->assertDontSee('bootstrap.min.js', false);

    $this->get($base.'ver_documentacion_autorizada/34')->assertOk()
        ->assertSee('data-panel-contenido', false)->assertSee('DEMO34')->assertSee($autorizados)
        ->assertSee($base.'documentacion_alumno/34')->assertSee('Ver PDF')
        ->assertDontSee('id="confirmar-revision-documento"', false)->assertDontSee('bootstrap.min.js', false);
});
