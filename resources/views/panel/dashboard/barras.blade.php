{{--
    Gráfica de barras (TailAdmin: monthly-sales-chart.html).
    $titulo, $subtitulo, $serie (nombre de la serie), $categorias (array), $valores (array de enteros).
    Si no hay valores mayores que 0 se muestra "Sin datos".
--}}
<div class="rounded-2xl border border-gray-200 bg-white px-5 pt-5 pb-5 sm:px-6 sm:pt-6 sm:pb-5 dark:border-gray-800 dark:bg-white/3" data-panel-bloque="barras">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ $titulo }}</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
    </div>

    @if(array_sum($valores) > 0)
        <div class="custom-scrollbar max-w-full overflow-x-auto">
            <div
                class="min-w-162.5 xl:min-w-full"
                data-grafica="barras"
                data-datos="{{ json_encode(['serie' => $serie, 'categorias' => array_values($categorias), 'valores' => array_values($valores)]) }}"
            ></div>
        </div>
    @else
        <div class="mt-4">@include('panel.dashboard.sin_datos', ['alto' => 'min-h-48'])</div>
    @endif
</div>
