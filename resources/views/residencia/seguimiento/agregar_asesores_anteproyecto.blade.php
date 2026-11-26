@extends('layouts.panel')
@section('title', 'Agregar asesores')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

    <main class="tw:w-full tw:lg:w-full tw:px-2">
        <x-panel.encabezado titulo="Anteproyectos aceptados" :migas="['Residencia profesional' => null]" />
        @if($no_plantilla ==0)
            <x-panel.alerta tipo="error" class="tw:mb-4">No se ha asignado plantilla de profesores al siguiente periodo</x-panel.alerta>

            @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>
                        <th>No.cuenta</th>
                        <th>Nombre del alumno</th>
                        <th>Nombre del anteproyecto</th>
                        <th>Nombre del asesor</th>
                        <th>Agregar asesor</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($anteproyectos as $anteproyecto)
                        <tr>
                            <td>{{$anteproyecto->cuenta}}</td>
                            <td>{{$anteproyecto->nombre}} {{$anteproyecto->apaterno}} {{$anteproyecto->amaterno}}</td>
                            <td>{{$anteproyecto->nom_proyecto}}</td>
                            @if($anteproyecto->asesor == 0)
                          <th>No tiene asesor</th>
                                @else
                                <th>{{$anteproyecto->titulo}}  {{$anteproyecto->profesor}}</th>
                           @endif

                            <td>
                                @if($anteproyecto->asesor == 0)

                                          <a href="#!" class="agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{ $anteproyecto->id_anteproyecto}}"><span class="fa fa-cog " aria-hidden="true"></span></a>


                                @else
                                    <a href="#!" class="modificar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" data-id="{{ $anteproyecto->id_anteproyecto}}"><span class="fa fa-cog " aria-hidden="true"></span></a>

                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
</div>
            </div>
        </div>
       @endif
    </main>


    <x-panel.modal id="modal_agregar_asesores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                        
                        <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Agregar Asesor</h4>
                    </div>
                    <div id="contenedor_agregar_asesores">


                    </div>



            </x-panel.modal>


    <x-panel.modal id="modal_modificar_asesores" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">

                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Asesor</h4>
                </div>
                <div id="contenedor_modificar_asesores">


                </div>



            </x-panel.modal>



    <script type="text/javascript">

        $(document).ready(function() {

            $(".agregar").click(function(){
                var id_anteproyecto=$(this).data("id");
                $.get("/residencia/mostrar_asesores_anteproyecto/"+id_anteproyecto,function(request){
                    $("#contenedor_agregar_asesores").html(request);
                    $("#modal_agregar_asesores").modal('show');

                });
            });
            $(".modificar").click(function(){
                var id_anteproyecto=$(this).data("id");
                $.get("/residencia/modificar_asesores_anteproyecto/"+id_anteproyecto,function(request){
                    $("#contenedor_modificar_asesores").html(request);
                    $("#modal_modificar_asesores").modal('show');

                });

            });
        });
    </script>
</div>
@endsection