@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title', 'Resultados Examen de Conocimientos Generales')

@section('content')

<div class="tw:w-full">

  {{-- HEADER --}}
  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">

      <div style="background:#2c3e50; color:white; padding:15px; margin-top:10px; margin-bottom:15px;">
        <h3 style="margin:0;">
          <span class="fa fa-user"></span>
          Resultados Examen de Conocimientos Generales
        </h3>
        <small style="opacity:0.8;">
          Módulo de consulta de personal docente
        </small>
      </div>

    </div>
  </div>

  {{-- CARD TABLE --}}
  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:lg:w-full tw:px-2">

      <div style="background:#fff; border:1px solid #ddd; box-shadow:0 2px 4px rgba(0,0,0,0.1);">

        <div style="padding:10px 15px; border-bottom:1px solid #eee; background:#f8f8f8; overflow:hidden;">

          <strong style="float:left; margin-top:6px;">
            <span class="fa fa-list"></span>
            Listado de docentes
          </strong>

          <a href="{{ route('admin.examen_general.excel') }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm" style="float:right;">
            <span class="fa fa-download"></span>
            Exportar Excel
          </a>

        </div>

        <div>

          @if(count($docentes) > 0)

          <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table class="tw-tabla" style="margin:0;" id="tab_pag1">

            <thead>
              <tr style="background:#ecf0f1;">
                <th style="width:50px; text-align:center;">#</th>
                <th>Nombre completo</th>
                <th style="width:120px; text-align:center;">Estado</th>
                <th style="width:120px; text-align:center;">Escolaridad</th>
                <th style="width:120px; text-align:center;">Resultados Obtenidos</th>
              </tr>
            </thead>

            <tbody>

              @foreach($docentes as $index => $docente)

              <tr>
                <td style="text-align:center; vertical-align:middle;">
                  {{ $index + 1 }}
                </td>

                <td style="vertical-align:middle;">
                  <span class="fa fa-user" style="color:#7f8c8d;"></span>
                  <strong>{{ $docente->nombre }}</strong>
                </td>

                <td style="text-align:center; vertical-align:middle;">
                  <span style="background:#27ae60; color:white; padding:3px 8px; font-size:11px;">
                    ACTIVO
                  </span>
                </td>

                <td style="text-align:center; vertical-align:middle;">
                  {{ $docente->escolaridad ?? '' }}
                </td>

                <td style="text-align:center; vertical-align:middle;">

                  @if($docente->es_nuevo)

                  <a href="{{ route('admin.examen_general.pdf', $docente->id_personal) }}" style="background:#2980b9;color:white;padding:4px 8px;text-decoration:none;">
                    Ver Resultados
                  </a>

                  @else

                  <a href="{{ route('admin.examen_general.pdf', $docente->id_personal) }}" style="background:#2980b9;color:white;padding:4px 8px;text-decoration:none;">
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

          <div style="padding:15px; text-align:center; color:#777;">
            No hay docentes activos registrados.
          </div>

          @endif

        </div>

      </div>

    </div>
  </div>

</div>
<br>

<script>
  $('#tab_pag1').DataTable();
</script>

@endsection