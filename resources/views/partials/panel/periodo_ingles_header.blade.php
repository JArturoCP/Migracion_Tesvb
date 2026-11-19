{{--
    Botón "Periodo de Inglés" del header: reemplaza la insignia "Periodo de Ingles: …" del menú de inglés
    (ingles/inicio_ingles/menu_ingles.blade.php L24-28). Conserva class="periodo_ingles" e id = periodo de
    inglés de la sesión: al hacer clic, resources/js/panel/modal_periodo_ingles.js pide el mismo
    GET /profesores_ingles/periodos/{id} y abre el modal "Modificar periodo" (al final de partials/panel/sidebar);
    los periodos se cambian con los mismos enlaces GET /recargar/periodos_ingles/{id}.

    Se muestra siempre al profesor de inglés y, a los demás, en las pantallas del módulo de inglés
    ($moduloIngles: layout_ingles dentro del marco y /ingles), donde el menú de inglés mostraba la insignia.
    Se distingue del periodo escolar por la etiqueta "Inglés", el ícono de libro y el color verde.
--}}
<?php
    $profesor_ingles_header = session()->has('profesor_ingles') ? session()->has('profesor_ingles') : false;
?>
@if($profesor_ingles_header == true || ! empty($moduloIngles))
    <?php
        $nombre_periodo_ingles = (string) Session::get('nombre_periodo_ingles');
        $periodo_ingles = Session::get('periodo_ingles');
        // "INGLÉS FEBRERO-JULIO 2028" → "FEB – JUL 2028"
        $meses = ['ENERO' => 'ENE', 'FEBRERO' => 'FEB', 'MARZO' => 'MAR', 'ABRIL' => 'ABR', 'MAYO' => 'MAY', 'JUNIO' => 'JUN',
            'JULIO' => 'JUL', 'AGOSTO' => 'AGO', 'SEPTIEMBRE' => 'SEP', 'OCTUBRE' => 'OCT', 'NOVIEMBRE' => 'NOV', 'DICIEMBRE' => 'DIC'];
        $periodo_ingles_corto = trim(preg_replace('/\s*-\s*/', ' – ', strtr(preg_replace('/^\s*INGL[ÉE]S\s*/u', '', mb_strtoupper($nombre_periodo_ingles)), $meses)));
    ?>
    <a
        href="#"
        class="periodo_ingles tw:relative tw:inline-flex tw:h-11 tw:min-w-11 tw:shrink-0 tw:items-center tw:justify-center tw:gap-2 tw:rounded-[10px] tw:border tw:border-emerald-300 tw:bg-emerald-50 tw:px-3 tw:text-emerald-800 tw:shadow-theme-xs tw:transition-all tw:select-none tw:hover:bg-emerald-100 tw:focus-visible:ring-3 tw:focus-visible:ring-emerald-300/50 tw:focus-visible:outline-hidden tw:active:translate-y-px tw:dark:border-emerald-800 tw:dark:bg-emerald-950 tw:dark:text-emerald-200"
        id="{{$periodo_ingles}}"
        @click.prevent
        title="Periodo de Inglés: {{ $nombre_periodo_ingles }}"
        aria-label="Cambiar periodo de Inglés (actual: {{ $nombre_periodo_ingles }})"
        data-panel-ingles-periodo
    >
        <svg class="tw:size-5 tw:shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 6.75c-1.9-1.4-4.4-2-7.25-2v13c2.85 0 5.35.6 7.25 2m0-13c1.9-1.4 4.4-2 7.25-2v13c-2.85 0-5.35.6-7.25 2m0-13v13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="tw:text-sm tw:font-semibold">Inglés</span>
        @if($periodo_ingles_corto !== '')
            <span class="tw:hidden tw:text-sm tw:font-medium tw:whitespace-nowrap tw:xl:inline">{{ $periodo_ingles_corto }}</span>
        @endif
    </a>
@endif
