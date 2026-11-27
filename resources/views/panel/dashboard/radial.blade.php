{{--
    Medidor radial (TailAdmin: monthly-target).
    $titulo, $subtitulo, $porcentaje (float|null), $texto (frase bajo el medidor),
    $detalle: lista de ['etiqueta', 'valor'] para la franja inferior (opcional 'formato' => 'moneda').
--}}
<div class="tw:flex tw:h-full tw:flex-col tw:justify-between tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-gray-100 tw:dark:border-gray-800 tw:dark:bg-white/3" data-panel-bloque="radial">
    <div class="tw:shadow-default tw:flex tw:flex-1 tw:flex-col tw:justify-between tw:rounded-2xl tw:bg-white tw:px-5 tw:pt-5 tw:pb-5 tw:sm:px-6 tw:sm:pt-6 tw:sm:pb-11 tw:dark:bg-gray-900">
        <div class="tw:flex tw:justify-between">
            <div>
                <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{ $titulo }}</h3>
                <p class="tw:mt-1 tw:text-sm tw:font-normal tw:text-gray-500 tw:dark:text-gray-400">{{ $subtitulo }}</p>
            </div>
        </div>

        @if($porcentaje !== null)
            <div>
                <div class="tw:relative">
                    <div class="tw:max-h-45 tw:overflow-hidden">
                        <div
                            class="tw:h-full tw:[&_.apexcharts-datalabels-group]:translate-y-0! tw:[&_.apexcharts-datalabels-group_.apexcharts-text]:fill-gray-800! tw:[&_.apexcharts-datalabels-group_.apexcharts-text]:font-semibold! tw:dark:[&_.apexcharts-datalabels-group_.apexcharts-text]:fill-white/90!"
                            data-grafica="radial"
                            data-datos="{{ json_encode(['valor' => $porcentaje, 'etiqueta' => $titulo]) }}"
                        ></div>
                    </div>
                </div>
                <p class="tw:mx-auto tw:mt-4.5 tw:w-full tw:max-w-95 tw:text-center tw:text-sm tw:text-gray-500 tw:sm:text-base tw:dark:text-gray-400">{{ $texto }}</p>
            </div>
        @else
            <div class="tw:mt-6">@include('panel.dashboard.sin_datos', ['alto' => 'tw:min-h-60', 'detalle' => $texto])</div>
        @endif
    </div>

    @if($porcentaje !== null)
        <div class="tw:flex tw:items-center tw:justify-center tw:gap-5 tw:px-6 tw:py-3.5 tw:sm:gap-8 tw:sm:py-5">
            @foreach($detalle as $i => $d)
                @if($i > 0)
                    <div class="tw:h-7 tw:w-px tw:bg-gray-200 tw:dark:bg-gray-800"></div>
                @endif
                <div>
                    <p class="tw:mb-1 tw:text-center tw:text-xs tw:text-gray-500 tw:sm:text-sm tw:dark:text-gray-400">{{ $d['etiqueta'] }}</p>
                    <p class="tw:flex tw:items-center tw:justify-center tw:gap-1 tw:text-base tw:font-semibold tw:text-gray-800 tw:sm:text-lg tw:dark:text-white/90">{{ ($d['formato'] ?? null) === 'moneda' ? '$' . number_format($d['valor'], 2) : number_format($d['valor']) }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
