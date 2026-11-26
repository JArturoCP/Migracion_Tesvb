@extends('layouts.panel')
@section('title', 'Tarjetas de Resguardos')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">

        <div class="tw:w-full">
            <x-panel.encabezado titulo="Impresión y Consulta de Tarjetas de Resguardo" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full tw:text-center">
                <!-- Formulario para Busqueda -->

                <!-- Fin formulario -->
            </div>
        <div class="tw:w-full" >
            <div class="tw:w-full">
                <div class="tw:p-5 tw:sm:p-6">
                        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta"  >
                            <thead>
                            <tr>

                                <th class="tw:text-center">Resguardatario:</th>
                                <th class="tw:text-center">Categoría:</th>
                                <th class="tw:text-center">Nombre del Bien:</th>
                                <th class="tw:text-center">Fecha de Resguardo:
                                <th class="tw:text-center">Imprimir:</th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($resguardos as $res)<!-- se crea un objeto para acceder a los datos-->
                            @foreach($res->sectores as $sect)
                                @foreach($res->bienes as $bien)<!-- se crea un objeto para acceder a los datos-->
                            <tr>
                                <td>{{$sect->nombre}}</td>
                                <td>{{$bien->categorias->nombre}}</td>
                                <td>{{$bien->nombre}}</td>
                                <td>{{$res->fecha}}</td>
                                <td>
                                    <form action="{{route('pdfrest',$res->id)}}" method="get" target="_blank">
                                        @csrf
                                    <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"  type="submit">Tarjeta de Resguardo

                                    </button>
                                    </form>
                                </td>

                                <!--lo borrado-->
                            </tr>
                            @endforeach
                            @endforeach
                            @endforeach
                        </table>
</div>
                        {{$resguardos->links()}}<!--para la paginacion-->
                </div>
            </div>
        </div>

    </div>


    </main>



</div>
@endsection