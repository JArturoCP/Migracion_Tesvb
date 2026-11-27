@extends('layouts.panel')
@section('title', 'Auditores')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Auditores" :migas="['Sistema de gestión de calidad' => null]" />
    @if(Session::get('errors'))
        <x-panel.alerta tipo="error" class="tw:mb-4">
            @foreach(Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </x-panel.alerta>
        @if(Session::forget('errors'))@endif
    @endif
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'" class="tw:mb-4">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
    <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor_lider tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-type="1"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar persona"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Auditores líderes</h3>
                </div>
                
                @if(sizeof($auditores_l)>0)
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                        <thead>
                        <th>Nombre</th>
                        <th>Acciones</th>
                       </thead>
                        <tbody>
                            @foreach($auditores_l as $auditor)
                                @if($auditor->id_categoria==1)
                                <tr>
                                    <td>{{$auditor->getAbr->abreviaciones->titulo.' '.$auditor->getName->nombre}}</td>
                                    <td class="tw:text-center"><a href="#" class="btn_delete_auditor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$auditor->id_personas_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></span></a></td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                @endif
            </div>

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar persona"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Auditores</h3>
                </div>
                @if(sizeof($auditores)>0)
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                        <thead>
                        <th>Nombre</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($auditores as $auditor)
                            @if($auditor->id_categoria==2)
                                <tr>
                                    <td>{{$auditor->getAbr->abreviaciones->titulo.' '.$auditor->getName->nombre}}</td>
                                    <td class="tw:text-center"><a href="#" class="btn_delete_auditor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$auditor->id_personas_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></span></a></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                @endif
            </div>

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor_entrenamiento tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-type="3"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar persona"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Auditores en entrenamiento</h3>
                </div>
                @if(sizeof($auditores_e)>0)
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla">
                        <thead>
                        <th>Nombre</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody>
                        @foreach($auditores_e as $auditor)
                            @if($auditor->id_categoria==3)
                                <tr>
                                    <td>{{$auditor->getAbr->abreviaciones->titulo.' '.$auditor->getName->nombre}}</td>
                                    <td class="tw:text-center"><a href="#" class="btn_delete_auditor tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" data-id="{{$auditor->id_personas_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></span></a></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                @endif
            </div>
        </div>
    </main>

    <form  method="POST" role="form" id="form_delete_auditor">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>

    <x-panel.modal id="modal_add_auditores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Registro de auditores</h4>
                </div>
                <form id="form_add_auditores" class="" role="form" method="POST" action="{{url('/sgc/auditores')}}">
                    @csrf
                    <div class="tw-modal-cuerpo">
                        <input type="text" id="id_categoria" name="id_categoria" hidden>
                        <div class="tw:mb-4">
                            <label for="nuevo_auditor">Nuevo Auditor</label>
                            <select name="nuevo_auditor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option value="" selected disabled="true">Selecciona...</option>
                                @foreach($personas as $persona)
                                    @foreach($persona->abreviaciones_prof as $persona_abr)
                                        <option value="{{$persona->id_personal}}">{{$persona_abr->getAbreviatura[0]->titulo.' '.$persona->nombre}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" value="Ok"/>
                    </div>
                </form>
            </x-panel.modal>

    <script>
        $(document).ready(function () {
            $(".add_auditor_lider, .add_auditor, .add_auditor_entrenamiento").click(function () {
                $("#id_categoria").attr('value',$(this).data('type'));
                $("#modal_add_auditores").modal('show');
            });

            $(".btn_delete_auditor").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#form_delete_auditor").attr("action","/sgc/auditores/"+id)
                            $("#form_delete_auditor").submit();
                        }
                    });
            });

            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

</div>
@endsection