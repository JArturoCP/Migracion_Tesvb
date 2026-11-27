<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
});

it('confirma el cierre y solo rechaza las encuestas pendientes del periodo seleccionado', function (
    string $tabla, string $tablaCierre, string $claveCierre, string $periodos, string $cierre, string $resultados,
) {
    $this->actingAs(EscenariosPanel::preparar('escolar', []));
    prepararTablaEncuestaEscolar($tabla);
    Schema::create($tablaCierre, function (Blueprint $table) use ($claveCierre) {
        $table->increments($claveCierre);
        $table->integer('id_periodo');
        $table->string('fecha_registro');
        $table->integer('id_estado');
    });

    $periodo = session('periodo_actual');
    DB::table($tabla)->insert([
        ['id_alumno' => 1, 'id_periodo' => $periodo, 'id_estado' => 0],
        ['id_alumno' => 2, 'id_periodo' => $periodo, 'id_estado' => 1],
        ['id_alumno' => 3, 'id_periodo' => session('periodo_anterior'), 'id_estado' => 0],
    ]);

    $base = '/encuestas_satisfaccion/';
    $ruta = $base.$periodos;
    $this->get($ruta)->assertOk()->assertSee('data-panel-contenido', false)
        ->assertSee('Periodo abierto')->assertSee('Encuestas no contestadas')
        ->assertSee('id="modal_enviar"', false)->assertSee('Confirmar cierre')
        ->assertSee('action="'.url($base.$cierre).'"', false)->assertDontSee('Ver resultados');

    $this->from($ruta)->post($base.$cierre)->assertRedirect($ruta);
    $this->assertDatabaseHas($tablaCierre, ['id_periodo' => $periodo, 'id_estado' => 1]);
    $this->assertDatabaseHas($tabla, ['id_alumno' => 1, 'id_estado' => 3]);
    $this->assertDatabaseHas($tabla, ['id_alumno' => 2, 'id_estado' => 1]);
    $this->assertDatabaseHas($tabla, ['id_alumno' => 3, 'id_estado' => 0]);

    $this->get($ruta)->assertOk()->assertSee('Periodo terminado')->assertSee('Encuestas rechazadas')
        ->assertSee($base.$resultados)->assertDontSee('id="modal_enviar"', false);
})->with([
    'inscripción' => ['enc_incripcion', 'enc_periodo_terminado', 'id_periodo_periodo', 'encuesta_incripcion_periodo', 'envio_periodo_terminado', 'ver_resultados_enc_incripcion'],
    'reinscripción' => ['enc_reinscripcion', 'enc_periodo_terminado_reins', 'id_periodo_reins', 'encuesta_reincripcion_periodo', 'envio_periodo_terminado_reins', 'ver_resultados_enc_reincripcion'],
]);

dataset('encuestas escolares', [
    'inscripción' => ['encuesta_incripcion', 'enviar_encuesta_incripcion', 'enc_incripcion', '1'],
    'reinscripción' => ['encuesta_reincripcion', 'enviar_encuesta_reinscripcion', 'enc_reinscripcion', '2'],
]);

