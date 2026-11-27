{{--
    Gráfica de barras (TailAdmin: monthly-sales-chart.html).
    $titulo, $subtitulo, $serie (nombre de la serie), $categorias (array), $valores (array de enteros). Opcional $moneda = true: etiquetas en pesos (MXN).
    Si no hay valores mayores que 0 se muestra "Sin datos".
--}}
<div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:px-5 tw:pt-5 tw:pb-5 tw:sm:px-6 tw:sm:pt-6 tw:sm:pb-5 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-bloque="barras">
    <div class="tw:flex tw:items-center tw:justify-between">
        <div>
            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
            <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
    </div>

    @if(array_sum($valores) > 0)
        <div class="tw:custom-scrollbar tw:max-w-full tw:overflow-x-auto">
            <div
                class="tw:min-w-162.5 tw:xl:min-w-full"
                data-grafica="barras"
                data-datos="{{ json_encode(['serie' => $serie, 'categorias' => array_values($categorias), 'valores' => array_values($valores)] + (! empty($moneda) ? ['moneda' => true] : [])) }}"
            ></div>
        </div>
    @else
        <div class="tw:mt-4">@include('panel.dashboard.sin_datos', ['alto' => 'tw:min-h-48'])</div>
    @endif
</div>
