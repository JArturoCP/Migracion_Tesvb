<?php

/*
 * Examen EGEL (admin y alumno) migrado al panel: cada vista, y cada rama del dashboard del alumno,
 * se renderiza con los mismos datos sintéticos que su versión anterior (tests/Fixtures/vistas_antes)
 * y se comparan formularios, campos, ids, clases que usan los scripts y textos (tests/Support/CasosExamenEgel).
 */

use Illuminate\Support\Facades\View;
use Tests\Support\CasosExamenEgel;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
    CasosExamenEgel::crearTablas();
    $this->withoutVite();
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
});

dataset('vistas_egel', fn () => CasosExamenEgel::vistas());
dataset('ramas_dashboard_egel', fn () => CasosExamenEgel::ramasDashboard());

it('conserva formularios, campos, ids, clases de scripts y textos', function (string $vista, string $rol, array $datos, array $sesion) {
    $this->actingAs(EscenariosPanel::preparar($rol, ['carrera_alumno' => 8]));
    session($sesion);

    expect(CasosExamenEgel::comparar($vista, $datos))->toBe([]);
})->with('vistas_egel');

it('pregunta del alumno: avisa cuando faltan respuestas', function () {
    $this->actingAs(EscenariosPanel::preparar('alumno', ['carrera_alumno' => 8]));
    [$vista, , $datos] = CasosExamenEgel::vistas()['alumno: pregunta sin responder'];

    CasosExamenEgel::comparar($vista, $datos, $html);

    expect($html)->toContain('Debes responder todas las preguntas antes de continuar.');
});

it('dashboard del alumno conserva cada rama', function (bool $aplicacion, bool $publicacion, array $completadas, bool $conResultado) {
    $usuario = EscenariosPanel::preparar('alumno', ['carrera_alumno' => 8]);
    $this->actingAs($usuario);
    CasosExamenEgel::prepararDashboard($usuario->id, $aplicacion, $publicacion, $completadas, $conResultado);

    expect(CasosExamenEgel::comparar('examen_egel.dashboard', []))->toBe([]);
})->with('ramas_dashboard_egel');
