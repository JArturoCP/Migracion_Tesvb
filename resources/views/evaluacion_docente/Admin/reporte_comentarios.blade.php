@extends('layouts.panel')
@section('title', 'Evaluacion Docente')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

    <main class="tw:flex tw:flex-wrap tw:gap-y-4">


        <x-panel.encabezado titulo="Comentarios evaluación docente" :migas="['Evaluación docente' => null]" />


        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tab_comment" class="tw-tabla tw-tabla-bordes">
                <thead>
                <tr>
                    <th class="tw:text-center" >DOCENTES EVALUADOS</th>
                    <th class="tw:text-center" >CONSULTAR COMENTARIO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($docentes as $docente)
                    <tr>
                        <th class="tw:text-center" >{{$docente->nombre}}</th>
                        <th class="tw:text-center"><a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" href="/reporte_comentario_docente/{{$docente->id_personal}}" target="_blank"><span class="fa fa-list-alt em6" aria-hidden="true" ></span></a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
</div>
        </div>

    </main>

    <script>
        $(document).ready(function() {
            $('#tab_comment').DataTable();
        });
    </script>
</div>
@endsection
