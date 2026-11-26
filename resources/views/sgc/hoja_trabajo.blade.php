@extends('layouts.panel')
@include('partials.panel.recursos_app')
    @section('title', 'Hoja de trabajo')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a href="{{url('/sgc/auditorias')}}">Planes de auditorias</a>
                    <span class="fa fa-chevron-right"></span>
                    <a href="{{url('sgc/ver_plan_auditoria')}}/{{$auditoria->id_auditoria}}">Detalles del Plan</a>
                    <span class="fa fa-chevron-right"></span>
                    <a href="{{url('/sgc/agenda')}}/{{$auditoria->id_auditoria}}">Agenda</a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Hoja de Trabajo</span>
                </p>

                @if(Session::get('errors'))
                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
                    @foreach(Session::get('errors')->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </div>
                @endif
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Hoja de trabajo</h3>
                    </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <form action="{{url('sgc/hoja_trabajo')}}" method="POST">
                            @csrf
                            <div>
                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                    <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                        <strong>Área:</strong>
                                        @foreach($agenda as $datosA)
                                            {{$datosA->area[0]->nom_departamento}}
                                            <input type="text" name="id_agenda" hidden value="{{$datosA->id_agenda}}">
                                        @endforeach
                                    </div>
                                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                        <strong>Auditoria No.</strong>
                                        {{date('Y',strtotime($auditoria->getAuditoria->fecha_i)).'-'.$auditoria->getAuditoria->id_auditoria}}
                                    </div>
                                    <div class="tw:w-full tw:lg:w-8/12 tw:px-2">
                                        <strong>Auditado:</strong>
                                        @foreach($agenda as $datosA)
                                            {{$datosA->area[0]->nom_departamento}}
                                        @endforeach

                                    </div>
                                    <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                        <strong>Fecha:</strong>
                                        @foreach($agenda as $datosA)
                                            {{$datosA->fecha}}
                                            <input type="text" name="fecha" hidden value="{{$datosA->fecha}}">
                                        @endforeach
                                    </div>
                                </div>
                                @if(!Session::get('id_reporte'))
                                    <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:float-right tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                                @endif
                            </div>
                        </form>
                        @if(Session::get('id_reporte'))
                            <hr>
                            @if(isset($array_procesos))
                                <div>
                                    <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
                                        <strong>No se encontro registro de los siguientes procesos: </strong>
                                        @foreach($array_procesos as $proceso)
                                            <p>{{$proceso}}</p>
                                        @endforeach

                                    </div>
                                </div>
                            @else
                                @if(!$notas->isEmpty())
                                    @foreach($agenda as $datosA)
                                        <button class="impPage tw:float-right tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-id="{{$datosA->id_agenda}}">Imprimir</button>
                                    @endforeach
                                @endif
                                <br><br>
                            @endif
                            <a href="#" class="btn_add_nota tw:float-right"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar nota"></span></a>
                            <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table class="tw-tabla tw-tabla-bordes">
                                <thead>
                                    <tr>
                                        <th class="tw:w-full tw:lg:w-9/12 tw:text-center tw:px-2">Notas</th>
                                        <th class="tw:w-full tw:lg:w-2/12 tw:px-2"></th>
                                        <th class="tw:w-full tw:lg:w-1/12 tw:px-2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($notas as $nota)
                                    <tr>
                                        <td>{{$nota->proceso}} {{$nota->descripcion}}</td>
                                        <td>{{$nota->getClasificacion->descripcion}}</td>
                                        <td class="tw:text-center"><a href="#"><span class="fa fa-trash"></span></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <form  method="POST" role="form" id="form_delete_norma">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <div class="modal fade tw-modal-compat" id="modal_add_nota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form_add_nota" class="" role="form" method="POST" action="{{url('sgc/notas')}}">
                    <div class="modal-header">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Agregar nota a la hoja de trabajo</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="tw:mb-4">
                            <label for="proceso">Proceso auditado</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="proceso">
                        </div>
                        <div class="tw:mb-4">
                            <label for="descripcion">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion"></textarea>
                        </div>
                        <div class="tw:mb-4">
                            <label for="procesos">Clasificacion</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="clasificacion">
                                <option value="" selected disabled>Selecciona...</option>
                                <option value="1">NC</option>
                                <option value="2">AM</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $(".btn_delete_nota").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_delete_norma").attr("action","/sgc/notas/"+id)
                            $("#form_delete_norma").submit();
                        }
                    });
            });

            $('.btn_add_nota').click(function () {
                $('#modal_add_nota').modal('show');
            });

            $(".impPage").click(function () {
                window.open('{{url('sgc/print_page_job')}}/'+$(this).data('id'),'_blank',"fullscreen=yes");
            });

            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
















