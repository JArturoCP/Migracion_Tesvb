<?php

/*
 * Menú del módulo de inglés en el panel:
 * - submenú "Inglés" del sidebar = opciones de ingles/inicio_ingles/menu_ingles (mismas condiciones y href);
 * - botón "Periodo de Inglés" del header = insignia .periodo_ingles del menú de inglés.
 * La comparación completa por rol (0 faltantes y 0 sobrantes) está en ComparacionEnlacesTest.
 */

use Illuminate\Support\Facades\View;
use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
});

/** Enlaces del menú de inglés que pasan al sidebar (sin Salir, Regresar ni el formulario vacío del modal). */
function enlacesMenuIngles(): array
{
    return array_values(array_filter(
        EscenariosPanel::enlaces(EscenariosPanel::menuIngles()),
        fn ($e) => ! preg_match('#/logout$#', $e) && $e !== 'GET http://localhost' && $e !== 'POST '
    ));
}

it('el submenú Inglés del sidebar tiene todas las opciones del menú de inglés de cada rol', function (string $rol, array $opciones, int $opcionesIngles) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    $menu = enlacesMenuIngles();
    $sidebar = EscenariosPanel::sidebarNuevo();

    expect($menu)->toHaveCount($opcionesIngles)
        ->and(substr_count($sidebar, 'Inicio de Inglés'))->toBe(1);
    foreach ($menu as $enlace) {
        expect(EscenariosPanel::enlaces($sidebar))->toContain($enlace);
    }
})->with([
    'profesor de inglés (Datos P. › Editar y Calificaciones)' => ['ingles', [], 2],
    'alumno (Carga académica de inglés)' => ['alumno', ['semestre' => 3], 4],
    'directivo con unidad 19 (coordinación)' => ['directivo', ['unidad' => 19], 22],
    'docente con actividad y unidad 19' => ['docente_actividad', ['unidad' => 19], 22],
]);

it('el enlace Editar del profesor usa el id_usuario de la sesión, igual que el menú de inglés', function () {
    $usuario = EscenariosPanel::preparar('ingles', []);
    $this->actingAs($usuario);

    expect(EscenariosPanel::sidebarNuevo())->toContain('href="/profesores_ingles/modificar/' . $usuario->id . '/"');
});

it('quien no tiene la entrada Inglés no ve el submenú', function (string $rol, array $opciones) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    expect(EscenariosPanel::sidebarNuevo())->not->toContain('Inicio de Inglés');
})->with([
    'directivo' => ['directivo', []],
    'jefe de división' => ['jefe_division', []],
    'directivo con unidad 14' => ['directivo', ['unidad' => 14]],
]);

it('el botón Periodo de Inglés aparece siempre al profesor y a los demás solo en pantallas de inglés', function () {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    $profesor = EscenariosPanel::headerNuevo();
    EscenariosPanel::vaciar();

    $this->actingAs(EscenariosPanel::preparar('alumno', ['semestre' => 3]));
    $alumnoFuera = EscenariosPanel::headerNuevo();
    View::share('moduloIngles', true);
    $alumnoEnIngles = EscenariosPanel::headerNuevo();

    expect(substr_count($profesor, 'data-panel-ingles-periodo'))->toBe(1)
        ->and($alumnoFuera)->not->toContain('data-panel-ingles-periodo')
        ->and(substr_count($alumnoEnIngles, 'data-panel-ingles-periodo'))->toBe(1);
});

it('el botón Periodo de Inglés conserva la clase, el id y la ruta del modal de la insignia original', function () {
    $this->actingAs(EscenariosPanel::preparar('ingles', []));
    session(['periodo_ingles' => 15, 'nombre_periodo_ingles' => 'INGLÉS FEBRERO-JULIO 2028']);

    $header = EscenariosPanel::headerNuevo();
    $menu = EscenariosPanel::menuIngles();

    expect($menu)->toContain('class="periodo_ingles" href="#" id="15"')
        ->and($header)->toMatch('#<a\s+href="\#"\s+class="periodo_ingles [^"]*"\s+id="15"#')
        ->toContain('Inglés')
        ->toContain('FEB – JUL 2028')
        ->and(file_get_contents(resource_path('js/panel/modal_periodo_ingles.js')))
        ->toContain("'/profesores_ingles/periodos/' + disparador.id")
        ->and(EscenariosPanel::sidebarNuevo())->toContain('id="contenedor_modificar_periodo"');
});

it('la lista de periodos de inglés conserva datos y enlaces', function () {
    View::addNamespace('antes', base_path('tests/Fixtures/vistas_antes'));
    $periodos = [
        (object) ['id_periodo_ingles' => 15, 'periodo_ingles' => 'INGLÉS FEBRERO-JULIO 2028'],
        (object) ['id_periodo_ingles' => 14, 'periodo_ingles' => 'INGLÉS AGOSTO 2027-ENERO 2028'],
    ];
    $datos = ['periodos_ingles' => $periodos, 'id_periodo_ingles' => '15'];

    $nuevo = view('ingles.periodos_ingles', $datos)->render();
    $viejo = view('antes::ingles.periodos_ingles', $datos)->render();

    expect(EscenariosPanel::enlaces($nuevo))->toBe(EscenariosPanel::enlaces($viejo))
        ->and($nuevo)->toContain('/recargar/periodos_ingles/14')
        ->toContain('INGLÉS FEBRERO-JULIO 2028')
        ->toContain('INGLÉS AGOSTO 2027-ENERO 2028');
});
