@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Promedio de los alumnos carrera:'.$carrera->nombre" :migas="['Cómputo' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                
                <div class="tw:p-5 tw:sm:p-6">

                   <p>Total de alumnos con promedio mayor o igual 95 = {{  $contar_alumnos_100 }}</p>
                    <p>Total de alumnos con 90 a 94 sin sumativa = {{ $contar_alumnos_50_sin_s }}</p>
                    <p>Total de alumnos con mayor o igual a 95 con sumativa = {{ $contar_alumnos_50_con_s }}</p>
                    <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Total= {{$total}}</h3>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection