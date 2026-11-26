@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('title', 'Ambiental')
@section('content')
    <main class="tw:w-full tw:lg:w-full tw:px-2">


        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
                <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
                    <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
                        <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:text-center">Proceso de Modificación de Documentación de los Procedimientos del {{ $periodo[0]->nombre_periodo_amb }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:lg:w-9/12 tw:lg:ml-[8.3333%] tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200">
                    <li  > <a href="{{url('/ambiental/ver_documentacion_ambiental')}}">Autorizar documentación</a></li>
                    <li class="active" ><a href="#">Proceso de Modificación</a>
                    </li>

                    <li  > <a href="{{url('/ambiental/documentacion_autorizada/')}}">Documentación Autorizada</a></li>
                </ul>
                <br>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table id="tabla_envio" class="table-responsive tw-tabla tw-tabla-bordes">
                    <thead>
                    <tr>

                        <th>Procedimiento</th>
                        <th>Nombre del encargado</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($encargados as $encargado)
                    <tr >
                        <td>{{ $encargado->nom_procedimiento }}</td>
                        <td>{{ $encargado->nombre }}</td>


                    </tr>
                    @endforeach

                    </tbody>
                </table>
</div>
            </div>
        </div>
    </main>
@endsection