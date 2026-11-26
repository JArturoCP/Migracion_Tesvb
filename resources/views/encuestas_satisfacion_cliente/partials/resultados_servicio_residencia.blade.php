@use('App\View\EncuestaServicioSocialResidencia')

@php
    $categorias = ['excelente', 'bueno', 'regular', 'malo', 'muy_malo'];
    $resultados = [[
        'titulo' => 'Resumen general',
        'conteos' => [$excelente, $bueno, $regular, $malo, $muy_malo],
        'porcentajes' => [$por_excelente, $por_bueno, $por_regular, $por_malo, $por_muy_malo],
    ]];
    foreach (EncuestaServicioSocialResidencia::PREGUNTAS as $numero => $pregunta) {
        $conteos = [];
        $porcentajes = [];
        foreach ($categorias as $categoria) {
            $claveConteo = $categoria === 'muy_malo' ? 'muymalo' : $categoria;
            $conteos[] = ${'preg'.$numero.'_'.$claveConteo};
            $porcentajes[] = ${'por_'.$categoria.$numero};
        }
        $resultados[] = ['titulo' => $numero.'. '.$pregunta, 'conteos' => $conteos, 'porcentajes' => $porcentajes];
    }
@endphp

<x-panel.encabezado :titulo="$titulo" :migas="$migas" />

<div class="tw:space-y-5">
    @foreach ($resultados as $resultado)
        <x-panel.tarjeta :titulo="$resultado['titulo']" :subtitulo="$loop->first ? $nombrePeriodo : null">
            @if ($loop->first)
                <p class="tw:mb-4 tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">
                    Excelente y bueno <x-panel.badge>{{ $excelente_bueno }} %</x-panel.badge>
                </p>
            @endif
            <div class="tw:grid tw:min-w-0 tw:gap-4 tw:lg:grid-cols-2 tw:lg:items-center">
                <x-panel.tabla compacta>
                    <thead><tr><th scope="col">Calificación</th><th scope="col">Porcentaje</th><th scope="col">Resultados</th></tr></thead>
                    <tbody>
                        @foreach (array_values(EncuestaServicioSocialResidencia::OPCIONES) as $indice => $etiqueta)
                            <tr>
                                <th scope="row">{{ $etiqueta }}</th>
                                <td>{{ $resultado['porcentajes'][$indice] }} %</td>
                                <td>{{ $resultado['conteos'][$indice] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-panel.tabla>
                <div class="tw:min-w-0 tw:rounded-lg tw:bg-white"
                    data-grafica-servicio-residencia="{{ json_encode($resultado['porcentajes']) }}"
                    data-titulo-encuesta="{{ $resultado['titulo'] }}"></div>
            </div>
        </x-panel.tarjeta>
    @endforeach
</div>

@push('scripts')
<script>
    $(function () {
        const categorias = @json(array_values(EncuestaServicioSocialResidencia::OPCIONES));

        document.querySelectorAll('[data-grafica-servicio-residencia]').forEach(contenedor => {
            const porcentajes = JSON.parse(contenedor.dataset.graficaServicioResidencia);
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
                    data: porcentajes.map((porcentaje, indice) => ({name: categorias[indice], y: Number(porcentaje)})),
                }],
            });
        });
    });
</script>
@endpush
