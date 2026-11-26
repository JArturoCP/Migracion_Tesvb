@extends('layouts.panel')
@include('partials.panel.recursos_app')

@section('content')

<style>
.shadow-panel{
    border:0;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

.table-header{
    background:#34495e;
    color:#fff;
}

.table-header th{
    font-weight:600;
    font-size:13px;
}

.btn-group .btn{
    margin-right:2px;
    border-radius:3px !important;
}

.label-primary{
    background:#3498db;
}
</style>

<div class="tw:w-full" style="margin-top:30px;">

    <!-- ENCABEZADO -->
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4" style="margin-bottom:15px;">

        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3 class="tw:text-brand-500" style="margin-top:5px;">
                <span class="fa fa-book"></span>
                Exámenes de Conocimientos Generales
            </h3>
        </div>

        <div class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">

        <a href="{{ url()->previous() }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
            <span class="fa fa-arrow-left"></span>Regresar
        </a>
            <a href="{{ route('admin.examen_general.create') }}" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">
                <span class="fa fa-plus"></span>
                Nuevo Examen
            </a>

        </div>

    </div>

    <!-- PANEL -->
    <div class="shadow-panel tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
            <strong>Listado de exámenes</strong>
        </div>

        <div class="tw:p-5 tw:sm:p-6">

            <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">

                <div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table class="tw-tabla tw-tabla-bordes tw-tabla-rayas tw:text-center tw-tabla-compacta">

                    <thead class="table-header">
                        <tr>
                            <th class="tw:text-center">No.</th>
                            <th class="tw:text-center">Carrera</th>
                            <th class="tw:text-center">Nombre</th>
                            <th class="tw:text-center" width="280">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($examenes as $e)
                        <tr>

                            <td><strong>{{ $e->id_examen_egel }}</strong></td>

                            <td>
                                <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-xs tw:font-medium tw:bg-brand-50 tw:text-brand-500">
                                    {{ $e->carrera }}
                                </span>
                            </td>

                            <td>{{ $e->nombre }}</td>

                            <td>
                                <div class="btn-group-sm tw:inline-flex tw:gap-2">

                                    <a href="{{ route('admin.examen_general.edit',$e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-amber-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-amber-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" title="Editar">
                                        <span class="fa fa-pencil"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.delete',$e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                                       onclick="return TNotify.confirmAction(event, this, '¿Seguro que deseas eliminar este examen?')"
                                       title="Eliminar">
                                        <span class="fa fa-trash"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.rapido', $e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" title="Carga rápida">
                                        <span class="fa fa-bolt"></span>
                                    </a>

                                    <a href="{{ route('admin.examen_general.preguntas', $e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-sky-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-sky-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" title="Ver preguntas">
                                        <span class="fa fa-list-alt"></span>
                                    </a>

                                </div>
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

@if(isset($ver) && $ver == 'create')
      @section('modal_examen_create')
      @include('examen_gnral_con.admin.examenes.create')
      @show
@endif

@if(isset($ver) && $ver == 'edit')
      @section('modal_examen_edit')
      @include('examen_gnral_con.admin.examenes.edit')
      @show
@endif

@include('partials.panel.validacion_envio')
@endsection