@extends('layouts.panel')
@section('title', 'Solicitudes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Revisión de las solicitudes de requisiciones de los departamentos o jefatura" :migas="['Finanzas' => null]" />
    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
        <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
            <li class="active"><a href="#">Revisión de solicitudes de requisiciones de los departamentos</a></li>
            <li>
                <a href="{{ url('/presupuesto_autorizado/proceso_mod_solicitudes/') }}" >En proceso de modificación</a>
            </li>
            {{--
            <li>
                <a href="{{ url('/presupuesto_autorizado/solicitudes_autorizadas_departamentos/' ) }}" >Solicitudes autorizadas</a>
            </li>
            --}}





        </ul>
        <p class="tw:w-full">
            <br>
        </p>
    </div>
    @foreach($solicitudes as $solicitud)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <p><span class="fa fa-file"></span> Solicitud: <b>{{ $solicitud->descripcion_solicitud }}</b></p>
                        <p>Nombre del departamento o jefatura: <b>{{ $solicitud->nom_departamento }}</b></p>
                        <p>Nombre del jefe o  de la jefa del departamento o jefatura: <b>{{ $solicitud->titulo }} {{ $solicitud->nombre_personal }}</b></p>
                           @if($solicitud->comentario_solicitud != '')
                            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                                <div class="tw:w-full tw:px-2">
                                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                                        <div class="tw:p-5 tw:sm:p-6">
                                          <p class="tw:text-red-600 tw:dark:text-red-400">Comentario: <b>{{ $solicitud->comentario_solicitud }}</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        <p>Proyecto: <b>{{ $solicitud->nombre_proyecto }}</b></p>
                        <p>Meta: <b>{{ $solicitud->meta }}</b></p>
                        <p>Mes: <b>{{ $solicitud->mes }}</b></p>
                        @if($solicitud->id_estado_enviado == 2)
                            <p class="tw:text-center"><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="window.location=('{{url('/presupuesto_autorizado/revisar_documentacion_solicitud/'.$solicitud->id_solicitud)}}')">Revisar documentacion de la solicitud</button></p>

                        @endif
                    </div>
                </div>

            </div>
        </div>
    @endforeach



    <script type="text/javascript">
        $(document).ready( function() {
            $("#guardar_envio").click(function (){
                $("#form_envio").submit();
                $("#guardar_envio").attr("disabled", true);
            });
        });
    </script>


</div>
@endsection