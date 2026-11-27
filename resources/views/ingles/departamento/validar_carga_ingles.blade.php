@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Validar cargas academicas de ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Cargas académicas de inglés autorizadas</h1>
            <x-panel.boton variante="secundario" href="/ingles/cargas_aut_excel/">
                <span class="fa fa-file-excel-o" aria-hidden="true"></span> Exportar cargas autorizadas
            </x-panel.boton>
        </header>

        <div id="consultar">
            <x-panel.tarjeta :sin-relleno="true">
                <x-panel.tabla id="table_enviado" class="table text-center tw:mb-0" style="min-width: 980px !important" aria-label="Cargas académicas autorizadas">
                    <thead>
                    <tr>
                        <th scope="col">No. cuenta</th>
                        <th scope="col">Nombre del usuario</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Semestre</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Permiso de modificación</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($alumnos as $alumno)
                            <tr>
                                <td >{{ $alumno->cuenta }}</td>
                                <td >{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
                                @if($alumno->genero == "M")
                                    <td>MASCULINO</td>
                                @else
                                    <td>FEMENINO</td>
                                @endif
                                <td>{{ $alumno->nivel_ingles }}</td>
                                <td>{{ $alumno->grupo_ingles }}</td>
                                <td>{{ $alumno->semestre }}</td>
                                <td>{{ $alumno->carrera }}</td>

                                 <td data-search="" data-order="">
                                    <button type="button" class="btn btn-default editar" id="{{ $alumno->id_validar_carga }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Dar permiso
                                    </button>
                                </td>

                            </tr>

                    @endforeach

                    </tbody>
                </x-panel.tabla>
            </x-panel.tarjeta>
        </div>
    </main>
    <div class="modal fade bs-example-modal-sm" id="modal_mostrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Permiso de modificación</h2>
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
                'aria-label': 'Tabla de cargas autorizadas'
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

        .dark #modal_mostrar .modal-content {
            background: #1d2939;
            color: #f2f4f7;
        }

        .dark #modal_mostrar :is(.modal-header, .modal-footer) {
            border-color: #475467;
        }

        .dark #modal_mostrar .close {
            color: #fff;
            opacity: 1;
            text-shadow: none;
        }
    </style>
@endsection
