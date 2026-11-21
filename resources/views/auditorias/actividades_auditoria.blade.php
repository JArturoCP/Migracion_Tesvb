@extends('layouts.panel')
@section('title', 'Actividades para la agenda')
@include('partials.panel.recursos_app')
@section('content')
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
                    <a href="#" class="add_actividad tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar actividad"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Actividades para la agenda</h3>
                </div>
                @if(sizeof($actividades)>0)
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <th class="tw:lg:w-10/12">Descripción</th>
                            <th class="tw:lg:w-2/12">Acciones</th>
                            </thead>
                            <tbody>
                            @foreach($actividades as $actividad)
                                <tr>
                                    <td>{{$actividad->descripcion}}</td>
                                    <td class="tw:text-center">
                                        <a href="#!" class="btn_edit_actividad tw:float-left" data-all="{{$actividad}}" data-toggle="tooltip" title="Editar actividad"><span class="fa fa-cog"></span></a>
                                        <a href="#!" class="btn_delete_actividad tw:float-right" data-id="{{$actividad->id_actividad}}" data-toggle="tooltip" title="Eliminar actividad"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
{{--                        <a href="#" class="add_actividad tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar actividad"></span></a>--}}
                    </div>
                @else
                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <br>
                        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700 tw:px-2" role="alert">No existen actividades registradas</div>
                    </div>

                @endif
            </div>
        </div>
    </main>


    <x-panel.modal id="modal_add_actividad" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Registro de actividad</h4>
                </div>
                <form id="form_add_actividad" class="" role="form" method="POST" action="{{url('/auditorias/actividades')}}">
                    @csrf
                    <div class="tw-modal-cuerpo">
                        @if($errors->any())
                            <div class="errors tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-red-200 tw:bg-red-50 tw:text-red-700" role="alert">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="tw:mb-4">
                            <label for="descripcion">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion" placeholder="Descripción de la actividad"></textarea>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>

    <x-panel.modal id="modal_edit_actividad" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar actividad</h4>
                </div>
                <form id="form_edit_actividad" class="" role="form" method="POST" action="{{url('/auditorias/actividades')}}">
                    @csrf
                    @method('PUT')
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="descripcion">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="descripcion" id="descripcion" placeholder="Descripción de la actividad">{{old('descripcion')}}</textarea>
                        </div>
                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                </form>
            
        
    </x-panel.modal>

    <form  method="POST" role="form" id="form_delete_actividad">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>


    <script>
        $(document).ready(function () {

            $(".add_actividad").click(function () {
                $("#modal_add_actividad").modal('show');
            });

            $('.btn_edit_actividad').click(function () {
                var datos=$(this).data('all');
                $('#form_edit_actividad').attr('action',"{{url('auditorias/actividades')}}/"+datos['id_actividad'])
                $('#descripcion').val(datos['descripcion'])
                $("#modal_edit_actividad").modal('show');

            });

            $(".btn_delete_actividad").click(function(){
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
                            $("#form_delete_actividad").attr("action","/auditorias/actividades/"+id)
                            $("#form_delete_actividad").submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });
            });

            @if($errors->any())
                $('#modal_add_actividad').modal('show');
                setTimeout(function () {
                    $('.errors').fadeOut(500);
                },5000)
            @endif

            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@endsection