it('muestra los resultados del periodo con diez preguntas calificadas y un resumen', function (string $tabla, string $ruta) {
    $this->actingAs(EscenariosPanel::preparar('escolar', []));
    prepararTablaEncuestaEscolar($tabla);
    $periodo = session('periodo_actual');
    DB::table($tabla)->insert([
        ['id_alumno' => 1, 'id_periodo' => $periodo, 'id_estado' => 1, 'cal_preg_1' => 4, 'cal_preg_10' => 1, 'cal_preg_11' => 2],
        ['id_alumno' => 2, 'id_periodo' => $periodo, 'id_estado' => 1, 'cal_preg_1' => 1, 'cal_preg_10' => 2, 'cal_preg_11' => 3],
        ['id_alumno' => 3, 'id_periodo' => session('periodo_anterior'), 'id_estado' => 1, 'cal_preg_1' => 4, 'cal_preg_10' => 2, 'cal_preg_11' => 1],
    ]);

    $respuesta = $this->get('/encuestas_satisfaccion/'.$ruta)->assertOk()
        ->assertSee('Resumen general')->assertSee('modules/exporting.js')->assertDontSee('Si tu tramite fue rechazado');
    $dom = new DOMDocument();
    @$dom->loadHTML($respuesta->getContent());
    $graficas = (new DOMXPath($dom))->query('//*[@data-grafica-encuesta]');

    expect($graficas->length)->toBe(11);
    expect($graficas->item(0)->getAttribute('data-grafica-encuesta'))->toBe('[1,1,1,1,0]')
        ->and($graficas->item(0)->getAttribute('data-total-encuesta'))->toBe('4')
        ->and($graficas->item(1)->getAttribute('data-grafica-encuesta'))->toBe('[1,0,0,1,0]')
        ->and($graficas->item(2)->getAttribute('data-total-encuesta'))->toBe('0')
        ->and($graficas->item(10)->getAttribute('data-grafica-encuesta'))->toBe('[0,1,1,0,0]');
})->with([
    'inscripción' => ['enc_incripcion', 'ver_resultados_enc_incripcion'],
    'reinscripción' => ['enc_reinscripcion', 'ver_resultados_enc_reincripcion'],
]);

it('muestra las once preguntas con los valores originales y restaura la captura', function (string $ruta, string $envio) {
    $this->actingAs(EscenariosPanel::preparar('alumno', []));
    $respuesta = $this->withSession(['_old_input' => ['pregunta1' => '3', 'pregunta10' => '1', 'motivo' => 'Faltó un documento']])
        ->get('/encuestas_satisfaccion/'.$ruta.'/');
    $respuesta->assertOk()->assertSee('data-panel-contenido', false)->assertSee('Faltó un documento');

    $dom = new DOMDocument();
    @$dom->loadHTML($respuesta->getContent());
    $xpath = new DOMXPath($dom);
    $form = $xpath->query('//form[@id="form_enviar_encuesta"]')->item(0);
    expect($form->getAttribute('action'))->toBe(url('/encuestas_satisfaccion/'.$envio))
        ->and($form->getAttribute('method'))->toBe('POST')
        ->and($xpath->query('.//input[@name="_token"]', $form)->length)->toBe(1);

    for ($numero = 1; $numero <= 11; $numero++) {
        $radios = iterator_to_array($xpath->query('.//input[@type="radio" and @name="pregunta'.$numero.'" and @required]', $form));
        $valores = array_map(fn ($radio) => $radio->getAttribute('value'), $radios);
        expect($valores)->toBe($numero === 10 ? ['2', '1'] : ['4', '3', '2', '1']);
    }

    expect($xpath->query('.//input[@name="pregunta1" and @value="3" and @checked]', $form)->length)->toBe(1)
        ->and($xpath->query('.//textarea[@name="motivo" and @required and not(@disabled)]', $form)->length)->toBe(1)
        ->and($xpath->query('.//textarea[@name="comentario" and not(@required)]', $form)->length)->toBe(1);
})->with('encuestas escolares');

function prepararTablaEncuestaEscolar(string $tabla): void
{
    Schema::table($tabla, function (Blueprint $table) {
        foreach (['id_carrera', 'id_tipo_encuesta'] as $columna) {
            $table->integer($columna)->nullable();
        }
        for ($numero = 1; $numero <= 11; $numero++) {
            $table->integer('cal_preg_'.$numero)->nullable();
        }
        $table->string('fecha_encuesta')->nullable();
        $table->string('fecha_registro')->nullable();
        $table->text('comentario_res_preg_10')->nullable();
        $table->text('comentario')->nullable();
    });
}

