<?php

/*
 * Compara el menú viejo (partials/menu_admin.blade.php) con el sidebar nuevo
 * (partials/panel/sidebar.blade.php) para cada rol y variante: mismos enlaces, mismos métodos,
 * mismas repeticiones, mismos elementos ocultos, mismos botones de periodo y mismo efecto en la sesión.
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

it('el sidebar nuevo tiene exactamente los mismos enlaces que el menú viejo', function (string $rol, array $opciones) {
    $usuario = EscenariosPanel::preparar($rol, $opciones);
    $this->actingAs($usuario);

    $viejo = EscenariosPanel::menuViejo();
    $nuevo = EscenariosPanel::sidebarNuevo();

    $enlacesViejo = EscenariosPanel::enlaces($viejo);
    $enlacesNuevo = EscenariosPanel::enlaces($nuevo);

    expect($enlacesViejo)->not->toBeEmpty();

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
        ->and(EscenariosPanel::botonesPeriodo($nuevo))->toBe(EscenariosPanel::botonesPeriodo($viejo))
        ->and(EscenariosPanel::efectoSesion($nuevo))->toBe(EscenariosPanel::efectoSesion($viejo));
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
