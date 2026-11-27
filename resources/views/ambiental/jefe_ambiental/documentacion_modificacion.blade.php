@extends('layouts.panel')
@section('title', 'Ambiental')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="tw:w-full tw:lg:w-full tw:px-2">


        <x-panel.encabezado :titulo="'Proceso de Modificación de Documentación de los Procedimientos del '.$periodo[0]->nombre_periodo_amb" :migas="['Gestión ambiental' => null]" />
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                    <li  > <a href="{{url('/ambiental/ver_documentacion_ambiental')}}">Autorizar documentación</a></li>
                    <li class="active" ><a href="#">Proceso de Modificación</a>
                    </li>

                    <li  > <a href="{{url('/ambiental/documentacion_autorizada/')}}">Documentación Autorizada</a></li>
                </ul>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div  class="tw:w-full tw:lg:w-10/12 tw:xl:ml-[8.3333%] tw:px-2">
                <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table id="tabla_envio" class="tw-tabla tw-tabla-bordes">
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
</div>
@endsection