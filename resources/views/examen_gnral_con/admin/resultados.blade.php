@extends('layouts.app')
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

<main class="container-fluid">

<div class="page-header">

    <div class="row">

        <div class="col-md-6">
            <h3>
                <i class="fa fa-users"></i>
                Administración de Docentes
            </h3>
        </div>

        <div class="col-md-6 text-right">

            <a href="{{ route('admin.examen_general.nuevos_docentes') }}"
               class="btn btn-primary">

                <i class="fa fa-user-plus"></i>

                Registrar docentes de nuevo ingreso

            </a>

        </div>

    </div>

</div>

<div class="row">

<div class="col-lg-6 col-md-6">

<div class="panel panel-info">

<div class="panel-heading">

<h4 class="panel-title text-center">

<i class="fa fa-user"></i>

DOCENTES CANDIDATOS A PLANTILLA

</h4>

</div>

<div class="panel-body">

<div class="table-responsive">

<table
id="table-docentes-sin"
class="table table-striped table-hover table-bordered">

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

<td class="text-left">

{{ $docente->nombre }}

</td>

<td>

{{ $docente->escolaridad ?? 'Sin datos' }}

</td>

<td class="text-center">

<button
class="btn btn-success btn-sm agrega"
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

<div class="col-lg-6 col-md-6">

<div class="panel panel-primary">

<div class="panel-heading">

<h4 class="panel-title text-center">

<i class="fa fa-check-circle"></i>

DOCENTES EN PLANTILLA

</h4>

</div>

<div class="panel-body">

<div class="table-responsive">

<table
id="table-docentes-con"
class="table table-striped table-hover table-bordered">

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

<td class="text-left">

{{ $docente->nombre }}

</td>

<td>

{{ $docente->escolaridad ?? 'Sin datos' }}

</td>

<td class="text-center">

<button
class="btn btn-danger btn-sm elimina"
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

<div id="modal_agrega_docentes" class="modal fade">

<div class="modal-dialog modal-sm">

<div class="modal-content">

<div class="modal-header modal-header-success">

<button
type="button"
class="close"
data-dismiss="modal">

&times;

</button>

<h4 class="modal-title text-center">

<i class="fa fa-check"></i>

Confirmar acción

</h4>

</div>

<div class="modal-body text-center">

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
class="btn btn-default"
data-dismiss="modal">

Cancelar

</button>

<button
id="confirma_agrega"
class="btn btn-success">

<i class="fa fa-check"></i>

Agregar

</button>

</div>

</div>

</div>

</div>

<!-- MODAL ELIMINAR -->

<div id="modal_elimina_docente" class="modal fade">

    <div class="modal-dialog modal-sm">

        <div class="modal-content">

            <div class="modal-header modal-header-danger">

                <button
                    type="button"
                    class="close"
                    data-dismiss="modal">

                    &times;

                </button>

                <h4 class="modal-title text-center">

                    <i class="fa fa-trash"></i>

                    Confirmar eliminación

                </h4>

            </div>

            <div class="modal-body text-center">

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
                    class="btn btn-default"
                    data-dismiss="modal">

                    Cancelar

                </button>

                <button
                    id="confirma_elimina"
                    class="btn btn-danger">

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

        language:{
            url:"//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
        },

        pageLength:10,

        order:[[1,'asc']]

    });

    $('#table-docentes-con').DataTable({

        language:{
            url:"//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
        },

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