@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Anteproyecto para revisar" :migas="['Residencia profesional' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:lg:w-full tw:px-2">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th>No. Cuenta</th>
                                <th>Nombre del alumno</th>
                                <th>Nombre del anteproyecto</th>
                                <th>Revisar</th>
                                <th>No. de revisión</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($anteproyectos as $anteproyecto)

                                <tr>
                                    <td>{{ $anteproyecto->cuenta }} </td>

                                    <td>{{ $anteproyecto->nombre }} {{ $anteproyecto->apaterno }} {{ $anteproyecto->amaterno }}</td>
                                    <td>{{ $anteproyecto->nom_proyecto }}</td>
                                    <td><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/residencia/revisar_anteproyecto/'.$anteproyecto->id_anteproyecto.'/'.$id_profesor ) }}'" title="Revisar anteproyecto"><i class="fa fa-pencil tw:text-sky-600"></i></button>
                                    </td>
                                    @if($anteproyecto->numero_evaluacion ==1)
                                        <td>PRIMERA REVISIÓN</td>
                                        @elseif($anteproyecto->numero_evaluacion ==2)
                                        <td>SEGUNDA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==3)
                                        <td>TERCERA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==4)
                                        <td>CUARTA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==5)
                                        <td>QUINTA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==6)
                                        <td>SEXTA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==7)
                                        <td>SEPTIMA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==8)
                                        <td>OCTAVA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==9)
                                        <td>NOVENA REVISIÓN</td>
                                    @elseif($anteproyecto->numero_evaluacion ==10)
                                        <td>DECIMA REVISIÓN</td>
                                        @else
                                        <td></td>
                                        @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection