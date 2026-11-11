@extends('layouts.app')

@section('title', 'Validar Carga Académica Estudiante Dual')

@section('content')

<?php

$escolar = session()->has('escolar');
$jefe_division = session()->has('jefe_division');

$estado = isset($validaciones[0])
    ? (int) $validaciones[0]->estado_validacion
    : 0;

?>

<main>

    {{-- =========================================================
    MENSAJES
    ========================================================== --}}

    @if (session('error'))

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="mensaje-adeudo">

                <div class="mensaje-icono">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                </div>

                <div class="mensaje-contenido">

                    <h3>
                        No se puede enviar la carga académica
                    </h3>

                    <p>
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        </div>
    </div>

    @endif


    @if (session('success'))

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="mensaje-exito">

                <span class="glyphicon glyphicon-ok-sign"></span>

                <div>

                    <h3>
                        ¡Carga enviada correctamente!
                    </h3>

                    <p>
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>
    </div>

    @endif


    {{-- =========================================================
    TÍTULO
    ========================================================== --}}

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-info">

                <div class="panel-heading text-center">

                    <h3 class="panel-title">

                        <span class="glyphicon glyphicon-file"></span>

                        &nbsp; VER CARGA ACADÉMICA

                    </h3>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
    DATOS DEL ESTUDIANTE
    ========================================================== --}}

    @if ($usuario == 2)

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-info">

                <div class="panel-heading text-center">

                    <h4 class="panel-title">

                        <span class="glyphicon glyphicon-user"></span>

                        &nbsp; DATOS DEL ESTUDIANTE

                    </h4>

                </div>

                <div class="panel-body text-center estudiante-panel">

                    <h4>
                        {{ $cuenta_y_nom }}
                    </h4>

                </div>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    ESTADO DE LA CARGA
    ========================================================== --}}

    @if ($estado == 0)

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alerta-carga-pendiente">

                <div class="encabezado-alerta">

                    <div class="icono-alerta">
                        <i class="fa fa-clock-o"></i>
                    </div>

                    <h4>
                        Carga Académica Pendiente
                    </h4>

                </div>

                <p>
                    La carga académica aún no ha sido enviada
                    a Servicios Escolares.
                </p>

            </div>

        </div>

    </div>

    @elseif ($estado == 888)

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alerta-carga alerta-validacion">

                <div class="encabezado-alerta">

                    <div class="icono-alerta">
                        <i class="fa fa-refresh"></i>
                    </div>

                    <h4>
                        Validación por Servicios Escolares
                    </h4>

                </div>

                <p>
                    La carga académica fue enviada correctamente
                    y se encuentra en proceso de validación por
                    Servicios Escolares.
                </p>

            </div>

        </div>

    </div>

    @elseif ($estado == 1)

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alerta-carga alerta-jefe">

                <div class="encabezado-alerta">

                    <div class="icono-alerta">
                        <i class="fa fa-user"></i>
                    </div>

                    <h4>
                        Pendiente de autorización del Jefe de División
                    </h4>

                </div>

                <p>
                    Servicios Escolares validó la carga académica.
                    Ahora corresponde al Jefe de División autorizarla.
                </p>

            </div>

        </div>

    </div>

    @elseif ($estado == 2)

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="alerta-carga alerta-autorizada">

                <div class="encabezado-alerta">

                    <div class="icono-alerta">
                        <i class="fa fa-check"></i>
                    </div>

                    <h4>
                        Carga Académica Autorizada
                    </h4>

                </div>

                <p>
                    La carga académica ha sido autorizada correctamente.
                </p>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    ADEUDOS
    ========================================================== --}}

    @if ($usuario == 2)

    @if ($estado == 0 || $estado == 3 || $estado == 888)

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            @if ($adeudo == 0)

            <div class="panel panel-success">

                <div class="panel-heading text-center">

                    <h3 class="panel-title">

                        <span class="glyphicon glyphicon-ok-sign"></span>

                        &nbsp; ESTADO DE ADEUDOS

                    </h3>

                </div>

                <div class="panel-body text-center estado-panel">

                    <span class="glyphicon glyphicon-ok-circle icon-success"></span>

                    <h4 class="text-success">
                        ¡No tiene adeudo!
                    </h4>

                    <p class="text-muted">
                        <span class="glyphicon glyphicon-check"></span>
                        No se encontraron adeudos pendientes.
                    </p>

                </div>

            </div>

            @else

            <div class="panel panel-danger">

                <div class="panel-heading text-center">

                    <h3 class="panel-title">

                        <span class="glyphicon glyphicon-warning-sign"></span>

                        &nbsp; ESTADO DE ADEUDOS

                    </h3>

                </div>

                <div class="panel-body text-center estado-panel">

                    <span class="glyphicon glyphicon-remove-circle icon-danger"></span>

                    <h4 class="text-danger">
                        Tiene adeudos pendientes
                    </h4>

                    <p class="text-muted">
                        <span class="glyphicon glyphicon-info-sign"></span>

                        Tiene adeudo con los siguientes
                        departamentos o carreras:
                    </p>

                    <div class="adeudos-container">

                        @foreach ($departamento_carrera as $adeudo_item)

                        <div class="well adeudo-item">

                            <h4 class="text-danger">

                                <span class="glyphicon glyphicon-briefcase"></span>

                                &nbsp;
                                {{ $adeudo_item['nombre'] }}

                            </h4>

                            <p>

                                <span class="glyphicon glyphicon-comment"></span>

                                &nbsp;
                                {{ $adeudo_item['comentario'] }}

                            </p>

                        </div>

                        @endforeach

                    </div>

                </div>

            </div>

            @endif

        </div>

    </div>

    @endif

    @endif


    {{-- =========================================================
    TABLA DE CARGA ACADÉMICA
    ========================================================== --}}

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <table class="table table-bordered" style="background:white;">

                <thead>

                    <tr class="info">

                        <th class="text-center">
                            CLAVE DE LA MATERIA
                        </th>

                        <th class="text-center">
                            NOMBRE DE LA MATERIA
                        </th>

                        <th class="text-center">
                            CRÉDITOS
                        </th>

                        <th class="text-center">
                            STATUS
                        </th>

                        <th class="text-center">
                            TIPO CURSA
                        </th>

                        <th class="text-center">
                            GRUPO
                        </th>

                        @if ($estado == 0 || $estado == 3)

                        <th class="text-center">
                            ELIMINAR
                        </th>

                        @endif

                    </tr>

                </thead>

                <tbody>

                    @foreach ($datos_carga as $consulta1)

                    @if ($consulta1['id_materia'] == 2258)

                    <tr>

                        <th></th>

                        <th class="text-center">
                            {{ $consulta1['clave'] }}
                        </th>

                        <td class="text-center">
                            {{ $consulta1['nombre'] }}
                        </td>

                        <td></td>

                        <td class="text-center">
                            ALTA
                        </td>

                        <td></td>

                        @if ($estado == 0 || $estado == 3)

                        <th class="text-center">

                            <a href="javascript:void(0)" class="elimina"
                                data-id_carga_academica="{{ $consulta1['id_carga_academica'] }}">

                                <span class="glyphicon glyphicon-trash" style="color:crimson;">
                                </span>

                            </a>

                        </th>

                        @endif

                    </tr>

                    @else

                    <tr>

                        <th class="text-center">
                            {{ $consulta1['clave'] }}
                        </th>

                        <td class="text-center">
                            {{ $consulta1['nombre'] }}
                        </td>

                        <td class="text-center">
                            {{ $consulta1['creditos'] }}
                        </td>

                        <td class="text-center">
                            {{ $consulta1['nombre_status'] }}
                        </td>

                        <td class="text-center">
                            {{ $consulta1['nombre_curso'] }}
                        </td>

                        <td class="text-center">
                            {{ $consulta1['id_semestre'] }}0{{ $consulta1['grupo'] }}
                        </td>

                        @if ($estado == 0 || $estado == 3)

                        <th class="text-center">

                            <a href="javascript:void(0)" class="elimina"
                                data-id_carga_academica="{{ $consulta1['id_carga_academica'] }}">

                                <span class="glyphicon glyphicon-trash" style="color:crimson;">
                                </span>

                            </a>

                        </th>

                        @endif

                    </tr>

                    @endif

                    @endforeach


                    {{-- TOTAL --}}

                    <tr>

                        <th></th>
                        <th></th>

                        <td class="text-center">
                            <b>Total de créditos:</b>
                        </td>

                        <td class="text-center">
                            {{ $suma }}
                        </td>

                        <td></td>

                        @if ($estado == 0 || $estado == 3)

                        <td></td>
                        <td></td>

                        @endif

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    {{-- =========================================================
    BOTÓN ENVIAR A SERVICIOS ESCOLARES
     
    IMPORTANTE:
     
    NO SE VALIDA $creditoss.
     
    SOLO:
     
    estado 0 o 3
     
    Y EL CONTROL REAL DE ADEUDO ESTÁ EN EL CONTROLADOR.
    ========================================================== --}}

    @if ($estado == 0 || $estado == 3)

    <div class="row">

        <div class="col-md-4 col-md-offset-4">

            <div class="panel panel-success">

                <div class="panel-heading text-center">

                    <h4 class="panel-title">

                        <span class="glyphicon glyphicon-send"></span>

                        ENVIAR CARGA ACADÉMICA

                    </h4>

                </div>

                <div class="panel-body text-center">

                    @if ($adeudo == 1)

                    <div class="alert alert-danger">

                        <span class="glyphicon glyphicon-warning-sign"></span>

                        <strong>
                            No puede enviar la carga.
                        </strong>

                        <p style="margin-top:8px;">
                            El estudiante tiene adeudos pendientes.
                            Debe regularizar su situación antes
                            de continuar.
                        </p>

                    </div>

                    <button type="button" class="btn btn-danger btn-lg" disabled>

                        <span class="glyphicon glyphicon-lock"></span>

                        Envío bloqueado por adeudo

                    </button>

                    @else

                    <p>
                        La carga académica está lista para ser
                        enviada a Servicios Escolares.
                    </p>

                    <a href="{{ url('/duales/enviar_carga/' . ($id_alu ?? $alumno)) }}" class="btn btn-success btn-lg"
                        id="btnEnviar">

                        <span class="glyphicon glyphicon-send"></span>

                        Enviar a Servicios Escolares

                    </a>


                    @endif

                </div>

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    AUTORIZACIÓN JEFE DE DIVISIÓN
    ========================================================== --}}

    @if ($usuario == 2 && $jefe_division)

    @if ($estado == 1)

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-primary">

                <div class="panel-heading text-center">

                    <h4 class="panel-title">

                        <span class="glyphicon glyphicon-user"></span>

                        AUTORIZACIÓN DEL JEFE DE DIVISIÓN

                    </h4>

                </div>

                <div class="panel-body text-center">

                    <p>
                        Servicios Escolares ya validó esta
                        carga académica.
                    </p>

                    <p>
                        El siguiente paso corresponde al
                        Jefe de División.
                    </p>

                    <form method="POST" action="{{ url('/duales/validacion_de_carga/' . $id) }}" id="formupdate">

                        <input type="hidden" name="_method" value="PUT">

                        {{ csrf_field() }}

                        <input type="hidden" name="estado" value="2">

                        <button type="submit" class="btn btn-success btn-lg">

                            <span class="glyphicon glyphicon-ok"></span>

                            Autorizar Carga Académica

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    @endif

    @endif


    {{-- =========================================================
    IMPRESIÓN
    ========================================================== --}}

    @if ($usuario == 2)

    @if ($estado == 2 || $estado == 8 || $estado == 9)

    <div class="row">

        <div class="col-md-4 col-md-offset-4">

            <div class="alert alert-success text-center">

                <p>
                    <strong>
                        Carga Académica Aceptada
                    </strong>
                </p>

                <a href="/duales/imprime_control/{{ $id }}" target="_blank" class="btn btn-success">

                    <span class="glyphicon glyphicon-print"></span>

                    Imprimir

                </a>

            </div>

        </div>

    </div>

    @endif

    @endif


    {{-- =========================================================
    MODAL ELIMINAR
    ========================================================== --}}

    <div id="modal_elimina" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">

        <div class="modal-dialog modal-sm">

            <div class="modal-content">

                <div class="modal-body">

                    <form action="" method="POST" id="form_delete">

                        {{ method_field('DELETE') }}

                        {{ csrf_field() }}

                        <input type="hidden" id="id_carga_academica" name="id_carga_academica">

                        <b>
                            ¿Realmente deseas eliminar este elemento?
                        </b>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn" data-dismiss="modal" style="background:crimson;color:white;">

                        Cancelar

                    </button>

                    <button id="confirma_elimina" type="button" class="btn btn-success">

                        Aceptar

                    </button>

                </div>

            </div>

        </div>

    </div>

