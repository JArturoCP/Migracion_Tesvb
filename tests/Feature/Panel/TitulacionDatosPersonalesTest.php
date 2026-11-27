<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

it('conserva los estados de datos personales y las consultas de proyectos por carrera', function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    $this->actingAs(EscenariosPanel::preparar('titulacion', []));

    Schema::create('ti_reg_datos_alum', function (Blueprint $tabla) {
        $tabla->increments('id_reg_dato_alum');
        foreach (['id_alumno', 'id_carrera', 'id_estado_enviado', 'id_opcion_titulacion', 'id_liberado_titulado', 'id_enviado_biblioteca'] as $campo) {
            $tabla->integer($campo);
        }
        foreach (['no_cuenta', 'nombre_al', 'apaterno', 'amaterno', 'correo_electronico', 'telefono', 'nom_proyecto'] as $campo) {
            $tabla->string($campo);
        }
        $tabla->dateTime('fecha_registro');
    });
    Schema::create('ti_opciones_titulacion', function (Blueprint $tabla) {
        $tabla->integer('id_opcion_titulacion');
        $tabla->string('opcion_titulacion');
    });
    Schema::create('ti_fecha_jurado_alumn', function (Blueprint $tabla) {
        $tabla->integer('id_alumno');
        $tabla->integer('asesor')->nullable();
        $tabla->integer('revisor')->nullable();
        $tabla->string('pdf_reporte_titulacion');
    });

    DB::table('gnral_carreras')->insert([
        ['id_carrera' => 21, 'nombre' => 'Carrera de prueba'],
        ['id_carrera' => 22, 'nombre' => 'Carrera sin registros'],
    ]);
    DB::table('ti_opciones_titulacion')->insert(['id_opcion_titulacion' => 5, 'opcion_titulacion' => 'Tesis']);

    foreach ([31 => 1, 32 => 2, 33 => 3, 34 => 4, 35 => 5, 36 => 5] as $id => $estado) {
        DB::table('ti_reg_datos_alum')->insert([
            'id_alumno' => $id, 'id_carrera' => 21, 'id_estado_enviado' => $estado,
            'id_opcion_titulacion' => 5, 'id_liberado_titulado' => (int) ($id === 36), 'id_enviado_biblioteca' => (int) ($estado === 5),
            'no_cuenta' => 'DEMO'.$id, 'nombre_al' => 'Estudiante', 'apaterno' => 'De', 'amaterno' => 'Prueba',
            'correo_electronico' => 'alumno'.$id.'@example.test', 'telefono' => '0000000000',
            'nom_proyecto' => 'Proyecto de prueba '.$id, 'fecha_registro' => '2026-11-01 12:00:00',
        ]);
    }
    DB::table('ti_fecha_jurado_alumn')->insert(['id_alumno' => 35, 'pdf_reporte_titulacion' => 'proyecto-prueba.pdf']);

    $base = '/titulacion/';
    $revision = $base.'carrera_alum_reg_datos/21';
    $modificacion = $base.'proceso_modificacion_datos_alumno/21';
    $entrega = $base.'faltante_datos_alumno/21';
    $autorizados = $base.'autorizados_datos_alumno/21';
    $proyectos = $base.'carrera_informacion/21';

    $this->get($base.'autorizar_datos_personales')->assertOk()->assertSee('data-panel-contenido', false)->assertSee($revision);
    $this->get($revision)->assertOk()->assertSee('DEMO31')->assertSee('DEMO33')->assertDontSee('DEMO32')
        ->assertSee('Autorizar correcciones')->assertSee($base.'revisar_datos_generales/33')
        ->assertSee($modificacion)->assertSee($entrega)->assertSee($autorizados)->assertDontSee('bootstrap.min.js', false);
    $this->get($modificacion)->assertOk()->assertSee('DEMO32')->assertDontSee('DEMO31');
    $this->get($entrega)->assertOk()->assertSee('DEMO34')->assertSee($base.'ver_datos_personales_alumno_ti/34/21');
    $this->get($autorizados)->assertOk()->assertSee('DEMO35')->assertDontSee('DEMO36')->assertSee($base.'ver_datos_per_ti_aut/35/21');
    $this->get($base.'carrera_alum_reg_datos/22')->assertOk()->assertSee('Sin datos por autorizar');

    foreach ([
        [$base.'ver_datos_personales_alumno_ti/34/21', $entrega, 34],
        [$base.'ver_datos_per_ti_aut/35/21', $autorizados, 35],
    ] as [$ruta, $regreso, $idAlumno]) {
        $this->get($ruta)->assertOk()->assertSee('data-panel-contenido', false)->assertSee($regreso)
            ->assertSee('Identificación y contacto')->assertSee('Trayectoria escolar')
            ->assertSee('Domicilio')->assertSee('Información complementaria')
            ->assertSee('Donación de libros')->assertSee('Nombre del equipo')->assertSee('Folio fiscal')
            ->assertSee('const idAlumno = '.$idAlumno, false)->assertDontSee('bootstrap.min.js', false);
    }

    $this->get($base.'documento_titulacion_autorizado')->assertOk()->assertSee($proyectos);
    $this->get($proyectos)->assertOk()->assertSee('Proyecto de prueba 35')->assertSee($base.'proyecto-prueba.pdf')
        ->assertSee('Sin documento')->assertDontSee('DEMO34')->assertDontSee('bootstrap.min.js', false);
    $this->get($base.'carrera_informacion/22')->assertOk()->assertSee('Sin proyectos autorizados');
});
