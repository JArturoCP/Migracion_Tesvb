@extends('layouts.panel')
@section('title', 'Unidades administrativas')
@include('partials.panel.recursos_app')
@section('content')
    <main class="tw-pantalla tw:w-full tw:lg:w-full tw:px-2">
        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">

        <nav aria-label="Ruta de navegación" class="tw:mb-5 tw:flex tw:flex-wrap tw:items-center tw:gap-x-2 tw:gap-y-1 tw:text-sm tw:text-gray-500">
            <span class="fa fa-arrow-right tw:text-brand-500"></span>
            <a class="tw:text-gray-500 tw:hover:text-brand-500 tw:dark:text-gray-400" href="{{url("auditorias/procesos/")}}">Procesos</a>

        </nav>
        </div>

        <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                    <a href="#" data-toggle="modal" data-target="#modal_crear" class="add_proceso tw:float-right" data-type="2"><span class="fa fa-plus" data-toggle="tooltip" title="Agregar Unidad Administrativa"></span></a>
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Unidades Administrativas del proceso:  <br>
                        {{$id->des_proceso}}
                    </h3>
                </div>
                    <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla tw-tabla-bordes">
                            <thead>
                            <th>Unidad Administrativa</th>
                            </thead>
                            <tbody>
                            @foreach($procesos as $proceso)
                                <tr>
                                    <td>
                                        {{$proceso->nom_departamento}}
                                        <a href="#!" class="btn_delete_proceso tw:float-right" data-id="{{$proceso->id_proceso_unidad}}" data-toggle="tooltip" title="Eliminar"><span class="fa fa-trash"></span></a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
</div>
                    </div>
            </div>
        </div>
    </main>

    <form id="form_proceso_crea" class="" role="form" method="POST" action="{{url("auditorias/procesos_unidad")}}">
        <x-panel.modal id="modal_crear" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="exampleModalLabel">Agregar Unidad Administrativa</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <input type="hidden" name="proceso" value="{{$id->id_proceso}}">

                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" name="id_admin" id="id_admin">
                                        <option value="" disabled="true" selected="true">Seleccione una opción</option>
                                        @foreach($unidades as $unidad)
                                            <option value="{{$unidad->id_unidad_admin}}">{{$unidad->nom_departamento}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Cancelar</button>
                        <input id="save_unidad" type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" value="Guardar"/>
                    </div>
                
            
        </x-panel.modal>
    </form>
    <form  method="POST" role="form" id="form_delete_proceso">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
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
                            $("#form_delete_proceso").attr("action","/auditorias/procesos_unidad/"+id)
                            $("#form_delete_proceso").submit();
                        }
                        else if (result.dismiss === Swal.DismissReason.cancel) { //Si presionas boton cancelar
                            swal.close()
                        }
                    });
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection