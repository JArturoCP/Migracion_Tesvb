<?php
/*
 * Convierte las clases de Bootstrap 3/4 de una vista Blade a clases tw: (estilo TailAdmin).
 * Solo toca atributos class="…" estáticos (no :class / v-bind:class). Conserva:
 *   - fragmentos Blade dentro del atributo ({{ }}, @if…),
 *   - clases desconocidas (propias de la pantalla),
 *   - clases de estado que cambian los scripts (active, show, in, fade, collapse, disabled, tab-pane, tab-content, hidden…),
 *   - toda clase que los <script> de la vista mencionen como selector o con add/remove/toggle/hasClass.
 * Uso: php bs2tw.php <archivo> <3|4>   → escribe el archivo convertido y un informe en STDERR.
 */
$archivo = $argv[1];
$bs = (int) ($argv[2] ?? 4);
$html = file_get_contents($archivo);

// ---------- clases que usan los scripts de la vista ----------
$guardar = [];
if (preg_match_all('#<script\b[^>]*>(.*?)</script>#si', $html, $sc)) {
    foreach ($sc[1] as $js) {
        if (preg_match_all('/(?:add|remove|toggle|has)Class\(\s*[\'"]([^\'"]+)[\'"]/', $js, $m)) {
            foreach ($m[1] as $lista) foreach (preg_split('/\s+/', trim($lista)) as $c) $guardar[$c] = true;
        }
        if (preg_match_all('/classList\.(?:add|remove|toggle|contains)\(([^)]*)\)/', $js, $m)) {
            foreach ($m[1] as $args) if (preg_match_all('/[\'"]([\w-]+)[\'"]/', $args, $a)) foreach ($a[1] as $c) $guardar[$c] = true;
        }
        if (preg_match_all('/getElementsByClassName\(\s*[\'"]([\w-]+)/', $js, $m)) foreach ($m[1] as $c) $guardar[$c] = true;
        // selectores dentro de cadenas: '.clase', "tr .clase", etc.
        if (preg_match_all('/([\'"])((?:(?!\1).)*)\1/', $js, $cad)) {
            foreach ($cad[2] as $s) {
                if (str_contains($s, '<')) continue;              // fragmento HTML, no selector
                if (preg_match_all('/(?<![\w\/-])\.([a-zA-Z_][\w-]*)/', $s, $m)) foreach ($m[1] as $c) $guardar[$c] = true;
            }
        }
    }
}
// Estados y ganchos que siempre se conservan (los usan Bootstrap-JS/Vue/el puente o el CSS de estados).
foreach (['active', 'show', 'in', 'fade', 'collapse', 'collapsed', 'disabled', 'tab-pane', 'tab-content', 'hidden', 'd-none',
          'fa', 'fas', 'far', 'fab', 'oi'] as $c) $guardar[$c] = true;

