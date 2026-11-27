@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Vouchers rechazados')
@section('content')
    <main class="tw-modulo tw:w-full tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Vouchers rechazados</h1>

        <div id="consultar">
                <x-panel.tarjeta :sin-relleno="true">
                    <x-panel.tabla id="table_enviado" class="table text-center tw:mb-0" style="min-width: 840px !important" aria-label="Vouchers rechazados">
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
                            <td >{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_enviado').DataTable( {

            } );
            $('#table_enviado').closest('.tesvb-dt-scroll').attr({
                tabindex: 0,
                role: 'region',
                'aria-label': 'Vouchers rechazados'
            });
            $("#table_enviado").on('click','.editar',function(){
                var id_validar_carga=$(this).attr('id');
                $.get("/ingles/modificar_carga_academica_ingles/"+id_validar_carga,function (request) {
                    $("#contenedor_mostrar").html(request);
                    $("#modal_mostrar").modal('show');
                });

            });

        });
    </script>

    <style>
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
