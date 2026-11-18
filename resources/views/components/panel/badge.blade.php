{{--
    Insignia de la plantilla (TailAdmin "Badge").
    <x-panel.badge tono="exito">Activo</x-panel.badge>
    tono: marca (predeterminado) | exito | advertencia | error | info | gris
--}}
@props(['tono' => 'marca'])
@php
    $tonos = [
        'marca' => 'tw:bg-brand-50 tw:text-brand-500 tw:dark:bg-brand-500/15 tw:dark:text-brand-400',
        'exito' => 'tw:bg-green-50 tw:text-green-700 tw:dark:bg-green-500/15 tw:dark:text-green-500',
        'advertencia' => 'tw:bg-amber-50 tw:text-amber-700 tw:dark:bg-amber-500/15 tw:dark:text-amber-400',
        'error' => 'tw:bg-red-50 tw:text-red-600 tw:dark:bg-red-500/15 tw:dark:text-red-500',
        'info' => 'tw:bg-sky-50 tw:text-sky-600 tw:dark:bg-sky-500/15 tw:dark:text-sky-500',
        'gris' => 'tw:bg-gray-100 tw:text-gray-700 tw:dark:bg-white/5 tw:dark:text-white/80',
    ];
@endphp
<span {{ $attributes->class(['tw:inline-flex tw:items-center tw:justify-center tw:gap-1 tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium', $tonos[$tono] ?? $tonos['marca']]) }}>{{ $slot }}</span>
