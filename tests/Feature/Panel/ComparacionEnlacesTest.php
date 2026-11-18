<?php

/*
 * Compara el menú viejo (partials/menu_admin.blade.php) con el sidebar nuevo
 * (partials/panel/sidebar.blade.php) para cada rol y variante: mismos enlaces, mismos métodos,
 * mismas repeticiones, mismos elementos ocultos y mismo efecto en la sesión.
 *
 * Dos elementos del menú viejo viven ahora en el HEADER (partials/panel/header.blade.php):
 *  - "Salir" (POST /logout con CSRF) → "Cerrar sesión" del menú de usuario.
 *  - Los 4 íconos de cambio de periodo → un botón único que aparece si se cumple cualquiera
 *    de sus condiciones.
 * Por eso se comparan: sidebar = menú viejo sin /logout; y en el header: POST /logout y el botón
 * de periodo exactamente cuando el menú viejo mostraba al menos un ícono de periodo.
 *
 * Si falla después de editar uno de los dos archivos, falta repetir el cambio en el otro
 * (ver docs/panel.md, "Mantenimiento doble").
 */

use Tests\Support\EscenariosPanel;

beforeEach(function () {
    EscenariosPanel::crearEsquema();
});

dataset('escenarios', function () {
    foreach (EscenariosPanel::escenarios() as $nombre => [$rol, $opciones]) {
        yield $nombre => [$rol, $opciones];
    }
});

it('el sidebar y el header nuevos tienen exactamente los mismos enlaces que el menú viejo', function (string $rol, array $opciones) {
    $usuario = EscenariosPanel::preparar($rol, $opciones);
    $this->actingAs($usuario);

    $viejo = EscenariosPanel::menuViejo();
    $nuevo = EscenariosPanel::sidebarNuevo();
    $header = EscenariosPanel::headerNuevo();

    $enlacesViejoCompletos = EscenariosPanel::enlaces($viejo);
    $enlacesNuevo = EscenariosPanel::enlaces($nuevo);
    $enlacesHeader = EscenariosPanel::enlaces($header);

    expect($enlacesViejoCompletos)->not->toBeEmpty();

    // "Salir" del menú viejo (enlace + formulario POST) → "Cerrar sesión" del header.
    $esLogout = fn ($enlace) => (bool) preg_match('#^(GET|POST) \S*/logout$#', $enlace);
    expect(array_values(array_filter($enlacesViejoCompletos, $esLogout)))->toBe(['GET http://localhost/logout', 'POST http://localhost/logout'])
        ->and(array_values(array_filter($enlacesNuevo, $esLogout)))->toBe([], 'El sidebar ya no debe tener /logout')
        ->and(array_values(array_filter($enlacesHeader, $esLogout)))->toBe(['POST http://localhost/logout'], 'El header debe tener el formulario POST /logout')
        ->and($header)->toContain('name="_token"');
    $enlacesViejo = array_values(array_filter($enlacesViejoCompletos, fn ($e) => ! $esLogout($e)));

    // Cambio de periodo: un solo botón en el header, con las mismas condiciones; ninguno en el sidebar.
    expect(EscenariosPanel::botonesPeriodo($nuevo))->toBe(0, 'El sidebar ya no debe tener el botón de periodo')
        ->and(EscenariosPanel::botonesPeriodo($header))->toBe(EscenariosPanel::botonesPeriodo($viejo) > 0 ? 1 : 0, 'Botón de periodo del header');

    // 0 faltantes y 0 sobrantes, con repeticiones.
    $faltantes = $enlacesViejo;
    foreach ($enlacesNuevo as $enlace) {
        $i = array_search($enlace, $faltantes, true);
        if ($i !== false) {
            unset($faltantes[$i]);
        }
    }
    $sobrantes = $enlacesNuevo;
    foreach ($enlacesViejo as $enlace) {
        $i = array_search($enlace, $sobrantes, true);
        if ($i !== false) {
            unset($sobrantes[$i]);
        }
    }

    expect(array_values($faltantes))->toBe([], 'Enlaces del menú viejo que faltan en el sidebar nuevo')
        ->and(array_values($sobrantes))->toBe([], 'Enlaces del sidebar nuevo que no están en el menú viejo')
        ->and($enlacesNuevo)->toBe($enlacesViejo)
        ->and(EscenariosPanel::efectoSesion($nuevo))->toBe(EscenariosPanel::efectoSesion($viejo))
        ->and(EscenariosPanel::efectoSesion($header))->toBe('[]', 'El header no debe cambiar la sesión');
})->with('escenarios');

it('los escenarios cubren todos los elementos del inventario', function () {
    // Unión de los enlaces (visibles y ocultos) que muestra el menú viejo en todos los escenarios.
    $todos = [];
    foreach (EscenariosPanel::escenarios() as [$rol, $opciones]) {
        EscenariosPanel::vaciar();
        EscenariosPanel::crearEsquema();
        $this->actingAs(EscenariosPanel::preparar($rol, $opciones));
        foreach (EscenariosPanel::enlaces(EscenariosPanel::menuViejo()) as $enlace) {
            $todos[$enlace] = true;
        }
    }

    // Con los escenarios actuales se cubren los 328 elementos de docs/INVENTARIO_MENU.md, que dan
    // 282 combinaciones distintas de "método + URL" (varios elementos comparten URL, p. ej. "Datos P.").
    // Si se agregan elementos al menú, agregar el escenario que los muestre y actualizar este número.
    expect(count($todos))->toBeGreaterThanOrEqual(282);
});

it('el botón de periodo del header aparece solo con las condiciones del menú original', function (string $rol, array $opciones, bool $esperado) {
    $this->actingAs(EscenariosPanel::preparar($rol, $opciones));

    $header = EscenariosPanel::headerNuevo();

    expect(EscenariosPanel::botonesPeriodo($header) === 1)->toBe($esperado)
        ->and(EscenariosPanel::botonesPeriodo(EscenariosPanel::menuViejo()) > 0)->toBe($esperado);
})->with([
    'directivo (condición 1)' => ['directivo', [], true],
    'titulación (condición 1)' => ['titulacion', [], true],
    'servicios escolares (condición 2)' => ['escolar', [], true],
    'centro de cómputo con unidad 14 (condición 3)' => ['computo', ['unidad' => 14], true],
    'residencias con unidad 20 (condición 3)' => ['residencias', ['unidad' => 20], true],
    'alumno (condición 4)' => ['alumno', ['semestre' => 3], true],
    'centro de cómputo sin unidad' => ['computo', [], false],
    'recursos humanos' => ['rh', [], false],
    'finanzas' => ['finanzas', [], false],
    'consultas' => ['consultas', [], false],
    'residencias con unidad 5' => ['residencias', ['unidad' => 5], false],
]);

it('el botón de periodo muestra el periodo abreviado y abre el modal', function () {
    $this->actingAs(EscenariosPanel::preparar('directivo', []));
    session(['nombre_periodo' => 'AGOSTO 2026-ENERO 2027']);

    $header = EscenariosPanel::headerNuevo();

    expect($header)->toContain('AGO 2026 – ENE 2027')
        ->toContain('title="Cambiar periodo"')
        ->toContain("\$dispatch('abrir-periodos')");
});
