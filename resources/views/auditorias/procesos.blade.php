@extends('layouts.panel')
@section('title', 'Procesos')
@include('partials.panel.recursos_app', ['datatables' => true])
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
                    <a href="#" class="add_proceso tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar proceso"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Procesos</h3>
                </div>
                @if(sizeof($procesos)>0)
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes" id="paginar_table">
                            <thead>
                                <tr>
                                <th rowspan="2">Nombre</th>
                                <th>Sistema</th>
                                <th rowspan="2">Acciones</th>
                                </tr>
                                <tr>
                                    <th>
                                    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">COCODI</div>
                                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">SGOE</div>
                                        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">Auditorias Internas</div>
                                    </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($procesos as $proceso)
                                <tr>
                                    <td><strong>{{$proceso->clave.' '}}</strong>{{\App\audParseCase::parseProceso($proceso->des_proceso)}}</td>
                                    <td class="tw:text-center">
                                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <input type="radio" name="sistemas{{$proceso->id_proceso}}" data-id="{{$proceso->id_proceso}}" data-value="1" class="sistema" {{$proceso->id_sistema==1?'checked':''}}>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <input type="radio" name="sistemas{{$proceso->id_proceso}}" data-id="{{$proceso->id_proceso}}" data-value="2" class="sistema" {{$proceso->id_sistema==2?'checked':''}}>
                                            </div>
                                            <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
                                                <input type="radio" name="sistemas{{$proceso->id_proceso}}" data-id="{{$proceso->id_proceso}}" data-value="3" class="sistema" {{$proceso->id_sistema==3?'checked':''}}>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="tw:text-center">
                                        <a href="#!" class="btn_edit_proceso tw:float-left" data-all="{{$proceso}}" data-toggle="tooltip" title="Editar proceso"><span class="fa fa-cog"></span></a>
                                        <a href="#!" class="btn_delete_proceso tw:float-right" data-id="{{$proceso->id_proceso}}" data-toggle="tooltip" title="Eliminar proceso"><span class="fa fa-trash"></span></a>
                                        <a href="{{url('/auditorias/procesos',$proceso->id_proceso)}}" class="" data-id="{{$proceso->id_proceso}}" data-toggle="tooltip" title="Ver unidades administrativas"><span class="fa fa-list"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
</div>
                        <a href="#" class="add_proceso tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar proceso"></span></a>
                    </div>
                @endif
            </div>
        </div>
    </main>


    <x-panel.modal id="modal_add_proceso" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Registro de proceso</h4>
                </div>
                <form id="form_add_proceso" class="" role="form" method="POST" action="{{url('/auditorias/procesos')}}">
                    @csrf
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="nuevo_proceso">Clave</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="clave" type="text" placeholder="Clave del proceso">
                        </div>
                        <div class="tw:mb-4">
                            <label for="nuevo_proceso">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="des_proceso" placeholder="Descripción del proceso"></textarea>
                        </div>
                        <div class="tw:mb-4">
                            <label for="id_sistema">Sistema</label>
                            <select name="id_sistema" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option value="" selected disabled="true">Selecciona...</option>
                                @foreach($sistemas as $sistema)
                                    <option value="{{$sistema->id_sistema}}">{{$sistema->desc_sistema}}</option>
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

    <x-panel.modal id="modal_edit_proceso" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Editar proceso</h4>
                </div>
                <form id="form_edit_proceso" class="" role="form" method="POST" action="{{url('/auditorias/procesos')}}">
                    @csrf
                    @method('PUT')
                    <div class="tw-modal-cuerpo">
                        <div class="tw:mb-4">
                            <label for="nuevo_proceso">Clave</label>
                            <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="clave" id="clave" type="text" placeholder="Clave del proceso">
                        </div>
                        <div class="tw:mb-4">
                            <label for="nuevo_proceso">Descripción</label>
                            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" name="des_proceso" id="des_proceso" placeholder="Descripción del proceso"></textarea>
                        </div>
                        <div class="tw:mb-4">
                            <label for="id_sistema">Sistema</label>
                            <select name="id_sistema" id="id_sistema" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                <option value="" selected disabled="true">Selecciona...</option>
                                @foreach($sistemas as $sistema)
                                    <option value="{{$sistema->id_sistema}}">{{$sistema->desc_sistema}}</option>
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

    <form  method="POST" role="form" id="form_delete_proceso">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>


    <script>
        $(document).ready(function () {
           $('#paginar_table').DataTable();
          //
            $('.guardar_sistema').click(function () {
                var data=[];
                $('input:radio:checked').each(function () {
                    data.push({"id_proceso":$(this).data('id'),"id_sistema":$(this).data('value')});
                });
                $.ajax({
                    url: '{{url("auditorias/procesos")}}/'+JSON.stringify(data)+'/edit',
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
                            location.reload();
                        },500);
                    }
                })
            });

            $(".add_proceso").click(function () {
                $("#modal_add_proceso").modal('show');
            });

            $('.btn_edit_proceso').click(function () {
                var datos=$(this).data('all');
                $('#form_edit_proceso').attr('action',"{{url('auditorias/procesos')}}/"+datos['id_proceso'])
                $('#clave').val(datos['clave'])
                $('#des_proceso').val(datos['des_proceso'])
                $('#id_sistema').val(datos['id_sistema'])
                $("#modal_edit_proceso").modal('show');

            });

            $(".btn_delete_proceso").click(function(){
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
                        $("#form_delete_proceso").attr("action","/auditorias/procesos/"+id)
                        $("#form_delete_proceso").submit();
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