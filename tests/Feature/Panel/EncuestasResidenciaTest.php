<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

it('consulta las encuestas de residencia de la carrera seleccionada y sus respuestas', function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    $this->actingAs(EscenariosPanel::preparar('residencias', []));

    Schema::table('gnral_alumnos', function (Blueprint $tabla) {
        foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $columna) {
            $tabla->string($columna)->nullable();
        }
    });
    Schema::create('enc_periodo_residencia', function (Blueprint $tabla) {
        $tabla->increments('id_periodo_residencia');
        $tabla->integer('id_periodo');
        $tabla->integer('id_estado')->default(0);
        $tabla->string('fecha_registro')->nullable();
        $tabla->string('fecha_termino')->nullable();
    });
    Schema::table('enc_residencia_profesional', function (Blueprint $tabla) {
        $tabla->integer('id_residencia_profesional')->nullable();
        $tabla->integer('id_periodo')->nullable();
        $tabla->integer('id_tipo_encuesta')->nullable();
        $tabla->string('fecha_registro')->nullable();
        $tabla->string('fecha_encuesta')->nullable();
        foreach (range(1, 10) as $numero) {
            $tabla->integer('cal_preg_'.$numero)->nullable();
        }
        $tabla->string('comentario')->nullable();
    });
    $periodo = session('periodo_actual');
    $rutaPeriodos = '/encuestas_satisfaccion/agregar_periodo_year_residencia';
    $this->get($rutaPeriodos)->assertOk()->assertSee('Periodo sin registrar')->assertSee('guardar_periodo_year_residencia');
    $this->from($rutaPeriodos)->post('/encuestas_satisfaccion/guardar_periodo_year_residencia', ['id_periodo' => $periodo])->assertRedirect($rutaPeriodos);
    DB::table('enc_periodo_residencia')->where('id_periodo', $periodo)->update(['id_periodo_residencia' => 4]);
    DB::table('gnral_carreras')->insert([['id_carrera' => 21, 'nombre' => 'Carrera elegida'], ['id_carrera' => 22, 'nombre' => 'Otra carrera']]);
    DB::table('gnral_alumnos')->insert([
        ['id_alumno' => 31, 'id_carrera' => 21, 'nombre' => 'Estudiante de prueba', 'cuenta' => 'DEMO31'],
        ['id_alumno' => 32, 'id_carrera' => 22, 'nombre' => 'Estudiante de otra carrera', 'cuenta' => 'DEMO32'],
        ['id_alumno' => 33, 'id_carrera' => 21, 'nombre' => 'Estudiante pendiente', 'cuenta' => 'DEMO33'],
    ]);
    DB::table('enc_residencia_profesional')->insert([
        ['id_residencia_profesional' => 51, 'id_alumno' => 31, 'id_periodo' => $periodo, 'id_estado' => 1, 'cal_preg_1' => 5, 'comentario' => 'Comentario de prueba'],
        ['id_residencia_profesional' => 52, 'id_alumno' => 32, 'id_periodo' => $periodo, 'id_estado' => 1, 'cal_preg_1' => 4, 'comentario' => null],
    ]);

    $base = '/encuestas_satisfaccion/';
    $this->get($rutaPeriodos)->assertOk()->assertSee('Abierto')->assertSee('ver_carreras_encuesta_residencia/'.$periodo)
        ->assertSee('termino_encuesta_residencia/4');
    $this->get($base.'ver_carreras_encuesta_residencia/'.$periodo)->assertOk()->assertSee('ver_encuesta_residencia_alumno/21');
    Schema::create('resi_asesores', function (Blueprint $tabla) {
        $tabla->integer('id_anteproyecto');
        $tabla->integer('id_periodo');
        $tabla->integer('id_carrera');
    });
    Schema::create('resi_promedio_general_residencia', function (Blueprint $tabla) {
        $tabla->integer('id_anteproyecto');
    });
    Schema::create('resi_anteproyecto', function (Blueprint $tabla) {
        $tabla->integer('id_anteproyecto');
        $tabla->integer('id_alumno');
    });
    DB::table('resi_asesores')->insert(['id_anteproyecto' => 61, 'id_periodo' => $periodo, 'id_carrera' => 21]);
    DB::table('resi_promedio_general_residencia')->insert(['id_anteproyecto' => 61]);
    DB::table('resi_anteproyecto')->insert(['id_anteproyecto' => 61, 'id_alumno' => 33]);
    $this->get($base.'ver_encuesta_residencia_alumno/21')->assertOk()->assertSee('DEMO31')->assertDontSee('DEMO32')
        ->assertSee('ver_carreras_encuesta_residencia/'.$periodo)->assertSee('enc_residencia_datos_alumn/33')->assertSee('envio_encuesta_estudiante_residencia');
    $this->get($base.'enc_residencia_datos_alumn/33')->assertOk()->assertSee('name="id_alumno" value="33"', false);
    $this->from($base.'ver_encuesta_residencia_alumno/21')->post($base.'envio_encuesta_estudiante_residencia', ['id_alumno' => 33])
        ->assertRedirect($base.'ver_encuesta_residencia_alumno/21');
    $this->assertDatabaseHas('enc_residencia_profesional', ['id_alumno' => 33, 'id_periodo' => $periodo]);
    $this->get($base.'termino_encuesta_residencia/4')->assertOk()->assertSee('name="id_periodo_residencia" value="4"', false);
    $this->from($rutaPeriodos)->post($base.'guardar_termino_encuesta_residencia', ['id_periodo_residencia' => 4])->assertRedirect($rutaPeriodos);
    $this->get($rutaPeriodos)->assertOk()->assertSee('Terminado')->assertSee('ver_enc_contestadas_residencia/4')
        ->assertDontSee('termino_encuesta_residencia/4');

    $alumnos = $base.'ver_enc_contestadas_resi_alum/21/4';
    $detalle = $base.'ver_enc_alumno_contestada/51';
    $this->get($base.'ver_enc_contestadas_residencia/4')->assertOk()->assertSee('data-panel-contenido', false)
        ->assertSee('Carrera elegida')->assertSee($alumnos);
    $this->get($alumnos)->assertOk()->assertSee('DEMO31')->assertSee($detalle)->assertDontSee('DEMO32');
    $this->get($detalle)->assertOk()->assertSee($alumnos)->assertSee('Excelente')->assertSee('Sin respuesta')
        ->assertSee('Comentario de prueba')->assertDontSee('name="pregunta1"', false);

    $reporte = $this->get($base.'ver_enc_carreras_res_residencia/4')->assertOk()
        ->assertSee('Resumen general')->assertSee('Excelente y bueno')->assertSee('modules/exporting.js');
    $dom = new DOMDocument();
    @$dom->loadHTML($reporte->getContent());
    $graficas = (new DOMXPath($dom))->query('//*[@data-grafica-residencia]');
    expect($graficas->length)->toBe(11)
        ->and($graficas->item(1)->getAttribute('data-grafica-residencia'))->toBe('[50,50,0,0,0]')
        ->and($graficas->item(2)->getAttribute('data-grafica-residencia'))->toBe('[0,0,0,0,0]');

    $usuario = EscenariosPanel::preparar('alumno', ['id_usuario' => 44]);
    $usuario->tipo_usuario = 1;
    $this->actingAs($usuario);
    $idAlumno = DB::table('gnral_alumnos')->where('id_usuario', $usuario->id)->value('id_alumno');
    DB::table('enc_residencia_profesional')->insert(['id_alumno' => $idAlumno, 'id_periodo' => $periodo, 'id_estado' => 0]);
    $rutaCaptura = $base.'encuesta_residencia/';
    $formulario = $this->get($rutaCaptura)->assertOk()->assertSee('Comentario (opcional)')
        ->assertSee($base.'guardar_encuesta_residencia/'.$idAlumno);
    @$dom->loadHTML($formulario->getContent());
    $xpath = new DOMXPath($dom);
    expect($xpath->query('//form[@id="form_enviar_encuesta"]//input[@type="radio" and @required]')->length)->toBe(50)
        ->and($xpath->query('//textarea[@name="comentario" and not(@required)]')->length)->toBe(1);

    $respuestas = array_fill_keys(array_map(fn ($numero) => 'pregunta'.$numero, range(1, 10)), 5);
    $this->post($base.'guardar_encuesta_residencia/'.$idAlumno, $respuestas)->assertRedirect('/inicio');
    $this->assertDatabaseHas('enc_residencia_profesional', ['id_alumno' => $idAlumno, 'id_estado' => 1, 'cal_preg_10' => 5, 'comentario' => '']);
    $this->get($rutaCaptura)->assertOk()->assertSee('Encuesta enviada correctamente')->assertDontSee('id="form_enviar_encuesta"', false);
});
