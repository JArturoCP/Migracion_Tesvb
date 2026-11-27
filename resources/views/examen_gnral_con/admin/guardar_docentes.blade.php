@extends('layouts.panel')
@section('title', 'Registro de Docentes de Nuevo Ingreso')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<div class="tw:w-full" style="margin-top:30px; margin-bottom:30px;">

  <div class="tw:mb-6 tw:border-b tw:border-gray-200 tw:dark:border-gray-800 tw:pb-2">
    <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
      <i class="fa fa-user-plus tw:text-brand-500"></i>
      Registro de Docentes de Nuevo Ingreso
    </h2>
    <p class="tw:text-gray-500 tw:dark:text-gray-400">
      Capture la información del docente para registrarlo en el sistema.
    </p>
  </div>

  <x-panel.encabezado titulo="Información del docente" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
    

    <div class="tw:p-5 tw:sm:p-6">

      <form action="{{ route('admin.examen_general.guardar_docentes_nuevos') }}" method="POST">
        @csrf

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4">
              <label>
                <i class="fa fa-user tw:text-brand-500"></i>
                Nombre completo
              </label>
              <input type="text" name="nombre_docente" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Ejemplo: Juan Pérez López" required>
            </div>
          </div>

          <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4">
              <label>
                <i class="fa fa-envelope tw:text-brand-500"></i>
                Correo electrónico
              </label>
              <input type="email" name="correo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="ejemplo@institucion.edu.mx" required>
            </div>
          </div>

          <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4">
              <label>
                <i class="fa fa-lock tw:text-brand-500"></i>
                Contraseña
              </label>
              <div class="input-group tw:flex tw:w-full tw:items-stretch">
                <input type="password" id="password" name="password" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" placeholder="Digite número de cédula" required>
                <span class="tw:inline-flex">
                  <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base" id="mostrarPassword"><i class="fa fa-eye"></i></button>
                </span>
              </div>
            </div>
          </div>

          <div class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:mb-4">
              <label>
                <i class="fa fa-graduation-cap tw:text-brand-500"></i>
                Carrera
              </label>
              <select name="id_carrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
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

        <div class="tw:text-right">
          <a href="{{ url()->previous() }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            <i class="fa fa-arrow-left"></i>
            Regresar
          </a>
          <button type="reset" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:disabled:bg-amber-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            <i class="fa fa-eraser"></i>
            Limpiar
          </button>
          <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            <i class="fa fa-save"></i>
            Guardar docente
          </button>
        </div>
      </form>

    </div>

    <div class="tw:border-t tw:border-gray-100 tw:dark:border-gray-800 tw:px-5 tw:py-4">
      <i class="fa fa-info-circle tw:text-sky-600"></i>
      Verifique que la información capturada sea correcta antes de guardar.
    </div>

  </div>

  <hr>

  <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
      <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
        <i class="fa fa-users"></i>
        Docentes registrados
      </h3>
    </div>

    <div class="tw:p-5 tw:sm:p-6">
      <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
        <table class="tw-tabla tw-tabla-bordes tw-tabla-rayas" id="tabla_docentes">
          <thead>
            <tr class="tw:bg-sky-50">
              <th width="60" class="tw:text-center">#</th>
              <th>Nombre</th>
              <th>Correo electrónico</th>
              <th class="tw:text-center">Contraseña</th>
              <th>Carrera</th>
            </tr>
          </thead>

          <tbody>
            @forelse($docentes_registrados as $docente)
            <tr>
              <td class="tw:text-center">
                {{ $loop->iteration }}
              </td>
              <td>
                {{ $docente->nombre_docente }}
              </td>
              <td>
                {{ $docente->correo }}
              </td>
              <td width="220">
                <div class="input-group tw:flex tw:w-full tw:items-stretch">
                  <input type="password" class="passwordDocente tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" value="{{ $docente->password }}" readonly>
                  <span class="tw:inline-flex">
                    <button type="button" class="verPassword tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base" title="Mostrar/Ocultar contraseña"><i class="fa fa-eye"></i></button>
                  </span>
                </div>
              </td>
              <td>
                {{ $docente->nombre ?? 'Sin carrera asignada' }}
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="tw:text-center">
                <i class="fa fa-info-circle tw:text-sky-600"></i>
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

  </div>
@endsection