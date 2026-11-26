@extends('layouts.panel')
@section('title', 'Evaluacion Docente')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:flex tw:flex-wrap tw:gap-y-4">

        <div class="tw:w-full tw:px-2">
            <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.history.back();">
                <span class="fa fa-arrow-left"></span> Regresar
            </button>
        </div>


    @foreach($grupos_materias as $grupo_materia)
            <x-panel.encabezado :titulo="'Evaluación docente de: '.$grupo_materia->profesor.' semestre: '.$grupo_materia->semestre" :migas="['Evaluación docente' => null]" />
            <div class="tw:w-full tw:px-2">
                <x-panel.alerta tipo="exito" class="tw:mb-4">GRUPO: {{$grupo_materia->id_semestre}}0{{$grupo_materia->id_grupo}}
                        MATERIA: {{$grupo_materia->materia}}</x-panel.alerta>
            </div>
        @endforeach

        <div class="tw:w-full">
            <div>
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" id="tab_comment">
                    <thead>
                    <tr>
                        <th class="tw:text-center" >#</th>
                        <th class="tw:text-center" >Comentario por alumno</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($eva_comentarios as $eva_comentario)
                        <tr>
                            <th class="tw:text-center" >{{ $loop->iteration }}</th>
                            <th class="tw:text-center" >{{ $eva_comentario->comentario}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>

    </main>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tab_comment').DataTable();
        });
    </script>

</div>
@endsection