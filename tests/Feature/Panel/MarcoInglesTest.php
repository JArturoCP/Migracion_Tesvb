<?php

/*
 * Layout de Inglés (ingles/inicio_ingles/layout_ingles.blade.php):
 * - sin sesión: el mismo HTML que antes (tests/Fixtures/vistas_antes/ingles/inicio_ingles/layout_ingles);
 * - con sesión: dentro del marco del panel con el mismo <head> (mismos CSS y JS) y el mismo contenido.
 */

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Tests\Support\BalanceHtml;
use Tests\Support\CompararVistas;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
});

function renderIngles(string $layout): string
{
    View::flushState();

    return Blade::render("@extends('$layout')\n@section('title', 'Prueba')\n@section('content')\n<div id=\"contenido_ingles\">CONTENIDO DEL MODULO</div>\n@endsection\n@section('scripts')\n<script>var scripts_ingles = 1;</script>\n@endsection");
}

it('sin sesión el layout de Inglés produce el mismo HTML que antes', function () {
    $normalizar = fn ($h) => trim(preg_replace('/\s+/', ' ', $h));

    expect($normalizar(renderIngles('ingles.inicio_ingles.layout_ingles')))
        ->toBe($normalizar(renderIngles('antes::ingles.inicio_ingles.layout_ingles')));
});

it('con sesión muestra Inglés dentro del marco con los mismos recursos y contenido', function () {
    $this->actingAs(EscenariosPanel::preparar('alumno', ['semestre' => 3]));
    session(['periodo_ingles' => 12, 'nombre_periodo_ingles' => 'INGLÉS AGOSTO 2026-ENERO 2027']);

    $nuevo = renderIngles('ingles.inicio_ingles.layout_ingles');
    $viejo = renderIngles('antes::ingles.inicio_ingles.layout_ingles');

    // menu_ingles original deja <li> que cierra su </ul> (cierre implícito válido en HTML)
    expect(array_values(array_filter(BalanceHtml::errores($nuevo), fn ($e) => ! preg_match('#^<li> de la línea \d+ sin cerrar \(lo cierra </(ul|li)>#', $e))))->toBe([])
        ->and($nuevo)->toContain('data-panel-marco')
        ->toContain('data-panel-menu')
        ->toContain('x-ignore')
        ->toContain('CONTENIDO DEL MODULO')
        ->toContain('var scripts_ingles = 1;')
        ->not->toContain('Cambiar entre modo claro y oscuro');

    // todos los CSS y JS del <head> original siguen cargándose
    preg_match('#<head>(.*?)</head>#s', $viejo, $cabeza);
    foreach (CompararVistas::recursos($cabeza[1]) as $recurso) {
        expect($nuevo)->toContain($recurso);
    }
});
