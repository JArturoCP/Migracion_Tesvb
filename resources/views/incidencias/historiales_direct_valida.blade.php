@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title', 'Registro de Oficios enviados')
@section('content')
    <style type="text/css">

        .btn-circle {

            width: 25px;
            height: 25px;
            text-align: center;
            padding: 3px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px ;
        }
    </style>
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-9/12 tw:lg:ml-[8.3333%] tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200">
                    <li class="active" ><a href="#">Historial de oficios recibidos</a>
                    </li>
                    <li  > <a href="{{url('/incidencias/validar_oficios_departamentos')}}">Oficios recibidos para validación</a></li>
                </ul>
                <br>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">HISTORIAL DE OFICIOS DE INCIDENCIAS DE LOS DEPARTAMENTOS DEL TESVB</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="table_enviado1" class="table-responsive tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th class="tw:text-center">No.</th>
                        <th class="tw:text-center">Nombre del solicitante</th>
                        <th class="tw:text-center">Fecha de oficio</th>
                        <th class="tw:text-center">Artículo</th>
                        <th class="tw:text-center">Estatus</th>
                        <th class="tw:text-center">Oficio</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($solicitudes as $solicitud)
                                <tr>
                                    <th>{{$i++}}</th>
                                    <th>{{$solicitud->nombre}}</th>
                                    <th>{{$solicitud->fecha_req}}</th>
                                    <th>{{$solicitud->nombre_articulo}}</th>
                                <!-- <button class="edita1 tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{ $solicitud->id_solicitud }}"><i class="fa fa-list"></i></button>-->
                                    <th>
                                        @if($solicitud->id_estado_solicitud == 4)
                                            <p>Enviado a direccion</p>
                                        @else
                                            <p>Aceptado</p>
                                        @endif
                                    </th>
                                    <th>
                                        @if($solicitud->id_estado_solicitud == 2)
                                            <p>Imprime jefe de departamento o jefe de división</p>
                                        @else
                                            <p>En proceso</p>
                                        @endif
                                    </th>

                                </tr>

                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>
        <div class="modal fade tw-modal-compat" id="modal_mostrar1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header tw:bg-sky-100">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title tw:text-center" id="myModalLabel">Oficio de Incidencia</h4>
                    </div>
                    <div class="modal-body">
                        <div id="contenedor_mostrar1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function() {
            //id de la tabla                 //class de boton
            $("#table_enviado1").on('click','.edita1',function(){
                //TNotify.alert("HOLA");
                var solicitud=$(this).attr('id');
                //TNotify.alert(solicitud);
                //url de web
                $.get("/oficios/ver/"+solicitud,function (request) {
                    //contenido del modal
                    $("#contenedor_mostrar1").html(request);
                    //id del modal
                    $("#modal_mostrar1").modal('show');
                });
            });
            $('#table_enviado1').DataTable( {

            } );
        });
    </script>
@endsection