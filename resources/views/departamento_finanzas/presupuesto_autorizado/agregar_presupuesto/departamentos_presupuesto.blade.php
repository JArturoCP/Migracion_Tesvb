@extends('layouts.panel')
@section('title', 'Presupuesto autorizado')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <x-panel.encabezado :titulo="'Departamentos y jefaturas de división del año '.$year" :migas="['Finanzas' => null]" />
    <div class="tw:grid tw:gap-3 tw:sm:grid-cols-2 tw:lg:grid-cols-3">
    @foreach($departamentos as $departamento)
        @if($departamento->estado == 1)
            <button type="button" class="tw:inline-flex tw:min-h-14 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:gap-2 tw:px-4 tw:py-3 tw:text-center tw:text-sm tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:disabled:bg-green-300"  onclick="window.location='{{ url('/presupuesto_autorizado/departamentos_agregar_presupuesto/'.$departamento->id_unidad_admin ) }}'">{{ $departamento->nom_departamento }}</button>
        @else
            <button type="button" class="tw:inline-flex tw:min-h-14 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:gap-2 tw:px-4 tw:py-3 tw:text-center tw:text-sm tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03]"  onclick="window.location='{{ url('/presupuesto_autorizado/departamentos_agregar_presupuesto/'.$departamento->id_unidad_admin ) }}'">{{ $departamento->nom_departamento }}</button>
        @endif
    @endforeach
    </div>
</div>
@endsection