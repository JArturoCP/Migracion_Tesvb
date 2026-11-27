@extends('ingles.inicio_ingles.layout_ingles')

@section('title', 'Inscripciones Examen Ubicacion')

@section('content')

<main class="ingles-i3c tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
    <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Examen de ubicación de nuevo ingreso</h1>

    <div class="tw:grid tw:min-w-0 tw:gap-4 tw:xl:grid-cols-2">

      <!-- =====================================
                 ALUMNOS PENDIENTES
            ====================================== -->
      <div class="tw:min-w-0">
        <x-panel.tarjeta>

        <div class="alert alert-danger text-center" style="border-radius: 8px;">

          <i class="fa fa-pencil"></i>

          <strong>
            Alumnos pendientes por registrar
          </strong>

        </div>

        <table class="table tw-tabla" id="tabla-ingles">

          <thead>

            <tr class="danger">

              <th class="text-center">
                #
              </th>

              <th class="text-center">
                No. CTA
              </th>

              <th class="text-center">
                Alumno
              </th>

              <th class="text-center">
                Acción
              </th>

            </tr>

          </thead>

          <tbody>

            @foreach($alumnos as $al)

            <tr data-id="{{ $al->id_alumno }}">

              <td class="text-center">
                {{ $loop->iteration }}
              </td>

              <td class="text-center">
                {{ $al->cuenta }}
              </td>

              <td class="text-center">
                {{ $al->apaterno }}
                {{ $al->amaterno }}
                {{ $al->nombre }}
              </td>

              <td class="text-center">

                <button type="button" class="btn btn-primary btn-sm abrirModal" data-id="{{ $al->id_alumno }}" data-nombre="{{ $al->nombre }} {{ $al->apaterno }} {{ $al->amaterno }}" style="border-radius: 6px;">

                  <i class="fa fa-pencil"></i>

                  Registrar

                </button>

              </td>

            </tr>

            @endforeach

          </tbody>

        </table>
        </x-panel.tarjeta>
      </div>

      <!-- =====================================
                 ALUMNOS REGISTRADOS
            ====================================== -->
      <div class="tw:min-w-0">
        <x-panel.tarjeta>

        <div class="alert alert-success text-center" style="border-radius: 8px;">

          <i class="fa fa-check-circle"></i>

          <strong>
            Alumnos ya registrados
          </strong>

        </div>

        <table class="table tw-tabla" id="tabla-registrados">

          <thead>

            <tr class="success">

              <th class="text-center">
                #
              </th>

              <th class="text-center">
                No. CTA
              </th>

              <th class="text-center">
                Alumno
              </th>

              <th class="text-center">
                Nivel
              </th>

              <th class="text-center">
                Grupo
              </th>

              <th class="text-center">
                Acción
              </th>

            </tr>

          </thead>

          <tbody>

            @foreach($alumnosRegistrados as $al)

            <tr data-id="{{ $al->id_alumno }}">

              <td class="text-center">
                {{ $loop->iteration }}
              </td>

              <td class="text-center">
                {{ $al->cuenta }}
              </td>

              <td class="text-center">
                {{ $al->apaterno }}
                {{ $al->amaterno }}
                {{ $al->nombre }}
              </td>

              <td class="text-center">

                {{ $niveles->firstWhere(
                                    'id_niveles_ingles',
                                    $al->id_nivel
                                )->descripcion ?? '-' }}

              </td>

              <td class="text-center">

                {{ $grupos->firstWhere(
                                    'id_grupo_ingles',
                                    $al->id_grupo
                                )->descripcion ?? '-' }}

              </td>

              <td class="text-center">

                <button type="button" class="btn btn-danger btn-sm eliminarRegistro" data-id="{{ $al->id_alumno }}" data-nombre="{{ $al->nombre }} {{ $al->apaterno }} {{ $al->amaterno }}" style="border-radius: 6px;">

                  <i class="fa fa-trash"></i>

                  Eliminar

                </button>

              </td>

            </tr>

            @endforeach

          </tbody>

        </table>
        </x-panel.tarjeta>
      </div>

    </div>

  <!-- =========================================
         MODAL REGISTRAR ALUMNO
    ========================================== -->
  <div class="modal fade" id="modalAlumno" tabindex="-1" role="dialog" aria-labelledby="modalAlumno-titulo">

    <div class="modal-dialog" style="max-width: 420px;">

      <div class="modal-content" style="border-radius: 14px; overflow: hidden;">

        <!-- HEADER -->

        <div class="modal-header bg-primary text-white" style="border-radius: 14px 14px 0 0;">

          <button type="button" class="close text-white" aria-label="Cerrar" data-dismiss="modal" style="opacity: 1;">

            <span>
              &times;
            </span>

          </button>

          <h4 class="modal-title" id="modalAlumno-titulo">

            <i class="fa fa-graduation-cap"></i>

            Asignar Nivel y Grupo

          </h4>

        </div>

        <!-- BODY -->

        <div class="modal-body">

          <input type="hidden" id="id_alumno">

          <!-- ALUMNO -->

          <div class="alert alert-info" style="border-radius: 10px;">

            <i class="fa fa-user"></i>

            <strong>
              Alumno:
            </strong>

            <span id="nombreAlumno"></span>

          </div>

          <!-- NIVEL -->

          <div class="form-group">

            <label for="nivel" style="font-weight: bold;">

              <i class="fa fa-list"></i>

              Nivel

            </label>

            <div class="input-group">

              <span class="input-group-addon">

                <i class="fa fa-book"></i>

              </span>

              <select id="nivel" class="form-control">

                <option value="">
                  Seleccione el nivel
                </option>

                @foreach($niveles as $n)

                <option value="{{ $n->id_niveles_ingles }}">

                  {{ $n->descripcion }}

                </option>

                @endforeach

              </select>

            </div>

          </div>

          <!-- GRUPO -->

          <div class="form-group">

            <label for="grupo" style="font-weight: bold;">

              <i class="fa fa-users"></i>

              Grupo

            </label>

            <div class="input-group">

              <span class="input-group-addon">

                <i class="fa fa-id-badge"></i>

              </span>

              <select id="grupo" class="form-control" disabled>

                <option value="">
                  Seleccione un nivel primero
                </option>

              </select>

            </div>

          </div>

        </div>

        <!-- FOOTER -->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">

            <i class="fa fa-times"></i>

            Cancelar

          </button>

          <button type="button" class="btn btn-success" id="btnGuardar" style="border-radius: 6px;">

            <i class="fa fa-floppy-o"></i>

            Guardar Registro

          </button>

        </div>

      </div>

    </div>

  </div>

  <!-- =========================================
         MODAL ELIMINAR
    ========================================== -->
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminar-titulo">

    <div class="modal-dialog" style="max-width: 420px;">

      <div class="modal-content" style="border-radius: 14px; overflow: hidden;">

        <!-- HEADER -->

        <div class="modal-header" style="
                        background: #d9534f;
                        color: white;
                        border-radius: 14px 14px 0 0;
                     ">

          <button type="button" class="close" aria-label="Cerrar" data-dismiss="modal" style="
                                color: white;
                                opacity: 1;
                            ">

            <span>
              &times;
            </span>

          </button>

          <h4 class="modal-title" id="modalEliminar-titulo">

            <i class="fa fa-exclamation-triangle"></i>

            Confirmar eliminación

          </h4>

        </div>

        <!-- BODY -->

        <div class="modal-body text-center" style="padding: 25px;">

          <div style="
                        font-size: 55px;
                        color: #d9534f;
                        margin-bottom: 15px;
                    ">

            <i class="fa fa-trash"></i>

          </div>

          <h4 style="
                        font-weight: bold;
                        margin-top: 0;
                    ">

            ¿Eliminar registro?

          </h4>

          <p style="
                        font-size: 16px;
                        color: #666;
                    ">

            Está a punto de eliminar el registro del alumno:

          </p>

          <div class="alert alert-warning" style="
                            border-radius: 8px;
                            margin-bottom: 0;
                         ">

            <i class="fa fa-user"></i>

            <strong id="nombreEliminar"></strong>

          </div>

          <p style="
                        color: #999;
                        margin-top: 15px;
                        margin-bottom: 0;
                    ">

            El alumno volverá a aparecer en la lista de
            <strong>pendientes por registrar</strong>.

          </p>

          <input type="hidden" id="id_alumno_eliminar">

        </div>

        <!-- FOOTER -->

        <div class="modal-footer text-center">

          <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px;">

            <i class="fa fa-times"></i>

            Cancelar

          </button>

          <button type="button" class="btn btn-danger" id="btnConfirmarEliminar" style="border-radius: 6px;">

            <i class="fa fa-trash"></i>

            Sí, eliminar

          </button>

        </div>

      </div>

    </div>

  </div>

