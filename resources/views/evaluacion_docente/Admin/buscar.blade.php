@extends('layouts.panel')
@section('title', 'Inicio')
@include('evaluacion_docente.partials.recursos_panel', ['datatables' => true])
@section('content')

<script type="text/javascript">


  $(document).ready(function() {
      $('#ejemplo').DataTable();
} );
</script>

    <x-panel.encabezado titulo="PROFESORES EVALUACIÓN DOCENTE" />

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-4xl" titulo="Docentes" subtitulo="Consulta el reporte de evaluación docente de cada profesor.">
        <x-panel.tabla id="ejemplo">
            <thead>
                <tr>
                    <th>DOCENTES</th>
                    <th class="tw:text-center">CONSULTAR</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profesores)
                <tr>
                    <td class="tw:font-medium tw:text-gray-800">{{$profesores->nombre}}</td>
                    <td class="tw:text-center"><a href="/reportes2/{{$profesores->id_personal}}/{{1}}/{{0}}" target="_blank" class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:ring-1 tw:ring-brand-200 tw:hover:bg-brand-50" title="Consultar"><span class="fa fa-list-alt em6" aria-hidden="true" ></span></a></td>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>
@endsection
