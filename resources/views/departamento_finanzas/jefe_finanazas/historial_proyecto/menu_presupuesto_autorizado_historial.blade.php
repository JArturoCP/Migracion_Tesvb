@extends('layouts.panel')
@section('title', 'Historial de presupuesto autorizado')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/inicio_presupuesto_autorizado_historial")}}">Años de los historiales de los presupuestos autorizados</a>
                <span class="fa fa-chevron-right"></span>
                <span>Menú del historial del presupuesto autorizado del {{  $year->descripcion }} </span>
            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Historial del presupuesto autorizado del '.$year->descripcion" :migas="['Finanzas' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                    <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Presupuesto autorizado</h5>
                    <p><button class="presupuesto_autorizado tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $year->id_year }}">Ver</button></p>

                </div>
            </div>
        </div>
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                    <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Presupuesto autorizado modificado</h5>
                    <p><button class="presupuesto_autorizado_mod tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $year->id_year }}">Ver</button></p>

                </div>
            </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6 tw:text-center">
                    <h5 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Solicitudes autorizadas</h5>
                    <p><button class="solicitudes_autorizadas tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" id="{{ $year->id_year }}">Ver</button></p>

                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $(".presupuesto_autorizado").click(function (){
                // TNotify.alert($("#grupos").val());
                var id_year = $(this).attr('id');

                window.location.href='/presupuesto_autorizado/presupesto_partida_historial/'+id_year;
            });
            $(".presupuesto_autorizado_mod").click(function (){
                // TNotify.alert($("#grupos").val());
                var id_year = $(this).attr('id');
                window.location.href='/presupuesto_autorizado/presupesto_partida_copia_historial/'+id_year;
            });
            $(".solicitudes_autorizadas").click(function (){
                // TNotify.alert($("#grupos").val());
                var id_year = $(this).attr('id');
                window.location.href='/presupuesto_autorizado/solicitudes_autorizadas_departamentos_historial/'+id_year;
            });


        });

    </script>
</div>
@endsection