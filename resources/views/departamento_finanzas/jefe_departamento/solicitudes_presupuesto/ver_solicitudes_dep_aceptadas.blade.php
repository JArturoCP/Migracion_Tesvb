@extends('layouts.panel')
@section('title', 'Solicitudes autorizadas liberadas')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado titulo="Solicitudes de requisiciones del presupuesto autorizado ya liberadas" :migas="['Finanzas' => null]" />
    @foreach($solicitudes as $solicitud)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                        <p><span class="fa fa-file"></span> Solicitud: <b>{{ $solicitud->descripcion_solicitud }}</b></p>
                        <p>Proyecto: <b>{{ $solicitud->nombre_proyecto }}</b></p>
                        <p>Meta: <b>{{ $solicitud->meta }}</b></p>
                        <p>Mes: <b>{{ $solicitud->mes }}</b></p>
                            <p class="tw:text-center"><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.location=('{{url('/presupuesto_autorizado/ver_docu_solicitud_aut_departamento/'.$solicitud->id_solicitud)}}')">Ver datos de la solicitud</button></p>
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