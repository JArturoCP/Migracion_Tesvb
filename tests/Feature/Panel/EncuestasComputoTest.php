<?php

use Tests\Support\EscenariosPanel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    $this->actingAs(EscenariosPanel::preparar('computo', []));
});

it('conserva las acciones de gestión y presenta los resultados del mes seleccionado', function () {
    Schema::create('enc_servicio_mantenimiento', function (Blueprint $tabla) {
        $tabla->increments('id_servicio_mantenimiento');
        foreach (['mes', 'year', 'id_personal', 'id_estado', 'cal_preg_1', 'cal_preg_2', 'cal_preg_3', 'cal_preg_4'] as $nombre) {
            $tabla->integer($nombre)->nullable();
        }
        foreach (['fecha_solicita', 'servicio_solicita', 'sugerencias'] as $nombre) {
            $tabla->string($nombre)->nullable();
        }
    });
    Schema::create('enc_periodo_mantenimiento', function (Blueprint $tabla) {
        $tabla->increments('id_periodo_mantenimiento');
        foreach (['mes', 'year', 'id_estado'] as $nombre) {
            $tabla->integer($nombre);
        }
    });

    $base = '/encuestas_satisfaccion/';
    $datos = ['year' => 2026, 'mes' => 1, 'id_personal' => EscenariosPanel::ID_PERSONAL, 'fecha_solicita' => '2026-01-15', 'servicio_solicita' => 'Servicio de prueba'];
    DB::table('enc_servicio_mantenimiento')->insert($datos + ['id_servicio_mantenimiento' => 81, 'id_estado' => 0]);
    DB::table('enc_servicio_mantenimiento')->insert($datos + ['id_servicio_mantenimiento' => 82, 'id_estado' => 2,
        'cal_preg_1' => 5, 'cal_preg_2' => 5, 'cal_preg_3' => 5, 'cal_preg_4' => 5, 'sugerencias' => 'Sugerencia de prueba']);

    $this->get($base.'ver_encuestas_mant/1/2026')->assertOk()->assertSee('data-panel-contenido', false)
        ->assertSee('data-target="#modal_agregar"', false)->assertSee($base.'notificacion_enviar_enc_mantenimiento/81')
        ->assertSee($base.'eliminar_enc_mantenimiento/81')->assertSee($base.'ver_enc_mantenimiento/82')
        ->assertDontSee($base.'eliminar_enc_mantenimiento/82');
    $this->get($base.'ver_enc_mantenimiento/82')->assertOk()->assertSee('Excelente')->assertSee('Sugerencia de prueba');
    $this->get($base.'ver_resultado_mantenimiento/1/2026')->assertOk()->assertSee('100 %')
        ->assertSee('id="container"', false)->assertSee('id="pregunta4"', false)->assertSee('modules/exporting.js');
    $this->get($base.'ver_resultado_mantenimiento/2/2026')->assertOk()->assertSee('0 %');
});

it('muestra el historial y los periodos con sus acciones por estado', function () {
    session(['historial_enc_c' => 1]);
    $historial = view('encuestas_satisfacion_cliente.computo.menu_historial', ['year_historial' => [(object) ['year' => 2026]]])->render();
    expect($historial)->toContain('data-panel-contenido', '/encuestas_satisfaccion/menu_historial_mantenimiento_year/2026');

    $periodos = view('encuestas_satisfacion_cliente.computo.periodos_mantenimiento', [
        'year' => 2026, 'total_periodos' => 2,
        'periodos' => [(object) ['mes' => 1, 'id_estado' => 0, 'id_periodo_mantenimiento' => 7],
            (object) ['mes' => 2, 'id_estado' => 1, 'id_periodo_mantenimiento' => 8]],
    ])->render();
    expect($periodos)->toContain('/termino_encuesta_mantenimiento/7', '/ver_resultado_mantenimiento/2/2026', 'data-panel-modal')
        ->not->toContain('data-target="#modal_agregar"', '/termino_encuesta_mantenimiento/8');

    $cierre = view('encuestas_satisfacion_cliente.computo.termino_periodo', [
        'periodo' => (object) ['id_periodo_mantenimiento' => 7, 'mes' => 1, 'year' => 2026],
    ])->render();
    expect($cierre)->toContain('name="id_periodo_mantenimiento" value="7"', 'enero de 2026');
});

it('conserva la ruta, los valores y las preguntas obligatorias de mantenimiento', function () {
    $mantenimiento = (object) ['id_servicio_mantenimiento' => 12, 'fecha_solicita' => '2026-01-15', 'servicio_solicita' => 'Servicio de prueba'];
    $listado = view('encuestas_satisfacion_cliente.computo.registro_encuestas', ['encuestas_mantenimiento' => [$mantenimiento]])->render();
    expect($listado)->toContain('/contestar_encuesta_mantenimiento/12', 'form="form_enviar_encuesta"', 'data-panel-modal');

    $html = view('encuestas_satisfacion_cliente.computo.encuesta_mantenimiento', compact('mantenimiento'))->render();
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    expect($html)->toContain('/enviar_encuesta_mantenimiento/12');
    foreach (range(1, 4) as $numero) {
        $radios = iterator_to_array($xpath->query('//input[@name="pregunta'.$numero.'" and @type="radio" and @required]'));
        expect(array_map(fn ($radio) => $radio->getAttribute('value'), $radios))->toBe(['5', '4', '3', '2', '1']);
    }
    expect($xpath->query('//textarea[@name="sugerencias" and not(@required)]')->length)->toBe(1);
});
