@extends('layouts.panel')
@section('title', 'Calificaciones Alumnos Duales')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Calificaciones alumnos duales" :migas="['Educación dual' => null]" />
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-full tw:px-2">
                <div class="tw:w-full tw:px-2 tw:text-center tw:p-6">
                    <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                            onclick="window.open('{{url('/duales/generar_listas_duales/')}}')">
                        Generar Lista de Asistencia <span class="fa fa-list"></span>
                    </button>
                </div>
                <div class="tw:w-full">
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:lg:w-full tw:px-2">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                

                                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla-centrada tw-tabla tw-tabla-bordes">
                                    <thead>
                                    <tr class="tw:bg-sky-50">
                                        <th class="tw:text-center"><strong>No. Cuenta</strong></th>
                                        <th class="tw:text-center"><strong>Nombre del Alumno Dual</strong></th>
                                        <th class="tw:text-center">Calificar Alumno</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datos_registros as $dato_registro)
                                        <tr>
                                            <td>{{$dato_registro->cuenta}}</td>
                                            <td>{{$dato_registro->nombre." ".$dato_registro->apaterno." ".$dato_registro->amaterno}}</td>
                                            <td>
                                                <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="{{url('/duales/calificar_estudiante/'.$dato_registro->id )}}"><span class="fa fa-pencil-square-o"></span></a>
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
        </div>
    </main>

    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#paginar_table').DataTable();
        });
    </script>

</div>
@endsection