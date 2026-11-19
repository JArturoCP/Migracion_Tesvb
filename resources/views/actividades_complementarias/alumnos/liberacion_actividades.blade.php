{{--
    Complementarias › Liberación del alumno (/liberacion_alumno, LiberacionAlumnosActividadesController@index).
    Diseño del panel; mismos datos ($libera_activi) y columnas. Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'LiberacionActividades')
@include('partials.panel.recursos_app')
@section('content')

<main>
  <x-panel.encabezado titulo="Liberación de Actividades" :migas="['Complementarias' => url('/consulta_actividades/')]" />
  {{-- [original] <form> sin atributos ni campos alrededor de la tabla --}}
  <form>
    <x-panel.tarjeta titulo="Liberación de Actividades" sin-relleno>
      <x-panel.tabla class="tabla-grande2">
        <thead>
          <tr>
            <th>Actividad</th>
            <th>Categoría</th>
            <th>Horas</th>
            <th>Créditos</th>
            <th>Calificación Obtenida</th>
          </tr>
        </thead>
        <tbody>
          @foreach($libera_activi as $libera_activi)
          <tr>
            <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$libera_activi->descripcion}}</td>
            <td>{{$libera_activi->descripcion_cat}}</td>
            <td>{{$libera_activi->horas}}</td>
            <td>{{$libera_activi->creditos}}</td>
            <td><x-panel.badge tono="exito">{{$libera_activi->promedio}}</x-panel.badge></td>
          </tr>
          @endforeach
        </tbody>
      </x-panel.tabla>
    </x-panel.tarjeta>
  </form>
</main>

@endsection
