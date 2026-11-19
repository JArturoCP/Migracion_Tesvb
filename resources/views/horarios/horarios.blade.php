@extends('layouts.panel')
@section('title', 'Horarios Docentes')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla">
    <x-panel.encabezado titulo="HORARIOS DOCENTES" />

    <x-panel.tarjeta class="tw:mx-auto tw:max-w-3xl" sin-relleno>
        <x-panel.tabla id="paginar_table">
            <thead>
              <tr>
                  <th >Clave</th>
                  <th >Nombre</th>
                  <th class="tw:text-center">Horario</th>
              </tr>
            </thead>
            <tbody>
        @foreach($docentes as $docente)
              <tr>
                <td>{{ $docente->clave }}</td>
                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $docente->nombre }}</td>
                <td class="tw:text-center">
                  <a href="/horarios_docentes/{{ $docente->id_personal }}" class="tw:inline-flex tw:size-9 tw:items-center tw:justify-center tw:rounded-lg tw:text-brand-500 tw:ring-1 tw:ring-brand-200 tw:hover:bg-brand-50" title="Ver horario"><span class="fa fa-list-alt em6" aria-hidden="true"></span></a>
                </td>
              </tr>
        @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>

@if(isset($ver))
      @section('horario_docente')
      @include('horarios.partialsh.partial_ver_horarios')
      @show
@endif

</main>
<script>
  $(document).ready(function() {

  $('#paginar_table').DataTable();

});
</script>

@endsection