</main>


{{-- =============================================================
ESTILOS
============================================================= --}}

<style>
.panel-title {
    font-weight: bold;
}

.panel-heading {
    padding: 10px 15px;
}

.panel-body {
    padding: 20px;
}

.estudiante-panel {
    padding: 15px;
}

.estudiante-panel h4 {
    margin: 8px 0 0;
    font-weight: bold;
    color: #555;
}

.estado-panel {
    padding: 20px;
}

.estado-panel h4 {
    font-weight: bold;
    margin: 10px 0;
}

.icon-success {
    font-size: 50px;
    color: #5cb85c;
}

.icon-danger {
    font-size: 50px;
    color: #d9534f;
}

.adeudos-container {
    margin-top: 15px;
}

.adeudo-item {
    padding: 10px;
    margin-bottom: 8px;
    text-align: center;
    background-color: #f9f9f9;
    border-left: 4px solid #d9534f;
}

.adeudo-item h4 {
    margin: 0 0 5px;
    font-weight: bold;
}

.adeudo-item p {
    margin: 0;
    color: #777;
}


/* ============================================================
   ALERTAS
============================================================ */

.alerta-carga {
    border-radius: 8px;
    padding: 15px 20px;
    margin: 15px 0;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
}

.alerta-carga-pendiente {
    background: #fff8e1;
    border-left: 4px solid #f0ad4e;
    border-radius: 8px;
    padding: 15px 20px;
    margin: 15px 0;
    text-align: center;
    color: #856404;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .08);
}

