@extends('layouts.panel')
@section('title', 'Periodo de anteproyectos')

@include('partials.panel.recursos_app', ['datatables' => true, 'datepicker' => true])
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">

  <!-- ===================================================== -->
  <!-- TITULO -->
  <!-- ===================================================== -->

  <x-panel.encabezado titulo="Periodos de Evaluación de Anteproyectos" :migas="['Residencia profesional' => null]" />

  <!-- ===================================================== -->
  <!-- PERIODO ACTIVO -->
  <!-- ===================================================== -->

  @if($periodo_activo != null)

  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
      <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
          <h3 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><span class="fa fa-check-circle-o"></span>Periodo activo</h3>
          <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><strong>Fecha de inicio:</strong>{{ $periodo_activo->fecha_inicio }}</h4>
          <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><strong>Fecha de término:</strong>{{ $periodo_activo->fecha_final }}</h4>
          <h4 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><strong>Periodo:</strong>{{ $periodo_activo->periodo }}</h4>
          <!-- BOTONES -->
          <div class="tw:mt-4 tw:flex tw:flex-wrap tw:justify-center tw:gap-3">
            <!-- DESACTIVAR -->
            <button type="button" class="desactivar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $periodo_activo->id_periodo_eval_anteproyecto }}"><span class="fa fa-power-off"></span>Desactivar</button>
            <!-- EDITAR -->
            <button type="button" class="editar_periodo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-id="{{ $periodo_activo->id_periodo_eval_anteproyecto }}" data-inicio="{{ $periodo_activo->fecha_inicio }}" data-final="{{ $periodo_activo->fecha_final }}">
                <span class="fa fa-pencil"></span>
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

  <x-panel.alerta tipo="error" class="tw:mb-4"><h3 class="tw:text-center tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
            <span class="fa fa-exclamation-triangle"></span>
            No hay periodo activo
          </h3></x-panel.alerta>

  @endif

  <!-- ===================================================== -->
  <!-- TABLA -->
  <!-- ===================================================== -->

  <?php $n = 1; ?>

  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_periodo_eval_anteproyecto" class="tw-tabla tw-tabla-bordes tw-tabla-rayas">
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
              <button type="button" class="activar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $periodo_anteproyecto->id_periodo_eval_anteproyecto }}">
                <span class="fa fa-check"></span>
                Activar
              </button>
            </td>

            <!-- =========================== -->
            <!-- ELIMINAR -->
            <!-- =========================== -->
            <td>
              <a href="javascript:void(0)" class="eliminar_periodo tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" id="{{ $periodo_anteproyecto->id_periodo_eval_anteproyecto }}"><span class="fa fa-trash " aria-hidden="true"></span></a>
            </td>
            @endif
          </tr>

          <?php $n++; ?>
          @endforeach
        </tbody>
      </table>
</div>
    </div>
  </div>

  <!-- ===================================================== -->
  <!-- BOTON AGREGAR -->
  <!-- ===================================================== -->

  <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
      <button data-toggle="modal" data-tooltip="true" data-placement="left" title="Agregar nuevo periodo de evaluación" data-target="#modal_agregar_periodo" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
        <span class="fa fa-plus" aria-hidden="true"></span>
      </button>
    </div>
  </div>


</main>

<!-- ========================================================= -->
<!-- MODAL AGREGAR -->
<!-- ========================================================= -->

<x-panel.modal id="modal_agregar_periodo" tamano="md" sin-relleno clase-cerrar="close">
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        
        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><span class="fa fa-plus"></span>Agregar periodo de evaluación</h4>
      </div>

      <form role="form" method="POST">
        {{ csrf_field() }}
        <div class="tw-modal-cuerpo">
          <!-- FECHA INICIAL -->
          <div class="tw:mb-4">
            <label for="fecha_inicial">
              <span class="fa fa-calendar"></span>Fecha inicial
            </label>

            <div class="date tw:flex tw:w-full tw:items-stretch">
              <input type="text" id="fecha_inicial" name="fecha_inicial" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Selecciona la fecha inicial" autocomplete="off" required>
              <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                <span class="fa fa-calendar"></span>
              </span>
            </div>
          </div>

          <!-- FECHA FINAL -->

          <div class="tw:mb-4">
            <label for="fecha_final">
              <span class="fa fa-calendar"></span>Fecha final
            </label>

            <div class="date tw:flex tw:w-full tw:items-stretch">
              <input type="text" id="fecha_final" name="fecha_final" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Selecciona la fecha final" autocomplete="off" required>
              <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                <span class="fa fa-calendar"></span>
              </span>
            </div>
          </div>
        </div>

        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"><span class="fa fa-floppy-o"></span>Guardar</button>
        </div>
      </form>
    </x-panel.modal>

<!-- ========================================================= -->
<!-- MODAL EDITAR -->
<!-- ========================================================= -->

