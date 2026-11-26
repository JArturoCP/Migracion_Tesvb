@extends('layouts.panel')
@section('title', 'Gestión Académica Alumnos')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Gestión académica de alumnos duales (alumnos)" :migas="['Educación dual' => null]" />

    <x-panel.alerta tipo="exito" class="tw:mb-4">DOCENTE: <br>{{$nombre_docente}}</x-panel.alerta>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla-centrada tw-tabla tw-tabla-bordes">
                <thead>
                <tr class="tw:bg-sky-50">
                    <th class="tw:text-center"><strong>NP</strong></th>
                    <th class="tw:text-center"><strong>Nombre del Alumno</strong></th>
                    <th class="tw:text-center"><strong>Ver Calificaciones del Alumno</strong></th>
                </tr>
                </thead>
                <tbody>
                @foreach($alumnos as $alumno)
                    <tr>
                        <td class="tw:text-center">{{ $loop->iteration}}</td>
                        <td class="tw:text-center">{{$alumno->nombre." ".$alumno->apaterno." ".$alumno->amaterno}}</td>
                        <td>
                            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="{{url('/duales/gestion_academica/mostrar_calificaciones_duales/'.$alumno->id )}}"><span class="fa fa-pencil-square-o"></span></a>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
</div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready( function()
        {
            $('#paginar_table').DataTable();
        });
    </script>

</div>
@endsection