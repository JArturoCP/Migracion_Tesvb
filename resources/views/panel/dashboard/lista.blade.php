{{--
    Lista con porcentajes (TailAdmin: demographic-card, sin el mapa).
    $titulo, $subtitulo, $unidad (p. ej. "estudiantes"), $elementos: lista de ['nombre', 'detalle', 'color', 'valor'].
    El porcentaje de cada elemento es valor / total. Sin datos si el total es 0.
--}}
<?php $total = array_sum(array_column($elementos, 'valor')); ?>
<div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 dark:border-gray-800 dark:bg-white/3" data-panel-bloque="lista">
    <div class="flex justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ $titulo }}</h3>
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">{{ $subtitulo }}</p>
        </div>
    </div>

    @if($total > 0)
        <div class="mt-6 flex flex-col gap-5">
            @foreach($elementos as $e)
                <?php $porcentaje = round($e['valor'] * 100 / $total, 2); ?>
                <div class="flex items-center justify-between gap-3" data-panel-lista-elemento>
                    <div class="flex min-w-0 items-center gap-3">
                        <div class="flex size-8 shrink-0 items-center justify-center rounded-lg text-xs font-semibold text-white" style="background-color: {{ $e['color'] ?: '#465FFF' }}">
                            {{ mb_substr($e['nombre'], 0, 3) }}
                        </div>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-gray-800 dark:text-white/90">{{ $e['nombre'] }}</p>
                            <span class="block truncate text-xs font-normal text-gray-500 dark:text-gray-400">{{ number_format($e['valor']) }} {{ $unidad }} · {{ $e['detalle'] }}</span>
                        </div>
                    </div>
                    <div class="flex w-28 shrink-0 items-center gap-3">
                        <div class="relative block h-2 w-full rounded-sm bg-gray-200 dark:bg-gray-800">
                            <div class="absolute top-0 left-0 flex h-full items-center justify-center rounded-sm bg-brand-500" style="width: {{ $porcentaje }}%"></div>
                        </div>
                        <p class="w-14 text-right text-sm font-medium text-gray-700 dark:text-gray-300">{{ number_format($porcentaje, 2) }}%</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="mt-6">@include('panel.dashboard.sin_datos')</div>
    @endif
</div>
