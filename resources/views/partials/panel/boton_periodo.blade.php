{{--
    Botón de periodo del header (mismo estilo que el botón de modo oscuro de TailAdmin): ícono de calendario
    y periodo abreviado ("AGOSTO 2026-ENERO 2027" → "AGO 2026 – ENE 2027"). Lo usan:
      - partials/panel/periodo_header        periodo escolar: abre el modal de partials/panel/periodos ("abrir-periodos").
      - partials/panel/periodo_ingles_header periodo de inglés: class="periodo_ingles" e id del periodo de inglés;
        resources/js/panel/modal_periodo_ingles.js pide GET /profesores_ingles/periodos/{id} y abre su modal.
    Parámetros: $titulo (tooltip), $nombrePeriodo (texto completo del periodo), $idPeriodoIngles (solo inglés).
--}}
<?php
    $meses = ['ENERO' => 'ENE', 'FEBRERO' => 'FEB', 'MARZO' => 'MAR', 'ABRIL' => 'ABR', 'MAYO' => 'MAY', 'JUNIO' => 'JUN',
        'JULIO' => 'JUL', 'AGOSTO' => 'AGO', 'SEPTIEMBRE' => 'SEP', 'OCTUBRE' => 'OCT', 'NOVIEMBRE' => 'NOV', 'DICIEMBRE' => 'DIC'];
    // los periodos de inglés se llaman "INGLÉS AGOSTO 2026-ENERO 2027": se quita el prefijo
    $periodo_corto = trim(preg_replace('/\s*-\s*/', ' – ', strtr(preg_replace('/^\s*INGL[ÉE]S\s+/u', '', mb_strtoupper((string) $nombrePeriodo)), $meses)));
    $esIngles = isset($idPeriodoIngles);
?>
<button
    type="button"
    @if($esIngles)
    id="{{ $idPeriodoIngles }}"
    data-panel-ingles-periodo
    @else
    @click="$dispatch('abrir-periodos')"
    data-panel-periodo
    @endif
    title="{{ $titulo }}"
    aria-label="{{ $titulo }}{{ $periodo_corto !== '' ? ' (actual: ' . $periodo_corto . ')' : '' }}"
    class="{{ $esIngles ? 'periodo_ingles ' : '' }}tw:relative tw:inline-flex tw:h-11 tw:min-w-11 tw:shrink-0 tw:items-center tw:justify-center tw:gap-2 tw:rounded-[10px] tw:border tw:border-gray-300 tw:bg-transparent tw:px-3 tw:text-gray-700 tw:shadow-theme-xs tw:transition-all tw:select-none tw:hover:bg-gray-50 tw:hover:text-gray-800 tw:focus-visible:ring-3 tw:focus-visible:ring-gray-300/50 tw:focus-visible:outline-hidden tw:active:translate-y-px tw:dark:border-gray-700 tw:dark:bg-gray-800 tw:dark:text-gray-300 tw:dark:hover:bg-gray-700/50 tw:dark:hover:text-white"
>
    <svg class="tw:size-5 tw:shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M8 2.75v2m8-2v2M3.75 9.25h16.5M5.25 4.75h13.5a1.5 1.5 0 011.5 1.5v12.5a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V6.25a1.5 1.5 0 011.5-1.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    @if($periodo_corto !== '')
        <span class="tw:hidden tw:text-sm tw:font-medium tw:whitespace-nowrap tw:xl:inline">{{ $periodo_corto }}</span>
    @endif
</button>