.alerta-validacion {
    background: #fff8e1;
    border-left: 4px solid #f0ad4e;
    color: #856404;
}

.alerta-jefe {
    background: #e8f4fd;
    border-left: 4px solid #337ab7;
    color: #31708f;
}

.alerta-autorizada {
    background: #eaf7ed;
    border-left: 4px solid #5cb85c;
    color: #3c763d;
}

.encabezado-alerta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 7px;
}

.icono-alerta {
    width: 38px;
    height: 38px;
    line-height: 38px;
    border-radius: 50%;
    font-size: 19px;
    text-align: center;
    flex-shrink: 0;
}

.alerta-carga-pendiente .icono-alerta,
.alerta-validacion .icono-alerta {
    background: #fff3cd;
    color: #f0ad4e;
}

.alerta-jefe .icono-alerta {
    background: #d9edf7;
    color: #337ab7;
}

.alerta-autorizada .icono-alerta {
    background: #dff0d8;
    color: #5cb85c;
}

.encabezado-alerta h4 {
    margin: 0;
    font-size: 17px;
    font-weight: 600;
}

.alerta-carga-pendiente p,
.alerta-carga p {
    margin: 0;
    font-size: 13px;
    line-height: 1.4;
}


/* ============================================================
   MENSAJE DE ADEUDO
============================================================ */

