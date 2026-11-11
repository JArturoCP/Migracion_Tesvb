@extends('layouts.app')
@section('title', 'Periodo de anteproyectos')

@section('content')

<style>
  /* ========================================================= */
  /* ESTILO GENERAL */
  /* ========================================================= */
  .periodo-panel {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  /* ========================================================= */
  /* BOTONES DEL PERIODO ACTIVO */
  /* ========================================================= */
  .botones-periodo {
    text-align: center;
    margin-top: 20px;
  }

  .botones-periodo .btn {
    margin: 0 4px;
  }

  /* ========================================================= */
  /* MODAL EDITAR */
  /* ========================================================= */
  .modal-periodo {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
  }

  /* ========================================================= */
  /* ENCABEZADO DEL MODAL */
  /* ========================================================= */
  .modal-periodo-header {
    background: linear-gradient(135deg,
        #337ab7,
        #286090);
    color: white;
    border-bottom: none;
    padding: 20px 25px;
  }

  .modal-title-container {
    display: flex;
    align-items: center;
  }

  .modal-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }

  .modal-icon .glyphicon {
    font-size: 24px;
  }

  .modal-periodo-header .modal-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 5px 0;
  }

  .modal-periodo-header small {
    color: rgba(255, 255, 255, 0.85);
    font-size: 13px;
  }

  .modal-close {
    color: white;
    opacity: 0.8;
    font-size: 28px;
    margin-top: -5px;
  }

  .modal-close:hover {
    color: white;
    opacity: 1;
  }

  /* ========================================================= */
  /* BODY MODAL */
  /* ========================================================= */
  .modal-periodo-body {
    padding: 25px 30px 20px 30px;
  }

  /* ========================================================= */
  /* MENSAJE INFORMATIVO */
  /* ========================================================= */
  .periodo-info {
    border-radius: 6px;
    border: none;
    background-color: #eaf4fb;
    color: #31708f;
    font-size: 13px;
    padding: 12px 15px;
    margin-bottom: 25px;
  }

  .periodo-info .glyphicon {
    margin-right: 7px;
  }

  /* ========================================================= */
  /* LABEL FECHA */
  /* ========================================================= */
  .label-fecha {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
  }

  .label-fecha .glyphicon {
    color: #337ab7;
    margin-right: 6px;
  }

  /* ========================================================= */
  /* INPUT FECHA */
  /* ========================================================= */
  .input-fecha {
    width: 100%;
  }

  .input-fecha .input-group-addon {
    background-color: #f5f7fa;
    border-color: #d9dfe5;
    color: #337ab7;
    min-width: 45px;
  }

  .input-fecha .form-control {
    height: 45px;
    border-color: #d9dfe5;
    box-shadow: none;
    font-size: 15px;
    padding: 10px 12px;
    transition: all 0.2s ease;
  }

  .input-fecha .form-control:focus {
    border-color: #337ab7;
    box-shadow: 0 0 0 2px rgba(51, 122, 183, 0.12);
  }

  /* ========================================================= */
  /* SEPARADOR DE FECHAS */
  /* ========================================================= */
  .separador-fechas {
    text-align: center;
    height: 25px;
    position: relative;
  }

  .separador-fechas:before {
    content: "";
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 1px;
    background-color: #ddd;
  }

  .separador-fechas .glyphicon {
    position: relative;
    z-index: 2;
    background-color: white;
    color: #337ab7;
    padding: 4px;
  }

  /* ========================================================= */
  /* FOOTER MODAL */
  /* ========================================================= */
  .modal-periodo-footer {
    background-color: #f7f8fa;
    border-top: 1px solid #e5e5e5;
    padding: 15px 25px;
  }

  /* ========================================================= */
  /* BOTON CANCELAR */
  /* ========================================================= */
  .btn-cancelar {
    background-color: white;
    border: 1px solid #ccc;
    color: #555;
    border-radius: 5px;
    padding: 9px 16px;
  }

  .btn-cancelar:hover {
    background-color: #f2f2f2;
  }

  /* ========================================================= */
  /* BOTON GUARDAR */
  /* ========================================================= */
  .btn-guardar {
    background: linear-gradient(135deg,
        #337ab7,
        #286090);
    border: none;
    color: white;
    border-radius: 5px;
    padding: 10px 18px;
    margin-left: 8px;
    transition: all 0.2s ease;
  }

  .btn-guardar:hover {
    background: linear-gradient(135deg,
        #286090,
        #204d74);
    color: white;
    transform: translateY(-1px);
  }

  /* ========================================================= */
  /* DATATABLE */
  /* ========================================================= */
  #table_periodo_eval_anteproyecto thead th {
    background-color: #337ab7;
    color: white;
    text-align: center;
    vertical-align: middle;
  }

  #table_periodo_eval_anteproyecto tbody td {
    vertical-align: middle;
  }

  #table_periodo_eval_anteproyecto tbody td:not(:first-child) {
    text-align: center;
  }

  /* ========================================================= */
  /* RESPONSIVE */
  /* ========================================================= */
  @media (max-width: 767px) {
    .modal-periodo-body {
      padding: 20px;
    }

    .botones-periodo .btn {
      margin-bottom: 5px;
    }
  }