// ---------- equivalencias ----------
$sp = [0 => '0', 1 => '1', 2 => '2', 3 => '4', 4 => '6', 5 => '12'];   // espaciado BS4 → Tailwind (4px)
$map = [
    'container' => 'tw:w-full', 'container-fluid' => 'tw:w-full',
    'row' => 'tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4',
    'form-row' => 'tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4',
    'card' => 'tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white',
    'panel' => 'tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white',
    'well' => 'tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-5',
    'jumbotron' => 'tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-gray-50 tw:p-8',
    'card-header' => 'tw:border-b tw:border-gray-100 tw:px-5 tw:py-4', 'panel-heading' => 'tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4',
    'card-body' => 'tw:p-5 tw:sm:p-6', 'panel-body' => 'tw:p-5 tw:sm:p-6',
    'card-footer' => 'tw:border-t tw:border-gray-100 tw:px-5 tw:py-4', 'panel-footer' => 'tw:border-t tw:border-gray-100 tw:px-5 tw:py-4',
    'card-title' => 'tw:text-base tw:font-medium tw:text-gray-800', 'panel-title' => 'tw:text-base tw:font-medium tw:text-gray-800',
    'panel-default' => '', 'panel-info' => '', 'panel-primary' => '', 'panel-success' => '', 'panel-warning' => '', 'panel-danger' => '', 'panel-group' => '',
    'panel-collapse' => '',
    'form-group' => 'tw:mb-4', 'form' => '', 'form-inline' => 'tw:flex tw:flex-wrap tw:items-center tw:gap-3', 'form-horizontal' => '',
    'form-text' => 'tw:mt-1 tw:block tw:text-xs', 'help-block' => 'tw:mt-1 tw:block tw:text-xs tw:text-gray-500',
    'control-label' => 'tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700',
    'col-form-label' => 'tw:mb-1.5 tw:block tw:text-sm tw:font-medium tw:text-gray-700',
    'form-check' => 'tw:flex tw:items-center tw:gap-2', 'form-check-inline' => 'tw:mr-4 tw:inline-flex tw:items-center tw:gap-2',
    'form-check-input' => 'tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500',
    'form-check-label' => 'tw:text-sm tw:text-gray-700',
    'radio-inline' => 'tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700',
    'checkbox-inline' => 'tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700',
    'radio' => 'tw:flex tw:items-center tw:gap-2', 'checkbox' => 'tw:flex tw:items-center tw:gap-2',
    'input-group' => 'tw:flex tw:w-full tw:items-stretch',
    'input-group-addon' => 'tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600',
    'input-group-text' => 'tw:inline-flex tw:h-full tw:items-center tw:border tw:border-gray-300 tw:bg-gray-50 tw:px-3 tw:text-sm tw:text-gray-600',
    'input-group-btn' => 'tw:inline-flex', 'input-group-prepend' => 'tw:flex', 'input-group-append' => 'tw:flex',
    'text-danger' => 'tw:text-red-600', 'text-success' => 'tw:text-green-600', 'text-warning' => 'tw:text-amber-600', 'text-info' => 'tw:text-sky-600',
    'text-primary' => 'tw:text-brand-500', 'text-muted' => 'tw:text-gray-500', 'text-dark' => 'tw:text-gray-800', 'text-white' => 'tw:text-white',
    'text-secondary' => 'tw:text-gray-500',
    'text-center' => 'tw:text-center', 'text-right' => 'tw:text-right', 'text-left' => 'tw:text-left', 'center' => 'tw:text-center',
    'text-uppercase' => 'tw:uppercase', 'text-justify' => 'tw:text-justify', 'text-nowrap' => 'tw:whitespace-nowrap',
    'font-weight-bold' => 'tw:font-semibold', 'font-weight-normal' => 'tw:font-normal', 'font-italic' => 'tw:italic', 'lead' => 'tw:text-lg', 'small' => 'tw:text-sm',
    'float-right' => 'tw:float-right', 'float-left' => 'tw:float-left', 'pull-right' => 'tw:float-right', 'pull-left' => 'tw:float-left',
    'clearfix' => 'tw:clear-both',
    'bg-success' => 'tw:bg-green-100', 'bg-primary' => 'tw:bg-brand-500 tw:text-white', 'bg-info' => 'tw:bg-sky-100', 'bg-danger' => 'tw:bg-red-100',
    'bg-warning' => 'tw:bg-amber-100', 'bg-white' => 'tw:bg-white', 'bg-light' => 'tw:bg-gray-50', 'bg-dark' => 'tw:bg-gray-800 tw:text-white',
    'bg-secondary' => 'tw:bg-gray-100',
    'shadow' => 'tw:shadow-theme-md', 'shadow-sm' => 'tw:shadow-theme-xs', 'border' => 'tw:border tw:border-gray-200', 'border-0' => 'tw:border-0',
    'rounded' => 'tw:rounded-lg', 'img-rounded' => 'tw:rounded-lg', 'rounded-circle' => 'tw:rounded-full', 'img-circle' => 'tw:rounded-full',
    'img-fluid' => 'tw:h-auto tw:max-w-full', 'img-responsive' => 'tw:h-auto tw:max-w-full',
    'img-thumbnail' => 'tw:rounded-lg tw:border tw:border-gray-200 tw:p-1',
    'list-group' => 'tw:divide-y tw:divide-gray-100 tw:rounded-lg tw:border tw:border-gray-200', 'list-group-flush' => 'tw:border-0',
    'list-group-item' => 'tw:block tw:px-4 tw:py-3',
    'list-unstyled' => '', 'list-inline' => 'tw:flex tw:flex-wrap tw:gap-3',
    'nav' => '', 'nav-item' => '', 'nav-link' => 'tw-pestana',
    'nav-tabs' => 'tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200',
    'nav-pills' => 'tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200',
    'nav-justified' => '',
    'progress' => 'tw:mb-3 tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200',
    'progress-bar' => 'tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-xs tw:font-medium tw:text-white',
    'progress-bar-success' => 'tw:bg-green-500', 'progress-bar-warning' => 'tw:bg-amber-500', 'progress-bar-danger' => 'tw:bg-red-500',
    'progress-bar-info' => 'tw:bg-sky-500', 'progress-bar-striped' => '', 'progress-bar-animated' => '',
    'alert' => 'tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm',
    'alert-primary' => 'tw:border-brand-200 tw:bg-brand-50 tw:text-brand-700', 'alert-info' => 'tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800',
    'alert-success' => 'tw:border-green-200 tw:bg-green-50 tw:text-green-800', 'alert-danger' => 'tw:border-red-200 tw:bg-red-50 tw:text-red-700',
    'alert-warning' => 'tw:border-amber-200 tw:bg-amber-50 tw:text-amber-800', 'alert-secondary' => 'tw:border-gray-200 tw:bg-gray-50 tw:text-gray-700',
    'alert-light' => 'tw:border-gray-200 tw:bg-white tw:text-gray-700', 'alert-dismissible' => 'tw:relative tw:pr-10', 'alert-heading' => 'tw:mb-1 tw:font-semibold',
    'badge' => 'tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium',
    'badge-primary' => 'tw:bg-brand-50 tw:text-brand-500', 'badge-info' => 'tw:bg-sky-50 tw:text-sky-600', 'badge-success' => 'tw:bg-green-50 tw:text-green-700',
    'badge-danger' => 'tw:bg-red-50 tw:text-red-600', 'badge-warning' => 'tw:bg-amber-50 tw:text-amber-700', 'badge-secondary' => 'tw:bg-gray-100 tw:text-gray-700',
    'table-responsive' => 'tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200',
    'table-bordered' => 'tw-tabla-bordes', 'table-striped' => 'tw-tabla-rayas', 'table-hover' => '', 'table-sm' => 'tw-tabla-compacta',
    'table-condensed' => 'tw-tabla-compacta',
    'd-flex' => 'tw:flex', 'd-block' => 'tw:block', 'd-inline' => 'tw:inline', 'd-inline-block' => 'tw:inline-block', 'd-inline-flex' => 'tw:inline-flex',
    'flex-wrap' => 'tw:flex-wrap', 'flex-column' => 'tw:flex-col', 'justify-content-center' => 'tw:justify-center', 'justify-content-between' => 'tw:justify-between',
    'justify-content-end' => 'tw:justify-end', 'align-items-center' => 'tw:items-center', 'align-middle' => 'tw:align-middle', 'align-content-center' => 'tw:content-center',
    'align-self-center' => 'tw:self-center',
    'w-100' => 'tw:w-full', 'w-75' => 'tw:w-3/4', 'w-50' => 'tw:w-1/2', 'w-25' => 'tw:w-1/4', 'h-100' => 'tw:h-full',
    'mr-auto' => 'tw:mr-auto', 'ml-auto' => 'tw:ml-auto', 'mx-auto' => 'tw:mx-auto', 'm-auto' => 'tw:m-auto',
    'page-header' => 'tw:mb-6 tw:border-b tw:border-gray-200 tw:pb-2',
    'caret' => '', 'sr-only' => 'tw:sr-only', 'close' => 'tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700',
    'table' => 'tw-tabla',
];
// espaciado: m, p con t,b,l,r,x,y y 0-5 (BS4); BS3 no los tiene, pero algunas vistas BS3 los usan igual.
foreach (['m', 'p'] as $prop) foreach (['', 't', 'b', 'l', 'r', 'x', 'y'] as $lado) foreach ($sp as $n => $tw) {
    $map["$prop$lado-$n"] = "tw:$prop$lado-$tw";
}
$botonColor = [
    'btn-primary' => 'tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600',
    'btn-success' => 'tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700',
    'btn-danger' => 'tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700',
    'btn-warning' => 'tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600',
    'btn-info' => 'tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600',
    'btn-default' => 'tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50',
    'btn-secondary' => 'tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50',
    'btn-light' => 'tw:bg-gray-50 tw:text-gray-700 tw:hover:bg-gray-100',
    'btn-dark' => 'tw:bg-gray-800 tw:text-white tw:hover:bg-gray-900',
    'btn-link' => 'tw:text-brand-500 tw:hover:underline',
    'btn-outline-primary' => 'tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50',
    'btn-outline-success' => 'tw:bg-white tw:text-green-700 tw:ring-1 tw:ring-green-300 tw:ring-inset tw:hover:bg-green-50',
    'btn-outline-danger' => 'tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50',
    'btn-outline-warning' => 'tw:bg-white tw:text-amber-600 tw:ring-1 tw:ring-amber-300 tw:ring-inset tw:hover:bg-amber-50',
    'btn-outline-info' => 'tw:bg-white tw:text-sky-600 tw:ring-1 tw:ring-sky-300 tw:ring-inset tw:hover:bg-sky-50',
    'btn-outline-secondary' => 'tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:hover:bg-gray-50',
    'btn-outline-dark' => 'tw:bg-white tw:text-gray-800 tw:ring-1 tw:ring-gray-400 tw:ring-inset tw:hover:bg-gray-50',
];
$botonTam = ['btn-sm' => 'tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm', 'btn-xs' => 'tw:gap-1 tw:px-2 tw:py-1 tw:text-xs', 'btn-lg' => 'tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base'];
$etiquetaColor = ['label-success' => 'exito', 'label-danger' => 'error', 'label-warning' => 'advertencia', 'label-info' => 'info', 'label-primary' => 'marca', 'label-default' => 'gris'];
$tonoBadge = ['exito' => 'tw:bg-green-50 tw:text-green-700', 'error' => 'tw:bg-red-50 tw:text-red-600', 'advertencia' => 'tw:bg-amber-50 tw:text-amber-700',
    'info' => 'tw:bg-sky-50 tw:text-sky-600', 'marca' => 'tw:bg-brand-50 tw:text-brand-500', 'gris' => 'tw:bg-gray-100 tw:text-gray-700'];
