{{--
    Medidor radial (TailAdmin: monthly-target).
    $titulo, $subtitulo, $porcentaje (float|null), $texto (frase bajo el medidor),
    $detalle: lista de ['etiqueta', 'valor'] para la franja inferior.
--}}
<div class="flex h-full flex-col justify-between rounded-2xl border border-gray-200 bg-gray-100 dark:border-gray-800 dark:bg-white/3" data-panel-bloque="radial">
    <div class="shadow-default flex flex-1 flex-col justify-between rounded-2xl bg-white px-5 pt-5 pb-5 sm:px-6 sm:pt-6 sm:pb-11 dark:bg-gray-900">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ $titulo }}</h3>
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">{{ $subtitulo }}</p>
            </div>
        </div>

        @if($porcentaje !== null)
            <div>
                <div class="relative">
                    <div class="max-h-45 overflow-hidden">
                        <div
                            class="h-full [&_.apexcharts-datalabels-group]:translate-y-0! [&_.apexcharts-datalabels-group_.apexcharts-text]:fill-gray-800! [&_.apexcharts-datalabels-group_.apexcharts-text]:font-semibold! dark:[&_.apexcharts-datalabels-group_.apexcharts-text]:fill-white/90!"
                            data-grafica="radial"
                            data-datos="{{ json_encode(['valor' => $porcentaje, 'etiqueta' => $titulo]) }}"
                        ></div>
                    </div>
                </div>
                <p class="mx-auto mt-4.5 w-full max-w-95 text-center text-sm text-gray-500 sm:text-base dark:text-gray-400">{{ $texto }}</p>
            </div>
        @else
            <div class="mt-6">@include('panel.dashboard.sin_datos', ['alto' => 'min-h-60', 'detalle' => $texto])</div>
        @endif
    </div>

    @if($porcentaje !== null)
        <div class="flex items-center justify-center gap-5 px-6 py-3.5 sm:gap-8 sm:py-5">
            @foreach($detalle as $i => $d)
                @if($i > 0)
                    <div class="h-7 w-px bg-gray-200 dark:bg-gray-800"></div>
                @endif
                <div>
                    <p class="mb-1 text-center text-xs text-gray-500 sm:text-sm dark:text-gray-400">{{ $d['etiqueta'] }}</p>
                    <p class="flex items-center justify-center gap-1 text-base font-semibold text-gray-800 sm:text-lg dark:text-white/90">{{ number_format($d['valor']) }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
