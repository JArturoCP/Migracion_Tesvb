{{--
    Botón "Cambiar periodo" del header (marcado en partials/panel/boton_periodo, compartido con el periodo de inglés).
    Muestra el selector escolar en partials/panel/periodos.blade.php (enlaces GET /periodo/{id}).

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
        // Si en la misma pantalla está el botón del periodo de inglés (partials/panel/periodo_ingles_header),
        // los dos se ven igual y solo los distingue el tooltip.
        $hay_periodo_ingles = session()->has('profesor_ingles') || ! empty($moduloIngles);
    ?>
    @include('partials.panel.periodos', [
        'titulo' => $hay_periodo_ingles ? 'Periodo escolar' : 'Cambiar periodo',
        'nombrePeriodo' => Session::get('nombre_periodo'),
    ])
@endif
