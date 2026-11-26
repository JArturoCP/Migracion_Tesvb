@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Concentrado de calificaciones duales '.$nombre_carrera.' (semestres)'" :migas="['Educación dual' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    @foreach($grupos as $grupo)
            @if($grupo->id_semestre >= 6)
        <div class="tw:w-full tw:px-2">
            <x-panel.alerta tipo="advertencia" class="tw:mb-4"><h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">{{$grupo->id_semestre}}0{{$grupo->grupo}}</h3><br>
                <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" 
                onclick="window.open('{{ url('/duales/concentrado_calificaciones_duales/materias/'.$grupo->id_carrera."/".$grupo->id_semestre."/".$grupo->grupo ) }}')" 
               >
                Mostrar Materias <span class="fa fa-level-up"></span>
                </button></x-panel.alerta>
        </div>
        @endif
        @endforeach

    </div>

</div>
@endsection