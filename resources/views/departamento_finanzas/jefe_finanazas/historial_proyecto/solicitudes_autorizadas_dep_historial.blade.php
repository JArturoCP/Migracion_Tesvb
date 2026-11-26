@extends('layouts.panel')
@section('title', 'Historial de las requisiciones de los proyectos')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/inicio_presupuesto_autorizado_historial")}}">Años de los historiales de los presupuestos autorizados</a>
                <span class="fa fa-arrow-right"></span>
                <a class="tw:text-brand-500 tw:hover:underline" href="{{url("/presupuesto_autorizado/menu_presupuesto_autorizado_historial/".$id_year)}}">Historial del presupuesto autorizado del {{ $year }} </a>
                <span class="fa fa-chevron-right"></span>
                <span>Departamentos o jefaturas con solicitudes autorizadas</span>
            </p>
        </div>
    </div>
    <x-panel.encabezado titulo="Historial departamentos o jefaturas con solicitudes autorizadas" :migas="['Finanzas' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">

                    <div class="tw:w-full tw:px-2">
                        <ul class="tw:mb-6 tw:divide-y tw:divide-gray-100 tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            @foreach($departamentos as $departamento)
                                <li><a class="tw:block tw:px-4 tw:py-3 tw:text-sm tw:font-medium tw:cursor-pointer tw:text-gray-700 tw:dark:text-gray-300 tw:hover:bg-gray-50" data-toggle="pill" href="#" onclick="window.location='{{ url('/presupuesto_autorizado/solicitudes_ver_departamento_historial/'.$departamento->id_unidad_admin.'/'.$id_year ) }}'"> {{ $departamento->nom_departamento }}</a></li>

                            @endforeach
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection