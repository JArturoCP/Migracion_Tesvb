@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Especialidades Programas de estudio" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">


                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:lg:max-w-2xl tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="exampleInputEmail1">Elige carrrera<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="carrera" name="carrera" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($carreras as $carrera)
                                            @if($carrera->id_carrera==$id_carrera)
                                                <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                            @else
                                                <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @if($no_seleccion == 0)
                          @else
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2 tw:text-center"  >
                                <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar especialidad" data-target="#modal_crear" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>

                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_especialidades" class="tw-tabla tw-tabla-bordes">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nombre de la especialidad</th>
                                    <th>Carrera</th>
                                    <th>Modificar</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php $i=1;?>
                                @foreach($especialidades as $especialidad)
                                    <tr>
                                        <th>{{$i++}}</th>
                                        <td>{{ $especialidad->especialidad }}</td>
                                        <td>{{ $especialidad->nombre }}</td>
                                        <td class="tw:text-center">
                                            <a class="modificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $especialidad->id_especialidad }}"><span class="fa fa-pencil-square-o " aria-hidden="true"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
                        </div>
                        </div>

                          @endif
                    </div>

            </div>
        </div>
    </div>


    <x-panel.modal id="modal_modificar_especialidades" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar nombre de la especialidad</h4>
                    </div>
                    <div class="tw-modal-cuerpo">
                        <div id="contenedor_modificar_especialidades">
                        </div>
                    </div>
                    <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                        <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                        <button     id="guardar_modificacion_especialidad"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  >Guardar</button>
                    </div>

            </x-panel.modal>

    <x-panel.modal id="modal_crear" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar especialidad</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/registrar/especialidad/$id_carrera")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="nombre_escuela">Nombre de la especialidad</label>
                                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="nombre_especialidad" name="nombre_especialidad"   required/>
                                </div>
                            </div>
                        </div>
                        <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Guardar</button>
                        </div>
                    </form>
                </div>
            </x-panel.modal>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#guardar_modificacion_especialidad").click(function (event) {
                var especialidad= $("#especialidad").val();
                var id_especialidad= $("#id_especialidad").val();

                if (especialidad != "") {

                    var especialidad=especialidad.toUpperCase();

                    window.location.href='/especialidades/modificacion_especialidad/'+id_especialidad+'/'+especialidad;


                } else {
                    swal({
                        position: "top",
                        type: "error",
                        title: "hay un campo vacio",
                        showConfirmButton: false,
                        timer: 3500
                    });
                }

            });
            $("#carrera").on('change',function(e){
                var carrera= $("#carrera").val();
                window.location.href='/servicios_escolares/especialidades/carreras/'+carrera ;


            });
            $("#tabla_especialidades").on('click','.modificar',function(){
                var id_especialidad=$(this).attr('id');
                $.get("/especialidades/modificar/"+id_especialidad,function (request) {
                    $("#contenedor_modificar_especialidades").html(request);
                    $("#modal_modificar_especialidades").modal('show');
                });


            });
        });
    </script>
</div>
@endsection