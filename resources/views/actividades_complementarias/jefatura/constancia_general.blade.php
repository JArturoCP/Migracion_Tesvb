@extends('layouts.panel')
@section('title', 'ConstanciaGeneral')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="CONSTANCIA GENERAL" />

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-4xl" sin-relleno>
        <x-panel.tabla id="paginacion">
          <thead>
            <tr>
              <th>No. Cuenta</th>
              <th>Alumno</th>
              <th>Créditos</th>
              <th>Promedio</th>
              <th class="tw:text-center">Imprimir</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cinco_creditos as $cinco_creditos)
              @if($cinco_creditos->creditos>=5)
                <tr>
                  <td>{{$cinco_creditos->cuenta}}</td>
                  <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$cinco_creditos->nombre}} {{$cinco_creditos->apaterno}} {{$cinco_creditos->amaterno}}</td>
                  <td>{{$cinco_creditos->creditos}}</td>
                  <td>{{$cinco_creditos->promedio}}</td>
                  <td class="tw:text-center">
                    <a href="{{url("/ConstanciaGeneral/".$cinco_creditos->id_alumno."/edit")}}" target="_blank" class="tw:inline-flex tw:size-8 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:hover:bg-brand-50" title="Imprimir">
                        <span class="fa fa-print em" aria-hidden="true"></span>
                    </a>
                  </td>
                </tr>
              @endif
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
