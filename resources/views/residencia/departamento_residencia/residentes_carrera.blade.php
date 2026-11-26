@extends('layouts.panel')
@section('title', 'Anteproyecto Institucional')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Proyectos de Residencia del periodo '.$periodo->periodo" :migas="['Residencia profesional' => null]" />

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                        <thead>
                        <tr>
                            <th>No. cuenta</th>
                            <th>Nombre del alumno</th>
                            <th>Nombre del proyecto</th>
                            <th>Asesor</th>
                            <th>Ver calificaciones </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($anteproyectos as $anteproyecto)

                            <tr>
                                <td>{{$anteproyecto->cuenta}}</td>
                                <td>{{$anteproyecto->nombre}} {{$anteproyecto->apaterno}}  {{$anteproyecto->amaterno}}</td>
                                <td>{{$anteproyecto->nom_proyecto}}</td>
                                <td>{{$anteproyecto->profesor}}</td>
                                <td>   <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.location='{{ url('/residentes/alumno/'.$anteproyecto->id_anteproyecto ) }}'"><i class="fa fa-pencil "></i></button>
                                </td>

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
@endsection