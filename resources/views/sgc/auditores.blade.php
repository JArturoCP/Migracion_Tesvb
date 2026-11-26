@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Auditores')
@section('content')
    @if(Session::get('errors'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
            @foreach(Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
        @if(Session::forget('errors'))@endif
    @endif
    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }} tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm">
                        <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor_lider tw:float-right" data-type="1"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar persona"></span></a>
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Auditores Líderes</h3>
                </div>
                @if(sizeof($auditores_l)>0)
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
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
                                    <td class="tw:text-center"><a href="#" class="btn_delete_auditor" data-id="{{$auditor->id_personas_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></span></a></td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                @endif
            </div>

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar persona"></span></a>
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Auditores</h3>
                </div>
                @if(sizeof($auditores)>0)
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
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
                                    <td class="tw:text-center"><a href="#" class="btn_delete_auditor" data-id="{{$auditor->id_personas_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></span></a></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
</div>
                </div>
                @endif
            </div>

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor_entrenamiento tw:float-right" data-type="3"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar persona"></span></a>
                    <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Auditores en entrenamiento</h3>
                </div>
                @if(sizeof($auditores_e)>0)
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
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
                                    <td class="tw:text-center"><a href="#" class="btn_delete_auditor" data-id="{{$auditor->id_personas_auditoria}}"><span class="fa fa-trash" data-toggle="tooltip" title="Eliminar"></span></a></td>
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

    <div class="modal fade tw-modal-compat" id="modal_add_auditores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Registro de auditores</h4>
                </div>
                <form id="form_add_auditores" class="" role="form" method="POST" action="{{url('/sgc/auditores')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="text" id="id_categoria" name="id_categoria" hidden>
                        <div class="tw:mb-4">
                            <label for="nuevo_auditor">Nuevo Auditor</label>
                            <select name="nuevo_auditor" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option value="" selected disabled="true">Selecciona...</option>
                                @foreach($personas as $persona)
                                    @foreach($persona->abreviaciones_prof as $persona_abr)
                                        <option value="{{$persona->id_personal}}">{{$persona_abr->getAbreviatura[0]->titulo.' '.$persona->nombre}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

@endsection