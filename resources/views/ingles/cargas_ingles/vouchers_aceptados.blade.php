@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Vouchers aceptados')
@section('content')
    <main class="tw-modulo tw:w-full tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Vouchers aceptados</h1>

            @if($estado_voucher_excell == 0)
            <div class="tw:flex tw:flex-wrap tw:gap-2">
                    <button id="aceptacion_descargar" class="btn btn-primary">Aceptación de descargar excel</button>
                </div>
            <div class="modal fade" id="aceptacion_descarga" tabindex="-1" role="dialog" aria-labelledby="aceptacion_descarga-titulo">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">&times;</button>
                    <h4 class="modal-title" id="aceptacion_descarga-titulo">Aceptación de descarga</h4>
                        </div>
                        <div class="modal-body">
                            <form id="form_descarga" class="form" action="{{url("/ingles/guardar_aceptacion_excel_voucher")}}" role="form" method="POST" >
                                {{ csrf_field() }}
                            <p>Deseas descargar los datos de los estudiantes con voucher aceptado</p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="aceptar_descarga" class="btn btn-primary" >Aceptar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="consultar">
                <x-panel.tarjeta :sin-relleno="true">
                    <x-panel.tabla id="table_enviado" class="table text-center tw:mb-0" style="min-width: 950px !important" aria-label="Vouchers aceptados">
                        <thead>
                        <tr>
                            <th scope="col"> No. cuenta</th>
                            <th scope="col"> Nombre del Estudiante</th>
                            <th scope="col"> Linea de Captura</th>
                            <th scope="col"> Fecha de Entrega (Finanzas)</th>
                            <th scope="col"> Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alumnos as $alumno)
                            <tr>
                                <td >{{ $alumno->cuenta }}</td>
                                <td>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                                <td>{{ $alumno->linea_captura}}</td>
                                <td>{{ $alumno->fecha_cambio }}</td>
                                <td data-search="" data-order="">
                                <div class="tw:flex tw:flex-wrap tw:justify-center tw:gap-2">
                                        <a class="btn btn-default btn-sm" onclick="window.open('{{url($alumno->voucher)  }}')" href="#" aria-label="Ver comprobante (abre en otra pestaña)">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver comprobante
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-panel.tabla>
                </x-panel.tarjeta>
            </div>
            @else
            <div class="tw:flex tw:flex-wrap tw:gap-2">
                    <button type="button" class="btn btn-success" onclick="window.open('{{url('/ingles/exportar_excell_voucher_aceptado/')}}')">
                        <span class="fa fa-file-excel-o" aria-hidden="true"></span> Exportar concentrado
                    </button>

                    <button id="agregar_reg_pendientes" class="btn btn-primary">Agregar registros pendientes en el excel para descargar</button>
                </div>
            <div class="modal fade" id="aceptacion_reg_pendientes" tabindex="-1" role="dialog" aria-labelledby="aceptacion_reg_pendientes-titulo">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">&times;</button>
                    <h4 class="modal-title" id="aceptacion_reg_pendientes-titulo">Agregar registros pendientes</h4>
                        </div>
                        <div class="modal-body">
                            <form id="form_agregar_pendientes" class="form" action="{{url("/ingles/guardar_agregar_pendi_excel")}}" role="form" method="POST" >
                                {{ csrf_field() }}
                                <p>Deseas agregar registros pendientes en el excel para descargar</p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="aceptar_agregar_pendientes" class="btn btn-primary" >Aceptar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="consultar">
                <x-panel.tarjeta :sin-relleno="true">
                    <x-panel.tabla id="table_enviado" class="table text-center tw:mb-0" style="min-width: 950px !important" aria-label="Vouchers aceptados">
                        <thead>
                        <tr>
                            <th scope="col"> No. cuenta</th>
                            <th scope="col"> Nombre del Estudiante</th>
                            <th scope="col"> Linea de Captura</th>
                            <th scope="col"> Fecha de Entrega (Finanzas)</th>
                            <th scope="col"> Acciones</th>
                            <th scope="col">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($alumnos as $alumno)
                            <tr>
                                <td >{{ $alumno->cuenta }}</td>
                                <td>{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                                <td>{{ $alumno->linea_captura}}</td>
                                <td>{{ $alumno->fecha_cambio }}</td>
                                <td data-search="" data-order="">
                                <div class="tw:flex tw:flex-wrap tw:justify-center tw:gap-2">
                                        <a class="btn btn-default btn-sm" onclick="window.open('{{url($alumno->voucher)  }}')" href="#" aria-label="Ver comprobante (abre en otra pestaña)">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver comprobante
                                        </a>
                                    </div>
                                </td>
                                <td>
                                @if($alumno->estado_agregacion_excel == 0)
                                        <button id="{{ $alumno->id_voucher }}" class="btn btn-primary aceptacion_descargar">Agregar registro pendiente <br> en el excel para descargar</button>
                                 @else
                                      <p>Registro agregado</p>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-panel.tabla>
                </x-panel.tarjeta>
            </div>
            @endif

    </main>
    <div class="modal fade bs-example-modal-sm" id="modal_mostrar" tabindex="-1" role="dialog" aria-labelledby="modal_mostrar-titulo">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_mostrar-titulo">Permiso de modificación</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_mostrar">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_ver_registro" tabindex="-1" role="dialog" aria-labelledby="modal_ver_registro-titulo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_ver_registro-titulo">Agregar registro pendiente</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_ver_registro">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="aceptar_registro" class="btn btn-primary" >Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( {

            } );
            $('#table_enviado').closest('.tesvb-dt-scroll').attr({
                tabindex: 0,
                role: 'region',
                'aria-label': 'Vouchers aceptados'
            });
            $("#table_enviado").on('click','.editar',function(){
                var id_validar_carga=$(this).attr('id');
                $.get("/ingles/modificar_carga_academica_ingles/"+id_validar_carga,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });

            });
            $("#aceptacion_descargar").click(function (){
                $("#aceptacion_descarga").modal('show');
            });
            $("#aceptar_descarga").click(function (){
                $("#aceptar_descarga").attr("disabled", true);
                $("#form_descarga").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Descarga exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });
            $("#table_enviado").on('click','.aceptacion_descargar',function(){
                var id_voucher=$(this).attr('id');
                $.get("/ingles/ver_registro_voucher/"+id_voucher,function (request) {
                    $("#contenedor_ver_registro").html(request);
                    $("#modal_ver_registro").modal('show');
                });

                $("#aceptar_registro").click(function (){
                    $("#aceptar_registro").attr("disabled", true);
                    $("#form_enviar_registro").submit();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Agregación exitosa",
                        showConfirmButton: false,
                        timer: 3500
                    });
                });
            });
            $("#agregar_reg_pendientes").click(function (){
                $("#aceptacion_reg_pendientes").modal('show');
            });

            $("#aceptar_agregar_pendientes").click(function (){
                $("#aceptar_agregar_pendientes").attr("disabled", true);
                $("#form_agregar_pendientes").submit();
                swal({
                    position: "top",
                    type: "success",
                    title: "Agregación exitosa",
                    showConfirmButton: false,
                    timer: 3500
                });
            });

        });
    </script>

    <style>
        .tesvb-contenido > main .btn-success {
            background: #087443;
            border-color: #087443;
            color: #fff;
        }

        .tesvb-contenido > main .btn-success:hover {
            background: #05603a;
            border-color: #05603a;
        }

        .dark #table_enviado tbody tr {
            background-color: transparent;
        }

        .dark #table_enviado_paginate a.paginate_button {
            background: transparent;
            color: var(--tw-color-gray-300) !important;
            border-color: var(--tw-color-gray-700);
        }

        .dark #table_enviado_paginate a.paginate_button.current,
        .dark #table_enviado_paginate a.paginate_button:not(.disabled):hover {
            background: var(--tw-color-brand-500);
            color: #fff !important;
        }

        .dark .tesvb-contenido .modal-content {
            background: #1d2939;
            color: #f2f4f7;
        }

        .dark .tesvb-contenido .modal-content :is(.modal-header, .modal-footer) {
            border-color: #475467;
        }

        .dark .tesvb-contenido .modal-content .close {
            color: #fff;
            opacity: 1;
            text-shadow: none;
        }
    </style>
@endsection
