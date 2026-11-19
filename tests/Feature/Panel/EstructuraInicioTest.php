<?php

/*
 * Estructura de /inicio: el HTML tiene las etiquetas balanceadas en todos los roles y variantes,
 * y el sidebar queda al lado del contenido (como src/pages/index.html de TailAdmin):
 *   body > div[data-panel-marco] (flex, min-h-screen) > [aside.sidebar (sticky), div[data-panel-area] > main > header]
 * Una etiqueta sin cerrar o de más en el sidebar cierra el contenedor flex antes de tiempo y
 * el sidebar termina arriba del contenido.
 */

use Tests\Support\BalanceHtml;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
});

dataset('escenarios', function () {
    foreach (EscenariosPanel::escenarios() as $nombre => [$rol, $opciones]) {
        yield $nombre => [$rol, $opciones];
    }
});

it('el HTML de /inicio tiene las etiquetas balanceadas', function (string $rol, array $opciones) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    $html = $this->get('/inicio')->assertOk()->getContent();

    expect(BalanceHtml::errores($html))->toBe([]);
})->with('escenarios');

it('el sidebar queda al lado del contenido dentro del contenedor flex', function (string $rol, array $opciones) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    $html = $this->get('/inicio')->assertOk()->getContent();

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8"?>' . $html);
    libxml_clear_errors();
    $xp = new DOMXPath($dom);

    // Scroll de la página completa (como el marco de los módulos): contenedor flex con el aside sticky
    // y, a su lado, el área con el header y el contenido.
    $contenedor = '//body/div[@data-panel-marco]';
    expect($xp->query($contenedor))->toHaveCount(1)
        ->and($xp->query($contenedor . '[contains(@class, "tw:flex") and contains(@class, "tw:min-h-screen")]'))->toHaveCount(1)
        ->and($xp->query($contenedor . '/aside[contains(@class, "tw:sidebar") and contains(@class, "tw:xl:sticky")]'))->toHaveCount(1)
        ->and($xp->query($contenedor . '/div[@data-panel-area]/main/header'))->toHaveCount(1)
        ->and($xp->query($contenedor . '/div[@data-panel-area]/main//*[@data-panel-bienvenida]'))->toHaveCount(1)
        // El menú completo queda dentro del aside.
        ->and($xp->query($contenedor . '/aside//ul[@data-panel-menu]'))->toHaveCount(1);
})->with([
    'directivo' => ['directivo', []],
    'directivo con unidad 25' => ['directivo', ['unidad' => 25]],
    'docente con actividad y unidad 1' => ['docente_actividad', ['unidad' => 1]],
    'jefe de división (2 carreras)' => ['jefe_division', ['dos_carreras' => true]],
    'alumno semestre 9 registrar residencia' => ['alumno', ['semestre' => 9, 'registrar_residencia' => true, 'estado_reg_anteproyecto' => true, 'anteproyecto_aceptado' => true, 'registro_empresa' => true]],
]);
