@extends('layouts.panel')
@include('partials.panel.recursos_app')

@section('content')

<div class="tw:w-full" style="margin-top: 60px; max-width: 600px;">

    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:text-center">
        
        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
            <h3 style="margin: 0;">
                <i class="fa fa-check-circle-o"></i>
                Sección {{ $id_seccion }} finalizada
            </h3>
        </div>

        <div class="tw:p-5 tw:sm:p-6" style="padding: 30px;">

            <h4 class="tw:text-green-600" style="margin-bottom: 20px;">
                Has completado correctamente la sección del examen.
            </h4>

            <p style="font-size: 15px;">
                Tus respuestas han sido registradas correctamente.
            </p>

            <hr>

            <a href="{{ url('/examen_conocimientos') }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base">
                <i class="fa fa-home"></i>
                Regresar al menú principal
            </a>

        </div>
    </div>

</div>

@endsection