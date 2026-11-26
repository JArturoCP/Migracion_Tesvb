@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<style>
    .main{
        margin-top:30px;
        margin-bottom:30px;
    }

    .panel-dashboard .panel-body{
        padding:25px;
    }

    .resultado-principal{
        font-size:72px;
        font-weight:bold;
        color:#337ab7;
        margin:0;
    }

    .table>thead>tr>th{
        text-align:center;
        vertical-align:middle;
        background:#f5f5f5;
    }

    .table>tbody>tr>td{
        vertical-align:middle;
    }

    .progress{
        margin-bottom:0;
        height:22px;
    }

    .progress-bar{
        line-height:22px;
        font-weight:bold;
    }

    .panel{
        margin-bottom:30px;
    }

    .resumen-numero{
        font-size:30px;
        font-weight:bold;
    }
</style>

<div class="main tw:w-full">

    <!-- Título -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">
            <h2 class="tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><strong>Resultado EGEL</strong></h2>
            <p class="tw:text-gray-500 tw:dark:text-gray-400">
                Consulta tu desempeño general y el detalle por módulos y secciones.
            </p>
            <hr>
        </div>
    </div>

    @if($resultado)

    <!-- Resumen -->
    <x-panel.encabezado titulo="Calificación" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
            <div class="panel-dashboard tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:text-center">
                

                <div class="tw:p-5 tw:sm:p-6">
                    <div class="resumen-numero">
                        {{ $resultado->calificacion_general }}%
                    </div>
                </div>
            </div>
        </div>

        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
            <div class="panel-dashboard tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:text-center">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    Nivel obtenido
                </div>

                <div class="tw:p-5 tw:sm:p-6">
                    <div class="resumen-numero">
                        {{ $resultado->nivel }}
                    </div>
                </div>
            </div>
        </div>

        <div class="tw:w-full tw:lg:w-4/12 tw:px-2">
            <div class="panel-dashboard tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03] tw:text-center">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    Módulos evaluados
                </div>

                <div class="tw:p-5 tw:sm:p-6">
                    <div class="resumen-numero">
                        {{ count($porModulo) }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @endif


    <!-- Resultado General -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">
                    <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">
                        Resultado General
                    </h3>
                </div>

                <div class="tw:p-5 tw:sm:p-6 tw:text-center">

                    @if($resultado)

                        <div class="resultado-principal">
                            {{ $resultado->calificacion_general }}%
                        </div>

                        <hr>

                        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                            Nivel alcanzado
                        </h4>

                        <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-green-50 tw:text-green-700 tw:text-lg" style="padding:10px 20px">
                            {{ $resultado->nivel }}
                        </span>

                    @else

                        <h4 class="tw:text-gray-500 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                            Aún no existe un resultado disponible.
                        </h4>

                    @endif

                </div>

            </div>

        </div>

    </div>


    <!-- Módulos -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:lg:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <strong>Resultados por módulo</strong>
                </div>

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                        <table class="tw-tabla tw-tabla-bordes tw-tabla-rayas">

                            <thead>

                            <tr>
                                <th>Módulo</th>
                                <th>Puntos obtenidos</th>
                                <th>Total puntos</th>
                                <th width="35%">Desempeño</th>
                            </tr>

                            </thead>

                            <tbody>

                            @foreach($porModulo as $m)

                                @php

                                    if($m->porcentaje>=90){
                                        $color="success";
                                    }elseif($m->porcentaje>=75){
                                        $color="info";
                                    }elseif($m->porcentaje>=60){
                                        $color="warning";
                                    }else{
                                        $color="danger";
                                    }

                                @endphp

                                <tr>

                                    <td>{{ $m->nombre }}</td>

                                    <td class="tw:text-center">
                                        {{ number_format($m->puntos,2) }}
                                    </td>

                                    <td class="tw:text-center">
                                        {{ number_format($m->total_valor,2) }}
                                    </td>

                                    <td>

                                        <div class="tw:mb-3 tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200">

                                            <div
                                                class="progress-bar-{{ $color }} tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-xs tw:font-medium tw:text-white"
                                                role="progressbar"
                                                style="width:{{ $m->porcentaje }}%;">

                                                {{ $m->porcentaje }}%

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Secciones -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:lg:w-full tw:px-2">

            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                    <strong>Resultados por sección</strong>
                </div>

                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                        <table class="tw-tabla tw-tabla-bordes tw-tabla-rayas">

                            <thead>

                            <tr>

                                <th>Sección</th>
                                <th>Puntos obtenidos</th>
                                <th>Total puntos</th>
                                <th width="35%">Desempeño</th>

                            </tr>

                            </thead>

                            <tbody>

                            @foreach($porSeccion as $s)

                                @php

                                    if($s->porcentaje>=90){
                                        $color="success";
                                    }elseif($s->porcentaje>=75){
                                        $color="info";
                                    }elseif($s->porcentaje>=60){
                                        $color="warning";
                                    }else{
                                        $color="danger";
                                    }

                                @endphp

                                <tr>

                                    <td>
                                        Sección {{ $s->id_seccion }}
                                    </td>

                                    <td class="tw:text-center">
                                        {{ number_format($s->puntos,2) }}
                                    </td>

                                    <td class="tw:text-center">
                                        {{ number_format($s->total_valor,2) }}
                                    </td>

                                    <td>

                                        <div class="tw:mb-3 tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200">

                                            <div
                                                class="progress-bar-{{ $color }} tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-xs tw:font-medium tw:text-white"
                                                role="progressbar"
                                                style="width:{{ $s->porcentaje }}%;">

                                                {{ $s->porcentaje }}%

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Botón -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:lg:w-full tw:text-center tw:px-2">

            <a href="{{ route('examen_general.pdf.oficial') }}"
               class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                <span class="fa fa-file"></span>

                Descargar reporte

            </a>

        </div>

    </div>

</div>

</div>
@endsection