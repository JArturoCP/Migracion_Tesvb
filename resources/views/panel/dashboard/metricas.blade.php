{{--
    Tarjetas de métricas (TailAdmin: ecommerce-metrics.html).
    $metricas: lista de ['etiqueta', 'valor' (int|null), 'anterior' (int|null), 'periodo_anterior', 'icono', 'clave'].
    El porcentaje compara con el periodo anterior solo si ese valor existe y es mayor que 0.
--}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6">
    @foreach($metricas as $m)
        <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6 dark:border-gray-800 dark:bg-white/3" data-panel-metrica="{{ $m['clave'] }}">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90 [&>svg]:size-6">
                @include('panel.dashboard.iconos.' . $m['icono'])
            </div>

            <div class="mt-5 flex items-end justify-between gap-3">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $m['etiqueta'] }}</span>
                    @if($m['valor'] === null)
                        <h4 class="mt-2 text-title-sm font-bold text-gray-400 dark:text-gray-500" data-panel-valor>Sin datos</h4>
                    @else
                        <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90" data-panel-valor>{{ number_format($m['valor']) }}</h4>
                    @endif
                </div>

                @if($m['valor'] !== null && $m['anterior'] !== null && $m['anterior'] > 0)
                    <?php $cambio = round(($m['valor'] - $m['anterior']) * 100 / $m['anterior'], 2); ?>
                    <span
                        title="Comparado con {{ $m['periodo_anterior'] }} ({{ number_format($m['anterior']) }})"
                        class="inline-flex h-6 w-fit shrink-0 items-center justify-center gap-1 rounded-lg px-2.5 py-0.5 text-sm font-medium whitespace-nowrap select-none {{ $cambio >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-500' : 'bg-red-50 text-red-600 dark:bg-red-500/15 dark:text-red-500' }}"
                    >
                        <svg class="size-3.5 fill-current {{ $cambio >= 0 ? '' : 'rotate-180' }}" width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.065 1.624a.748.748 0 01.558-.25h.001c.192 0 .384.073.531.22l3 2.998a.75.75 0 11-1.06 1.06l-1.722-1.72v6.193a.75.75 0 01-1.5 0v-6.19L4.155 5.654a.75.75 0 01-1.06-1.061l2.97-2.968z" fill="currentColor" />
                        </svg>
                        {{ number_format(abs($cambio), 2) }}%
                    </span>
                @endif
            </div>
        </div>
    @endforeach
</div>
