{{--
    Tarjetas de métricas (TailAdmin: ecommerce-metrics.html).
    $metricas: lista de ['etiqueta', 'valor' (int|null), 'anterior' (int|null), 'periodo_anterior', 'icono', 'clave'].
    El porcentaje compara con el periodo anterior solo si ese valor existe y es mayor que 0.
    Opcional: 'formato' => 'moneda' muestra el valor (y el anterior) como pesos con 2 decimales ($1,234.50).
--}}
<?php $formatoMetrica = fn ($m, $v) => ($m['formato'] ?? null) === 'moneda' ? '$' . number_format($v, 2) : number_format($v); ?>
<div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:sm:grid-cols-2 tw:md:gap-6">
    @foreach($metricas as $m)
        <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:p-5 tw:md:p-6 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-metrica="{{ $m['clave'] }}">
            <div class="tw:flex tw:h-12 tw:w-12 tw:items-center tw:justify-center tw:rounded-xl tw:bg-gray-100 tw:text-gray-800 tw:dark:bg-gray-800 tw:dark:text-white/90 tw:[&>svg]:size-6">
                @include('panel.dashboard.iconos.' . $m['icono'])
            </div>

            <div class="tw:mt-5 tw:flex tw:items-end tw:justify-between tw:gap-3">
                <div>
                    <span class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">{{ $m['etiqueta'] }}</span>
                    @if($m['valor'] === null)
                        <h4 class="tw:mt-2 tw:text-title-sm tw:font-bold tw:text-gray-400 tw:dark:text-gray-500" data-panel-valor>Sin datos</h4>
                    @else
                        <h4 class="tw:mt-2 tw:text-title-sm tw:font-bold tw:text-gray-800 tw:dark:text-white/90" data-panel-valor>{{ $formatoMetrica($m, $m['valor']) }}</h4>
                    @endif
                </div>

                @if($m['valor'] !== null && $m['anterior'] !== null && $m['anterior'] > 0)
                    <?php $cambio = round(($m['valor'] - $m['anterior']) * 100 / $m['anterior'], 2); ?>
                    <span
                        title="Comparado con {{ $m['periodo_anterior'] }} ({{ $formatoMetrica($m, $m['anterior']) }})"
                        class="tw:inline-flex tw:h-6 tw:w-fit tw:shrink-0 tw:items-center tw:justify-center tw:gap-1 tw:rounded-lg tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium tw:whitespace-nowrap tw:select-none {{ $cambio >= 0 ? 'tw:bg-green-50 tw:text-green-600 tw:dark:bg-green-500/15 tw:dark:text-green-500' : 'tw:bg-red-50 tw:text-red-600 tw:dark:bg-red-500/15 tw:dark:text-red-500' }}"
                    >
                        <svg class="tw:size-3.5 tw:fill-current {{ $cambio >= 0 ? '' : 'tw:rotate-180' }}" width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.065 1.624a.748.748 0 01.558-.25h.001c.192 0 .384.073.531.22l3 2.998a.75.75 0 11-1.06 1.06l-1.722-1.72v6.193a.75.75 0 01-1.5 0v-6.19L4.155 5.654a.75.75 0 01-1.06-1.061l2.97-2.968z" fill="currentColor" />
                        </svg>
                        {{ number_format(abs($cambio), 2) }}%
                    </span>
                @endif
            </div>
        </div>
    @endforeach
</div>
