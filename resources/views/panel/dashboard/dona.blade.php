{{--
    Gráfica de dona (ApexCharts "donut", misma tarjeta que las demás gráficas del dashboard).
    $titulo, $subtitulo, $segmentos: lista de ['etiqueta', 'valor' (int)] (hasta 4 colores: marca, marca claro, ámbar y verde). Si todos suman 0 se muestra x-panel.vacio.
    $vacio (opcional): mensaje del estado vacío.
--}}
<?php $totalDona = array_sum(array_column($segmentos, 'valor')); ?>
<div class="tw:h-full tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:px-5 tw:pt-5 tw:pb-5 tw:sm:px-6 tw:sm:pt-6 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-bloque="dona">
    <div>
        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
        <p class="tw:mt-1 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
    </div>

    @if($totalDona > 0)
        <div class="tw:mx-auto tw:mt-4 tw:max-w-80" data-grafica="dona"
             data-datos="{{ json_encode(['etiquetas' => array_column($segmentos, 'etiqueta'), 'valores' => array_column($segmentos, 'valor')]) }}"></div>
        <ul class="tw:mt-4 tw:flex tw:flex-wrap tw:justify-center tw:gap-x-6 tw:gap-y-2">
            @foreach($segmentos as $i => $s)
                <li class="tw:flex tw:items-center tw:gap-2 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">
                    <span class="tw:size-2.5 tw:rounded-full {{ ['tw:bg-brand-500', 'tw:bg-brand-200 tw:dark:bg-brand-300', 'tw:bg-amber-500', 'tw:bg-green-500'][$i] ?? 'tw:bg-gray-400' }}" aria-hidden="true"></span>
                    {{ $s['etiqueta'] }}
                    <span class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ number_format($s['valor']) }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <x-panel.vacio class="tw:mt-6" :mensaje="$vacio ?? 'No hay registros en este periodo.'" />
    @endif
</div>
