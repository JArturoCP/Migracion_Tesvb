@use('App\View\EncuestaEscolar')

@php
    $categorias = ['Excelente', 'Buena', 'Regular', 'Mala', 'Muy mala'];
    $resultados = [[
        'titulo' => 'Resumen general',
        'conteos' => [$total_excelente, $total_buena, $total_regular, $total_mala, 0],
        'total' => $total_total,
    ]];

    foreach (EncuestaEscolar::PREGUNTAS as $numero => $pregunta) {
        if ($numero === 10) {
            continue;
        }

        $resultados[] = [
            'titulo' => $numero.'. '.$pregunta,
            'conteos' => [${'excelente'.$numero}, ${'buena'.$numero}, ${'regular'.$numero}, ${'mala'.$numero}, 0],
            'total' => ${'total_enc_preg'.$numero},
        ];
    }
@endphp

<x-panel.encabezado :titulo="$titulo" :migas="['Periodos de las encuestas' => $urlPeriodos]" />

<div class="tw:space-y-5">
    @foreach ($resultados as $resultado)
        <x-panel.tarjeta :titulo="$resultado['titulo']" :subtitulo="$loop->first ? $periodo_nom?->periodo : null">
            <div class="tw:grid tw:min-w-0 tw:gap-4 tw:lg:grid-cols-2 tw:lg:items-center">
                <dl class="tw:grid tw:grid-cols-2 tw:gap-3 tw:sm:grid-cols-3">
                    @foreach ($categorias as $indice => $categoria)
                        <div class="tw:min-w-0 tw:rounded-lg tw:bg-gray-50 tw:px-3 tw:py-2 tw:dark:bg-white/5">
                            <dt class="tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ $categoria }}</dt>
                            <dd class="tw:font-semibold tw:text-gray-900 tw:dark:text-white">{{ $resultado['conteos'][$indice] }}</dd>
                        </div>
                    @endforeach
                    <div class="tw:min-w-0 tw:rounded-lg tw:bg-brand-50 tw:px-3 tw:py-2 tw:dark:bg-brand-500/15">
                        <dt class="tw:text-sm tw:text-brand-700 tw:dark:text-brand-300">{{ $loop->first ? 'Total de respuestas' : 'Número de encuestas' }}</dt>
                        <dd class="tw:font-semibold tw:text-brand-700 tw:dark:text-brand-300">{{ $resultado['total'] }}</dd>
                    </div>
                </dl>
                <div class="tw:min-w-0 tw:rounded-lg tw:bg-white" data-grafica-encuesta="{{ json_encode($resultado['conteos']) }}"
                    data-total-encuesta="{{ $resultado['total'] }}" data-titulo-encuesta="{{ $resultado['titulo'] }}"></div>
            </div>
        </x-panel.tarjeta>
    @endforeach
</div>

@push('scripts')
    <script>
        $(function () {
            const categorias = @json($categorias);

            document.querySelectorAll('[data-grafica-encuesta]').forEach(function (contenedor) {
                const total = Number(contenedor.dataset.totalEncuesta);
                const conteos = JSON.parse(contenedor.dataset.graficaEncuesta);

                Highcharts.chart(contenedor, {
                    chart: {type: 'column', height: 230},
                    title: {text: null},
                    xAxis: {type: 'category'},
                    yAxis: {min: 0, title: {text: 'Porcentaje'}},
                    legend: {enabled: false},
                    plotOptions: {series: {dataLabels: {enabled: true, format: '{point.y:.2f}%'}}},
                    tooltip: {pointFormat: '<b>{point.y:.2f}%</b>'},
                    exporting: {chartOptions: {title: {text: contenedor.dataset.tituloEncuesta}}},
                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: conteos.map((conteo, indice) => ({
                            name: categorias[indice],
                            y: total > 0 ? conteo / total * 100 : 0,
                        })),
                    }],
                });
            });
        });
    </script>
@endpush
