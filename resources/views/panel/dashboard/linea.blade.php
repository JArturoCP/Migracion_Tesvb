{{--
    Gráfica de línea/área con pestañas (TailAdmin: statistics-chart).
    $titulo, $subtitulo, $categorias (array), $series: lista de ['clave', 'nombre', 'valores'].
    Las pestañas son "General" (todas las series) y una por serie. Sin datos si todas las series suman 0.
--}}
<?php $hayDatos = collect($series)->sum(fn ($s) => array_sum($s['valores'])) > 0; ?>
<div
    x-data="{ pestana: 'general' }"
    class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:px-5 tw:pt-5 tw:pb-5 tw:sm:px-6 tw:sm:pt-6 tw:dark:border-gray-800 tw:dark:bg-white/3"
    data-panel-bloque="linea"
>
    <div class="tw:mb-6 tw:flex tw:flex-col tw:gap-5 tw:sm:flex-row tw:sm:items-center tw:sm:justify-between">
        <div>
            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
        @if($hayDatos)
            <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-3 tw:sm:justify-end">
                <div class="tw:flex tw:items-center tw:gap-0.5 tw:rounded-lg tw:bg-gray-100 tw:p-0.5 tw:dark:bg-gray-900">
                    @foreach(array_merge([['clave' => 'general', 'nombre' => 'General']], $series) as $s)
                        <button
                            type="button"
                            @click="pestana = '{{ $s['clave'] }}'; $dispatch('grafica-pestana', { grafica: 'linea', pestana: '{{ $s['clave'] }}' })"
                            :class="pestana === '{{ $s['clave'] }}' ? 'tw:bg-white tw:text-gray-900 tw:shadow-theme-xs tw:hover:bg-white tw:hover:text-gray-900 tw:dark:bg-gray-800 tw:dark:text-white tw:dark:hover:bg-gray-800 tw:dark:hover:text-white' : 'tw:text-gray-500 tw:hover:bg-transparent tw:hover:text-gray-900 tw:dark:text-gray-400 tw:dark:hover:bg-transparent tw:dark:hover:text-white'"
                            class="tw:h-8 tw:rounded-md tw:px-3 tw:text-sm tw:font-medium tw:transition-colors"
                        >{{ $s['nombre'] }}</button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @if($hayDatos)
        <div class="tw:custom-scrollbar tw:max-w-full tw:overflow-x-auto">
            <div class="tw:min-w-250 tw:xl:min-w-full">
                <div
                    class="tw:h-full"
                    data-grafica="linea"
                    data-datos="{{ json_encode(['categorias' => array_values($categorias), 'series' => $series]) }}"
                ></div>
            </div>
        </div>
    @else
        @include('panel.dashboard.sin_datos', ['alto' => 'tw:min-h-60'])
    @endif
</div>
