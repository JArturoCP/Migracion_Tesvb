@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

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
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:mb-4" >

        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3 class="tw:text-brand-500 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" style="margin-top:5px;">
                <span class="fa fa-book"></span>
                Exámenes de Conocimientos Generales
            </h3>
        </div>

        <div class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">

        <a href="{{ url()->previous() }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            <span class="fa fa-arrow-left"></span>Regresar 
        </a>
            <a href="{{ route('admin.examen_general.create') }}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
                <span class="fa fa-plus"></span>
                Nuevo Examen
            </a>

        </div>

    </div>

    <!-- PANEL -->
    <x-panel.encabezado titulo="Listado de exámenes" :migas="['Examen general de conocimientos' => null]" />
    <div class="shadow-panel tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

        

        <div class="tw:p-5 tw:sm:p-6">

            <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

                <table class="tw-tabla-centrada tw-tabla tw-tabla-bordes tw-tabla-rayas tw-tabla-compacta">

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
                                       class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Editar"><span class="fa fa-pencil"></span></a>

                                    <a href="{{ route('admin.examen_general.delete',$e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-red-600 tw:ring-1 tw:ring-red-300 tw:ring-inset tw:hover:bg-red-50 tw:dark:bg-gray-800 tw:dark:text-red-500 tw:dark:ring-red-500/40 tw:dark:hover:bg-red-500/10 tw:size-9 tw:text-base"
                                       onclick="return TNotify.confirmAction(event, this, '¿Seguro que deseas eliminar este examen?')"
                                       title="Eliminar"><span class="fa fa-trash"></span></a>

                                    <a href="{{ route('admin.examen_general.rapido', $e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Carga rápida"><span class="fa fa-bolt"></span></a>

                                    <a href="{{ route('admin.examen_general.preguntas', $e->id_examen_egel) }}" 
                                       class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base" title="Ver preguntas"><span class="fa fa-list-alt"></span></a>

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
</div>
@endsection