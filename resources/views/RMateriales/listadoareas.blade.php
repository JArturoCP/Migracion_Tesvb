@extends('layouts.panel')
@section('title', 'Areas')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">
        <div class="tw:w-full">
                <x-panel.encabezado titulo="Departamentos del TESVB" :migas="['Recursos materiales' => null]" />
            </div>
            <div class="tw:w-full">
                <div class="tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                    <div class="tw:p-5 tw:sm:p-6">
                            <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta">
                                <thead>
                                <tr>
                                    <th class="tw:text-blue-800 tw:dark:text-blue-400 tw:text-center">No. Depto</th>
                                    <th class="tw:text-blue-800 tw:dark:text-blue-400 tw:text-center">Nombre del Departamento</th>
                                    <th class="tw:text-blue-800 tw:dark:text-blue-400 tw:text-center">Encargado del Departamento</th>

                                </tr>
                                </thead>
                                @foreach($jefes_unidades as $area)<!-- se crea un objeto para acceder a los datos-->
                                <tbody>
                                <tr>
                                    <td class="tw:text-center">{{$area->id_unidad_admin}}</td>
                                    <td class="tw:text-center">{{$area->nom_departamento}}</td>
                                    <td class="tw:text-center">{{$area->nombre}}</td>


                                </tr>
                                @endforeach
                                </tbody>
                            </table>
</div>
                                 <!--para la paginacion-->
                    </div>
                </div>
            </div>

    </main>


</div>
@endsection