@extends('layouts.panel')
@include('partials.panel.recursos_app')

@section('content')

<div class="tw:w-full tw:text-center" style="margin-top: 50px; max-width: 700px;">

    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
            <h3 style="margin: 0;">
                <i class="fa fa-check-circle-o"></i>
                Área concluida
            </h3>
        </div>

        <div class="tw:p-5 tw:sm:p-6" style="padding: 30px;">

            <div class="tw:mb-4 tw:rounded-xl tw:border tw:p-4 tw:text-sm tw:border-green-200 tw:bg-green-50 tw:text-green-800">
                <h4 style="margin: 0;">
                    Has concluido el área: <strong>{{ $moduloActual->nombre }}</strong>
                </h4>
            </div>

            <hr>

            <h4 style="margin-bottom: 20px;">
                Prepárate para comenzar la siguiente área
            </h4>

            <a href="{{ route('examen_general.seccion.pregunta', [
        'id_seccion' => $id_seccion,
        'page' => $nextPage
    ]) }}"
   class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-5 tw:py-3.5 tw:text-base">
    <i class="fa fa-arrow-right"></i>
    Comenzar siguiente área
</a>

        </div>
    </div>

</div>

@endsection