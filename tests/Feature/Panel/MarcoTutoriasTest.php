<?php

/*
 * Layout de Tutorías (tutorias/app_tutorias.blade.php):
 * - con sesión: sus mismas partes (head, cuerpo con menú interno y contenido) dentro del marco del panel;
 * - sin sesión: el diseño original.
 */

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Tests\Support\BalanceHtml;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
});

function renderTutorias(): string
{
    View::flushState();

    return Blade::render("@extends('tutorias.app_tutorias')\n@section('title', 'Prueba')\n@section('content')\n<div id=\"ind\">CONTENIDO DEL MODULO</div>\n@endsection");
}

it('con sesión muestra Tutorías dentro del marco sin cambiar su contenido', function () {
    $this->actingAs(EscenariosPanel::preparar('alumno', ['semestre' => 3]));
    session(['tutor_asignado' => 'TUTOR X', 'generacion_asignada' => '2024', 'estado_eva' => true]);

    $html = renderTutorias();

    expect(BalanceHtml::errores($html))->toBe([])
        ->and($html)->toContain('data-panel-marco')
        ->toContain('data-panel-menu')                       // sidebar del panel
        ->toContain('x-ignore')                              // Alpine no toca el contenido (plantillas Vue)
        ->toContain('<div id="app" class="container">')      // cuerpo original de Tutorías
        ->toContain('CONTENIDO DEL MODULO')
        ->toContain('href="/tutorias/inicioalu"')            // menú interno: mismas opciones
        ->toContain('href=/tutorias/actividad')
        ->toContain('href=/tutorias/calendario')
        ->toContain('href="/tutoras_evaluacion/evaluacion_al_tutor/"')
        ->toContain('js/js_tutorias/app.js')                 // mismos scripts del layout original
        ->toContain('js/js_tutorias/fullcalendar.min.js')
        ->toContain('css/css_tutorias/app.css')
        ->toContain('Cambiar entre modo claro y oscuro') // modo oscuro en todas las pantallas (en el marco solo sidebar y header)
        ->not->toContain('<header id="header"');             // la franja amarilla la sustituye el header del panel
});

it('sin sesión muestra el diseño original de Tutorías', function () {
    $html = renderTutorias();

    expect($html)->not->toContain('data-panel-marco')
        ->toContain('<header id="header"')
        ->toContain('<div id="app" class="container">')
        ->toContain('CONTENIDO DEL MODULO');
});
