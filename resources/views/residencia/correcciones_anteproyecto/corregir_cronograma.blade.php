@extends('layouts.app')
@section('title', 'Corregir Anteproyecto')
@section('content')

@php

/*
=============================================================
OBTENER ANTEPROYECTO
=============================================================
*/

$id_anteproyecto = null;

if (isset($cronograma) && count($cronograma) > 0) {
    $id_anteproyecto = $cronograma[0]->id_anteproyecto;
}

$datos_anteproyecto = null;

if ($id_anteproyecto) {

    $datos_anteproyecto = DB::table('resi_anteproyecto')
        ->where('id_anteproyecto', $id_anteproyecto)
        ->first();

}

/*
=============================================================
ESTADOS
=============================================================

estado_permiso = 4
El alumno tiene permiso para corregir.

estado_enviado = 3
El alumno ya realizó la corrección con el permiso.

estado_aceptado_cronograma = 1
El cronograma está autorizado.

IMPORTANTE:
La autorización se revisa POR ACTIVIDAD.
No se debe deshabilitar todo el cronograma porque
una sola actividad esté autorizada.
*/

$tiene_permiso = false;

if ($datos_anteproyecto) {

    if (
        $datos_anteproyecto->estado_permiso == 4 &&
        $datos_anteproyecto->estado_enviado != 3
    ) {

        $tiene_permiso = true;

    }

}

/*
=============================================================
VERIFICAR SI TODO EL CRONOGRAMA ESTÁ AUTORIZADO
=============================================================
*/

$cronograma_autorizado = false;

if (isset($cronograma) && count($cronograma) > 0) {

    $cronograma_autorizado = true;

    foreach ($cronograma as $semana) {

        if ($semana->estado_aceptado_cronograma != 1) {

            $cronograma_autorizado = false;
            break;

        }

    }

}

@endphp