$glyph = ['glyphicon-ok' => 'fa-check', 'glyphicon-list-alt' => 'fa-list-alt', 'glyphicon-transfer' => 'fa-exchange', 'glyphicon-ok-sign' => 'fa-check-circle',
    'glyphicon-alert' => 'fa-exclamation-triangle', 'glyphicon-remove-sign' => 'fa-times-circle', 'glyphicon-remove' => 'fa-times', 'glyphicon-print' => 'fa-print',
    'glyphicon-pencil' => 'fa-pencil', 'glyphicon-arrow-left' => 'fa-arrow-left', 'glyphicon-search' => 'fa-search', 'glyphicon-trash' => 'fa-trash',
    'glyphicon-plus' => 'fa-plus', 'glyphicon-eye-open' => 'fa-eye', 'glyphicon-download-alt' => 'fa-download', 'glyphicon-floppy-disk' => 'fa-floppy-o',
    'glyphicon-user' => 'fa-user', 'glyphicon-stats' => 'fa-bar-chart', 'glyphicon-refresh' => 'fa-refresh', 'glyphicon-file' => 'fa-file',
    'glyphicon-edit' => 'fa-pencil-square-o', 'glyphicon-cog' => 'fa-cog', 'glyphicon-ban-circle' => 'fa-ban', 'glyphicon-export' => 'fa-external-link',
    'glyphicon-ok-circle' => 'fa-check-circle-o', 'glyphicon-open-file' => 'fa-file-o', 'glyphicon-tags' => 'fa-tags', 'glyphicon-tasks' => 'fa-tasks', 'glyphicon-info-sign' => 'fa-info-circle', 'glyphicon-warning-sign' => 'fa-exclamation-triangle'];
