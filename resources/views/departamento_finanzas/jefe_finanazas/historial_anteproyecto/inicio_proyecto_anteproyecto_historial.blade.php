@extends('layouts.panel')
@section('title', 'Historial del anteproyecto')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_anteproyecto/historial_anteproyecto_proyectos/".$id_year)}}">Historial de los proyectos del anteproyecto de presupuesto {{ $year }} </a>
                <span class="fa fa-chevron-right"></span>
                <span>Menu del proyecto seleccionado del año {{ $proyecto->year }}</span>
            </p>
        </div>
    </div>
    <x-panel.encabezado :titulo="'Historial de las requisiciones autorizadas del anteproyecto '.$proyecto->year.' '.$proyecto->nombre_proyecto" :migas="['Finanzas' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:flex tw:flex-wrap tw:gap-y-4 tw:p-5 tw:sm:p-6">
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/presupuesto_total_anteproyecto_historial/'.$id_presupuesto ) }}'" href="">Presupuesto total del proyecto(completo)</a></li>
                        </ul>
                    </div>
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_historial/'.$id_presupuesto ) }}'" href="">Por capitulos(completo)</a></li>
                        </ul>
                    </div>
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/proyecto_meses_anteproyecto_historial/'.$id_presupuesto ) }}'" href="">Por mes(completo)</a></li>
                        </ul>
                    </div>
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/proyecto_meta_anteproyecto_historial/'.$id_presupuesto ) }}'" href="">Por meta(completo)</a></li>
                        </ul>
                    </div>

                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/presupuesto_total_anteproyecto_inc_historial/'.$id_presupuesto ) }}'" href="">Presupuesto total del proyecto(sin partidas presupuestales en 0)</a></li>
                        </ul>
                    </div>
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/proyecto_capitulo_anteproyecto_inc_historial/'.$id_presupuesto ) }}'" href="">Por capitulos(sin partidas presupuestales en 0)</a></li>
                        </ul>
                    </div>
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/proyecto_meses_anteproyecto_inc_historial/'.$id_presupuesto ) }}'" href="">Por mes(sin partidas presupuestales en 0)</a></li>
                        </ul>
                    </div>
                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" onclick="window.location='{{ url('/presupuesto_anteproyecto/proyecto_metas_anteproyecto_inc_historial/'.$id_presupuesto ) }}'" href="">Por meta(sin partidas presupuestales en 0)</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
@endsection