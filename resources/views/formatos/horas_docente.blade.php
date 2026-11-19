@extends('layouts.panel')
@section('title', 'Horas Docentes')
@include('partials.panel.recursos_app')
@section('content')


    <main class="tw-pantalla">
        <x-panel.encabezado titulo="Horas docente por materia de las carreras">
            <x-slot:extra>
                <x-panel.badge>{{ $nombre_periodo1->periodo }}, {{ $nombre_periodo2->periodo }}</x-panel.badge>
            </x-slot:extra>
        </x-panel.encabezado>

        <x-panel.tarjeta sin-relleno class="c tabla-grande">
            <x-slot:acciones>
                <x-panel.boton tamano="sm" href="/formatos/excel_horas_docentes/" target="_blank"><span class="fa fa-external-link"  aria-hidden="true"></span>Exportar Excel</x-panel.boton>
            </x-slot:acciones>
            <div class="tw:max-w-full tw:overflow-x-auto">
                    <table class="tw-tabla tw-tabla-bordes tw-tabla-compacta tabla-grande3">
                        <tr>
                            <th>PE</th>
                            <th>Categoria</th>
                            <th>Docente</th>
                            <th>Periodo</th>
                            <th>Semestre</th>
                            <th>Asignatura</th>
                            <th>Grupos</th>
                            <th>Horas X Asignatura</th>
                            <th>Total</th>
                        </tr>


                        @foreach($carreras_periodo as $carreras)
                            @foreach($carreras["docentes"] as $docente)
                                @foreach($docente["materias"] as $materia)
                                <tr>
                                    <td>{{ $carreras["nombre_carrera"] }}</td>
                                    <td>{{ $docente["cargo"] }}</td>
                                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $docente["nombre"] }}</td>
                                    <td>{{ $docente["nombre_periodo"] }}</td>
                                    <td>{{ $materia["id_semestre"] }}</td>
                                    <td>{{ $materia["nombre_materia"] }}</td>
                                    <td>{{ $materia["no_grupos"] }}</td>
                                    <?php $suma_horas= $materia["hrs_practica"]+$materia["hrs_teoria"];?>
                                    <td>{{ $suma_horas }}</td>
                                    <td>{{ $materia["t_lic"] }}</td>

                                </tr>
                                @endforeach
                            @endforeach
                        @endforeach

                    </table>
            </div>
        </x-panel.tarjeta>


        <!--<div class="col-md-3 col-md-offset-5 ml">
               <button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
        </div>-->

    </main>


@endsection
