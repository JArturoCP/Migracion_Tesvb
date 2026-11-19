{{--
    Tarjeta de la plantilla (TailAdmin "ComponentCard").
    <x-panel.tarjeta titulo="Actividades" subtitulo="Periodo actual">
        <x-slot:acciones><x-panel.boton>Nuevo</x-panel.boton></x-slot:acciones>
        …contenido…
    </x-panel.tarjeta>
    sin-relleno: el cuerpo no lleva padding (para tablas que llegan al borde).
--}}
@props(['titulo' => null, 'subtitulo' => null, 'sinRelleno' => false])
<div {{ $attributes->class(['tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]']) }}>
    @if ($titulo || isset($acciones))
        <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3 tw:px-5 tw:py-4 tw:sm:px-6 tw:sm:py-5">
            <div>
                @if ($titulo)
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
                @endif
                @if ($subtitulo)
                    <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
                @endif
            </div>
            @isset($acciones)
                <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-2">{{ $acciones }}</div>
            @endisset
        </div>
    @endif
    <div @class([
        'tw:border-t tw:border-gray-100 tw:dark:border-gray-800' => $titulo || isset($acciones),
        'tw:p-4 tw:sm:p-6' => ! $sinRelleno,
    ])>
        {{ $slot }}
    </div>
</div>
