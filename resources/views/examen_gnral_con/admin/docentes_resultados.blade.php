@extends('layouts.app')
@section('title', 'Resultados Examen de Conocimientos Generales')

@section('content')

<div class="container">

  {{-- HEADER --}}
  <div class="row">
    <div class="col-md-12">

      <div style="background:#2c3e50; color:white; padding:15px; margin-top:10px; margin-bottom:15px;">
        <h3 style="margin:0;">
          <span class="glyphicon glyphicon-user"></span>
          Resultados Examen de Conocimientos Generales
        </h3>
        <small style="opacity:0.8;">
          Módulo de consulta de personal docente
        </small>
      </div>

    </div>
  </div>

  {{-- CARD TABLE --}}
  <div class="row">
    <div class="col-md-12">

      <div style="background:#fff; border:1px solid #ddd; box-shadow:0 2px 4px rgba(0,0,0,0.1);">

        <div style="padding:10px 15px; border-bottom:1px solid #eee; background:#f8f8f8; overflow:hidden;">

          <strong style="float:left; margin-top:6px;">
            <span class="glyphicon glyphicon-list"></span>
            Listado de docentes
          </strong>

          <a href="{{ route('admin.examen_general.excel') }}" class="btn btn-success btn-sm" style="float:right;">
            <span class="glyphicon glyphicon-download-alt"></span>
            Exportar Excel
          </a>

        </div>

        <div>

          @if(count($docentes) > 0)

          <table class="table table-hover" style="margin:0;" id="tab_pag1">

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
                  <span class="glyphicon glyphicon-user" style="color:#7f8c8d;"></span>
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