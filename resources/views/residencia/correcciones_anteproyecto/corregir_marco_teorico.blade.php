@extends('layouts.app')
@section('title', 'Registrar Anteproyecto')
@section('content')

@php
/*OBTENER ESTADO DEL ANTEPROYECTO*/

$datos_anteproyecto = DB::table('resi_anteproyecto')
->where('id_anteproyecto', $marco_teorico->id_anteproyecto)
->first();

/*
ESTADOS

estado_permiso = 4
El alumno tiene permiso para corregir.

estado_enviado = 3
El alumno ya realizó la corrección con el permiso.

estado_aceptado_marco = 1
El Marco Teórico está autorizado.

IMPORTANTE:
Después de guardar con permiso 4, tu controlador NO cambia
estado_permiso. Cambia estado_enviado a 2.

Por eso NO usamos solamente estado_permiso para determinar
si debe aparecer "Marco Teórico autorizado".
*/

$tiene_permiso = false;
$marco_teorico_autorizado = false;

if ($datos_anteproyecto) {

/*
---------------------------------------------------------
TIENE PERMISO PARA CORREGIR
---------------------------------------------------------
*/

if (
$datos_anteproyecto->estado_permiso == 4 &&
$datos_anteproyecto->estado_enviado != 3
) {

$tiene_permiso = true;

}

/*
---------------------------------------------------------
MARCO TEÓRICO AUTORIZADO
---------------------------------------------------------
*/

if (
$marco_teorico->estado_aceptado_marco == 1 &&
$datos_anteproyecto->estado_enviado == 3
) {

$marco_teorico_autorizado = true;

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

            <div class="alert alert-warning text-center" style="
            border-radius:8px;
            margin-top:15px;
            border-left:5px solid #f0ad4e;
         ">

                <span class="glyphicon glyphicon-pencil" style="font-size:20px;">
                </span>

                <strong>

                    El Departamento de Servicio Social y Residencia Profesional
                    te ha otorgado permiso para modificar nuevamente tu
                    Marco Teórico.

                </strong>

                <br>

                Realiza las correcciones necesarias y presiona
                <strong>Guardar</strong>.

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
  MENSAJE MARCO TEÓRICO AUTORIZADO
  ========================================================== --}}

    @if($marco_teorico_autorizado)

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="alert alert-success text-center" style="
            border-radius:8px;
            margin-top:15px;
            border-left:5px solid #5cb85c;
         ">

                <span class="glyphicon glyphicon-ok-circle" style="font-size:20px;">
                </span>

                <strong>

                    Tu Marco Teórico fue corregido y autorizado.

                </strong>

                <br>

                El Departamento de Servicio Social y Residencia Profesional
                ha validado nuevamente tu Marco Teórico.

            </div>

        </div>

    </div>

    @endif


    {{-- =========================================================
  CONTENEDOR PRINCIPAL
  ========================================================== --}}

    <div class="row">

        <div class="col-md-10 col-md-offset-1 col-xs-12">

            <div class="panel panel-info" style="
            border-radius:8px;
            box-shadow:0 2px 8px rgba(0,0,0,.08);
         ">


                {{-- =================================================
        ENCABEZADO
        ================================================== --}}

                <div class="panel-heading" style="
                text-align:center;
                font-size:18px;
                font-weight:bold;
             ">

                    <span class="glyphicon glyphicon-edit"></span>

                    Corregir Marco Teórico

                </div>


                <div class="panel-body">


                    {{-- =================================================
          NAVEGACIÓN
          ================================================== --}}

                    <div class="row">

                        {{-- ATRÁS --}}

                        <div class="col-md-2 col-md-offset-3" style="text-align:center;">

                            <a href="{{url('/residencia/anteproyecto/corregir_justificacion')}}" class="btn btn-link"
                                style="font-weight:bold;">

                                <span class="glyphicon glyphicon-arrow-left" style="
                                font-size:45px;
                                color:#458acc;
                              ">
                                </span>

                                <br>

                                Atrás

                            </a>

                        </div>


                        {{-- SIGUIENTE --}}

                        <div class="col-md-2 col-md-offset-2" style="text-align:center;">

                            <a href="{{url('/residencia/anteproyecto/corregir_cronograma')}}" class="btn btn-link"
                                style="font-weight:bold;">

                                <span class="glyphicon glyphicon-arrow-right" style="
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
            FORMULARIO
            ================================================== --}}

                        <div class="col-md-7 col-md-offset-1">

                            <div class="panel panel-primary" style="
                            border-radius:8px;
                            box-shadow:0 2px 6px rgba(0,0,0,.08);
                         ">

                                <div class="panel-heading text-center">

                                    <span class="glyphicon glyphicon-list-alt"></span>

                                    Marco Teórico del Anteproyecto

                                </div>


                                <div class="panel-body">

                                    <form class="form" id="form_marco_teorico" role="form" method="POST"
                                        action="{{url('/residencia/guardar_correciones_marco_teorico/')}}">

                                        {{ csrf_field() }}


                                        {{-- =================================================
                    ID ANTEPROYECTO
                    ================================================== --}}

                                        <input type="hidden" id="id_anteproyecto" name="id_anteproyecto"
                                            value="{{ $marco_teorico->id_anteproyecto }}">


                                        {{-- =================================================
                    MARCO TEÓRICO
                    ================================================== --}}

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label for="marco_teorico">

                                                        <span class="glyphicon glyphicon-book"></span>

                                                        MARCO TEÓRICO

                                                    </label>

                                                    <textarea class="form-control" id="marco_teorico"
                                                        name="marco_teorico" rows="25"
                                                        placeholder="Ingresa el Marco Teórico de tu anteproyecto"
                                                        required @if($marco_teorico_autorizado) readonly
                                                        @endif>{{ $marco_teorico->marco_teorico }}</textarea>

                                                </div>

                                            </div>

                                        </div>


                                        {{-- =================================================
                    BOTÓN GUARDAR
                    ================================================== --}}

                                        <div class="row">

                                            <div class="col-md-12 text-center">

                                                @if($marco_teorico_autorizado)

                                                {{-- =================================================
                        MARCO TEÓRICO AUTORIZADO
                        ================================================== --}}

                                                <button id="guardar_marco_teorico" type="button" class="btn btn-success"
                                                    disabled style="
                            min-width:190px;
                            border-radius:5px;
                          ">

                                                    <span class="glyphicon glyphicon-ok"></span>

                                                    Marco Teórico autorizado

                                                </button>

                                                @else

                                                {{-- =================================================
                        PUEDE MODIFICAR
                        ================================================== --}}

                                                <button id="guardar_marco_teorico" type="button" class="btn btn-primary"
                                                    style="
                            min-width:150px;
                            border-radius:5px;
                          ">

                                                    <span class="glyphicon glyphicon-floppy-disk"></span>

                                                    Guardar

                                                </button>

                                                @endif

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
            COMENTARIOS
            ================================================== --}}

                        <div class="col-md-4">

                            <div class="panel panel-default" style="
                            border-radius:8px;
                            box-shadow:0 2px 6px rgba(0,0,0,.08);
                         ">

                                <div class="panel-heading text-center" style="font-weight:bold;">

                                    <span class="glyphicon glyphicon-comment"></span>

                                    COMENTARIOS DE LOS REVISORES

                                </div>


                                <div class="panel-body">


                                    {{-- =================================================
                  MENSAJE DE ESTADO
                  ================================================== --}}

                                    @if($marco_teorico_autorizado)

                                    <div class="alert alert-success text-center">

                                        <span class="glyphicon glyphicon-ok-circle"></span>

                                        <strong>

                                            Ya te autorizaron el Marco Teórico.

                                        </strong>

                                        <br>

                                        El Marco Teórico corregido fue
                                        registrado correctamente.

                                    </div>


                                    @elseif($tiene_permiso)

                                    <div class="alert alert-warning text-center">

                                        <span class="glyphicon glyphicon-pencil"></span>

                                        <strong>

                                            Tienes permiso para modificar nuevamente
                                            esta sección.

                                        </strong>

                                        <br>

                                        Realiza las correcciones necesarias y presiona
                                        <strong>Guardar</strong>.

                                    </div>


                                    @else

                                    <div class="alert alert-danger text-center">

                                        <span class="glyphicon glyphicon-warning-sign"></span>

                                        <strong>

                                            Corrige lo que se te pide en los comentarios
                                            de los revisores.

                                        </strong>

                                    </div>

                                    @endif


                                    {{-- =================================================
                  COMENTARIOS DE DOCENTES
                  ================================================== --}}

                                    @foreach($comentarios_marco_teorico as $comentario)


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
MODAL ENVIAR ANTEPROYECTO
============================================================= --}}

