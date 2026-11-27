@extends('layouts.panel')
@section('title', 'Resultados de encuestas de Titulación')
@include('partials.panel.recursos_app', ['graficas' => true])

@section('content')
    @php
        $base = '/encuestas_satisfaccion/';
        $historial = session('historial_enc_t') == 1;
        $migas = $historial
            ? ['Historial de encuestas' => url($base.'historial_encuesta_estudiante_titulacion'), 'Periodos de las encuestas' => url($base.'menu_historial_titulacion_year/'.$year)]
            : ['Periodos de las encuestas' => url($base.'enviar_encuesta_estudiante_titulacion')];

        $rubros = [
            ['nombre' => 'Servicio', 'conteos' => [7 => $preg7, 9 => $preg9, 11 => $preg11, 12 => $preg12, 13 => $preg13, 14 => $preg14, 16 => $preg16, 18 => $preg18],
                'total' => $total_serv_rubro, 'puntos' => $total_serv_satisfacion, 'porcentaje' => $porcentaje_serv_sat],
            ['nombre' => 'Información', 'conteos' => [4 => $preg4, 5 => $preg5, 6 => $preg6, 8 => $preg8, 10 => $preg10, 17 => $preg17],
                'total' => $total_inf_rubro, 'puntos' => $total_inf_satisfacion, 'porcentaje' => $porcentaje_inf_sat],
            ['nombre' => 'Tiempo', 'conteos' => [15 => $preg15],
                'total' => $total_tiempo_rubro, 'puntos' => $total_tiempo_satisfacion, 'porcentaje' => $porcentaje_tiempo_sat],
        ];
        $resumen = array_column($rubros, 'porcentaje', 'nombre') + ['Satisfacción total' => $satisfacion_total];
    @endphp

    <x-panel.encabezado titulo="Resultados de encuestas de Titulación" :migas="$migas" />

    <div class="tw:space-y-5">
        <x-panel.tarjeta titulo="Resumen de satisfacción" :subtitulo="'Año '.$year">
            <div class="tw:grid tw:min-w-0 tw:gap-4 tw:lg:grid-cols-2 tw:lg:items-center">
                <dl class="tw:grid tw:grid-cols-2 tw:gap-3">
                    @foreach ($resumen as $nombre => $porcentaje)
                        <div @class([
                            'tw:min-w-0 tw:rounded-lg tw:px-3 tw:py-2',
                            'tw:bg-gray-50 tw:text-gray-800 tw:dark:bg-white/5 tw:dark:text-gray-200' => ! $loop->last,
                            'tw:bg-brand-50 tw:text-brand-700 tw:dark:bg-brand-500/15 tw:dark:text-brand-300' => $loop->last,
                        ])>
                            <dt class="tw:text-sm">{{ $nombre }}</dt>
                            <dd class="tw:font-semibold">{{ number_format($porcentaje, 2) }} %</dd>
                        </div>
                    @endforeach
                </dl>
                <div id="grafica-titulacion" class="tw:min-w-0 tw:rounded-lg tw:bg-white"
                    data-resultados="{{ json_encode($resumen) }}"></div>
            </div>
        </x-panel.tarjeta>

        <x-panel.tarjeta titulo="Detalle por rubro">
            <x-panel.tabla compacta desplazable="Resultados detallados por rubro">
                <thead>
                    <tr>
                        <th scope="col">Rubro</th>
                        @foreach (range(4, 18) as $numero)
                            <th scope="col" aria-label="Pregunta {{ $numero }}">{{ $numero }}</th>
                        @endforeach
                        <th scope="col">Total de respuestas</th>
                        <th scope="col">Puntos por rubro</th>
                        <th scope="col">Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rubros as $rubro)
                        <tr>
                            <th scope="row">{{ $rubro['nombre'] }}</th>
                            @foreach (range(4, 18) as $numero)
                                <td>{{ $rubro['conteos'][$numero] ?? 0 }}</td>
                            @endforeach
                            <td>{{ $rubro['total'] }}</td>
                            <td>{{ $rubro['puntos'] }}</td>
                            <td>{{ number_format($rubro['porcentaje'], 2) }} %</td>
                        </tr>
                    @endforeach
                </tbody>
            </x-panel.tabla>
        </x-panel.tarjeta>
    </div>
@endsection

@push('scripts')
    <script>
        const graficaTitulacion = document.getElementById('grafica-titulacion');
        const resultadosTitulacion = JSON.parse(graficaTitulacion.dataset.resultados);

        Highcharts.chart(graficaTitulacion, {
            chart: {type: 'column', height: 230},
            title: {text: null},
            xAxis: {type: 'category'},
            yAxis: {min: 0, title: {text: 'Porcentaje'}},
            legend: {enabled: false},
            plotOptions: {series: {dataLabels: {enabled: true, format: '{point.y:.2f}%'}}},
            tooltip: {pointFormat: '<b>{point.y:.2f}%</b>'},
            exporting: {chartOptions: {title: {text: 'Resultados de encuestas de Titulación'}}},
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: Object.entries(resultadosTitulacion).map(([name, y]) => ({name, y})),
            }],
        });
    </script>
@endpush