</style>

<main class="col-md-12">

  <!-- ===================================================== -->
  <!-- TITULO -->
  <!-- ===================================================== -->

  <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <div class="panel panel-info periodo-panel">
        <div class="panel-heading">
          <h2 class="panel-title text-center">Periodos de Evaluación de Anteproyectos</h2>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================================================== -->
  <!-- PERIODO ACTIVO -->
  <!-- ===================================================== -->

  @if($periodo_activo != null)

  <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <div class="panel panel-success periodo-panel">
        <div class="panel-heading">
          <h3 class="text-center"><span class="glyphicon glyphicon-ok-circle"></span>Periodo activo</h3>
          <h4 class="text-center"><strong>Fecha de inicio:</strong>{{ $periodo_activo->fecha_inicio }}</h4>
          <h4 class="text-center"><strong>Fecha de término:</strong>{{ $periodo_activo->fecha_final }}</h4>
          <h4 class="text-center"><strong>Periodo:</strong>{{ $periodo_activo->periodo }}</h4>
          <!-- BOTONES -->
          <div class="botones-periodo">
            <!-- DESACTIVAR -->
            <button type="button" class="btn btn-danger desactivar" id="{{ $periodo_activo->id_periodo_eval_anteproyecto }}"><span class="glyphicon glyphicon-off"></span>Desactivar</button>
            <!-- EDITAR -->
            <button type="button" class="btn btn-warning editar_periodo" data-id="{{ $periodo_activo->id_periodo_eval_anteproyecto }}" data-inicio="{{ $periodo_activo->fecha_inicio }}" data-final="{{ $periodo_activo->fecha_final }}">
                <span class="glyphicon glyphicon-pencil"></span>
              Editar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @else

  <!-- ================================================= -->
  <!-- NO HAY PERIODO ACTIVO -->
  <!-- ================================================= -->

  <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <div class="panel panel-danger periodo-panel">
        <div class="panel-heading">
          <h3 class="text-center">
            <span class="glyphicon glyphicon-warning-sign"></span>
            No hay periodo activo
          </h3>
        </div>
      </div>
    </div>
  </div>

  @endif

  <!-- ===================================================== -->
  <!-- TABLA -->
  <!-- ===================================================== -->

  <?php $n = 1; ?>

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <table id="table_periodo_eval_anteproyecto" class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>No.</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Periodo</th>
            @if($periodo_activo == null)
            <th>Estado</th>
            <th>Eliminar</th>
            @endif
          </tr>
        </thead>

        <tbody>
          @foreach($periodo_anteproyectos as $periodo_anteproyecto)
          <tr>
            <td class = "text-center">{{ $n }}</td>
            <td>{{ $periodo_anteproyecto->fecha_inicio }}</td>
            <td>{{ $periodo_anteproyecto->fecha_final }}</td>
            <td>{{ $periodo_anteproyecto->periodo }}</td>

            @if($periodo_activo == null)

            <!-- =========================== -->
            <!-- ACTIVAR -->
            <!-- =========================== -->

            <td>
              <button type="button" class="btn btn-primary activar" id="{{ $periodo_anteproyecto->id_periodo_eval_anteproyecto }}">
                <span class="glyphicon glyphicon-ok"></span>
                Activar
              </button>
            </td>

            <!-- =========================== -->
            <!-- ELIMINAR -->
            <!-- =========================== -->
            <td>
              <a href="javascript:void(0)" class="eliminar_periodo" id="{{ $periodo_anteproyecto->id_periodo_eval_anteproyecto }}">
                <span class="glyphicon glyphicon-trash em2" aria-hidden="true"></span>
              </a>
            </td>
            @endif
          </tr>

          <?php $n++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- ===================================================== -->
  <!-- BOTON AGREGAR -->
  <!-- ===================================================== -->

  <div class="row">
    <div class="col-md-1 col-md-offset-3">
      <button data-toggle="modal" data-tooltip="true" data-placement="left" title="Agregar nuevo periodo de evaluación" data-target="#modal_agregar_periodo" type="button" class="btn btn-success btn-lg flotante">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      </button>
    </div>
  </div>

  <br><br>

</main>

<!-- ========================================================= -->
<!-- MODAL AGREGAR -->
<!-- ========================================================= -->

