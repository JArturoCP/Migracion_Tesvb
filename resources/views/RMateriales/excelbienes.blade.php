@extends('layouts.panel')
@section('title', 'Bienes Excel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">
    <main class="main">
        <div class="tw:w-full">
            <x-panel.encabezado titulo="Reportes en Excel de bienes del TESVB" :migas="['Recursos materiales' => null]" />
            <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2 tw:text-center">

            <div class="tw:w-full tw:mb-4 tw:lg:w-full tw:px-2">
                <a class="tw:text-brand-500 tw:hover:underline" href="{{ url('exportar/xlsx') }}"><button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Descargar Excel formato xlsx</button></a>
            </div>
            </div>
        </div>

    </main>

</div>
@endsection


