.mensaje-adeudo {
    display: flex;
    align-items: center;
    background: #fff1f0;
    border: 1px solid #f5c6cb;
    border-left: 6px solid #d9534f;
    border-radius: 10px;
    padding: 18px 22px;
    margin: 20px 0;
    box-shadow: 0 3px 10px rgba(217, 83, 79, .12);
}

.mensaje-icono {
    width: 55px;
    height: 55px;
    min-width: 55px;
    border-radius: 50%;
    background: #d9534f;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-right: 18px;
}

.mensaje-contenido h3 {
    margin: 0 0 7px;
    color: #a94442;
    font-weight: bold;
}

.mensaje-contenido p {
    margin: 0;
    color: #843534;
    line-height: 1.5;
}


/* ============================================================
   MENSAJE DE ÉXITO
============================================================ */

.mensaje-exito {
    display: flex;
    align-items: center;
    background: #f0fff4;
    border: 1px solid #c3e6cb;
    border-left: 6px solid #5cb85c;
    border-radius: 10px;
    padding: 18px 22px;
    margin: 20px 0;
    color: #3c763d;
}

.mensaje-exito>span {
    font-size: 45px;
    margin-right: 18px;
}

.mensaje-exito h3 {
    margin: 0 0 7px;
    font-weight: bold;
}

.mensaje-exito p {
    margin: 0;
}


/* ============================================================
   BOTÓN
============================================================ */

#btnEnviar {
    min-width: 260px;
    font-weight: bold;
    box-shadow: 0 3px 6px rgba(0, 0, 0, .15);
}
</style>


{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script>
$(document).ready(function() {

    /*
     * ============================================================
     * ELIMINAR CARGA
     * ============================================================
     */

    $(".elimina").click(function() {

        var id_carga_academica =
            $(this).data('id_carga_academica');

        $('#id_carga_academica')
            .val(id_carga_academica);

        $('#modal_elimina').modal('show');

    });


    /*
     * ============================================================
     * CONFIRMAR ELIMINACIÓN
     * ============================================================
     */

    $("#confirma_elimina").click(function() {

        var id_carga_academica =
            $("#id_carga_academica").val();

        $("#form_delete").attr(
            "action",
            "/duales/eliminar_carga_academica/" +
            id_carga_academica
        );

        $("#form_delete").submit();

    });


    /*
     * ============================================================
     * EVITAR DOBLE ENVÍO
     * ============================================================
     */

    $("#btnEnviar").click(function() {

        var boton = $(this);

        boton.css(
            "pointer-events",
            "none"
        );

        boton.html(
            '<span class="glyphicon glyphicon-refresh"></span> Enviando...'
        );

    });


    /*
     * ============================================================
     * EVITAR DOBLE AUTORIZACIÓN
     * ============================================================
     */

    $("#formupdate").submit(function() {

        $(this)
            .find('button[type="submit"]')
            .prop('disabled', true);

    });

});
</script>

@endsection