it('guarda las respuestas con el procedimiento original y vuelve al inicio', function (string $ruta, string $envio, string $tabla, string $rechazado) {
    $this->actingAs(EscenariosPanel::preparar('alumno', []));
    prepararTablaEncuestaEscolar($tabla);
    $idAlumno = DB::table('gnral_alumnos')->where('id_usuario', auth()->id())->value('id_alumno');
    DB::table($tabla)->insert(['id_alumno' => $idAlumno, 'id_periodo' => session('periodo_actual')]);

    $respuestas = array_fill_keys(array_map(fn ($numero) => 'pregunta'.$numero, range(1, 11)), '4');
    $respuestas['pregunta10'] = $rechazado;
    $respuestas['motivo'] = 'Faltó un documento';

    $this->post('/encuestas_satisfaccion/'.$envio.'/', $respuestas)->assertRedirect('/inicio');
    $this->assertDatabaseHas($tabla, [
        'id_alumno' => $idAlumno, 'id_estado' => 1, 'cal_preg_1' => 4, 'cal_preg_11' => 4,
        'cal_preg_10' => $rechazado, 'comentario_res_preg_10' => $rechazado === '1' ? 'Faltó un documento' : '', 'comentario' => '',
    ]);
})->with('encuestas escolares');

it('permite consultar las respuestas por carrera y muestra por separado el motivo y los comentarios', function (
    string $tabla, string $clave, string $programas, string $listado, string $detalle, int $rechazado,
) {
    $this->actingAs(EscenariosPanel::preparar('escolar', []));
    prepararTablaEncuestaEscolar($tabla);
    Schema::table('gnral_alumnos', function (Blueprint $table) {
        foreach (['cuenta', 'nombre', 'apaterno', 'amaterno'] as $columna) {
            $table->string($columna)->nullable();
        }
    });

    $base = '/encuestas_satisfaccion/';
    $idCarrera = DB::table('gnral_carreras')->insertGetId(['nombre' => 'Carrera de prueba']);
    $rutaListado = $base.$listado.'/'.$idCarrera;
    $this->get($base.$programas)->assertOk()
        ->assertSee('data-panel-contenido', false)->assertSee('Carrera de prueba')->assertSee($rutaListado);
    $this->get($rutaListado)->assertOk()->assertSee('Sin encuestas contestadas');

    $idAlumno = DB::table('gnral_alumnos')->insertGetId([
        'id_carrera' => $idCarrera, 'cuenta' => '20260001', 'nombre' => 'Estudiante', 'apaterno' => 'De', 'amaterno' => 'Prueba',
    ]);
    $idEncuesta = DB::table($tabla)->insertGetId([
        'id_alumno' => $idAlumno, 'id_carrera' => $idCarrera, 'id_periodo' => session('periodo_actual'), 'id_estado' => 1,
        'cal_preg_1' => 4, 'cal_preg_10' => $rechazado, 'comentario_res_preg_10' => 'Faltó un documento',
        'comentario' => 'Ampliar el horario de atención.',
    ], $clave);
    $rutaDetalle = $base.$detalle.'/'.$idEncuesta;

    $this->get($rutaListado)->assertOk()->assertSee('20260001')->assertSee('Estudiante De Prueba')
        ->assertSee('id="tabla_alumnos"', false)->assertSee($rutaDetalle);
    $respuesta = $this->get($rutaDetalle)->assertOk()->assertSee($rutaListado)
        ->assertSee('Excelente')->assertSee('Sin respuesta')->assertSee('Ampliar el horario de atención.')
        ->assertDontSee('name="pregunta1"', false);

    if ($rechazado === 1) {
        $respuesta->assertSeeInOrder(['Motivo o requisito faltante', 'Faltó un documento', 'Comentarios', 'Ampliar el horario de atención.']);
    } else {
        $respuesta->assertDontSee('Faltó un documento');
    }
})->with([
    'inscripción' => ['enc_incripcion', 'id_incripcion', 'carrera_enc_incripcion', 'alumnos_enc_incripcion', 'enc_est_inscripcion', 1],
    'reinscripción' => ['enc_reinscripcion', 'id_reinscripcion', 'carrera_enc_reincripcion', 'alumnos_enc_reincripcion', 'enc_est_reinscripcion', 2],
]);
