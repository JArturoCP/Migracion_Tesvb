@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Vouchers pendientes de validación')
@section('content')
    <main class="tw-modulo tw:w-full tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Vouchers pendientes de validación</h1>

        <div class="tw:flex tw:flex-wrap tw:gap-2">
                <button type="button" class="btn btn-success" onclick="window.open('{{url('/ingles/mostrar_excell_voucher/')}}')">
                              <span class="fa fa-file-excel-o" aria-hidden="true"></span> Exportar concentrado
                      </button>
            </div>

        <div id="consultar">
                <x-panel.tarjeta :sin-relleno="true">
                    <x-panel.tabla id="table_enviado" class="table text-center tw:mb-0" style="min-width: 1080px !important" aria-label="Vouchers pendientes de validación">
                    <thead>
                    <tr>
                        <th scope="col"> No. cuenta</th>
                        <th scope="col"> Nombre del Estudiante</th>
                        <th scope="col"> Linea de Captura</th>
                        <th scope="col"> Fecha de Entrega (Finanzas)</th>
                        <th scope="col"> Tipo de Formato de Pago</th>
                        <th scope="col"> Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->cuenta }}</td>
                            <td class="text-capitalize">{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                            <td>{{ $alumno->linea_captura}}</td>
                            <td>{{ $alumno->fecha_cambio }}</td>
                            @if($alumno->id_tipo_voucher == 1)
                            <td>Original</td>
                            @elseif($alumno->id_tipo_voucher == 2)
                            <td>Copia</td>
                            @endif
                            <td data-search="" data-order="">
                                <div class="tw:flex tw:flex-wrap tw:justify-center tw:gap-2">
                                    <a class="btn btn-default btn-sm" onclick="window.open('{{url($alumno->voucher)  }}')" href="#" aria-label="Ver comprobante (abre en otra pestaña)">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver comprobante
                                        </a>
                                    <form action="{{url("/aceptar_voucher/{$alumno->id_voucher}")}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                    </form>

                                        <button id="{{$alumno->id_voucher}}" type="button" class="btn btn-danger btn-sm rechazar">Rechazar</button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </x-panel.tabla>
                </x-panel.tarjeta>
            </div>

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
    <div class="modal fade" id="modal_modificar" tabindex="-1" role="dialog" aria-labelledby="modal_modificar-titulo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_modificar-titulo">Rechazar voucher</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_modificar">
                    </div>
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
                'aria-label': 'Vouchers pendientes de validación'
            });
            $("#table_enviado").on('click','.editar',function(){
                var id_validar_carga=$(this).attr('id');
                $.get("/ingles/modificar_carga_academica_ingles/"+id_validar_carga,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });
            });
            $("#table_enviado").on('click','.rechazar',function(){
                var id_voucher=$(this).attr('id');
                $.get("/ingles/modificar_voucher_ingles/"+id_voucher,function (request) {
                    $("#contenedor_modificar").html(request);
                    $("#modal_modificar").modal('show');
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

        .tesvb-contenido > main .rechazar {
            background: #a61b2b;
            border-color: #a61b2b;
            color: #fff;
        }

        .tesvb-contenido > main .rechazar:hover {
            background: #861222;
            border-color: #861222;
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

        .dark #contenedor_modificar :is(h4, label) {
            color: #f2f4f7 !important;
        }

        .dark #contenedor_modificar textarea {
            background-color: #101828;
            border-color: #667085;
            color: #f2f4f7;
        }
    </style>
@endsection
