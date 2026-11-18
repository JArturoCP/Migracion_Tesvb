{{--
    Alerta de la plantilla (TailAdmin "Alert").
    <x-panel.alerta tipo="exito" titulo="Listo">Se guardó la evaluación.</x-panel.alerta>
    tipo: info (predeterminado) | exito | advertencia | error
--}}
@props(['tipo' => 'info', 'titulo' => null])
@php
    $tonos = [
        'info' => ['tw:border-sky-500 tw:bg-sky-50 tw:dark:border-sky-500/30 tw:dark:bg-sky-500/15', 'tw:text-sky-500'],
        'exito' => ['tw:border-green-500 tw:bg-green-50 tw:dark:border-green-500/30 tw:dark:bg-green-500/15', 'tw:text-green-500'],
        'advertencia' => ['tw:border-amber-500 tw:bg-amber-50 tw:dark:border-amber-500/30 tw:dark:bg-amber-500/15', 'tw:text-amber-500'],
        'error' => ['tw:border-red-500 tw:bg-red-50 tw:dark:border-red-500/30 tw:dark:bg-red-500/15', 'tw:text-red-500'],
    ];
    [$caja, $icono] = $tonos[$tipo] ?? $tonos['info'];
@endphp
<div {{ $attributes->merge(['role' => 'alert'])->class(['tw:rounded-xl tw:border tw:p-4', $caja]) }}>
    <div class="tw:flex tw:items-start tw:gap-3">
        <div class="tw:-mt-0.5 {{ $icono }}" aria-hidden="true">
            <svg class="tw:fill-current" width="24" height="24" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.6501 12.0001C3.6501 7.38852 7.38852 3.6501 12.0001 3.6501C16.6117 3.6501 20.3501 7.38852 20.3501 12.0001C20.3501 16.6117 16.6117 20.3501 12.0001 20.3501C7.38852 20.3501 3.6501 16.6117 3.6501 12.0001ZM12.0001 1.8501C6.39441 1.8501 1.8501 6.39441 1.8501 12.0001C1.8501 17.6058 6.39441 22.1501 12.0001 22.1501C17.6058 22.1501 22.1501 17.6058 22.1501 12.0001C22.1501 6.39441 17.6058 1.8501 12.0001 1.8501ZM10.9992 7.52517C10.9992 8.07746 11.4469 8.52517 11.9992 8.52517H12.0002C12.5525 8.52517 13.0002 8.07746 13.0002 7.52517C13.0002 6.97289 12.5525 6.52517 12.0002 6.52517H11.9992C11.4469 6.52517 10.9992 6.97289 10.9992 7.52517ZM12.0002 17.3715C11.586 17.3715 11.2502 17.0357 11.2502 16.6215V10.945C11.2502 10.5308 11.586 10.195 12.0002 10.195C12.4144 10.195 12.7502 10.5308 12.7502 10.945V16.6215C12.7502 17.0357 12.4144 17.3715 12.0002 17.3715Z" /></svg>
        </div>
        <div class="tw:min-w-0 tw:flex-1">
            @if ($titulo)
                <h4 class="tw:mb-1 tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h4>
            @endif
            <div class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ $slot }}</div>
        </div>
    </div>
</div>
