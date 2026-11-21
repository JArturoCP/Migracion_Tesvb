@extends('layouts.panel')
@section('title', 'Auditores')
@include('partials.panel.recursos_app')
@section('content')
    @if(\Illuminate\Support\Facades\Session::get('errors'))
        <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
            @foreach(\Illuminate\Support\Facades\Session::get('errors')->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
        @if(\Illuminate\Support\Facades\Session::forget('errors'))@endif
    @endif
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-6/12 tw:lg:ml-[25%] tw:px-2">
                @if (session()->has('flash_notification.message'))
                    <x-panel.alerta class="tw:mb-4" :tipo="['success' => 'exito', 'danger' => 'error', 'warning' => 'advertencia'][session('flash_notification.level')] ?? 'info'">{!! session('flash_notification.message') !!}</x-panel.alerta>
                @endif
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <a href="#" class="add_auditor tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar auditor"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Auditores</h3>
                </div>
                @if(sizeof($auditores)>0)
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <tr>
                                <th class="tw:text-center" rowspan="2">Alias</th>
                                <th class="tw:text-center" rowspan="2">Nombre</th>
                                <th class="tw:text-center">Rol</th>
                                <th class="tw:text-center" rowspan="2">Acciones</th>
                            </tr>
                            <tr>
                                <td class="tw:text-center">
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-3/12 tw:px-2">Auditor Líder</div>
                                        <div class="tw:w-full tw:lg:w-3/12 tw:px-2">Auditor</div>
                                        <div class="tw:w-full tw:lg:w-3/12 tw:px-2">Auditor en Entrenamiento</div>
                                        <div class="tw:w-full tw:lg:w-3/12 tw:px-2">Ninguno</div>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                            <tbody>

                            {{--@foreach($auditores as $auditors)
                                @foreach($auditors->getAbr as $auditor1)
                                    @foreach($auditor1->abreviaciones as $auditor)
                                        <tr>
                                            <td>{{$auditor->titulo.' '.$auditors->getName[0]->nombre}}</td>
                                            <td class="tw:text-center">
                                                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                        <input type="radio" name="rol{{$auditors->id_auditores}}" data-id="{{$auditors->id_auditores}}" data-value="1" class="form-actions roles" {{$auditors->id_categoria==1?'checked':''}}>
                                                    </div>
                                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                        <input type="radio" name="rol{{$auditors->id_auditores}}" data-id="{{$auditors->id_auditores}}" data-value="2" class="form-actions roles" {{$auditors->id_categoria==2?'checked':''}}>
                                                    </div>
                                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                        <input type="radio" name="rol{{$auditors->id_auditores}}" data-id="{{$auditors->id_auditores}}" data-value="3" class="form-actions roles" {{$auditors->id_categoria==3?'checked':''}}>
                                                    </div>
                                                    <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                        <input type="radio" name="rol{{$auditors->id_auditores}}" data-id="{{$auditors->id_auditores}}" data-value="4" class="form-actions roles" {{$auditors->id_categoria==4?'checked':''}}>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="tw:text-center">
                                                <a href="#!" class="btn_delete_auditor" data-id="{{$auditors->id_auditores}}"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
--}}{{--                                @endif--}}{{--
                            @endforeach--}}
                            @foreach($auditoresT as $auditor)
                                <tr>
                                    <td>{{$auditor->alias}}</td>
                                    <td>{{$auditor->titulo.' '.$auditor->nombre}}</td>
                                    <td class="tw:text-center">
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                <input type="radio" name="rol{{$auditor->id_auditores}}" data-id="{{$auditor->id_auditores}}" id="lider{{$auditor->id_auditores}}" data-value="1" class="form-actions roles lider" {{$auditor->id_categoria==1?'checked':''}}>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                <input type="radio" name="rol{{$auditor->id_auditores}}" data-id="{{$auditor->id_auditores}}" id="auditor{{$auditor->id_auditores}}" data-value="2" class="form-actions roles auditor" {{$auditor->id_categoria==2?'checked':''}}>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                <input type="radio" name="rol{{$auditor->id_auditores}}" data-id="{{$auditor->id_auditores}}" id="entrenamiento{{$auditor->id_auditores}}" data-value="3" class="form-actions roles entrenamiento" {{$auditor->id_categoria==3?'checked':''}}>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-3/12 tw:px-2">
                                                <input type="radio" name="rol{{$auditor->id_auditores}}" data-id="{{$auditor->id_auditores}}" id="ninguno{{$auditor->id_auditores}}" data-value="4" class="form-actions roles ninguno" {{$auditor->id_categoria==4?'checked':''}}>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="tw:text-center">
                                        <a href="#!" class="btn_delete_auditor" data-id="{{$auditor->id_auditores}}" data-toggle="tooltip" title="Eliminar auditor"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
                        <button class="guardar_roles tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Guardar</button>
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
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Registro de auditores</h4>
                </div>
                <form id="form_add_auditores" class="" role="form" method="POST" action="{{url('/auditorias/auditores')}}">
                    @csrf
                    <div class="tw-modal-cuerpo">
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
                        <div class="tw:mb-4">
                            <label for="nuevo_auditor">Rol</label>
                            <select name="id_categoria" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option value="" selected disabled="true">Selecciona...</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id_categoria}}">{{$categoria->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Ok"/>
                    </div>
                </form>
            
        
    </x-panel.modal>

    <script>
        $(document).ready(function () {
            $(".lider").click(function () {
               let id =$(this).data('id');
               let el_back=$(".lider[id!='lider"+id+"']:checked");
               $("#ninguno"+el_back.data("id")).prop("checked",true);
               el_back.prop("cehcked",false);
            });

            $('.guardar_roles').click(function () {
                var data=[];
                $('input:radio:checked').each(function () {
                        data.push({"id_personas_auditoria":$(this).data('id'),"id_categoria":$(this).data('value')});
                });
                $.ajax({
                    url: '{{url("auditorias/auditores")}}/'+JSON.stringify(data)+'/edit',
                    method: 'GET',
                    data: {},
                    success: function () {
                        Swal.fire({
                            title: 'Guardado',
                            timer: 1000,
                            showConfirmButton: false,
                            type: 'success'
                        });
                        setTimeout(function () {
                            document.location.href='{{url('auditorias/auditores')}}';
                        },500);
                    }
                })
            });

            $(".add_auditor").click(function () {
                $("#modal_add_auditores").modal('show');
            });

            $(".btn_delete_auditor").click(function(){
                var id=$(this).data('id');
                swal({
                    title: "Seguro que desea eliminar?",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar',
                })
                .then((result) => {
                    if (result.value) { //Si presionas boton aceptar
                        $("#form_delete_auditor").attr("action","/auditorias/auditores/"+id)
                        $("#form_delete_auditor").submit();
                    }
                    else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                        swal.close()
                    }
                });
            });

            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@endsection