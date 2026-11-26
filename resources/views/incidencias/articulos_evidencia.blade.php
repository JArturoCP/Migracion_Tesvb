@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title','Incidencias')
@section('content')

<main class="tw:w-full tw:lg:w-full tw:px-2">
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                <div class="tw:w-full tw:lg:w-5/12 tw:lg:ml-[33.3333%] tw:px-2">
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                            <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Evidencia a subir</h3>
                        </div>
                    </div>  
                </div>
            </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-2/12 tw:lg:ml-[16.6667%] tw:px-2">
            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
                <strong>Nota: </strong> Puedes agregar otro tipo de evidencia si así se requiere.
            </div>
        </div>

        <div class="tw:w-full tw:lg:w-1/12 tw:px-2">
            <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{url('incidencias/cargar_otra_evidencia')}}">Agregar</a>
        </div>
    </div>

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_envio" class="table-responsive tw-tabla tw-tabla-bordes">
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
                                                    <button class="agregar tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" id="{{ $evidArt->id_evid }}">Agregar</button>
                                                  {{--  <a class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" href="{{url('incidencias/cargar_evidencia',$evidArt->id_evid)}}">Agregar</a>--}}
                                                @elseif($fechaact> $date_future)
                                                        <p>Has olvidado subir tu evidencia</p>
                                                    @else
                                                    <p>Podras subir tu evidencia el dia requerido hasta 5 dias habiles despues</p>
                                                @endif

                                            @else
                                            <a  target="_blank" href="/incidencias/{{$evidArt->arch_evidencia}}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">Ver evidencia </a>
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
    <div class="modal fade bs-example-modal-lg tw-modal-compat" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-panel-modal hidden>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header tw:bg-brand-500 tw:text-white">
                    <button type="button" class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar evidencia</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedor_agregar">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" >Aceptar</button>
                </div>
            </div>
        </div>
    </div>
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

@endsection