<div class="modal fade" id="modal_agregar_periodo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>Agregar periodo de evaluación</h4>
      </div>

      <form class="form" role="form" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <!-- FECHA INICIAL -->
          <div class="form-group">
            <label for="fecha_inicial">
              <span class="glyphicon glyphicon-calendar"></span>Fecha inicial
            </label>

            <div class="input-group date">
              <input type="text" id="fecha_inicial" name="fecha_inicial" class="form-control" placeholder="Selecciona la fecha inicial" autocomplete="off" required>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>

          <!-- FECHA FINAL -->

          <div class="form-group">
            <label for="fecha_final">
              <span class="glyphicon glyphicon-calendar"></span>Fecha final
            </label>

            <div class="input-group date">
              <input type="text" id="fecha_final" name="fecha_final" class="form-control" placeholder="Selecciona la fecha final" autocomplete="off" required>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!-- MODAL EDITAR -->
<!-- ========================================================= -->

<div class="modal fade" id="modal_editar_periodo" tabindex="-1" role="dialog" aria-labelledby="modalEditarPeriodoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-periodo">
      <!-- ================================================= -->
      <!-- HEADER -->
      <!-- ================================================= -->
      <div class="modal-header modal-periodo-header">
        <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <div class="modal-title-container">
          <div class="modal-icon">
            <span class="glyphicon glyphicon-calendar"></span>
          </div>
          <div>
            <h4 class="modal-title" id="modalEditarPeriodoLabel">Editar periodo</h4>
            <small>Modifica las fechas del periodo de evaluación</small>
          </div>
        </div>
      </div>

      <!-- ================================================= -->
      <!-- FORMULARIO -->
      <!-- ================================================= -->

      <form id="form_editar_periodo" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="modal-body modal-periodo-body">
          <!-- ID -->
          <input type="hidden" id="editar_id_periodo" name="id_periodo_eval_anteproyecto">
          <!-- INFORMACION -->
          <div class="alert alert-info periodo-info">
            <span class="glyphicon glyphicon-info-sign"></span>
            Selecciona la nueva fecha de inicio y
            la fecha de término del periodo.
          </div>

          <!-- ========================================= -->
          <!-- FECHA INICIAL -->
          <!-- ========================================= -->

          <div class="form-group">
            <label for="editar_fecha_inicial" class="label-fecha">
              <span class="glyphicon glyphicon-calendar"></span>
              Fecha inicial
            </label>

            <div class="input-group input-fecha">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
              <input type="text" id="editar_fecha_inicial" name="fecha_inicial" class="form-control" placeholder="Selecciona la fecha inicial" autocomplete="off" required>
            </div>
          </div>

          <!-- ========================================= -->
          <!-- SEPARADOR -->
          <!-- ========================================= -->

          <div class="separador-fechas">
            <span class="glyphicon glyphicon-arrow-down"></span>
          </div>

          <!-- ========================================= -->
          <!-- FECHA FINAL -->
          <!-- ========================================= -->
          <div class="form-group">
            <label for="editar_fecha_final" class="label-fecha">
              <span class="glyphicon glyphicon-calendar"></span>
              Fecha final
            </label>

            <div class="input-group input-fecha">
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
              <input type="text" id="editar_fecha_final" name="fecha_final" class="form-control" placeholder="Selecciona la fecha final" autocomplete="off" required>
            </div>
          </div>
        </div>

        <!-- ================================================= -->
        <!-- FOOTER -->
        <!-- ================================================= -->
        <div class="modal-footer modal-periodo-footer">
          <button type="button" class="btn btn-cancelar" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>
            Cancelar
          </button>

          <button type="submit" class="btn btn-guardar">
            <span class="glyphicon glyphicon-floppy-disk"></span>
            Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!-- MODAL ELIMINAR -->
<!-- ========================================================= -->

<div id="modal_eliminado_periodo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="POST" role="form" id="form_delete">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="modal-body">
          <span class="glyphicon glyphicon-trash"></span>
          ¿Realmente deseas eliminar éste elemento?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancelar
          </button>
          <input id="confirma_eliminado_periodo" type="button" class="btn btn-danger" value="Aceptar">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!-- MODAL ACTIVAR -->
<!-- ========================================================= -->

