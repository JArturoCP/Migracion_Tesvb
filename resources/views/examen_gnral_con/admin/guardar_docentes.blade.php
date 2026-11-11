@extends('layouts.app')
@section('title', 'Registro de Docentes de Nuevo Ingreso')
@section('content')

<div class="container" style="margin-top:30px; margin-bottom:30px;">

  <div class="page-header">
    <h2>
      <i class="fa fa-user-plus text-primary"></i>
      Registro de Docentes de Nuevo Ingreso
    </h2>
    <p class="text-muted">
      Capture la información del docente para registrarlo en el sistema.
    </p>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">
        <i class="fa fa-address-card"></i>
        Información del docente
      </h3>
    </div>

    <div class="panel-body">

      <form action="{{ route('admin.examen_general.guardar_docentes_nuevos') }}" method="POST">
        @csrf

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>
                <i class="fa fa-user text-primary"></i>
                Nombre completo
              </label>
              <input type="text" name="nombre_docente" class="form-control input-lg" placeholder="Ejemplo: Juan Pérez López" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>
                <i class="fa fa-envelope text-primary"></i>
                Correo electrónico
              </label>
              <input type="email" name="correo" class="form-control input-lg" placeholder="ejemplo@institucion.edu.mx" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>
                <i class="fa fa-lock text-primary"></i>
                Contraseña
              </label>
              <div class="input-group">
                <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Digite número de cédula" required>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default" id="mostrarPassword">
                    <i class="fa fa-eye"></i>
                  </button>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>
                <i class="fa fa-graduation-cap text-primary"></i>
                Carrera
              </label>
              <select name="id_carrera" class="form-control input-lg" required>
                <option value="">
                  Seleccione una carrera
                </option>
                @foreach($carreras as $carrera)
                <option value="{{ $carrera->id_carrera }}">
                  {{ $carrera->nombre }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <hr>

        <div class="text-right">
          <a href="{{ url()->previous() }}" class="btn btn-default">
            <i class="fa fa-arrow-left"></i>
            Regresar
          </a>
          <button type="reset" class="btn btn-warning">
            <i class="fa fa-eraser"></i>
            Limpiar
          </button>
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i>
            Guardar docente
          </button>
        </div>
      </form>

    </div>

    <div class="panel-footer">
      <i class="fa fa-info-circle text-info"></i>
      Verifique que la información capturada sea correcta antes de guardar.
    </div>

  </div>

  <hr>

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">
        <i class="fa fa-users"></i>
        Docentes registrados
      </h3>
    </div>

    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tabla_docentes">
          <thead>
            <tr class="info">
              <th width="60" class="text-center">#</th>
              <th>Nombre</th>
              <th>Correo electrónico</th>
              <th class="text-center">Contraseña</th>
              <th>Carrera</th>
            </tr>
          </thead>

          <tbody>
            @forelse($docentes_registrados as $docente)
            <tr>
              <td class="text-center">
                {{ $loop->iteration }}
              </td>
              <td>
                {{ $docente->nombre_docente }}
              </td>
              <td>
                {{ $docente->correo }}
              </td>
              <td width="220">
                <div class="input-group">
                  <input type="password" class="form-control input-sm passwordDocente" value="{{ $docente->password }}" readonly>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default verPassword" title="Mostrar/Ocultar contraseña">
                      <i class="fa fa-eye"></i>
                    </button>
                  </span>
                </div>
              </td>
              <td>
                {{ $docente->nombre ?? 'Sin carrera asignada' }}
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center">
                <i class="fa fa-info-circle text-info"></i>
                No hay docentes registrados.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // DataTable
      $('#tabla_docentes').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        pageLength: 10,
        order: [
          [1, 'asc']
        ]
      });
      // Mostrar / ocultar contraseña del formulario
      $('#mostrarPassword').click(function() {
        let input = $('#password');
        let icono = $(this).find('i');
        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icono.removeClass('fa-eye');
          icono.addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icono.removeClass('fa-eye-slash');
          icono.addClass('fa-eye');
        }
      });
      // Mostrar / ocultar contraseña en tabla
      $('#tabla_docentes').on('click', '.verPassword', function() {
        let input = $(this)
          .closest('.input-group')
          .find('.passwordDocente');
        let icono = $(this).find('i');
        if (input.attr('type') === 'password') {
          input.attr('type', 'text');
          icono.removeClass('fa-eye');
          icono.addClass('fa-eye-slash');
        } else {
          input.attr('type', 'password');
          icono.removeClass('fa-eye-slash');
          icono.addClass('fa-eye');
        }
      });
    });
  </script>

  @endsection