@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

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
        color: #fff;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-warning {
        background: linear-gradient(45deg, #f0ad4e, #ec971f);
        border: none;
        color: #fff;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-danger {
        background: linear-gradient(45deg, #d9534f, #c9302c);
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    .btn-icon {
        width: 42px;
        height: 42px;
        padding: 0;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin: 0 5px;
    }

    .btn-icon:hover {
        opacity: 0.85;
    }

    form.inline-form {
        display: inline-block;
        margin: 0;
    }
</style>

<div class="tw:w-full" style="margin-top:30px;">

    <!-- Encabezado -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3 class="tw:text-brand-500 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                <span class="fa fa-calendar"></span>
                Configuración de Periodos Examen de Conocimientos Generales
            </h3>
        </div>

        <div class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">
            <a href="{{ url()->previous() }}"  class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                <span class="fa fa-arrow-left"></span> Regresar
            </a>
        </div>
    </div>

    <hr>

    <!-- Mensajes -->
    @if(session('success'))
        <x-panel.alerta tipo="exito" class="tw:mb-4">
            {{ session('success') }}
        </x-panel.alerta>
    @endif

    @if($errors->any())
        <x-panel.alerta tipo="error" class="tw:mb-4">
            <ul class="tw:mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-panel.alerta>
    @endif

    <!-- FORMULARIO -->
    <x-panel.encabezado titulo="Definir nuevo periodo" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
        
        <div class="tw:p-5 tw:sm:p-6">
            <form action="{{ route('admin.examen_general.periodos.guardar') }}" method="POST">
                @csrf
                <div class="tw:mb-4">
                    <label>Nombre del periodo</label>
                    <input type="text" name="periodo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                </div>

                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center"><strong>Periodo de Aplicación</strong></div>
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:mb-4">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_examen_inicio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                </div>
                                <div class="tw:mb-4">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_examen_fin" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center"><strong>Publicación de Resultados</strong></div>
                            <div class="tw:p-5 tw:sm:p-6">
                                <div class="tw:mb-4">
                                    <label>Inicio</label>
                                    <input type="date" name="periodo_resultado_inicio" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                </div>
                                <div class="tw:mb-4">
                                    <label>Fin</label>
                                    <input type="date" name="periodo_resultado_fin" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tw:text-center tw:mb-4" >
                    <button type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                        <span class="fa fa-floppy-o"></span> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr>

    <!-- HISTORIAL -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <!-- Periodos de aplicación -->
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">Historial - Periodos de Aplicación</div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas">
                        <thead>
                            <tr>
                                <th class="tw:text-center">Periodo</th>
                                <th class="tw:text-center">Inicio</th>
                                <th class="tw:text-center">Fin</th>
                                <th class="tw:text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examen_gnral_periodo as $p)
                                <tr>
                                    <td>{{ $p->periodo }}</td>
                                    <td>{{ $p->fecha_inicio }}</td>
                                    <td>{{ $p->fecha_fin }}</td>
                                    <td style="display:flex; justify-content:center; gap:10px;">
                                        <a href="{{ route('admin.examen_general.periodos.edit', $p->id_periodo_examen) }}"
                                           class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Editar"><span class="fa fa-pencil-square-o"></span></a>

                                        <form action="{{ route('admin.examen_general.periodos.destroy', $p->id_periodo_examen) }}"
                                              method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" title="Eliminar"
                                                    onclick="return TNotify.confirmAction(event, this, '¿Deseas eliminar este periodo?')"><span class="fa fa-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>

        <!-- Periodos de resultados -->
        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center">Historial - Resultados</div>
                <div class="tw:p-5 tw:sm:p-6">
                    <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas">
                        <thead>
                            <tr>
                                <th class="tw:text-center">Periodo</th>
                                <th class="tw:text-center">Inicio</th>
                                <th class="tw:text-center">Fin</th>
                                <th class="tw:text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examen_periodo_resultados as $p)
                                <tr>
                                    <td>{{ $p->periodo }}</td>
                                    <td>{{ $p->fecha_inicio }}</td>
                                    <td>{{ $p->fecha_fin }}</td>
                                    <td style="display:flex; justify-content:center; gap:10px;">
                                        <a href="{{ route('admin.examen_general.periodos.edit', $p->id_periodo_examen) }}"
                                           class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Editar"><span class="fa fa-pencil-square-o"></span></a>

                                        <form action="{{ route('admin.examen_general.periodos.destroy', $p->id_periodo_examen) }}"
                                              method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base" title="Eliminar"
                                                    onclick="return TNotify.confirmAction(event, this, '¿Deseas eliminar este periodo?')"><span class="fa fa-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
@endsection