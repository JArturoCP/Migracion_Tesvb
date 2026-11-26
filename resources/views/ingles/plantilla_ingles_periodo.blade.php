@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Agregar plantilla de ingles')
@section('content')
    <main class="ingles-catalogo tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Agregar plantilla al periodo</h1>

        <div class="tw:grid tw:min-w-0 tw:gap-4 tw:lg:grid-cols-2">
            <section class="tw:min-w-0">
                <x-panel.tarjeta :sin-relleno="true">
                    <div class="tw:space-y-4 tw:p-4">
                        <h2 class="tw:m-0 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Facilitadores disponibles</h2>
                        <table id="paginar_table" class="table tw-tabla tw:mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Agregar facilitador a plantilla</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($profesores as $profesor)
                                    <tr>
                                        <td>{{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</td>
                                        <td class="text-center" data-search="" data-order="">
                                            <button type="button" class="btn btn-primary agrega" id="{{ $profesor->id_profesores }}"><i class="glyphicon glyphicon-log-in em2" aria-hidden="true"></i> Agregar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-panel.tarjeta>
            </section>
            <section class="tw:min-w-0">
                <x-panel.tarjeta :sin-relleno="true">
                    <div class="tw:space-y-4 tw:p-4">
                        <h2 class="tw:m-0 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Facilitadores en la plantilla</h2>
                        <table id="paginar_plantilla" class="table tw-tabla tw:mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($profesores_periodo as $profesor_periodo)
                                    <tr>
                                        <td>{{ $profesor_periodo->nombre }} {{ $profesor_periodo->apellido_paterno }} {{ $profesor_periodo->apellido_materno }}</td>
                                        <td class="text-center" data-search="" data-order="">
                                            <button type="button" class="btn btn-default eliminar" id="{{ $profesor_periodo->id_profesores }}"><span class="glyphicon glyphicon-trash em2" aria-hidden="true"></span> Quitar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-panel.tarjeta>
            </section>
        </div>
    </main>
    <!-- Modal para agregar plantilla-->
    <form  class="form" role="form" action="{{url("/agregar_profesor/agregar_ingles_plantilla/")}}" method="POST">
        <div class="modal fade bs-example-modal-sm ingles-catalogo-modal" id="modal_asignar_plantilla" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Asignar a plantilla</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div id="contenedor_asignar_plantilla">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary acepta">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- eliminar profesor plantilla -->
    <div id="modal_eliminar_profesor_plantilla" class="modal fade bs-example-modal-sm ingles-catalogo-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-eliminar-plantilla">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{url("/profesor_ingles/eliminar/")}}" method="POST" role="form" >
                    <div class="modal-body">
                        {{method_field('DELETE') }}
                        {{ csrf_field() }}
                        <p id="titulo-eliminar-plantilla">¿Realmente deseas eliminar este profesor?</p>
                        <input type="hidden" id="id_prof" name="id_prof" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input id="confirma_elimina_oficio" type="submit" class="btn btn-danger" value="Aceptar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready( function() {
            $("#paginar_table").on('click','.agrega',function(){
                var id_profesor=$(this).attr('id');


                $.get("/agregar_profesor/ingles_plantilla/"+id_profesor,function (request) {
                    $("#contenedor_asignar_plantilla").html(request);
                    $("#modal_asignar_plantilla").modal('show');
                });
            });
            $("#paginar_plantilla").on('click','.eliminar',function(){
                var id_profesor=$(this).attr('id');
                $('#id_prof').val(id_profesor);
                $('#modal_eliminar_profesor_plantilla').modal('show');

            });

            $('#paginar_table').DataTable( {

            } );
            $('#paginar_plantilla').DataTable( {

            } );
        });
    </script>

    <style>
        .dark .ingles-catalogo-modal .modal-content,
        .dark .ingles-catalogo-modal .modal-header {
            background: #1d2939;
            color: #f2f4f7;
            border-color: #475467;
        }
        .dark .ingles-catalogo-modal .modal-footer {
            border-color: #475467;
        }
        .dark .ingles-catalogo-modal .close {
            color: #f2f4f7;
            opacity: 1;
            text-shadow: none;
        }
        .dark .ingles-catalogo-modal input.form-control {
            background: #101828;
            color: #f2f4f7;
            border-color: #667085;
        }
    </style>
    <style>
        .ingles-catalogo .btn-primary,
        .ingles-catalogo-modal .btn-primary {
            background: #3538cd;
            border-color: #3538cd;
            color: #fff;
        }
        .ingles-catalogo .btn-primary:hover,
        .ingles-catalogo-modal .btn-primary:hover {
            background: #2d31a6;
            border-color: #2d31a6;
            color: #fff;
        }
        .ingles-catalogo .btn:focus-visible,
        .ingles-catalogo-modal .btn:focus-visible {
            outline: 2px solid #3538cd;
            outline-offset: 2px;
        }
        .dark .ingles-catalogo .btn:focus-visible,
        .dark .ingles-catalogo-modal .btn:focus-visible {
            outline-color: #a4bcfd;
        }
        .dark .ingles-catalogo table.dataTable tbody tr,
        .dark .ingles-catalogo table.dataTable tbody td {
            background-color: #1d2939;
            color: #e4e7ec;
        }
        .dark .ingles-catalogo table.dataTable tbody tr:hover td {
            background-color: #25324a;
        }
        .dark .ingles-catalogo .dataTables_paginate .pagination > li > a {
            background: #1d2939;
            border-color: #475467;
            color: #e4e7ec;
        }
        .dark .ingles-catalogo .dataTables_paginate .pagination > .active > a {
            background: #3538cd;
            color: #fff;
        }
        .dark .ingles-catalogo .dataTables_paginate .pagination > .disabled > a {
            color: #98a2b3;
        }
    </style>
@endsection