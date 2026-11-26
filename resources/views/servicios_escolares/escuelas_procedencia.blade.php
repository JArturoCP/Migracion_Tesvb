@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app', ['datatables' => true, 'validacion' => true])
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Agregar escuelas de procedencia" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2 tw:text-center"  >
    <button data-toggle="modal"  data-tooltip="true" data-placement="left" title="Agregar escuela" data-target="#modal_crear" type="button" class="flotante tw:fixed tw:right-6 tw:bottom-6 tw:z-40 tw:inline-flex tw:size-14 tw:items-center tw:justify-center tw:rounded-full tw:bg-brand-500 tw:text-xl tw:text-white tw:shadow-theme-lg tw:hover:bg-brand-600">
        <span class="fa fa-plus" aria-hidden="true"></span>
    </button>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw:w-full tw-tabla tw-tabla-rayas tw:lg:w-full tw:px-2" id="tabla_escuela">
                <thead class="">
                <tr class="tw:text-center">
                    <th class="tw:text-center">No.</th>
                    <th class="tw:text-center">NOMBRE DE LA ESCUELA</th>
                    <th class="tw:text-center">MUNICIPIO</th>
                    <th class="tw:text-center">ESTADO</th>
                    <th class="tw:text-center">MODIFICAR</th>
                </tr>
                </thead>
                <?php $i=0; ?>
                    @foreach($escuelas as $escuela)
                        <?php $i++; ?>
                    <tr class="tw:text-center">
                        <td class="tw:text-center">{{$i}}</td>
                        <td class="tw:text-center">{{$escuela->nombre_escuela}}</td>
                        <td class="tw:text-center">{{$escuela->municipio}}</td>
                        <td class="tw:text-center">{{$escuela->estado}}</td>
                        <td class="tw:text-center">
                            <a class="modificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" id="{{ $escuela->id_escuela_procedencia }}"><span class="fa fa-pencil-square-o " aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
            </table>
</div>
        </div>
    </div>
    <x-panel.modal id="modal_crear" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="exampleModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="exampleModalLabel">Agregar escuela de procedencia</h4>
                </div>
                <div class="tw-modal-cuerpo">

                    <form id="form_agregar" class="" action="{{url("/registrar/escuela_procedencia/")}}" role="form" method="POST" >
                        {{ csrf_field() }}
                         <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                             <div class="tw:w-full tw:px-2">
                                 <div class="tw:mb-4">
                                     <label for="nombre_escuela">Nombre de la escuela</label>
                                     <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" id="nombre_escuela" name="nombre_escuela" rows="3" placeholder="Ingresa el nombre de la escuela"style="" required></textarea>
                                </div>
                             </div>
                         </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                            <div class="tw:w-full tw:px-2">
                                <div class="tw:mb-4">
                                    <label for="estado">Nombre del Estado</label>
                                    <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"  id="estado" name="estado" required>
                                        <option disabled selected hidden>Selecciona una opción</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id_estado}}"> {{$estado->nombre_estado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                        <div class="tw:w-full tw:px-2">
                            <div class="tw:mb-4">
                                <label for="exampleInputEmail1">Municipio o Ciudad de la comisión<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg" >*</b></label>
                                <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"placeholder="selecciona una Opcion" id="municipios" name="municipios" value="">
                                    <option disabled selected hidden>Selecciona una opción</option>
                                </select>
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
    <x-panel.modal id="modal_modificar_esc" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <form id="form_mod_periodo_ingles" class="" action="{{url("/modificacion/escuela_procedencia/")}}" role="form" method="POST" >
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
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#tabla_escuela').DataTable();
            $("#tabla_escuela").on('click','.modificar',function(){
                var id_escuela=$(this).attr('id');
                $.get("/escuela_procedencia/modificar/"+id_escuela,function (request) {
                    $("#contenedor_modificar_esc").html(request);
                    $("#modal_modificar_esc").modal('show');
                });

            });
            $("#estado").change(function(e){
                var id_estado= e.target.value;
                $.get('/ajax-subcat?id_estado=' + id_estado,function(data){

                    $('#municipios').empty();
                    ;
                    $.each(data,function(datos_alumno,subcatObj){
                        //  TNotify.alert(subcatObj);
                        $('#municipios').append('<option value="'+subcatObj.id_municipio+'" data-muni="'+subcatObj.nombre_municipio+'" >'+subcatObj.nombre_municipio+'</option>');
                    });
                });
            });
            $("#form_agregar").validate({
                rules: {
                    nombre_escuela : "required",
                    estado: "required",
                },
            });
        });
    </script>
</div>
@endsection
