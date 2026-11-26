@extends('layouts.panel')
@section('title', 'Bajas Temporales Estudiantes')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">
    @if($ver ==0)
        <x-panel.encabezado titulo="Bajas temporales de los estudiantes (programas de estudio)" :migas="['Servicios escolares' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Elige carrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            <option value="{{$carrera->id_carrera}}" data-esta="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    @else
        <x-panel.encabezado titulo="Bajas temporales de los estudiantes" :migas="['Servicios escolares' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                <div class="tw:mb-4">
                    <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                        <option disabled selected hidden>Selecciona una opción</option>
                        @foreach($carreras as $carrera)
                            @if($carrera->id_carrera==$id_carrera)
                                <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                            @else
                                <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">

                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="table_enviado" class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th class="tw:text-center">#</th>
                                <th class="tw:text-center">NO.CUENTA</th>
                                <th class="tw:text-center">NOMBRE DEL ALUMNO </th>
                                <th class="tw:text-center">OBSERVACIÓN</th>
                                <th class="tw:text-center">ACCIÓN</th>
                                <th class="tw:text-center">SOLICITUD DE BAJA</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alumnos as $alumno)

                                <tr>
                                    <td class="tw:text-center">{{$loop->iteration}}</td>
                                    <td class="tw:text-center">{{ $alumno->cuenta }}</td>
                                    <td class="tw:text-center">{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                                    @if($alumno->estado_validacion == 10)
                                        <td class="tw:text-center">SIN ELIMINACIÓN DE CARGA</td>
                                    @elseif($alumno->estado_validacion == 11)
                                        <td class="tw:text-center">CON ELIMINACIÓN DE CARGA</td>
                                    @endif
                                    <td class="tw:text-center" >
                                        <button class="btn-edit tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"
                                                data-toggle="modal"
                                                data-target="#modalEditar"
                                                data-cuenta="{{ $alumno->cuenta }}"
                                                data-nombre="{{ $alumno->nombre }}"
                                                data-apaterno="{{ $alumno->apaterno }}"
                                                data-amaterno="{{ $alumno->amaterno }}"
                                                data-id = "{{$alumno->id}}"
                                                data-id-alumno = "{{$alumno->id_alumno}}"><span class="fa fa-pencil"></span></button>

                                    </td>
                                    <td class="tw:text-center" >
                                        <button type="button" class="btn-imprimir-baja tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:size-9 tw:text-base"
                                                data-id-alumno="{{ $alumno->id_alumno }}"
                                                data-id="{{ $alumno->id }}"
                                                data-tipo="temporal"><span class="fa fa-print"></span></button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
                    </div>
                </div>
            </div>
        </div>

        <x-panel.modal id="modalEditar" tamano="md" sin-relleno>

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Registrar Oficio para activacion de Alumnos</h4>
                    </div>

                    <form action="/guardar-baja-temporal" method="POST">
                        @csrf
                        @method('POST')

                        <div class="tw-modal-cuerpo">


                            <!-- id_alumno gnral_alumnos -->
                            <input type="hidden" name="id_alumno" id="idAlumnoHidden">
                            <!-- id tabla eva_validacion_de_cargas -->
                            <input type="hidden" name="id" id="idHidden">


                            <div class="tw:mb-4">
                                <label>No. Cuenta:</label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="editcuenta" disabled>
                                <input type="hidden" name="cuenta" id="cuentaHidden">
                            </div>

                            <div class="tw:mb-4">
                                <label>Nombre:</label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="editnombre" disabled>
                                <input type="hidden" name="nombre" id="nombreHidden">
                            </div>

                            <div class="tw:mb-4">
                                <label>Apellido Paterno:</label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="editApaterno" disabled>
                                <input type="hidden" name="apaterno" id="apaternoHidden">
                            </div>

                            <div class="tw:mb-4">
                                <label>Apellido Materno:</label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="editAmaterno" disabled>
                                <input type="hidden" name="amaterno" id="amaternoHidden">
                            </div>

                            <div class="tw:mb-4">
                                <label>Número de Oficio:</label>
                                <input type="text" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="observacion" id="observacion" required placeholder="Porfavor ingresa el número de oficio para activacion de alumno">
                            </div>

                        </div>

                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                                <span class="fa fa-floppy-o"></span> Guardar Cambios
                            </button>
                        </div>
                    </form>


                </x-panel.modal>

        <!-- Modal de Adeudo -->
        <x-panel.modal id="modalAdeudo" tamano="md" sin-relleno aria-labelledby="modalAdeudoLabel">

                    <div class="tw-modal-cuerpo tw:pt-14 tw:text-center tw:pt-7.5 tw:px-6.25 tw:pb-5">
                        <span class="fa fa-times-circle-o"></span>
                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:mb-1 tw:mt-3.75 tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                            Adeudo pendiente
                        </h4>
                        <p class="tw:text-gray-500 tw:dark:text-gray-400 tw:text-[13px] tw:mb-4.5">
                            No se puede generar la solicitud de baja
                        </p>
                        <p class="tw:text-xs tw:text-red-600 tw:dark:text-red-400 tw:font-semibold tw:mb-2" id="contadorAdeudos"></p>

                        <ul class="tw:text-left tw:list-none tw:p-0 tw:m-0 tw:mb-1.25 tw:bg-gray-50 tw:dark:bg-gray-900 tw:rounded tw:border tw:border-gray-100 tw:dark:border-gray-800 tw:max-h-65 tw:overflow-y-auto" id="listaDepartamentosAdeudo">
                            <!-- Se llena por JS -->
                        </ul>
                    </div>

                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6 tw:text-center tw:border-t tw:border-gray-100 tw:dark:border-gray-800 tw:p-3">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>

                </x-panel.modal>

    @endif
    <script type="text/javascript">

        $(document).on('click', '.btn-edit', function () {

            // Hidden inputs que se enviarán al backend
            $('#idAlumnoHidden').val($(this).data('id-alumno'));
            $('#idHidden').val($(this).data('id'));


            // Solo mostrar datos, NO se envían
            $('#editcuenta').val($(this).data('cuenta'));
            $('#editnombre').val($(this).data('nombre'));
            $('#editApaterno').val($(this).data('apaterno'));
            $('#editAmaterno').val($(this).data('amaterno'));
        });

        // Verificar adeudo antes de imprimir la solicitud de baja
        $(document).on('click', '.btn-imprimir-baja', function () {
            var $btn = $(this);
            var idAlumno = $btn.data('id-alumno');
            var id = $btn.data('id');
            var tipo = $btn.data('tipo');

            $btn.prop('disabled', true);

            $.ajax({
                url: '/servicios_escolares/baja/verificar-adeudo/' + idAlumno,
                method: 'GET',
                success: function (data) {
                    $btn.prop('disabled', false);

                    if (data.tiene_adeudo) {
                        var $lista = $('#listaDepartamentosAdeudo');
                        $lista.empty();

                        var total = data.departamentos.length;
                        $('#contadorAdeudos').text(
                            total + (total === 1 ? ' departamento pendiente' : ' departamentos pendientes')
                        );

                        data.departamentos.forEach(function (depto) {
                            $lista.append(
                                '<li style="padding: 8px 12px; border-bottom: 1px solid #eee; font-size: 13px; color: #555;">' +
                                '<span class="fa fa-exclamation-circle" style="color: #d9534f; margin-right: 6px; font-size: 11px;"></span>' +
                                depto +
                                '</li>'
                            );
                        });
                        $lista.find('li').last().css('border-bottom', 'none');

                        $('#modalAdeudo').modal('show');
                    } else {
                        window.location.href = '/servicios_escolares/baja/imprimir/' + idAlumno + '/' + id + '/' + tipo;
                    }
                },
                error: function () {
                    $btn.prop('disabled', false);
                    $('#listaDepartamentosAdeudo').html(
                        '<li style="padding: 10px; font-size: 13px; color: #d9534f;">Ocurrió un error al verificar el adeudo. Intenta nuevamente.</li>'
                    );
                    $('#modalAdeudo').modal('show');
                }
            });
        });

        $(document).ready(function() {

            $("#carrera").on('change', function(){
                var id_carrera = $(this).val();
                window.location.href = '/servicios_escolares/bajas_temporales/ver/' + id_carrera;
            });

            $('#table_enviado').DataTable();
        });

    </script>


</div>
@endsection