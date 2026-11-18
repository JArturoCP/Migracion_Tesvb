{{--
    Gráfica de línea/área con pestañas (TailAdmin: statistics-chart).
    $titulo, $subtitulo, $categorias (array), $series: lista de ['clave', 'nombre', 'valores'].
    Las pestañas son "General" (todas las series) y una por serie. Sin datos si todas las series suman 0.
--}}
<?php $hayDatos = collect($series)->sum(fn ($s) => array_sum($s['valores'])) > 0; ?>
<div
    x-data="{ pestana: 'general' }"
    class="rounded-2xl border border-gray-200 bg-white px-5 pt-5 pb-5 sm:px-6 sm:pt-6 dark:border-gray-800 dark:bg-white/3"
    data-panel-bloque="linea"
>
    <div class="mb-6 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ $titulo }}</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
        @if($hayDatos)
            <div class="flex flex-wrap items-center gap-3 sm:justify-end">
                <div class="flex items-center gap-0.5 rounded-lg bg-gray-100 p-0.5 dark:bg-gray-900">
                    @foreach(array_merge([['clave' => 'general', 'nombre' => 'General']], $series) as $s)
                        <button
                            type="button"
                            @click="pestana = '{{ $s['clave'] }}'; $dispatch('grafica-pestana', { grafica: 'linea', pestana: '{{ $s['clave'] }}' })"
                            :class="pestana === '{{ $s['clave'] }}' ? 'bg-white text-gray-900 shadow-theme-xs hover:bg-white hover:text-gray-900 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-800 dark:hover:text-white' : 'text-gray-500 hover:bg-transparent hover:text-gray-900 dark:text-gray-400 dark:hover:bg-transparent dark:hover:text-white'"
                            class="h-8 rounded-md px-3 text-sm font-medium transition-colors"
                        >{{ $s['nombre'] }}</button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @if($hayDatos)
        <div class="custom-scrollbar max-w-full overflow-x-auto">
            <div class="min-w-250 xl:min-w-full">
                <div
                    class="h-full"
                    data-grafica="linea"
                    data-datos="{{ json_encode(['categorias' => array_values($categorias), 'series' => $series]) }}"
                ></div>
            </div>
        </div>
    @else
        @include('panel.dashboard.sin_datos', ['alto' => 'min-h-60'])
    @endif
</div>