<div id="modal_enviar" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel">

    <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">

            <form action="{{url('/residencia/enviar_anteproyecto_corregido/')}}" method="POST" role="form">

                {{ csrf_field() }}

                <div class="modal-body">

                    <p>
                        ¿Realmente deseas enviar tu anteproyecto?
                    </p>

                    <input type="hidden" id="id_anteproyecto_modal" name="id_anteproyecto" value="">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">

                        Cancelar

                    </button>

                    <input id="confirma_elimina_oficio" type="submit" class="btn btn-danger" value="Aceptar">

                </div>

            </form>

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
    GUARDAR MARCO TEÓRICO
    =============================================================
    */

    $("#guardar_marco_teorico").click(function(event) {

        event.preventDefault();

        var marco_teorico = $("#marco_teorico").val();

        /*
        =========================================================
        VALIDAR CAMPO
        =========================================================
        */

        if ($.trim(marco_teorico) != "") {

            /*
            =====================================================
            EVITAR DOBLE ENVÍO
            =====================================================
            */

            $("#guardar_marco_teorico").attr("disabled", true);

            /*
            =====================================================
            ENVIAR FORMULARIO
            =====================================================
            */

            $("#form_marco_teorico").submit();

        } else {

            swal({

                position: "top",

                type: "warning",

                title: "El campo se encuentra vacío.",

                showConfirmButton: false,

                timer: 3500

            });

        }

    });


    /*
    =============================================================
    ENVIAR ANTEPROYECTO
    =============================================================
    */

    $(".enviar").click(function(event) {

        var id = $(this).attr('id');

        $('#id_anteproyecto_modal').val(id);

        $('#modal_enviar').modal('show');

    });

});
</script>

@endsection