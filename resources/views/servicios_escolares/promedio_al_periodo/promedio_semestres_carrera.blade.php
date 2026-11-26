@extends('layouts.panel')
@section('title', 'S.Escolares')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Promedios de los alumnos por periodo '.$nombre_carrera.' (semestres)'" :migas="['Servicios escolares' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        @foreach($grupos as $grupo)
            <div class="tw:w-full tw:px-2">
                <x-panel.alerta tipo="exito" class="tw:mb-4"><h3>SEMESTRE <br>{{$grupo->descripcion}}</h3><br><button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" onclick="window.open('{{ url('/servicios_escolares/promedio_alumno_grupo/'.$id_carrera."/".$grupo->id_semestre ) }}')">Mostrar Alumnos </button></x-panel.alerta>
            </div>
        @endforeach

    </div>

</div>
@endsection