{{--
    Complementarias › Créditos del alumno (/creditos, CreditosSemestresController@index). Diseño del panel;
    mismos datos ($historial_creditos) y columnas. Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'HistorialCreditos')
@include('partials.panel.recursos_app')
@section('content')

<main>
  <x-panel.encabezado titulo="Créditos Liberados" :migas="['Complementarias' => url('/consulta_actividades/')]" />
  {{-- [original] <form> sin atributos ni campos alrededor de la tabla --}}
  <form>
    <x-panel.tarjeta titulo="Créditos Liberados" sin-relleno>
      <x-panel.tabla class="tabla-grande2 responsive">
        <thead>
          <tr>
            <th>Actividad</th>
            <th>Créditos</th>
            <th>Docente</th>
            <th>Semestre</th>
            <th>Promedio</th>
          </tr>
        </thead>
        <tbody>
          @foreach($historial_creditos as $creditos)
          <tr>
            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$creditos->ac}}</td>
            <td>{{$creditos->cre}}</td>
            <td>{{$creditos->titulo}} {{$creditos->docente}}</td>
            <td>{{$creditos->semestre}}</td>
            <td><x-panel.badge tono="exito">{{$creditos->promedio}}</x-panel.badge></td>
          </tr>
          @endforeach
        </tbody>
      </x-panel.tabla>
    </x-panel.tarjeta>
  </form>
</main>

@endsection
