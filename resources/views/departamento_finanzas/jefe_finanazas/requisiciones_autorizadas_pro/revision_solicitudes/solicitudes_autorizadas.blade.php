@extends('layouts.panel')
@section('title', 'Solicitudes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Solicitudes de requisiciones de los departamentos" :migas="['Finanzas' => null]" />
    <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:px-2">
        <ul class="tw:w-full tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
            <li>
                <a href="{{ url('/presupuesto_autorizado/revisar_solicitudes') }}" > Revisión de solicitudes de requisiciones de los departamentos</a>
            </li>
            <li><a href="{{ url('/presupuesto_autorizado/solicitudes_autorizadas_departamentos/' ) }}" >En proceso de modificación</a>
            </li>
            <li class="active"><a href="#">
                Solicitudes autorizadas</a>
            </li>





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
                        <p>Nombre del departamento: <b>{{ $solicitud->nom_departamento }}</b></p>
                        <p>Jefe(a) del departamento o de la jefatura: <b>{{ $solicitud->titulo }} {{ $solicitud->nombre_personal }}</b></p>
                        <p><span class="fa fa-file"></span> Solicitud: <b>{{ $solicitud->descripcion_solicitud }}</b></p>
                        <p>Proyecto: <b>{{ $solicitud->nombre_proyecto }}</b></p>
                        <p>Meta: <b>{{ $solicitud->meta }}</b></p>
                        <p>Mes: <b>{{ $solicitud->mes }}</b></p>

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