<div class="container-fluid">

    {{-- =========================================================
    MENSAJE DE PERMISO ESPECIAL
    ========================================================== --}}

    @if($tiene_permiso)

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="alert alert-warning text-center"
                 style="
                    border-radius:8px;
                    margin-top:15px;
                    border-left:5px solid #f0ad4e;
                 ">

                <span class="glyphicon glyphicon-pencil"
                      style="font-size:20px;">
                </span>

                <strong>
                    El Departamento de Servicio Social y Residencia Profesional
                    te ha otorgado permiso para modificar nuevamente tu
                    cronograma.
                </strong>

                <br>

                Realiza las correcciones necesarias y presiona
                <strong>Guardar</strong>.

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    MENSAJE CRONOGRAMA AUTORIZADO
    ========================================================== --}}

    @if($cronograma_autorizado)

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="alert alert-success text-center"
                 style="
                    border-radius:8px;
                    margin-top:15px;
                    border-left:5px solid #5cb85c;
                 ">

                <span class="glyphicon glyphicon-ok-circle"
                      style="font-size:20px;">
                </span>

                <strong>
                    Tu cronograma fue corregido y autorizado.
                </strong>

                <br>

                El Departamento de Servicio Social y Residencia Profesional
                ha validado nuevamente tu cronograma.

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
    CONTENEDOR PRINCIPAL
    ========================================================== --}}

    <div class="row">

        <div class="col-md-10 col-md-offset-1 col-xs-12">

            <div class="panel panel-info"
                 style="
                    border-radius:8px;
                    box-shadow:0 2px 8px rgba(0,0,0,.08);
                 ">

                {{-- ENCABEZADO --}}

                <div class="panel-heading"
                     style="
                        text-align:center;
                        font-size:18px;
                        font-weight:bold;
                     ">

                    <span class="glyphicon glyphicon-edit"></span>

                    Corregir Cronograma

                </div>


                <div class="panel-body">

                    {{-- =================================================
                    NAVEGACIÓN
                    ================================================== --}}

                    <div class="row">

                        {{-- ATRÁS --}}

                        <div class="col-md-2 col-md-offset-3"
                             style="text-align:center;">

                            <a href="{{url('/residencia/anteproyecto/corregir_marco_teorico')}}"
                               class="btn btn-link"
                               style="font-weight:bold;">

                                <span class="glyphicon glyphicon-arrow-left"
                                      style="
                                        font-size:45px;
                                        color:#458acc;
                                      ">
                                </span>

                                <br>

                                Atrás

                            </a>

                        </div>


                        {{-- SIGUIENTE --}}

                        <div class="col-md-2 col-md-offset-2"
                             style="text-align:center;">

                            <a href="{{url('/residencia/anteproyecto/corregir_enviar_anteproyecto')}}"
                               class="btn btn-link"
                               style="font-weight:bold;">

                                <span class="glyphicon glyphicon-arrow-right"
                                      style="
                                        font-size:45px;
                                        color:#458acc;
                                      ">
                                </span>

                                <br>

                                Siguiente

                            </a>

                        </div>

                    </div>

                    <br>


                    {{-- =================================================
                    CONTENIDO
                    ================================================== --}}

                    <div class="row">


                        {{-- =================================================
                        CRONOGRAMA
                        ================================================== --}}

                        <div class="col-md-8">

                            <div class="panel panel-primary"
                                 style="
                                    border-radius:8px;
                                    box-shadow:0 2px 6px rgba(0,0,0,.08);
                                 ">

                                <div class="panel-heading text-center">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                    Cronograma de Actividades

                                </div>


                                <div class="panel-body">

                                    @foreach($cronograma as $semana)

                                    @php

                                        $fecha_inicial =
                                            date(
                                                "d-m-Y",
                                                strtotime($semana->f_inicio)
                                            );

                                        $fecha_final =
                                            date(
                                                "d-m-Y",
                                                strtotime($semana->f_termino)
                                            );

                                    @endphp


                                    <div class="col-md-12 text-center"
                                         style="margin-bottom:10px;">

                                        <div style="
                                            border:3px solid #d9edf7;
                                            border-radius:5px;
                                            padding:10px;
                                        ">

                                            {{-- SEMANA --}}

                                            <h5>

                                                <strong>
                                                    SEMANA {{$semana->no_semana}}
                                                </strong>

                                            </h5>


                                            {{-- FECHAS --}}

                                            <p>

                                                <b>
                                                    {{$fecha_inicial}}
                                                </b>

                                                al

                                                <b>
                                                    {{$fecha_final}}
                                                </b>

                                            </p>


                                            {{-- ACTIVIDAD --}}

                                            <p>

                                                <b>
                                                    Actividad(es)
                                                </b>

                                                <br>

                                                {{$semana->actividad}}

                                            </p>


                                            {{-- =================================================
                                            BOTÓN DE ESTA ACTIVIDAD
                                            ================================================== --}}

                                            @if($semana->estado_aceptado_cronograma == 1)

                                                <button
                                                    type="button"
                                                    class="btn btn-success"
                                                    disabled
                                                    style="min-width:130px;">

                                                    <span class="glyphicon glyphicon-ok"></span>

                                                    Autorizado

                                                </button>

                                            @else

                                                <button
                                                    type="button"
                                                    class="btn btn-primary modificar_actividad"
                                                    data-id="{{$semana->id_cronograma}}"
                                                    data-semana="{{$semana->no_semana}}"
                                                    data-fecha-inicial="{{$semana->f_inicio}}"
                                                    data-fecha-final="{{$semana->f_termino}}"
                                                    data-actividad="{{htmlspecialchars($semana->actividad, ENT_QUOTES, 'UTF-8')}}">

                                                    <span class="glyphicon glyphicon-cog"></span>

                                                    Modificar

                                                </button>

                                            @endif

                                        </div>

                                    </div>

                                    @endforeach

                                    <div style="clear:both;"></div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                        COMENTARIOS
                        ================================================== --}}

                        <div class="col-md-4">

                            <div class="panel panel-default"
                                 style="
                                    border-radius:8px;
                                    box-shadow:0 2px 6px rgba(0,0,0,.08);
                                 ">

                                <div class="panel-heading text-center"
                                     style="font-weight:bold;">

                                    <span class="glyphicon glyphicon-comment"></span>

                                    COMENTARIOS DE LOS REVISORES

                                </div>


                                <div class="panel-body">


                                    {{-- MENSAJE DE ESTADO --}}

                                    @if($cronograma_autorizado)

                                        <div class="alert alert-success text-center">

                                            <span class="glyphicon glyphicon-ok-circle"></span>

                                            <strong>
                                                Ya te autorizaron el cronograma.
                                            </strong>

                                            <br>

                                            El cronograma corregido fue
                                            registrado correctamente.

                                        </div>


                                    @elseif($tiene_permiso)

                                        <div class="alert alert-warning text-center">

                                            <span class="glyphicon glyphicon-pencil"></span>

                                            <strong>
                                                Tienes permiso para modificar
                                                nuevamente esta sección.
                                            </strong>

                                            <br>

                                            Realiza las correcciones necesarias
                                            y presiona <strong>Guardar</strong>.

                                        </div>


                                    @else

                                        <div class="alert alert-danger text-center">

                                            <span class="glyphicon glyphicon-warning-sign"></span>

                                            <strong>
                                                Corrige lo que se te pide en los
                                                comentarios de los revisores.
                                            </strong>

                                        </div>

                                    @endif


                                    {{-- =================================================
                                    COMENTARIOS DE DOCENTES
                                    ================================================== --}}

                                    @foreach($comentarios_cronograma as $comentario)


                                        {{-- AUTORIZADO --}}

                                        @if($comentario->id_estado_evaluacion == 1)

                                            <div class="panel panel-success">

                                                <div class="panel-heading text-center">

                                                    <strong>
                                                        NOMBRE DEL DOCENTE:
                                                    </strong>

                                                    {{$comentario->nombre}}

                                                    <br>

                                                    <strong>
                                                        STATUS DEL ANTEPROYECTO:
                                                    </strong>

                                                    AUTORIZADO

                                                </div>

                                                <div class="panel-body">

                                                    {{$comentario->comentario}}

                                                </div>

                                            </div>


                                        {{-- ACEPTADO CON CAMBIOS --}}

                                        @elseif($comentario->id_estado_evaluacion == 2)

                                            <div class="panel panel-warning">

                                                <div class="panel-heading text-center">

                                                    <strong>
                                                        NOMBRE DEL DOCENTE:
                                                    </strong>

                                                    {{$comentario->nombre}}

                                                    <br>

                                                    <strong>
                                                        STATUS DEL ANTEPROYECTO:
                                                    </strong>

                                                    ACEPTADO CON CAMBIOS

                                                </div>

                                                <div class="panel-body">

                                                    {{$comentario->comentario}}

                                                </div>

                                            </div>


                                        {{-- RECHAZADO --}}

                                        @elseif($comentario->id_estado_evaluacion == 3)

                                            <div class="panel panel-danger">

                                                <div class="panel-heading text-center">

                                                    <strong>
                                                        NOMBRE DEL DOCENTE:
                                                    </strong>

                                                    {{$comentario->nombre}}

                                                    <br>

                                                    <strong>
                                                        STATUS DEL ANTEPROYECTO:
                                                    </strong>

                                                    RECHAZADO

                                                </div>

                                                <div class="panel-body">

                                                    {{$comentario->comentario}}

                                                </div>

                                            </div>

                                        @endif

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
MODAL MODIFICAR ACTIVIDAD
============================================================= --}}

