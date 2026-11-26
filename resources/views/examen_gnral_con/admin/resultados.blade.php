@extends('layouts.panel')
@section('title', 'Agregar Docentes en Plantilla')

@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')
<div class="tw-pantalla">

<style>
    .page-header{
        margin-top:0;
        margin-bottom:20px;
    }

    .panel{
        min-height:650px;
        box-shadow:0 2px 6px rgba(0,0,0,.15);
    }

    .panel-heading h4{
        margin:0;
        font-weight:bold;
    }

    .table>thead>tr>th{
        text-align:center;
        vertical-align:middle;
    }

    .table>tbody>tr>td{
        vertical-align:middle;
    }

    .btn{
        border-radius:3px;
    }

    .modal-header-success{
        background:#5cb85c;
        color:white;
    }

    .modal-header-danger{
        background:#d9534f;
        color:white;
    }

    .table-responsive{
        min-height:560px;
    }
</style>

<main class="tw:w-full">

<div class="tw:mb-6 tw:border-b tw:border-gray-200 tw:dark:border-gray-800 tw:pb-2">

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                <i class="fa fa-users"></i>
                Administración de Docentes
            </h3>
        </div>

        <div class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">

            <a href="{{ route('admin.examen_general.nuevos_docentes') }}"
               class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">

                <i class="fa fa-user-plus"></i>

                Registrar docentes de nuevo ingreso

            </a>

        </div>

    </div>

</div>

<x-panel.encabezado titulo="Docentes candidatos a plantilla" :migas="['Examen general de conocimientos' => null]" />
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

<div class="tw:w-full tw:xl:w-6/12 tw:lg:w-6/12 tw:px-2">

<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">



<div class="tw:p-5 tw:sm:p-6">

<div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

<table
id="table-docentes-sin"
class="tw-tabla tw-tabla-rayas tw-tabla-bordes">

<thead>

<tr class="tw:bg-sky-50">

<th width="50">#</th>

<th>Nombre</th>

<th width="180">Escolaridad</th>

<th width="120">Acción</th>

</tr>

</thead>

<tbody>

@foreach($docentes as $docente)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td class="tw:text-left">

{{ $docente->nombre }}

</td>

<td>

{{ $docente->escolaridad ?? 'Sin datos' }}

</td>

<td class="tw:text-center">

<button class="agrega tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
data-id="{{ $docente->id_personal }}"
title="Agregar">

<i class="fa fa-plus"></i>

Agregar

</button>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>

<div class="tw:w-full tw:xl:w-6/12 tw:lg:w-6/12 tw:px-2">

<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">

<div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">

<h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">

<i class="fa fa-check-circle"></i>

DOCENTES EN PLANTILLA

</h4>

</div>

<div class="tw:p-5 tw:sm:p-6">

<div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">

<table
id="table-docentes-con"
class="tw-tabla tw-tabla-rayas tw-tabla-bordes">

<thead>

<tr class="tw:bg-sky-50">

<th width="50">#</th>

<th>Nombre</th>

<th width="180">Escolaridad</th>

<th width="120">Acción</th>

</tr>

</thead>

<tbody>

@foreach($plantilla_docentes as $docente)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td class="tw:text-left">

{{ $docente->nombre }}

</td>

<td>

{{ $docente->escolaridad ?? 'Sin datos' }}

</td>

<td class="tw:text-center">

<button class="elimina tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-1.5 tw:px-3 tw:py-2 tw:text-sm tw:whitespace-nowrap"
data-id="{{ $docente->id_personal }}"
title="Eliminar">

<i class="fa fa-trash"></i>

Quitar

</button>

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

<!-- MODAL AGREGAR -->

<x-panel.modal id="modal_agrega_docentes" tamano="sm" sin-relleno clase-cerrar="close">

<div class="tw:px-6 tw:pt-6 tw:pr-14">



<h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

<i class="fa fa-check"></i>

Confirmar acción

</h4>

</div>

<div class="tw-modal-cuerpo tw:text-center">

<form
action="{{url('/examen_gnral_con/guardar_docente_investigacion')}}"
method="POST"
id="form_docente_crea">

{{ csrf_field() }}

<input
type="hidden"
name="docente"
id="docente">

<p>

¿Desea agregar este docente a la plantilla?

</p>

</form>

</div>

<div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

<button class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
data-dismiss="modal">

Cancelar

</button>

<button
id="confirma_agrega" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

<i class="fa fa-check"></i>

Agregar

</button>

</div>

</x-panel.modal>

<!-- MODAL ELIMINAR -->

<x-panel.modal id="modal_elimina_docente" tamano="sm" sin-relleno clase-cerrar="close">

            <div class="tw:px-6 tw:pt-6 tw:pr-14">

                

                <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">

                    <i class="fa fa-trash"></i>

                    Confirmar eliminación

                </h4>

            </div>

            <div class="tw-modal-cuerpo tw:text-center">

                <form
                    action="{{ url('/examen_gnral_con/eliminar_docente_investigacion') }}"
                    method="POST"
                    id="form_docente_elimina">

                    {{ csrf_field() }}

                    <input
                        type="hidden"
                        name="docente"
                        id="docente_eliminar">

                    <p>

                        ¿Desea quitar este docente de la plantilla?

                    </p>

                </form>

            </div>

            <div class="tw:mt-4 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">

                <button
                    class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap"
                    data-dismiss="modal">

                    Cancelar

                </button>

                <button
                    id="confirma_elimina"
                    class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">

                    <i class="fa fa-trash"></i>

                    Eliminar

                </button>

            </div>

        </x-panel.modal>

</main>

<script>

$(document).ready(function(){

    $('#table-docentes-sin').DataTable({


        pageLength:10,

        order:[[1,'asc']]

    });

    $('#table-docentes-con').DataTable({


        pageLength:10,

        order:[[1,'asc']]

    });

    $("#table-docentes-sin").on("click",".agrega",function(){

        let id=$(this).data("id");

        $("#docente").val(id);

        $("#modal_agrega_docentes").modal("show");

    });

    $("#confirma_agrega").click(function(){

        $(this).prop("disabled",true);

        $("#form_docente_crea").submit();

    });

    $("#table-docentes-con").on("click",".elimina",function(){

        let id=$(this).data("id");

        $("#docente_eliminar").val(id);

        $("#modal_elimina_docente").modal("show");

    });

    $("#confirma_elimina").click(function(){

        $(this).prop("disabled",true);

        $("#form_docente_elimina").submit();

    });

});

</script>

</div>
@endsection