</main>

<!-- =========================================
     JAVASCRIPT
========================================== -->

<script>
  $(document).ready(function() {
    /* =====================================================
       DATATABLES
    ===================================================== */
    var tablaPendientes = $('#tabla-ingles').DataTable();
    var tablaRegistrados = $('#tabla-registrados').DataTable();
    /* =====================================================
       ABRIR MODAL REGISTRAR
    ===================================================== */
    $(document).on('click', '.abrirModal', function() {
      var id = $(this).data('id');
      var nombre = $(this).data('nombre');
      $('#id_alumno').val(id);
      $('#nombreAlumno').text(nombre);
      // Limpiar selección anterior
      $('#nivel').val('');
      $('#grupo')
        .html('<option value="">Seleccione un nivel primero</option>')
        .prop('disabled', true);
      $('#modalAlumno').modal('show');
    });
    /* =====================================================
       GUARDAR REGISTRO
    ===================================================== */
    $('#btnGuardar').click(function() {
      var id_alumno = $('#id_alumno').val();
      var id_nivel = $('#nivel').val();
      var id_grupo = $('#grupo').val();
      /* ---------------------------------------------
         VALIDAR NIVEL
      --------------------------------------------- */
      if (id_nivel === '') {
        TNotify.alert('Seleccione un nivel.');
        return;
      }
      /* ---------------------------------------------
         VALIDAR GRUPO
      --------------------------------------------- */
      if (id_grupo === '') {
        TNotify.alert('Seleccione un grupo.');
        return;
      }
      var boton = $(this);
      /* ---------------------------------------------
         OBTENER TEXTOS
      --------------------------------------------- */
      var nivelTxt = $('#nivel option:selected').text().trim();
      var grupoTxt = $('#grupo option:selected').text().trim();
      /* ---------------------------------------------
         DESHABILITAR BOTÓN
      --------------------------------------------- */
      boton.prop('disabled', true);
      boton.html(
        '<i class="fa fa-spinner fa-spin"></i> Guardando...'
      );
      /* ---------------------------------------------
         AJAX
      --------------------------------------------- */
      $.ajax({
        url: "{{ route('ingles.guardar_ubicacion') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          id_alumno: id_alumno,
          id_nivel: id_nivel,
          id_grupo: id_grupo
        },
        success: function(response) {
          /* -----------------------------------------
             BUSCAR FILA
          ----------------------------------------- */
          var fila = tablaPendientes.row(
            'tr[data-id="' + id_alumno + '"]'
          );
          if (fila.length === 0) {
            TNotify.alert('No se encontró la fila del alumno.');
            return;
          }
          var datos = fila.data();
          /* -----------------------------------------
             AGREGAR A REGISTRADOS
          ----------------------------------------- */
          tablaRegistrados.row.add([
            tablaRegistrados.rows().count() + 1,
            datos[1],
            datos[2],
            nivelTxt,
            grupoTxt,
            '<button type="button" ' +
            'class="btn btn-danger btn-sm eliminarRegistro" ' +
            'data-id="' + id_alumno + '" ' +
            'data-nombre="' +
            $('#nombreAlumno').text() +
            '" ' +
            'style="border-radius: 6px;">' +
            '<i class="fa fa-trash"></i> Eliminar' +
            '</button>'
          ]).draw(false);
          /* -----------------------------------------
             ELIMINAR DE PENDIENTES
          ----------------------------------------- */
          fila.remove().draw(false);
          /* -----------------------------------------
             CERRAR MODAL
          ----------------------------------------- */
          $('#modalAlumno').modal('hide');
          /* -----------------------------------------
             RESTAURAR BOTÓN
          ----------------------------------------- */
          boton.prop('disabled', false);
          boton.html(
            '<i class="fa fa-floppy-o"></i> Guardar Registro'
          );
          /* -----------------------------------------
             MENSAJE
          ----------------------------------------- */
          TNotify.alert(
            response.message ||
            'Registro guardado correctamente.'
          );
        },
        error: function(xhr) {
          console.log(xhr.responseText);
          boton.prop('disabled', false);
          boton.html(
            '<i class="fa fa-floppy-o"></i> Guardar Registro'
          );
          TNotify.alert(
            'Ocurrió un error al guardar el registro.'
          );
        }
      });
    });
    /* =====================================================
       CARGAR GRUPOS POR NIVEL
    ===================================================== */
    $('#nivel').change(function() {
      var id_nivel = $(this).val();
      $('#grupo')
        .prop('disabled', true)
        .html(
          '<option value="">Cargando grupos...</option>'
        );
      /* ---------------------------------------------
         SIN NIVEL
      --------------------------------------------- */
      if (id_nivel === '') {
        $('#grupo')
          .html(
            '<option value="">Seleccione un nivel primero</option>'
          )
          .prop('disabled', true);
        return;
      }
      /* ---------------------------------------------
         AJAX GRUPOS
      --------------------------------------------- */
      $.get(
        '/ingles/grupos-por-nivel', {
          id_nivel: id_nivel
        },
        function(data) {
          /* -----------------------------------------
             SIN GRUPOS
          ----------------------------------------- */
          if (data.length === 0) {
            $('#grupo')
              .html(
                '<option value="">No hay grupos en este nivel</option>'
              )
              .prop('disabled', true);
            return;
          }
          /* -----------------------------------------
             CREAR OPCIONES
          ----------------------------------------- */
          var opciones =
            '<option value="">Seleccione el grupo</option>';
          $.each(data, function(index, grupo) {
            opciones +=
              '<option value="' +
              grupo.id_grupo_ingles +
              '">' +
              grupo.descripcion +
              '</option>';
          });
          $('#grupo')
            .html(opciones)
            .prop('disabled', false);
        }
      );
    });
    /* =====================================================
       ABRIR MODAL ELIMINAR
    ===================================================== */
    $(document).on('click', '.eliminarRegistro', function() {
      var id = $(this).data('id');
      var nombre = $(this).data('nombre');
      $('#id_alumno_eliminar').val(id);
      $('#nombreEliminar').text(nombre);
      $('#modalEliminar').modal('show');
    });
    /* =====================================================
       CONFIRMAR ELIMINACIÓN
    ===================================================== */
    $('#btnConfirmarEliminar').click(function() {
      var id_alumno =
        $('#id_alumno_eliminar').val();
      var boton = $(this);
      /* ---------------------------------------------
         VALIDAR ID
      --------------------------------------------- */
      if (!id_alumno) {
        TNotify.alert(
          'No se pudo identificar al alumno.'
        );
        return;
      }
      /* ---------------------------------------------
         DESHABILITAR BOTÓN
      --------------------------------------------- */
      boton.prop('disabled', true);
      boton.html(
        '<i class="fa fa-spinner fa-spin"></i> Eliminando...'
      );
      /* ---------------------------------------------
         AJAX
      --------------------------------------------- */
      $.ajax({
        url: "{{ route('ingles.eliminar_ubicacion') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          id_alumno: id_alumno
        },
        success: function(response) {
          if (response.success) {
            /* -------------------------------------
               CERRAR MODAL
            ------------------------------------- */
            $('#modalEliminar').modal('hide');
            /* -------------------------------------
               RESTAURAR BOTÓN
            ------------------------------------- */
            boton.prop('disabled', false);
            boton.html(
              '<i class="fa fa-trash"></i> Sí, eliminar'
            );
            /* -------------------------------------
               ACTUALIZAR TABLA
            ------------------------------------- */
            // Recargamos para que Laravel
            // vuelva a generar ambas listas.
            TNotify.alert(
              response.message ||
              'Registro eliminado correctamente.'
            );
            location.reload();
          } else {
            TNotify.alert(
              response.message ||
              'No se pudo eliminar el registro.'
            );
            boton.prop('disabled', false);
            boton.html(
              '<i class="fa fa-trash"></i> Sí, eliminar'
            );
          }
        },
       error: function (xhr) {

    console.log('STATUS:', xhr.status);
    console.log('RESPONSE:', xhr.responseText);

    TNotify.alert(
        'Error ' + xhr.status +
        '\n\n' +
        xhr.responseText
    );

}
      });
    });
    /* =====================================================
       LIMPIAR MODAL ELIMINAR AL CERRAR
    ===================================================== */
    $('#modalEliminar').on(
      'hidden.bs.modal',
      function() {
        $('#id_alumno_eliminar').val('');
        $('#nombreEliminar').text('');
        $('#btnConfirmarEliminar')
          .prop('disabled', false)
          .html(
            '<i class="fa fa-trash"></i> Sí, eliminar'
          );
      }
    );
  });