<div class="modal fade"
     id="modal_modificar_actividad"
     tabindex="-1"
     role="dialog"
     aria-labelledby="modalActividad">

    <div class="modal-dialog" role="document">

        <div class="modal-content"
             style="
                border-radius:8px;
                overflow:hidden;
                box-shadow:0 5px 20px rgba(0,0,0,.25);
             ">

            <form
                id="form_modificar_actividades"
                class="form"
                action="{{url('/residencia/guardar_correciones_cronograma/')}}"
                method="POST">

                {{ csrf_field() }}

                {{-- =================================================
                ENCABEZADO
                ================================================== --}}

                <div class="modal-header"
                     style="
                        background:linear-gradient(135deg,#337ab7,#286090);
                        color:white;
                        border-bottom:none;
                        padding:18px 20px;
                     ">

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        style="
                            color:white;
                            opacity:.9;
                            font-size:28px;
                        ">

                        <span>&times;</span>

                    </button>

                    <h4 class="modal-title text-center"
                        style="
                            font-weight:bold;
                            margin:0;
                        ">

                        <span class="glyphicon glyphicon-edit"></span>

                        &nbsp;Modificar actividad

                    </h4>

                </div>


                {{-- =================================================
                CUERPO
                ================================================== --}}

                <div class="modal-body"
                     style="
                        padding:25px;
                        background:#f8f9fa;
                     ">

                    {{-- ID CRONOGRAMA --}}

                    <input
                        type="hidden"
                        id="modal_id_cronograma"
                        name="id_cronograma"
                        value="">


                    {{-- =================================================
                    FECHA INICIAL
                    ================================================== --}}

                    <div class="form-group">

                        <label for="modal_fecha_inicial">

                            <span class="glyphicon glyphicon-calendar"
                                  style="color:#337ab7;">
                            </span>

                            Fecha inicial

                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="modal_fecha_inicial"
                            name="fecha_inicial"
                            readonly
                            style="
                                height:42px;
                                border-radius:5px;
                                background:#eeeeee;
                                cursor:not-allowed;
                            ">

                        <small class="text-muted">
                            La fecha de inicio de la semana no puede modificarse.
                        </small>

                    </div>


                    {{-- =================================================
                    FECHA FINAL
                    ================================================== --}}

                    <div class="form-group">

                        <label for="modal_fecha_final">

                            <span class="glyphicon glyphicon-calendar"
                                  style="color:#337ab7;">
                            </span>

                            Fecha final

                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="modal_fecha_final"
                            name="fecha_s"
                            readonly
                            style="
                                height:42px;
                                border-radius:5px;
                                background:#eeeeee;
                                cursor:not-allowed;
                            ">

                        <small class="text-muted">
                            La fecha de término de la semana no puede modificarse.
                        </small>

                    </div>


                    {{-- =================================================
                    ACTIVIDAD
                    ================================================== --}}

                    <div class="form-group">

                        <label for="modal_actividades">

                            <span class="glyphicon glyphicon-tasks"
                                  style="color:#337ab7;">
                            </span>

                            Actividad(es)

                        </label>

                        <textarea
                            class="form-control"
                            id="modal_actividades"
                            name="actividades"
                            rows="8"
                            placeholder="Ingresa la actividad correspondiente a esta semana"
                            required
                            style="
                                border-radius:5px;
                                resize:vertical;
                            "></textarea>

                        <small class="text-muted">

                            Aquí puedes corregir las actividades
                            correspondientes únicamente a esta semana.

                        </small>

                    </div>

                </div>


                {{-- =================================================
                PIE DEL MODAL
                ================================================== --}}

                <div class="modal-footer"
                     style="
                        background:#f5f5f5;
                        border-top:1px solid #ddd;
                        padding:15px 20px;
                     ">

                    <button
                        type="button"
                        class="btn btn-default"
                        data-dismiss="modal"
                        style="
                            min-width:110px;
                            border-radius:5px;
                        ">

                        <span class="glyphicon glyphicon-remove"></span>

                        Cancelar

                    </button>

                    <button
                        type="button"
                        id="guarda_actividades"
                        class="btn btn-primary"
                        style="
                            min-width:110px;
                            border-radius:5px;
                        ">

                        <span class="glyphicon glyphicon-floppy-disk"></span>

                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>


{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script type="text/javascript">

$(document).ready(function() {


    /*
    =============================================================
    ABRIR MODAL DE LA ACTIVIDAD SELECCIONADA
    =============================================================
    */

    $(".modificar_actividad").click(function(event) {

        event.preventDefault();


        /*
        ---------------------------------------------------------
        OBTENER DATOS DE LA ACTIVIDAD SELECCIONADA
        ---------------------------------------------------------
        */

        var id_cronograma =
            $(this).attr("data-id");

        var semana =
            $(this).attr("data-semana");

        var fecha_inicial =
            $(this).attr("data-fecha-inicial");

        var fecha_final =
            $(this).attr("data-fecha-final");

        var actividad =
            $(this).attr("data-actividad");


        /*
        ---------------------------------------------------------
        COLOCAR DATOS EN EL MODAL
        ---------------------------------------------------------
        */

        $("#modal_id_cronograma")
            .val(id_cronograma);

        $("#modal_fecha_inicial")
            .val(fecha_inicial);

        $("#modal_fecha_final")
            .val(fecha_final);

        $("#modal_actividades")
            .val(actividad);


        /*
        ---------------------------------------------------------
        CAMBIAR TÍTULO
        ---------------------------------------------------------
        */

        $("#modal_modificar_actividad .modal-title")
            .html(
                "Modificar actividad - Semana " + semana
            );


        /*
        ---------------------------------------------------------
        HABILITAR BOTÓN
        ---------------------------------------------------------
        */

        $("#guarda_actividades")
            .prop("disabled", false);


        /*
        ---------------------------------------------------------
        ABRIR MODAL
        ---------------------------------------------------------
        */

        $("#modal_modificar_actividad")
            .modal("show");

    });


    /*
    =============================================================
    GUARDAR ACTIVIDAD SELECCIONADA
    =============================================================
    */

    $("#guarda_actividades").click(function(event) {

        event.preventDefault();


        /*
        ---------------------------------------------------------
        OBTENER DATOS
        ---------------------------------------------------------
        */

        var id_cronograma =
            $.trim($("#modal_id_cronograma").val());

        var fecha_inicial =
            $.trim($("#modal_fecha_inicial").val());

        var fecha_final =
            $.trim($("#modal_fecha_final").val());

        var actividades =
            $.trim($("#modal_actividades").val());


        /*
        ---------------------------------------------------------
        VALIDAR ID
        ---------------------------------------------------------
        */

        if (id_cronograma == "") {

            swal({
                position: "top",
                type: "warning",
                title: "No se identificó la actividad.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR FECHA INICIAL
        ---------------------------------------------------------
        */

        if (fecha_inicial == "") {

            swal({
                position: "top",
                type: "warning",
                title: "Selecciona la fecha inicial.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR FECHA FINAL
        ---------------------------------------------------------
        */

        if (fecha_final == "") {

            swal({
                position: "top",
                type: "warning",
                title: "Selecciona la fecha final.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR ACTIVIDAD
        ---------------------------------------------------------
        */

        if (actividades == "") {

            swal({
                position: "top",
                type: "warning",
                title: "El campo de actividad se encuentra vacío.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        VALIDAR FECHAS
        ---------------------------------------------------------
        */

        if (fecha_final < fecha_inicial) {

            swal({
                position: "top",
                type: "warning",
                title: "La fecha final no puede ser menor que la fecha inicial.",
                showConfirmButton: false,
                timer: 3500
            });

            return false;

        }


        /*
        ---------------------------------------------------------
        EVITAR DOBLE ENVÍO
        ---------------------------------------------------------
        */

        $("#guarda_actividades")
            .prop("disabled", true);


        /*
        ---------------------------------------------------------
        ENVIAR FORMULARIO
        ---------------------------------------------------------
        */

        $("#form_modificar_actividades")
            .submit();

    });


    /*
    =============================================================
    LIMPIAR MODAL AL CERRAR
    =============================================================
    */

    $("#modal_modificar_actividad").on(
        "hidden.bs.modal",
        function() {

            $("#modal_id_cronograma").val("");

            $("#modal_fecha_inicial").val("");

            $("#modal_fecha_final").val("");

            $("#modal_actividades").val("");

            $("#guarda_actividades")
                .prop("disabled", false);

        }
    );


});

</script>

@endsection