$resp = $bs === 3 ? ['xs' => '', 'sm' => 'md:', 'md' => 'lg:', 'lg' => 'xl:'] : ['' => '', 'sm' => 'sm:', 'md' => 'md:', 'lg' => 'lg:', 'xl' => 'xl:'];
$control = 'tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500';
$archivoCtl = 'tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden';

$desconocidas = [];
$porcentaje = fn (int $n) => rtrim(rtrim(number_format($n * 100 / 12, 4, '.', ''), '0'), '.') . '%';

$convertirClases = function (string $valor, string $tag, string $tipo) use (&$desconocidas, $guardar, $map, $botonColor, $botonTam, $etiquetaColor, $tonoBadge, $glyph, $resp, $control, $archivoCtl, $porcentaje, $bs) {
    preg_match_all('/\{\{.*?\}\}|\{!!.*?!!\}|@\w+(?:\((?:[^()]|\([^()]*\))*\))?|\S+/s', $valor, $m);
    $tokens = $m[0];
    $quedan = []; $tw = [];
    $hay = array_flip($tokens);
    $esBoton = isset($hay['btn']);
    $col = false; $base = false;
    foreach ($tokens as $t) {
        if ($t[0] === '{' || $t[0] === '@' || str_contains($t, "'") || str_contains($t, '"') || str_contains($t, '+')) { $quedan[] = $t; continue; }
        if (isset($guardar[$t])) { $quedan[] = $t; }
        // columnas
        if (preg_match('/^col(?:-(xs|sm|md|lg|xl))?(?:-(\d+|auto))?$/', $t, $c)) {
            $bp = $c[1] ?? ''; $n = $c[2] ?? '';
            if ($bs === 3 && $bp === '') { $desconocidas[$t] = true; $quedan[] = $t; continue; }
            $pre = $resp[$bp] ?? null; if ($pre === null) { $quedan[] = $t; continue; }
            $col = true; if ($pre === '') $base = true;
            if ($n === '') $tw[] = "tw:{$pre}min-w-0 tw:{$pre}flex-1";
            elseif ($n === 'auto') $tw[] = "tw:{$pre}w-auto tw:{$pre}flex-none";
            else $tw[] = 'tw:' . $pre . ((int) $n === 12 ? 'w-full' : "w-$n/12");
            continue;
        }
        if (preg_match('/^col-(xs|sm|md|lg)-offset-(\d+)$/', $t, $c) || preg_match('/^offset(?:-(sm|md|lg|xl))?-(\d+)$/', $t, $c)) {
            $bp = $c[1] ?? ''; $pre = $resp[$bp] ?? '';
            $tw[] = 'tw:' . $pre . 'ml-[' . $porcentaje((int) $c[2]) . ']';
            continue;
        }
        if (preg_match('/^glyphicon(-[\w-]+)?$/', $t)) {
            if ($t === 'glyphicon') { $quedan[] = 'fa'; continue; }
            if (isset($glyph[$t])) { $quedan[] = $glyph[$t]; continue; }
            $desconocidas[$t] = true; $quedan[] = 'fa'; continue;
        }
        if ($t === 'btn') { $tw[] = 'tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60'; continue; }
        if (isset($botonColor[$t])) { $tw[] = $botonColor[$t]; continue; }
        if (isset($botonTam[$t])) { $tw[] = $botonTam[$t]; continue; }
        if ($t === 'btn-block') { $tw[] = 'tw:flex tw:w-full'; continue; }
        if ($t === 'btn-group') { $tw[] = 'tw:inline-flex tw:gap-2'; continue; }
        if ($t === 'label' && $tag !== 'label') { $tw[] = 'tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium'; continue; }
        if (isset($etiquetaColor[$t])) { $tw[] = $tonoBadge[$etiquetaColor[$t]]; continue; }
        if ($t === 'form-control' || $t === 'custom-select' || $t === 'custom-file-input' || $t === 'form-control-file') {
            if ($tipo === 'file') $tw[] = $archivoCtl;
            elseif ($tag === 'textarea') $tw[] = $control;
            elseif ($tipo === 'checkbox' || $tipo === 'radio') $tw[] = 'tw:size-4 tw:accent-brand-500';
            else $tw[] = $control . ' tw:h-11';
            continue;
        }
        if (in_array($t, ['custom-select-md', 'custom-select-sm', 'form-control-sm', 'input-sm', 'input-lg', 'form-control-lg', 'input-group-sm', 'custom-file'], true)) continue;
        if ($t === 'bs-example-modal-sm' || str_starts_with($t, 'modal')) { $quedan[] = $t; $desconocidas['(modal) ' . $t] = true; continue; }
        if (array_key_exists($t, $map)) { if ($map[$t] !== '') $tw[] = $map[$t]; continue; }
        if (!isset($guardar[$t])) {
            if (preg_match('/^(btn|col|form|table|panel|card|nav|navbar|dropdown|input|text|bg|badge|label|alert|list|progress|pull|img|d|justify|align|offset|float|font|custom|page|m[trblxy]?|p[trblxy]?)-/', $t)) $desconocidas[$t] = true;
            $quedan[] = $t;
        }
    }
    if ($col) { $tw[] = 'tw:px-2'; if (!$base) array_unshift($tw, 'tw:w-full'); }
    if ($esBoton && !array_intersect($tokens, array_keys($botonTam))) $tw[] = 'tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm';
    $todo = array_merge($quedan, preg_split('/\s+/', trim(implode(' ', $tw))));
    $todo = array_values(array_unique(array_filter($todo, fn ($x) => $x !== '')));
    return implode(' ', $todo);
};