<x-panel.modal id="modal_editar_periodo" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="modalEditarPeriodoLabel">
      <!-- ================================================= -->
      <!-- HEADER -->
      <!-- ================================================= -->
      <div class="tw:px-6 tw:pt-6 tw:pr-14">
        

        <div class="tw:text-lg tw:font-semibold tw:text-gray-800-container">
          <div class="tw:flex tw:size-10 tw:shrink-0 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-50 tw:text-brand-500">
            <span class="fa fa-calendar"></span>
          </div>
          <div>
            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="modalEditarPeriodoLabel">Editar periodo</h4>
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
        <div class="tw-modal-cuerpo">
          <!-- ID -->
          <input type="hidden" id="editar_id_periodo" name="id_periodo_eval_anteproyecto">
          <!-- INFORMACION -->
          <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-sky-200 tw:bg-sky-50 tw:text-sky-800">
            <span class="fa fa-info-circle"></span>
            Selecciona la nueva fecha de inicio y
            la fecha de término del periodo.
          </div>

          <!-- ========================================= -->
          <!-- FECHA INICIAL -->
          <!-- ========================================= -->

          <div class="tw:mb-4">
            <label for="editar_fecha_inicial">
              <span class="fa fa-calendar"></span>
              Fecha inicial
            </label>

            <div class="tw:flex tw:w-full tw:items-stretch">
              <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                <span class="fa fa-calendar"></span>
              </span>
              <input type="text" id="editar_fecha_inicial" name="fecha_inicial" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Selecciona la fecha inicial" autocomplete="off" required>
            </div>
          </div>

          <!-- ========================================= -->
          <!-- SEPARADOR -->
          <!-- ========================================= -->

          <div class="tw:my-2 tw:text-center tw:text-brand-500">
            <span class="fa fa-arrow-down"></span>
          </div>

          <!-- ========================================= -->
          <!-- FECHA FINAL -->
          <!-- ========================================= -->
          <div class="tw:mb-4">
            <label for="editar_fecha_final">
              <span class="fa fa-calendar"></span>
              Fecha final
            </label>

            <div class="tw:flex tw:w-full tw:items-stretch">
              <span class="tw:inline-flex tw:items-center tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-3 tw:text-sm tw:text-gray-600 tw:dark:text-gray-400">
                <span class="fa fa-calendar"></span>
              </span>
              <input type="text" id="editar_fecha_final" name="fecha_final" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Selecciona la fecha final" autocomplete="off" required>
            </div>
          </div>
        </div>

        <!-- ================================================= -->
        <!-- FOOTER -->
        <!-- ================================================= -->
        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">
            <span class="fa fa-times"></span>
            Cancelar
          </button>

          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            <span class="fa fa-floppy-o"></span>
            Guardar cambios
          </button>
        </div>
      </form>
    </x-panel.modal>

<!-- ========================================================= -->
<!-- MODAL ELIMINAR -->
<!-- ========================================================= -->

<x-panel.modal id="modal_eliminado_periodo" tamano="sm" sin-relleno>
      <form action="" method="POST" role="form" id="form_delete">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="tw-modal-cuerpo tw:pt-14">
          <span class="fa fa-trash"></span>
          ¿Realmente deseas eliminar éste elemento?
        </div>

        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">
            Cancelar
          </button>
          <input id="confirma_eliminado_periodo" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Aceptar">
        </div>
      </form>
    </x-panel.modal>

<!-- ========================================================= -->
<!-- MODAL ACTIVAR -->
<!-- ========================================================= -->

<x-panel.modal id="modal_activar_periodo" tamano="sm" sin-relleno>
      <form id="form_activar" action="{{ url('/residencia/activar_periodo_anteproyecto/') }}" method="POST">
        {{ csrf_field() }}
        <div class="tw-modal-cuerpo tw:pt-14">
          <input type="hidden" id="id_periodo_eval_anteproyecto" name="id_periodo_eval_anteproyecto">
          <span class="fa fa-check"></span>
          ¿Realmente quiere activar este periodo?
        </div>

        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">
            Cancelar
          </button>

          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            Aceptar
          </button>
        </div>
      </form>
    </x-panel.modal>

<!-- ========================================================= -->
<!-- MODAL DESACTIVAR -->
<!-- ========================================================= -->

<x-panel.modal id="modal_desactivar_periodo" tamano="sm" sin-relleno>
      <form id="form_desactivar" action="{{ url('/residencia/desactivar_periodo_anteproyecto/') }}" method="POST">
        {{ csrf_field() }}
        <div class="tw-modal-cuerpo tw:pt-14">
          <input type="hidden" id="id_periodo_eval_anteproyecto1" name="id_periodo_eval_anteproyecto1">
          <span class="fa fa-exclamation-triangle"></span>
          ¿Realmente quiere desactivar este periodo?
        </div>

        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
          <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">
            Cancelar
          </button>

          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            Desactivar
          </button>
        </div>
      </form>
    </x-panel.modal>

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

</div>
@endsection