</script>

<style>

    .ingles-i3c .btn:focus-visible,
    .ingles-i3c .form-control:focus-visible,
    .ingles-i3c [tabindex="0"]:focus-visible {
        outline: 2px solid #3538cd;
        outline-offset: 2px;
    }
    .dark .ingles-i3c :is(.btn, .form-control, [tabindex="0"]):focus-visible {
        outline-color: #a4bcfd;
    }
    .dark .ingles-i3c .form-control {
        color: #f2f4f7;
        background: #1d2939;
        border-color: #667085;
        color-scheme: dark;
    }

    .dark .ingles-i3c .modal-content {
        background: #1d2939;
        color: #f2f4f7;
    }
    .dark .ingles-i3c .modal-content :is(.modal-header, .modal-footer) {
        border-color: #475467;
    }
    .dark .ingles-i3c .modal-header.bg-info {
        background: #25324a;
    }
    .dark .ingles-i3c .modal-header .close {
        color: #fff;
        opacity: 1;
        text-shadow: none;
    }

    .dark .ingles-i3c table.dataTable tbody :is(tr, td) {
        background-color: #1d2939;
        color: #e4e7ec;
    }
    .dark .ingles-i3c table.dataTable th {
        background-color: #25324a;
        color: #f2f4f7;
    }
    .dark .ingles-i3c table.dataTable tbody tr:hover td {
        background-color: #25324a;
    }

    .dark .ingles-i3c #modalEliminar .modal-body p {
        color: #d0d5dd !important;
    }
    .dark .ingles-i3c .modal-body .alert-info {
        background: #183453;
        color: #d1e9ff;
        border-color: #3d6384;
    }
    .dark .ingles-i3c .modal-body .alert-warning {
        background: #3b2b18;
        color: #fedf89;
        border-color: #745436;
    }
</style>
@endsection