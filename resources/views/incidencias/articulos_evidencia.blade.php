@extends('layouts.panel')
@section('title','Incidencias')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<main class="tw:w-full tw:lg:w-full tw:px-2">
            <x-panel.encabezado titulo="Evidencia a subir" :migas="['Incidencias' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-2/12 tw:lg:grow tw:px-2">
            <x-panel.alerta tipo="exito" class="tw:mb-4">
                <strong>Nota: </strong> Puedes agregar otro tipo de evidencia si así se requiere.
            </x-panel.alerta>
        </div>

        <div class="tw:w-full tw:lg:w-1/12 tw:lg:grow tw:px-2">
            <a class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" href="{{url('incidencias/cargar_otra_evidencia')}}">Agregar</a>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">       
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
                    <thead>
                     <tr>
                         <th class="tw:text-center"> Artículo que requiere evidencia</th>
                         <th class="tw:text-center">Motivo de oficio</th>
                         <th class="tw:text-center">Fecha requerida</th>
                         <th class="tw:text-center">Fecha ultima para subir la evidencia</th>
                         <th class="tw:text-center">Agregar evidencia</th>
                     </tr>
                    </thead>
                    <tbody>
                        @foreach($eviden as $evidArt)

                     <tr>
                                        @if($evidArt->arch_evidencia == null)

                                                                            @if($evidArt->id_estado_solicitud==2)
                                                                              <?php
                                        $date_now = $evidArt->fecha_req;
                                        $date_future = strtotime('+5 days', strtotime($date_now));
                                        $date_future = date('Y-m-d', $date_future);
                                                                              ?>
                                        <th>{{$evidArt->nombre_articulo}}</th>
                                                                                  <th>{{ $evidArt->motivo_oficio }}</th>
                                        <th>{{$evidArt->fecha_req}}</th>
                                        <th> {{$date_future}}</th>
                                        <th>
                                            @if($evidArt->arch_evidencia==null)
                                                @if( $fechaact>=$evidArt->fecha_req  && $fechaact<= $date_future)
                                                    <button class="agregar tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap" id="{{ $evidArt->id_evid }}">Agregar</button>
                                                  {{--  <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{url('incidencias/cargar_evidencia',$evidArt->id_evid)}}">Agregar</a>--}}
                                                @elseif($fechaact> $date_future)
                                                        <p>Has olvidado subir tu evidencia</p>
                                                    @else
                                                    <p>Podras subir tu evidencia el dia requerido hasta 5 dias habiles despues</p>
                                                @endif

                                            @else
                                            <a  target="_blank" href="/incidencias/{{$evidArt->arch_evidencia}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap">Ver evidencia </a>
                                            @endif
                                        </th>
                                    @endif
                                
                                @endif
                     </tr>
                        @endforeach
                    </tbody>
                </table>
</div>
            </div>
        </div>


  </main>

<form id="form_registrar" action="{{url("/incidencias/cargando_evidencia_oficio")}}" role="form" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <x-panel.modal id="modal_agregar" tamano="md" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                <div class="tw:px-6 tw:pt-6 tw:pr-14">
                    
                    <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Agregar evidencia</h4>
                </div>
                <div class="tw-modal-cuerpo">
                    <div id="contenedor_agregar">

                    </div>

                </div>
                <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" >Aceptar</button>
                </div>
            </x-panel.modal>
</form>
<script type="text/javascript">

    $(document).ready( function() {
        $(".agregar").click(function (){
            var id_evid=$(this).attr('id');

            $.get("/incidencias/ver_datos_oficio_evidencia/"+id_evid,function (request) {
                $("#contenedor_agregar").html(request);
                $("#modal_agregar").modal('show');
            });

        });

    });
</script>

</div>
@endsection