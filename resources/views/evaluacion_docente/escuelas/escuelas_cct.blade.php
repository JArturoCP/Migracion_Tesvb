@extends('layouts.panel')
@section('title', 'Instituciones educativas')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">


    <main class="tw:w-full tw:lg:w-full tw:px-2">




        <x-panel.encabezado titulo="Instituciones educativas" :migas="['Servicios escolares' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2 tw:text-center"  >
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2 tw:text-center"  >
                <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar instituciones" data-target="#modal_crear" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                    <span class="fa fa-plus" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="paginar_table" class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>CCT</th>
                        <th>NOMBRE DE LA INSTITUCIÓN</th>
                        <th>DOMICILIO</th>
                        <th>MUNICIPIO</th>
                        <th>LOCALIDAD</th>
                        <th>TURNO</th>
                        <th>SERVICIO</th>
                        <th>EDITAR</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($escuelas as $escuela)
                        <tr>
                            <td>{{$escuela->cct}}</td>
                            <td>{{$escuela->nombre_escuela}}</td>
                            <td>{{$escuela->domicilio}}</td>
                            <td>{{$escuela->municipio}}</td>
                            <td>{{$escuela->localidad}}</td>
                            <td>{{$escuela->turno}}</td>
                            <td>{{$escuela->servicio}}</td>
                            <td class="tw:text-center">
                                <a class="modificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $escuela->id_institucion }}"><span class="fa fa-pencil-square-o " aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>

        <x-panel.modal id="modal_modificar_esc" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                    <form id="form" class="" action="{{url("/cct/guardar_modificacion/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Escuela de Procedencia</h4>
                        </div>
                        <div class="tw-modal-cuerpo">
                            <div id="contenedor_modificar_esc">
                            </div>
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button     type="submit"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  >Guardar</button>
                        </div>
                    </form>
                </x-panel.modal>

        <x-panel.modal id="modal_crear" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                        <div class="tw:px-6 tw:pt-6 tw:pr-14">
                            
                            <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Agregar Escuela de Procedencia</h4>
                        </div>
                    <form id="form_agregar" class="" action="{{url("/cct/guardar_institucion_educativa/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw-modal-cuerpo">
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="cct">CCT de la Institución educativa</label>

                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="cct" name="cct" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="3"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="nombre_escuela">Nombre de la Institución educativa</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="nombre_escuela" name="nombre_escuela" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="domicilio">Domiclio de la Institución educativa</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="domicilio" name="domicilio" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="municipio">Municipio de la Institución educativa</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="municipio" name="municipio" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="localidad">Localidad de la Institución educativa</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="localidad" name="localidad" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="turno">Turno de la Institución educativa</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="turno" name="turno" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4">
                                        <label for="servicio">Servicio de la Institución educativa</label>
                                        <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="servicio" name="servicio" rows="3" onkeyup="javascript:this.value=this.value.toUpperCase();"  required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button     type="button"  id="guardar_institucion" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  >Guardar</button>
                        </div>

                </x-panel.modal>

    <script>
        $(document).ready(function() {
            $('#paginar_table').DataTable();
            $("#paginar_table").on('click','.modificar',function(){
                var id_institucion=$(this).attr('id');
                $.get("/cct/registros_modificar/"+id_institucion,function (request) {
                    $("#contenedor_modificar_esc").html(request);
                    $("#modal_modificar_esc").modal('show');
                });

            });
            $("#guardar_institucion").click(function (){
                var cct = $("#cct").val();
                var nombre_escuela = $("#nombre_escuela").val();
                var domicilio = $("#domicilio").val();
                var municipio = $("#municipio").val();
                var localidad = $("#localidad").val();
                var turno = $("#turno").val();
                var servicio = $("#servicio").val();

                if (cct != "" && nombre_escuela !=""  && domicilio !="" && municipio !="" && localidad !="" && turno != "" && servicio !="") {
                    $("#guardar_institucion").attr("disabled", true);
                    $("#form_agregar").submit();
                    swal({
                        position: "top",
                        type: "success",
                        title: "Registro exitoso",
                        showConfirmButton: false,
                        timer: 3500
                    });

                }
                else{
                    swal({
                        position: "top",
                        type: "warning",
                        title: "Algún campo se encuentra  vacío.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
            });
        });
    </script>

</div>
@endsection
