{{--
    Lista con porcentajes (TailAdmin: demographic-card, sin el mapa).
    $titulo, $subtitulo, $unidad (p. ej. "estudiantes"), $elementos: lista de ['nombre', 'detalle', 'color', 'valor'].
    El porcentaje de cada elemento es valor / total. Sin datos si el total es 0.
--}}
<?php $total = array_sum(array_column($elementos, 'valor')); ?>
<div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:sm:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-bloque="lista">
    <div class="tw:flex tw:justify-between">
        <div>
            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
            <p class="tw:mt-1 tw:text-sm tw:font-normal tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
    </div>

    @if($total > 0)
        <div class="tw:mt-6 tw:flex tw:flex-col tw:gap-5">
            @foreach($elementos as $e)
                <?php $porcentaje = round($e['valor'] * 100 / $total, 2); ?>
                <div class="tw:flex tw:items-center tw:justify-between tw:gap-3" data-panel-lista-elemento>
                    <div class="tw:flex tw:min-w-0 tw:items-center tw:gap-3">
                        <div class="tw:flex tw:size-8 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-lg tw:text-xs tw:font-semibold tw:text-white" style="background-color: {{ $e['color'] ?: '#465FFF' }}">
                            {{ mb_substr($e['nombre'], 0, 3) }}
                        </div>
                        <div class="tw:min-w-0">
                            <p class="tw:truncate tw:text-sm tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $e['nombre'] }}</p>
                            <span class="tw:block tw:truncate tw:text-xs tw:font-normal tw:text-gray-500 tw:dark:text-gray-400">{{ number_format($e['valor']) }} {{ $unidad }} · {{ $e['detalle'] }}</span>
                        </div>
                    </div>
                    <div class="tw:flex tw:w-28 tw:shrink-0 tw:items-center tw:gap-3">
                        <div class="tw:relative tw:block tw:h-2 tw:w-full tw:rounded-sm tw:bg-gray-200 tw:dark:bg-gray-800">
                            <div class="tw:absolute tw:top-0 tw:left-0 tw:flex tw:h-full tw:items-center tw:justify-center tw:rounded-sm tw:bg-brand-500" style="width: {{ $porcentaje }}%"></div>
                        </div>
                        <p class="tw:w-14 tw:text-right tw:text-sm tw:font-medium tw:text-gray-700 tw:dark:text-gray-300">{{ number_format($porcentaje, 2) }}%</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="tw:mt-6">@include('panel.dashboard.sin_datos')</div>
    @endif
</div>
