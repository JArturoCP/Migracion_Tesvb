{{--
    Botón del periodo de inglés del header: reemplaza la insignia "Periodo de Ingles: …" del menú de inglés
    (ingles/inicio_ingles/menu_ingles.blade.php L24-28). Mismo diseño que el botón del periodo escolar
    (partials/panel/boton_periodo); solo cambia el tooltip ("Periodo de inglés").
    Conserva class="periodo_ingles" e id = periodo de inglés de la sesión: al hacer clic,
    resources/js/panel/modal_periodo_ingles.js pide el mismo GET /profesores_ingles/periodos/{id} y abre
    el modal de periodos de inglés (al final de partials/panel/sidebar); cada periodo cambia con el mismo
    GET /recargar/periodos_ingles/{id}.

    Se muestra siempre al profesor de inglés y, a los demás, en las pantallas del módulo de inglés
    ($moduloIngles: layout_ingles dentro del marco y /ingles), donde el menú de inglés mostraba la insignia.
--}}
@if(session()->has('profesor_ingles') || ! empty($moduloIngles))
    @include('partials.panel.boton_periodo', [
        'titulo' => 'Periodo de inglés',
        'nombrePeriodo' => Session::get('nombre_periodo_ingles'),
        'idPeriodoIngles' => Session::get('periodo_ingles'),
    ])
@endif