$salida = preg_replace_callback('/(?<=[\s"\'])class=(["\'])(.*?)\1/s', function ($m) use ($convertirClases, &$html) {
    return $m[0];
}, $html);

// Recorre con desplazamientos para conocer la etiqueta y el type de cada atributo.
$res = ''; $pos = 0;
if (preg_match_all('/(?<=[\s"\'])class=(["\'])(.*?)\1/s', $html, $todos, PREG_OFFSET_CAPTURE)) {
    foreach ($todos[0] as $i => [$texto, $off]) {
        $antes = substr($html, 0, $off);
        $ini = strrpos($antes, '<');
        $tag = ''; $tipo = '';
        if ($ini !== false && preg_match('/^<([a-zA-Z][\w.-]*)/', substr($html, $ini, 40), $tm)) $tag = strtolower($tm[1]);
        $fin = strpos($html, '>', $off);
        $etiqueta = substr($html, $ini === false ? $off : $ini, ($fin === false ? strlen($html) : $fin) - ($ini === false ? $off : $ini));
        if (preg_match('/\stype=["\']?(\w+)/', $etiqueta, $tt)) $tipo = strtolower($tt[1]);
        $comilla = $todos[1][$i][0];
        $valor = $todos[2][$i][0];
        $nuevo = $convertirClases($valor, $tag, $tipo);
        $res .= substr($html, $pos, $off - $pos) . 'class=' . $comilla . $nuevo . $comilla;
        $pos = $off + strlen($texto);
    }
}
$res .= substr($html, $pos);
file_put_contents($archivo, $res);
fwrite(STDERR, basename($archivo) . ': ' . count($todos[0] ?? []) . " atributos class; conservadas por scripts: "
    . implode(',', array_diff(array_keys($guardar), ['active', 'show', 'in', 'fade', 'collapse', 'collapsed', 'disabled', 'tab-pane', 'tab-content', 'hidden', 'd-none', 'fa', 'fas', 'far', 'fab', 'oi']))
    . "\n  revisar: " . implode(', ', array_keys($desconocidas)) . "\n");
