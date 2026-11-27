@extends('layouts.panel')
@section('title', 'Resultados Examen de Conocimientos Generales')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Resultados del examen de conocimientos generales" :migas="['Examen general de conocimientos' => null]" />
    <p class="tw:-mt-4 tw:mb-6 tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Módulo de consulta de personal docente</p>

<div class="tw:w-full">

  {{-- CARD TABLE --}}
  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">

      <div style="background:#fff; border:1px solid #ddd; box-shadow:0 2px 4px rgba(0,0,0,0.1);">

        <div style="padding:10px 15px; border-bottom:1px solid #eee; background:#f8f8f8; overflow:hidden;">

          <strong style="float:left; margin-top:6px;">
            <span class="fa fa-list"></span>
            Listado de docentes
          </strong>

          <a href="{{ route('admin.examen_general.excel') }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            <span class="fa fa-download"></span>
            Exportar Excel
          </a>

        </div>

        <div>

          @if(count($docentes) > 0)

          <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla" id="tab_pag1">

            <thead>
              <tr style="background:#ecf0f1;">
                <th class="tw:text-center" style="width:50px">#</th>
                <th>Nombre completo</th>
                <th class="tw:text-center tw:w-30">Estado</th>
                <th class="tw:text-center tw:w-30">Escolaridad</th>
                <th class="tw:text-center tw:w-30">Resultados Obtenidos</th>
              </tr>
            </thead>

            <tbody>

              @foreach($docentes as $index => $docente)

              <tr>
                <td class="tw:text-center tw:align-middle">
                  {{ $index + 1 }}
                </td>

                <td class="tw:align-middle">
                  <span class="fa fa-user" style="color:#7f8c8d;"></span>
                  <strong>{{ $docente->nombre }}</strong>
                </td>

                <td class="tw:text-center tw:align-middle">
                  <span class="tw:text-white" style="background:#27ae60; padding:3px 8px; font-size:11px">
                    ACTIVO
                  </span>
                </td>

                <td class="tw:text-center tw:align-middle">
                  {{ $docente->escolaridad ?? '' }}
                </td>

                <td class="tw:text-center tw:align-middle">

                  @if($docente->es_nuevo)

                  <a class="tw:text-brand-500 tw:hover:underline tw:text-white tw:no-underline" href="{{ route('admin.examen_general.pdf', $docente->id_personal) }}" style="background:#2980b9; padding:4px 8px">
                    Ver Resultados
                  </a>

                  @else

                  <a class="tw:text-brand-500 tw:hover:underline tw:text-white tw:no-underline" href="{{ route('admin.examen_general.pdf', $docente->id_personal) }}" style="background:#2980b9; padding:4px 8px">
                    Ver Resultados
                  </a>

                  @endif

                </td>
              </tr>

              @endforeach

            </tbody>

          </table>
</div>

          @else

          <div class="tw:text-center tw:text-gray-500 tw:dark:text-gray-400" style="padding:15px">
            No hay docentes activos registrados.
          </div>

          @endif

        </div>

      </div>

    </div>
  </div>

</div>

<script>
  $('#tab_pag1').DataTable();
</script>

</div>
@endsection