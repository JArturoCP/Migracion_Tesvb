@extends('layouts.panel')
@section('title', 'Estadisticas de Indice de reprobación')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/servicios_escolares/estadisticas/indice_reprobacion/".$id_carrera)}}">Semestres</a>
                <span class="fa fa-chevron-right"></span>
                <span>indice de reprobacion del semestre</span>

            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Índice de reprobación '.$carreras->nombre" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
@foreach($ind_rep as $carrera)
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
            <div class="tw:p-5 tw:sm:p-6">
                <div class="tw:w-full tw:lg:w-full tw:px-2">
                    @foreach($carrera['semestres'] as $semestre)
                        @if($semestre['materias']!=null)
                            <h4><label for="" class="label tw:w-full tw:lg:w-full tw:text-center tw:bg-green-50 tw:text-green-700 tw:px-2">SEMESTRE: {{$semestre['nom_semestre']}}</label></h4>
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada border-table tw-tabla tw-tabla-rayas tw:my-0">
                                <thead>
                                <tr class="tw:text-center">
                                    <th class="tw:text-center">Materia</th>
                                    <th class="tw:text-center">Docente</th>
                                    <th class="tw:text-center">Grupo</th>
                                    <th class="tw:text-center">Matricula</th>
                                    <th class="tw:text-center">Promedio</th>
                                    <th class="tw:text-center">Reprobados</th>
                                    <th class="tw:text-center">Índice de reprobación</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($semestre['materias'] as $materia)
                                    <tr class="">
                                        <td>{{ $materia['mat'] }}</td>
                                        <td>{{ $materia['docente'] }}</td>
                                        <td>{{ $materia['grupo'] }}</td>
                                        <td>{{ $materia['matricula'] }}</td>
                                        <td>{{ $materia['promedio'] }}</td>
                                        <td>{{ $materia['reprobados'] }}</td>
                                        <td>{{ $materia['ind_rep'] }}%</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
                        @else

                        @endif
                    @endforeach
            </div>
        </div>
    </div>
@endforeach
        </div>
    </div>
</div>
@endsection