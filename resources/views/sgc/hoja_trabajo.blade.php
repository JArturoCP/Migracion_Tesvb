@extends('layouts.panel')
    @section('title', 'Hoja de trabajo')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <p>
                    <span class="fa fa-arrow-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url('/sgc/auditorias')}}">Planes de auditorias</a>
                    <span class="fa fa-chevron-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url('sgc/ver_plan_auditoria')}}/{{$auditoria->id_auditoria}}">Detalles del Plan</a>
                    <span class="fa fa-chevron-right"></span>
                    <a class="tw:text-brand-500 tw:hover:underline" href="{{url('/sgc/agenda')}}/{{$auditoria->id_auditoria}}">Agenda</a>
                    <span class="fa fa-chevron-right"></span>
                    <span>Hoja de Trabajo</span>
                </p>

                @if(Session::get('errors'))
                    <x-panel.alerta tipo="error" class="tw:mb-4">
                    @foreach(Session::get('errors')->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </x-panel.alerta>
                @endif
                <x-panel.encabezado titulo="Hoja de trabajo" :migas="['Sistema de gestión de calidad' => null]" />
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    
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
                                    <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                                @endif
                            </div>
                        </form>
                        @if(Session::get('id_reporte'))
                            <hr>
                            @if(isset($array_procesos))
                                <div>
                                    <x-panel.alerta tipo="error" class="tw:mb-4">
                                        <strong>No se encontro registro de los siguientes procesos: </strong>
                                        @foreach($array_procesos as $proceso)
                                            <p>{{$proceso}}</p>
                                        @endforeach

                                    </x-panel.alerta>
                                </div>
                            @else
                                @if(!$notas->isEmpty())
                                    @foreach($agenda as $datosA)
                                        <button class="impPage tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-id="{{$datosA->id_agenda}}">Imprimir</button>
                                    @endforeach
                                @endif
                                <br><br>
                            @endif
                            <a href="#" class="btn_add_nota tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar nota"></span></a>
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
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
                                        <td class="tw:text-center"><a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" href="#"><span class="fa fa-trash"></span></a></td>
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

    <x-panel.modal id="modal_add_nota" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <form id="form_add_nota" class="" role="form" method="POST" action="{{url('sgc/notas')}}">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar nota a la hoja de trabajo</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        @csrf
                        <div class="tw:mb-4">
                            <label for="proceso">Proceso auditado</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="text" name="proceso">
                        </div>
                        <div class="tw:mb-4">
                            <label for="descripcion">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion"></textarea>
                        </div>
                        <div class="tw:mb-4">
                            <label for="procesos">Clasificacion</label>
                            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="clasificacion">
                                <option value="" selected disabled>Selecciona...</option>
                                <option value="1">NC</option>
                                <option value="2">AM</option>
                            </select>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Guardar"/>
                    </div>
                </form>
            </x-panel.modal>

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
</div>
@endsection
















