@extends('layouts.panel')
@section('title', 'Padron de Bienes')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">

        <div class="tw:w-full">
            <x-panel.encabezado titulo="Consulta de Bienes por Dependencia" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full tw:text-center">
                <!-- Formulario para Busqueda -->
                <form action="{{route('pdfp')}}" method="get" target="_blank">
                    @csrf
                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"  type="submit">Imprimir Padron

                    </button>
                </form>

                <!-- Fin formulario -->
            </div>
        </div>

        <div class="tw:w-full" >
            <div class="tw:w-full">

                <div class="tw:p-5 tw:sm:p-6">
                    @if($resguardos->isEmpty())
                        <div class="tw:text-center tw:bg-amber-50 tw:dark:bg-amber-500/15">No hay Sectores Públicos</div>
                    @else
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta" >
                            <thead>
                            <tr>
                                <th class="tw:text-center">Departamento:</th>
                                <th class="tw:text-center">Resguardatario:</th>
                                <th class="tw:text-center">Puesto:</th>
                                <th class="tw:text-center">Nombre del Bien:</th>
                                <th class="tw:text-center">Fecha Registro:</th>
                                <th class="tw:text-center">Estado Bien:</th>



                            </tr>
                            </thead>

                            <tbody>
                            @foreach($resguardos as $res)<!-- se crea un objeto para acceder a los datos-->
                            @foreach($res->bienes as $bien)
                                @foreach($res->sectores as $sector)
                                <tr>
                                    <td>{{$sector->departamentos->nom_departamento}}</td>
                                    <td>{{$sector->nombre}}</td>
                                    <td>{{$sector->puesto}}</td>
                                    <td>{{$bien->nombre}}</td>
                                    <td>{{$res->fecha}}</td>
                                    <td>
                                        @if($bien->condicion == 1)
                                            <span class="tw:text-green-600">Activo</span>
                                        @else
                                            <span class="tw:text-red-600">Desactivado</span>
                                        @endif
                                    </td>
                                </tr>
                                 @endforeach
                                @endforeach
                            @endforeach
                        </table>
</div>
                        {{$resguardos->links()}}<!--para la paginacion-->

                    @endif
                </div>
            </div>
        </div>


    </main>



</div>
@endsection