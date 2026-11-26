@extends('layouts.panel')
@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

<div class="main">
    <style>
    body {
        background: #f4f6f9;
    }

    .panel {
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        border: none;
    }

    .panel-heading {
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
    }

    .panel-primary .panel-heading {
        background: linear-gradient(45deg, #337ab7, #5bc0de);
        color: #fff;
    }

    .panel-success .panel-heading {
        background: linear-gradient(45deg, #5cb85c, #4cae4c);
        color: #fff;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ddd;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #337ab7;
        box-shadow: 0 0 6px rgba(51,122,183,0.3);
    }

    .btn-lg {
        border-radius: 30px;
        padding: 10px 22px;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(45deg, #337ab7, #286090);
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-danger {
        background: linear-gradient(45deg, #d9534f, #c9302c);
        border: none;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }


</style>

<div class="tw:w-full" style="margin-top:30px;">

    <!-- Encabezado -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="title-box">
                <h3 class="tw:text-brand-500 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:m-0" >
                    <span class="fa fa-calendar"></span>
                    Editar Periodo Examen de Conocimientos Generales
                </h3>
            </div>
        </div>

        <div class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
            <a href="{{ route('admin.examen_general.periodos.index') }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                <span class="fa fa-arrow-left"></span>
                Regresar
            </a>
        </div>
    </div>

    <hr>

    <!-- Mensajes -->
    @if(session('success'))
        <x-panel.alerta tipo="exito" class="tw:mb-4 tw:w-full">
            {{ session('success') }}
        </x-panel.alerta>
    @endif

    @if($errors->any())
        <x-panel.alerta tipo="error" class="tw:mb-4 tw:w-full">
            <ul class="tw:mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-panel.alerta>
    @endif

    <!-- PANEL -->
    <x-panel.encabezado titulo="Actualizar periodo" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:w-full tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
        

        <div class="tw:p-5 tw:sm:p-6">

            <form action="{{ route('admin.examen_general.periodos.update', $examen_gnral_periodo->id_periodo_examen) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="tw:mb-4">
                    <label>Nombre del periodo</label>
                    <input type="text" name="periodo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
                           value="{{ $examen_gnral_periodo->periodo }}" required>
                </div>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                    <!-- Aplicación -->
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">
                                Periodo de Aplicación
                            </div>

                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:mb-4">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_examen_inicio"
                                           class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
                                           value="{{ \Carbon\Carbon::parse($examen_gnral_periodo->fecha_inicio)->format('Y-m-d') }}"
                                           required>
                                </div>

                                <div class="tw:mb-4">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_examen_fin"
                                           class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
                                           value="{{ \Carbon\Carbon::parse($examen_gnral_periodo->fecha_fin)->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resultados -->
                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">
                                Publicación de Resultados
                            </div>

                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:mb-4">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_resultado_inicio"
                                           class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
                                           value="{{ \Carbon\Carbon::parse($examen_periodo_resultados->fecha_inicio)->format('Y-m-d') }}"
                                           required>
                                </div>

                                <div class="tw:mb-4">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_resultado_fin"
                                           class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11"
                                           value="{{ \Carbon\Carbon::parse($examen_periodo_resultados->fecha_fin)->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- BOTONES -->
                <div style="margin-top:25px; display:flex; justify-content:center; gap:15px;">

                    <!-- GUARDAR -->
                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><span class="fa fa-download"></span></button>

            </form>

                    <!-- ELIMINAR -->
                    <form action="{{ route('admin.examen_general.periodos.destroy', $examen_gnral_periodo->id_periodo_examen) }}"
                          method="POST"
                          onsubmit="return TNotify.confirmAction(event, this, '¿Deseas eliminar este periodo?')">

                        @csrf
                        @method('DELETE')

                        <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"><span class="fa fa-trash"></span></button>
                    </form>

                </div>

        </div>
    </div>

</div>

</div>

</div>
@endsection 