<div id="modal_activar_periodo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id="form_activar" class="form" action="{{ url('/residencia/activar_periodo_anteproyecto/') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" id="id_periodo_eval_anteproyecto" name="id_periodo_eval_anteproyecto">
          <span class="glyphicon glyphicon-ok"></span>
          ¿Realmente quiere activar este periodo?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancelar
          </button>

          <button type="submit" class="btn btn-primary">
            Aceptar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!-- MODAL DESACTIVAR -->
<!-- ========================================================= -->

<div id="modal_desactivar_periodo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id="form_desactivar" class="form" action="{{ url('/residencia/desactivar_periodo_anteproyecto/') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <input type="hidden" id="id_periodo_eval_anteproyecto1" name="id_periodo_eval_anteproyecto1">
          <span class="glyphicon glyphicon-warning-sign"></span>
          ¿Realmente quiere desactivar este periodo?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cancelar
          </button>

          <button type="submit" class="btn btn-danger">
            Desactivar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script type="text/javascript">
  $(document).ready(function() {
    /* =========================================================
       DATATABLE
       ========================================================= */
    $('#table_periodo_eval_anteproyecto').DataTable({
      language: {
        processing: "Procesando...",
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ registros",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 a 0 de 0 registros",
        infoFiltered: "(filtrado de _MAX_ registros)",
        loadingRecords: "Cargando...",
        zeroRecords: "No se encontraron registros",
        emptyTable: "No hay datos disponibles",
        paginate: {
          first: "Primero",
          previous: "Anterior",
          next: "Siguiente",
          last: "Último"
        }
      },
      pageLength: 10,
      responsive: true,
      order: [
        [0, 'asc']
      ]
    });
    /* =========================================================
       DATEPICKER AGREGAR
       ========================================================= */
    $('#fecha_inicial').datepicker({
      autoclose: true,
      startDate: '+0d',
      language: 'es',
      format: 'yyyy/mm/dd'
    });
    $('#fecha_final').datepicker({
      autoclose: true,
      startDate: '+0d',
      language: 'es',
      format: 'yyyy/mm/dd'
    });
    /* =========================================================
       VALIDAR FECHA FINAL AL AGREGAR
       ========================================================= */
    $('#fecha_inicial').on('changeDate', function(selected) {
      var fechaInicial = selected.date;
      $('#fecha_final').datepicker(
        'setStartDate',
        fechaInicial
      );
    });
    /* =========================================================
       DATEPICKER EDITAR
       ========================================================= */
    $('#editar_fecha_inicial').datepicker({
      autoclose: true,
      language: 'es',
      format: 'yyyy/mm/dd'
    });
    $('#editar_fecha_final').datepicker({
      autoclose: true,
      language: 'es',
      format: 'yyyy/mm/dd'
    });
    /* =========================================================
       VALIDAR FECHA FINAL AL EDITAR
       ========================================================= */
    $('#editar_fecha_inicial').on('changeDate', function(selected) {
      var fechaInicial = selected.date;
      $('#editar_fecha_final').datepicker(
        'setStartDate',
        fechaInicial
      );
    });
    /* =========================================================
       EDITAR PERIODO
       ========================================================= */
    $(".editar_periodo").click(function() {
      var id = $(this).data('id');
      var fechaInicio = $(this).data('inicio');
      var fechaFinal = $(this).data('final');
      /*
      | Cargar ID
      */
      $('#editar_id_periodo').val(id);
      /*
      | Cargar fechas
      */
      $('#editar_fecha_inicial').val(fechaInicio);
      $('#editar_fecha_final').val(fechaFinal);
      /*
      | Establecer fecha mínima
      | de la fecha final
      */
      $('#editar_fecha_final').datepicker(
        'setStartDate',
        fechaInicio
      );
      /*
      | URL para actualizar
      */
      $('#form_editar_periodo').attr(
        'action',
        '{{ url("/residencia/evalucion_anteproyecto/editar") }}/' + id
      );
      /*
      | Abrir modal
      */
      $('#modal_editar_periodo').modal('show');
    });
    /* =========================================================
       ACTIVAR PERIODO
       ========================================================= */
    $("#table_periodo_eval_anteproyecto").on(
      'click',
      '.activar',
      function() {
        var id = $(this).attr('id');
        $('#id_periodo_eval_anteproyecto').val(id);
        $('#modal_activar_periodo').modal('show');
      }
    );
    /* =========================================================
       ELIMINAR PERIODO
       ========================================================= */
    $("#table_periodo_eval_anteproyecto").on(
      'click',
      '.eliminar_periodo',
      function() {
        var id = $(this).attr('id');
        $('#confirma_eliminado_periodo').data(
          'id',
          id
        );
        $('#modal_eliminado_periodo').modal('show');
      }
    );
    /* =========================================================
       CONFIRMAR ELIMINACIÓN
       ========================================================= */
    $("#confirma_eliminado_periodo").click(function() {
      var id = $(this).data('id');
      $("#form_delete").attr(
        "action",
        "/residencia/evalucion_anteproyecto/eliminar/" + id
      );
      $("#form_delete").submit();
    });
    /* =========================================================
       DESACTIVAR PERIODO
       ========================================================= */
    $(".desactivar").click(function() {
      var id = $(this).attr('id');
      $('#id_periodo_eval_anteproyecto1').val(id);
      $('#modal_desactivar_periodo').modal('show');
    });
  });
</script>

@endsection