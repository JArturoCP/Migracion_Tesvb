{{--
    Botón de la plantilla (TailAdmin "Button"). Con href se dibuja como <a>; si no, como <button type="button">.
    Todos los atributos (type, id, name, value, class, data-*, onclick, v-if…) pasan sin cambios.
    <x-panel.boton type="submit">Guardar</x-panel.boton>
    <x-panel.boton variante="peligro" tamano="sm" href="/pdf" target="_blank">PDF</x-panel.boton>
    variante: primario (predeterminado) | secundario | exito | peligro | advertencia | info
              | contorno-primario | contorno-exito | contorno-peligro
    tamano:   sm | md (predeterminado) | lg
--}}
@props(['variante' => 'primario', 'tamano' => 'md', 'href' => null])
@php
    $variantes = [
        'primario' => 'tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300',
        'secundario' => 'tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03]',
        'exito' => 'tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:disabled:bg-green-300',
        'peligro' => 'tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300',
        'advertencia' => 'tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300',
        'info' => 'tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:disabled:bg-sky-300',
        'contorno-primario' => 'tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10',
        'contorno-exito' => 'tw:bg-white tw:text-green-700 tw:ring-1 tw:ring-green-300 tw:ring-inset tw:hover:bg-green-50 tw:dark:bg-gray-800 tw:dark:text-green-500 tw:dark:ring-green-500/40 tw:dark:hover:bg-green-500/10',
        'contorno-peligro' => 'tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10',
    ];
    $tamanos = [
        'sm' => 'tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm',
        'md' => 'tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm',
        'lg' => 'tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base',
    ];
    $clases = 'tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed '
        . ($variantes[$variante] ?? $variantes['primario']) . ' ' . ($tamanos[$tamano] ?? $tamanos['md']);
@endphp
@if ($href !== null)
    <a href="{{ $href }}" {{ $attributes->class([$clases]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['type' => 'button'])->class([$clases]) }}>{{ $slot }}</button>
@endif
