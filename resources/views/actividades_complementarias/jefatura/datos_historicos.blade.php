@extends('layouts.panel')
@section('title', 'DatosHistoricos')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="DATOS HISTÓRICOS" />

    <x-panel.tarjeta sin-relleno>
        <x-panel.tabla id="paginacion">
          <thead>
            <tr>
              <th>No. Cuenta</th>
              <th>Alumno</th>
              <th>Semestre</th>
              <th>Grupo</th>
              <th>Actividad</th>
              <th>Docente</th>
              <th>Créditos</th>
              <th>Promedio</th>
              <th>Periodo</th>
            </tr>
          </thead>
          <tbody>
            @foreach($historico as $historico)
            <tr>
              <td>{{$historico->cuenta}}</td>
              <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$historico->nombre}} {{$historico->apaterno}} {{$historico->amaterno}}</td>
              <td>{{$historico->semestre}}</td>
              <td>{{$historico->grupo}}</td>
              <td>{{$historico->descripcion}}</td>
              <td>{{$historico->titulo}} {{$historico->docente}}</td>
              <td>{{$historico->creditos}}</td>
              <td>{{$historico->promedio}}</td>
              <td>{{$historico->periodo}}</td>
            </tr>
            @endforeach  
          </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>
</main>

<script>
$(document).ready(function(){
    $('#paginacion').DataTable();
});
</script>
@endsection
