{{--
    Botón "Cambiar periodo" del header (mismo estilo que el botón de modo oscuro de TailAdmin).
    Abre el modal de partials/panel/periodos.blade.php (evento "abrir-periodos"; enlaces GET /periodo/{id}).

    Se muestra con EXACTAMENTE las mismas condiciones que los 4 íconos de calendario (#periodo) de
    partials/menu_admin.blade.php; basta con que se cumpla una. Las variables y expresiones se copian
    literalmente de ese archivo (líneas indicadas).
--}}
<?php
    // menu_admin L7-29
    $palumno = session()->has('palumno') ? session()->has('palumno') : false;
    $profesor_conact = session()->has('profesor_conact') ? session()->has('profesor_conact') : false;
    $profesor_sinact = session()->has('profesor_sinact') ? session()->has('profesor_sinact') : false;
    $jefe_division = session()->has('jefe_division') ? session()->has('jefe_division') : false;
    $directivo = session()->has('directivo') ? session()->has('directivo') : false;
    $desa = session()->has('desa') ? session()->has('desa') : false;
    $escolar = session()->has('escolar') ? session()->has('escolar') : false;
    $id_unidad_admin = session()->has('id_unidad_admin') ? session()->has('id_unidad_admin') : false;
    $departamento_titulacion = session()->has('titulacion') ? session()->has('titulacion') : false;
    // menu_admin L295 y L1490
    $unidad = Session::get('id_unidad_admin');
    $id_per = Session::get('usuario_alumno');

    $mostrar_periodo =
        // 1) menu_admin L396-397
        ($profesor_conact==true || $jefe_division==true || $directivo==true ||$desa==true ||
            $profesor_sinact==true || $departamento_titulacion == true)
        // 2) menu_admin L1051 (escolar || directivo) y L1155 (escolar)
        || (($escolar==true || $directivo==true) && $escolar==true)
        // 3) menu_admin L1570 y L1590
        || (($id_unidad_admin == true || $id_per ===2630 || $id_per ===2662 || $escolar == true) && ($unidad == 14 || $unidad == 20 ))
        // 4) menu_admin L1842 (palumno) y L1928 (escolar != true)
        || ($palumno==true && $escolar !=true);
?>
@if($mostrar_periodo)
    <?php
        // "AGOSTO 2026-ENERO 2027" → "AGO 2026 – ENE 2027"
        $meses = ['ENERO' => 'ENE', 'FEBRERO' => 'FEB', 'MARZO' => 'MAR', 'ABRIL' => 'ABR', 'MAYO' => 'MAY', 'JUNIO' => 'JUN',
            'JULIO' => 'JUL', 'AGOSTO' => 'AGO', 'SEPTIEMBRE' => 'SEP', 'OCTUBRE' => 'OCT', 'NOVIEMBRE' => 'NOV', 'DICIEMBRE' => 'DIC'];
        $periodo_corto = trim(preg_replace('/\s*-\s*/', ' – ', strtr(mb_strtoupper((string) Session::get('nombre_periodo')), $meses)));
    ?>
    <button
        type="button"
        @click="$dispatch('abrir-periodos')"
        title="Cambiar periodo"
        aria-label="Cambiar periodo{{ $periodo_corto !== '' ? ' (actual: ' . $periodo_corto . ')' : '' }}"
        class="relative inline-flex h-11 min-w-11 shrink-0 items-center justify-center gap-2 rounded-[10px] border border-gray-300 bg-transparent px-3 text-gray-700 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden active:translate-y-px dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700/50 dark:hover:text-white"
        data-panel-periodo
    >
        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M8 2.75v2m8-2v2M3.75 9.25h16.5M5.25 4.75h13.5a1.5 1.5 0 011.5 1.5v12.5a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V6.25a1.5 1.5 0 011.5-1.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        @if($periodo_corto !== '')
            <span class="hidden text-sm font-medium whitespace-nowrap xl:inline">{{ $periodo_corto }}</span>
        @endif
    </button>
@endif
