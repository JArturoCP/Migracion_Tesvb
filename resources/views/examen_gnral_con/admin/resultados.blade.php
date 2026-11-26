@extends('layouts.panel')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('title', 'Agregar Docentes en Plantilla')

@section('content')

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

<div class="tw:mb-6 tw:border-b tw:border-gray-200 tw:pb-2">

    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
            <h3>
                <i class="fa fa-users"></i>
                Administración de Docentes
            </h3>
        </div>

        <div class="tw:w-full tw:lg:w-6/12 tw:text-right tw:px-2">

            <a href="{{ route('admin.examen_general.nuevos_docentes') }}"
               class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">

                <i class="fa fa-user-plus"></i>

                Registrar docentes de nuevo ingreso

            </a>

        </div>

    </div>

</div>

<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

<div class="tw:w-full tw:xl:w-6/12 tw:lg:w-6/12 tw:px-2">

<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

<div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">

<h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">

<i class="fa fa-user"></i>

DOCENTES CANDIDATOS A PLANTILLA

</h4>

</div>

<div class="tw:p-5 tw:sm:p-6">

<div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">

<div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table
id="table-docentes-sin"
class="tw-tabla tw-tabla-rayas tw-tabla-bordes">

<thead>

<tr class="info">

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

<button
class="agrega tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm"
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

</div>

<div class="tw:w-full tw:xl:w-6/12 tw:lg:w-6/12 tw:px-2">

<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">

<div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">

<h4 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">

<i class="fa fa-check-circle"></i>

DOCENTES EN PLANTILLA

</h4>

</div>

<div class="tw:p-5 tw:sm:p-6">

<div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">

<div class="tw-tabla-contenedor tw:mb-4 tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200">
<table
id="table-docentes-con"
class="tw-tabla tw-tabla-rayas tw-tabla-bordes">

<thead>

<tr class="info">

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

<button
class="elimina tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-1.5 tw:px-3 tw:py-1.5 tw:text-sm"
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

</div>

<!-- MODAL AGREGAR -->

<div id="modal_agrega_docentes" class="modal fade tw-modal-compat" tabindex="-1" role="dialog" data-panel-modal hidden>

<div class="modal-dialog modal-sm">

<div class="modal-content">

<div class="modal-header modal-header-success">

<button
type="button"
class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700"
data-dismiss="modal">

&times;

</button>

<h4 class="modal-title tw:text-center">

<i class="fa fa-check"></i>

Confirmar acción

</h4>

</div>

<div class="modal-body tw:text-center">

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

<div class="modal-footer">

<button
class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
data-dismiss="modal">

Cancelar

</button>

<button
id="confirma_agrega"
class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">

<i class="fa fa-check"></i>

Agregar

</button>

</div>

</div>

</div>

</div>

<!-- MODAL ELIMINAR -->

<div id="modal_elimina_docente" class="modal fade tw-modal-compat" tabindex="-1" role="dialog" data-panel-modal hidden>

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header modal-header-danger">

                <button
                    type="button"
                    class="tw:text-2xl tw:leading-none tw:text-gray-400 tw:hover:text-gray-700"
                    data-dismiss="modal">

                    &times;

                </button>

                <h4 class="modal-title tw:text-center">

                    <i class="fa fa-trash"></i>

                    Confirmar eliminación

                </h4>

            </div>

            <div class="modal-body tw:text-center">

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

            <div class="modal-footer">

                <button
                    class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm"
                    data-dismiss="modal">

                    Cancelar

                </button>

                <button
                    id="confirma_elimina"
                    class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm">

                    <i class="fa fa-trash"></i>

                    Eliminar

                </button>

            </div>

        </div>

    </div>

</div>

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

@endsection