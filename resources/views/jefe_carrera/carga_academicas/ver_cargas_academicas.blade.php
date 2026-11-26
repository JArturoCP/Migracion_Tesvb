@extends('layouts.panel')
@section('title', 'Validación de cargas')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

        <x-panel.encabezado titulo="Validación de cargas académicas por parte del jefe de división" :migas="['Jefatura de división' => null]" />
      <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="tw:w-full tw:px-2">
              <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes" Style="background: white;" id="autorizar">
                  <thead>
                  <tr>
                      <th>No. CUENTA</th>
                      <th>NOMBRE DE ALUMNO(A)</th>
                      <th>SEMESTRE</th>
                      <th>GRUPO</th>
                      <th>CARRERA</th>
                      <th>CARGA ACADEMICA</th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($estudiantes_ins as $estudiante)
                      <tr>
                          <th>{{$estudiante['cuenta'] }}</th>
                          <td>{{$estudiante['nombre'] }} </td>
                          <td>{{$estudiante['semestre'] }} </td>
                          <td>{{$estudiante['grupo'] }} </td>
                          <td>{{ $estudiante['carrera'] }}</td>
                          <td >
                              <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" onclick="window.open('{{ url('/revicion_carga_estudiante/'.$estudiante['id_alumno'].'/'.$estudiante['id_semestre'] ) }}')"><span class="fa fa-list-alt em5" aria-hidden="true"></span></a>
                          </td>

                      </tr>
                  @endforeach



                  </tbody>
              </table>
</div>
          </div>
      </div>
    <script>
        $(document).ready(function() {
            $('#autorizar').DataTable();
        });
    </script>
</div>
@endsection