<?php

/*
 * /inicio usa el nuevo diseño (panel.inicio + layouts.panel) para todos los roles y no carga
 * Bootstrap, jQuery ni recursos externos.
 */

use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    $this->withoutVite();
});

dataset('roles', [
    'alumno' => ['alumno', ['semestre' => 3]],
    'docente con actividad' => ['docente_actividad', []],
    'docente sin actividad' => ['docente', []],
    'jefe de división' => ['jefe_division', []],
    'desarrollo académico' => ['desarrollo', []],
    'directivo' => ['directivo', []],
    'consultas' => ['consultas', []],
    'servicios escolares' => ['escolar', []],
    'recursos humanos' => ['rh', []],
    'centro de cómputo' => ['computo', []],
    'residencias' => ['residencias', []],
    'titulación' => ['titulacion', []],
    'finanzas' => ['finanzas', []],
]);

it('/inicio devuelve panel.inicio con el layout nuevo', function (string $rol, array $opciones) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    $respuesta = $this->get('/inicio');

    $respuesta->assertOk()
        ->assertViewIs('panel.inicio')
        ->assertSee('data-panel-menu', false)
        ->assertSee('data-panel-bienvenida', false)
        ->assertSee('NOMBRE DE PRUEBA')
        ->assertSee('AGO-DIC 2026');

    $html = $respuesta->getContent();
    expect(strtolower($html))->not->toContain('jquery')
        ->and(strtolower($html))->not->toContain('bootstrap');

    // Solo se permiten URLs del propio sitio y el espacio de nombres de los SVG (no es una petición).
    preg_match_all('#https?://[^"\'\s)<>]+#', $html, $urls);
    $externas = array_filter($urls[0], fn ($u) => ! str_starts_with($u, 'http://localhost') && $u !== 'http://www.w3.org/2000/svg');
    expect(array_values($externas))->toBe([]);
})->with('roles');

it('las vistas anteriores siguen existiendo sin cambios', function () {
    expect(view()->exists('home_recargado'))->toBeTrue()
        ->and(view()->exists('partials.menu_admin'))->toBeTrue()
        ->and(view()->exists('layouts.app'))->toBeTrue();
});
