<?php
/*
 * Cambios de estructura repetidos al migrar una vista de Bootstrap 3 (layouts.app) al panel.
 * Uso: php tools/panel/estructura_bs.php <vista.blade.php> [opciones de recursos, p. ej. "validacion,datatables"]
 *
 * Hace solo cambios de marcado; no toca formularios (action, method, name), ids, clases que usan los
 * scripts, @if/@foreach ni <script>:
 *   1. @extends('layouts.app') → layouts.panel + @include('partials.panel.recursos_app', [opciones]).
 *   2. Título en panel-heading (panel-info) → <x-panel.encabezado titulo="…" />.
 *   3. Alerta flash_notification → <x-panel.alerta> con el tipo según el nivel.
 *   4. Botón flotante (.flotante) → botón redondo fijo de la plantilla (conserva clase y data-target).
 *   5. <table> → dentro de un contenedor con borde y desplazamiento horizontal.
 *   6. Modales de Bootstrap (div.modal > .modal-dialog > .modal-content) → <x-panel.modal id="…" sin-relleno>,
 *      con encabezado, cuerpo y pie de la plantilla; se quita el botón × (el componente trae el suyo).
 * Después hay que pasar tools/panel/bs2tw.php <vista> 3 para el resto de las clases y revisar a mano.
 */
$archivo = $argv[1];
$opciones = array_filter(explode(',', $argv[2] ?? ''));
$t = file_get_contents($archivo);

// 1. layout
if (!str_contains($t, "@extends('layouts.app')")) { fwrite(STDERR, "$archivo: no extiende layouts.app\n"); }
$recursos = "@include('partials.panel.recursos_app'" . ($opciones ? ', [' . implode(', ', array_map(fn ($o) => "'$o' => true", $opciones)) . ']' : '') . ")";
$t = preg_replace("/@extends\('layouts\.app'\)\s*\n(@section\('title',[^\n]*\)\s*\n)?/", "@extends('layouts.panel')\n$1$recursos\n", $t, 1, $n1);

// 2. título
$t = preg_replace_callback('#<div class="panel panel-(?:info|default|primary)">\s*<div class="panel-heading">\s*<h3 class="panel-title[^"]*">(.*?)</h3>\s*</div>\s*</div>#s', function ($m) {
    return '<x-panel.encabezado titulo="' . trim(preg_replace('/\s+/', ' ', $m[1])) . '" />';
}, $t, -1, $n2);

// 3. flash
$t = preg_replace('#<div class="alert alert-\{\{ session\(\'flash_notification\.level\'\) \}\}">\s*<button[^>]*>&times;</button>\s*(\{!! session\(\'flash_notification\.message\'\) !!\})\s*</div>#s',
    "<x-panel.alerta class=\"tw:mb-4\" :tipo=\"['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'\">$1</x-panel.alerta>", $t, -1, $n3);

// 4. botón flotante
$t = preg_replace('/class="btn btn-\w+ btn-lg flotante"/', 'class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600"', $t, -1, $n4);

// 5. tablas
$t = preg_replace('#(<table\b.*?</table>)#s', "<div class=\"tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white\">\n$1\n</div>", $t, -1, $n5);

// 6. modales
$n6 = 0;
$desde = 0;
while (preg_match('#<div\b(?=[^>]*\bclass="modal(?: |")[^>]*>)(?=[^>]*\bid="([^"]+)")([^>]*)>#', $t, $m, PREG_OFFSET_CAPTURE, $desde)) {
    $ini = $m[0][1];
    $atributos = $m[2][0];
    $id = $m[1][0];
    // fin del div del modal contando <div …> y </div>
    $pos = $ini + strlen($m[0][0]);
    $nivel = 1;
    $cierres = [];
    while ($nivel > 0 && preg_match('#<div\b[^>]*>|</div>#', $t, $d, PREG_OFFSET_CAPTURE, $pos)) {
        if ($d[0][0] === '</div>') { $nivel--; $cierres[] = [$d[0][1], $nivel]; } else { $nivel++; }
        $pos = $d[0][1] + strlen($d[0][0]);
    }
    $fin = $pos;
    $bloque = substr($t, $ini, $fin - $ini);
    if (!preg_match('#^(<div[^>]*>)(\s*)<div class="modal-dialog( modal-(sm|lg|md))?"[^>]*>\s*<div class="modal-content"([^>]*)>#', $bloque, $c)) { $desde = $fin; continue; }
    $tamano = ['sm' => 'sm', 'lg' => 'lg', 'md' => 'md'][$c[4] ?? 'md'] ?? 'md';
    $interior = substr($bloque, strlen($c[0]));
    // quitar los cierres de .modal-content y .modal-dialog (los dos </div> anteriores al cierre del modal)
    $interior = substr($interior, 0, strrpos($interior, '</div>'));                    // cierre del modal
    foreach ([1, 2] as $_) {
        $p = strrpos($interior, '</div>');
        $interior = substr($interior, 0, $p) . substr($interior, $p + 6);
    }
    $tieneEncabezado = (bool) preg_match('#class="modal-header#', $interior);
    // la × del componente conserva la clase "close" por si un script hace $(".close").click(…)
    $claseCerrar = preg_match('#<button[^>]*class="close"[^>]*data-dismiss="modal"|<button[^>]*data-dismiss="modal"[^>]*class="close"#', $interior) ? ' clase-cerrar="close"' : '';
    $interior = preg_replace_callback('#(<div class="modal-header[^"]*"[^>]*>)(.*?)(</div>)#s', function ($h) {
        $sinCerrar = preg_replace('#<button[^>]*data-dismiss="modal"[^>]*>.*?</button>#s', '', $h[2]);
        return '<div class="tw:px-6 tw:pt-6 tw:pr-14">' . $sinCerrar . $h[3];
    }, $interior);
    $interior = preg_replace('#class="modal-title([^"]*)"#', 'class="tw:text-lg tw:font-semibold tw:text-gray-800$1"', $interior);
    $interior = preg_replace('#class="modal-body([^"]*)"#', 'class="tw-modal-cuerpo' . ($tieneEncabezado ? '' : ' tw:pt-12') . '$1"', $interior);
    $interior = preg_replace('#class="modal-footer([^"]*)"#', 'class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6$1"', $interior);
    $extra = '';
    if (preg_match('/aria-labelledby="([^"]*)"/', $atributos, $al)) $extra .= ' aria-labelledby="' . $al[1] . '"';
    if (preg_match('/data-backdrop="static"/', $atributos)) $extra .= ' estatico';
    // el id de .modal-content (si lo tiene) se conserva en un div que envuelve el contenido
    if (preg_match('/\bid="([^"]+)"/', $c[5] ?? '', $idc)) $interior = "<div id=\"{$idc[1]}\">" . $interior . '</div>';
    $nuevo = "<x-panel.modal id=\"$id\" tamano=\"$tamano\" sin-relleno$claseCerrar$extra>" . $interior . '</x-panel.modal>';
    $t = substr($t, 0, $ini) . $nuevo . substr($t, $fin);
    $desde = $ini + strlen($nuevo);
    $n6++;
}

file_put_contents($archivo, $t);
fwrite(STDERR, basename($archivo) . ": layout $n1, título $n2, flash $n3, flotante $n4, tablas $n5, modales $n6\n");
