@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
                            <x-panel.encabezado :titulo="'Promedios de los alumnos por periodo '.$nombre_carrera.' ('.$id_semestre.' semestre) periodo:'.$nperiodo" :migas="['Servicios escolares' => null]" />
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <a href="/servicios_escolares/promedio_alumnos_semestres_excel/{{$id_carrera}}/{{$id_semestre}}/" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Exportar Promedios <span class="oi oi-document tw:p-1"></span></a>

                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-rayas tw:lg:w-full tw:px-2">
                                    <thead class="">
                                    <tr class="tw:text-center">
                                        <th  >NP.</th>
                                        <th  >No. CTA</th>
                                        <th >ALUMNO</th>
                                        <th >PROMEDIO</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($array_datos_alumnos as $alumno)
                                        <tr class="">
                                            <td>{{$alumno['numero1']}}</td>
                                            <td>{{$alumno['cuenta']}}</td>
                                            <td>{{$alumno['apaterno']}} {{$alumno['amaterno']}} {{$alumno['nombre']}}</td>
                                            <td >{{$alumno['promedio_final']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
</div>

                            </div>
                            </div>

</div>
@endsection