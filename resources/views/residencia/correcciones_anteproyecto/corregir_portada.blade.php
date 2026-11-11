@extends('layouts.app')
@section('title', 'Registrar Anteproyecto')
@section('content')

<div class="container-fluid">
{{-- =========================================================
MENSAJE DE ANTEPROYECTO ACEPTADO
========================================================== --}}
@if($modificar == 3)

<div class="row"> <div class="col-md-10 col-md-offset-1">
  <div class="alert alert-success text-center" style="
        border-radius:8px;
        margin-top:15px;
        border-left:5px solid #5cb85c;
     ">
    <span class="glyphicon glyphicon-ok-circle" style="font-size:20px;"></span>

    <strong>Tu anteproyecto fue aceptado. </strong>
    <br>

   Registra tu empresa y ya puedes imprimir tu dictamen de anteproyecto.

  </div>

</div>

</div>
@endif

{{-- =========================================================
MENSAJE DE PERMISO ESPECIAL DEL DEPARTAMENTO
========================================================== --}}
@if($modificar == 4)

<div class="row">
<div class="col-md-10 col-md-offset-1">

  <div class="alert alert-warning text-center" style="
        border-radius:8px;
        margin-top:15px;
        border-left:5px solid #f0ad4e;
     ">

    <span class="glyphicon glyphicon-pencil" style="font-size:20px;"></span>

    <strong>El Departamento de Servicio Social y Residencia Profesional te ha otorgado permiso para modificar tu anteproyecto.</strong>

    <br>

    Realiza las correcciones necesarias y presiona
    <strong>Guardar</strong> en cada apartado.

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

      Corregir Portada

    </div>

    <div class="panel-body">

      {{-- =================================================
             NAVEGACIÓN
        ================================================== --}}

      <div class="row">

        <div class="col-md-2 col-md-offset-5" style="text-align:center;">

          <a href="{{url('/residencia/anteproyecto/corregir_objetivos')}}"
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
             FORMULARIO
        ================================================== --}}

        <div class="col-md-7">

          <div class="panel panel-primary" style="
                border-radius:8px;
                box-shadow:0 2px 6px rgba(0,0,0,.08);
             ">

            <div class="panel-heading text-center">

              <span class="glyphicon glyphicon-list-alt"></span>

              Datos de la Portada

            </div>

            <div class="panel-body">

              <form class="form"
                    role="form"
                    action="{{url('/residencia/guardar_correciones_portada/')}}"
                    method="POST"
                    id="form_portada">

                {{ csrf_field() }}

                {{-- =================================
                     ALUMNO
                ================================== --}}

                <div class="row">

                  <div class="col-md-12">

                    <div class="form-group">

                      <label>

                        <span class="glyphicon glyphicon-user"></span>

                        NOMBRE DEL RESIDENTE

                      </label>

                      <div class="well well-sm"
                           style="margin-bottom:15px;">

                        <strong>

                          {{$datosalumno->nombre}}
                          {{$datosalumno->apaterno}}
                          {{$datosalumno->amaterno}}

                        </strong>

                      </div>

                    </div>

                  </div>

                </div>

                {{-- =================================
                     TIPO DE PROYECTO
                ================================== --}}

                <div class="row">

                  <div class="col-md-8">

                    <div class="form-group">

                      <label for="tipo_proy">

                        <span class="glyphicon glyphicon-folder-open"></span>

                        PROYECTO:

                      </label>

                      <input type="hidden"
                             id="anteproyecto"
                             name="anteproyecto"
                             value="{{$portada->id_anteproyecto}}">

                      <select class="form-control"
                              id="tipo_proy"
                              name="tipo_proy"
                              required>

                        @foreach($tipo_proyecto as $tipo)

                          @if($tipo->id_tipo_proyecto == $portada->id_tipo_proyecto)

                            <option value="{{$tipo->id_tipo_proyecto}}" selected>

                              {{$tipo->descripcion}}

                            </option>

                          @else

                            <option value="{{$tipo->id_tipo_proyecto}}">

                              {{$tipo->descripcion}}

                            </option>

                          @endif

                        @endforeach

                      </select>

                    </div>

                  </div>

                </div>

                {{-- =================================
                     NOMBRE DEL PROYECTO
                ================================== --}}

                <div class="row">

                  <div class="col-md-12">

                    <div class="form-group">

                      <label for="nombre_proyecto">

                        <span class="glyphicon glyphicon-pencil"></span>

                        NOMBRE DEL PROYECTO

                      </label>

                      <textarea
                        class="form-control"
                        style="text-transform:uppercase;"
                        id="nombre_proyecto"
                        name="nombre_proyecto"
                        rows="4"
                        placeholder="Ingresa el nombre del proyecto"
                        required>{{ $portada->nom_proyecto }}</textarea>

                      <small class="text-muted">

                        No se aceptan comillas ni caracteres especiales.

                      </small>

                    </div>

                  </div>

                </div>

                {{-- =================================
                     BOTÓN GUARDAR
                ================================== --}}

                <div class="row">

                  <div class="col-md-12 text-center">

                    @if($portada->estado_aceptado_portada == 1 && $modificar != 4)

                      {{-- PORTADA AUTORIZADA --}}

                      <button
                        id="guardar_solicitud"
                        type="button"
                        class="btn btn-success"
                        disabled
                        style="
                          min-width:180px;
                          border-radius:5px;
                        ">

                        <span class="glyphicon glyphicon-ok"></span>

                        Portada autorizada

                      </button>

                    @else

                      {{-- PUEDE MODIFICAR --}}

                      <button
                        id="guardar_solicitud"
                        type="button"
                        class="btn btn-primary"
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

        <div class="col-md-5">

          <div class="panel panel-default" style="
                border-radius:8px;
                box-shadow:0 2px 6px rgba(0,0,0,.08);
             ">

            <div class="panel-heading text-center"
                 style="font-weight:bold;">

              <span class="glyphicon glyphicon-comment"></span>

              COMENTARIOS DE LOS REVISORES

            </div>

            <div class="panel-body">

              {{-- =================================
                   MENSAJE DE ESTADO
              ================================== --}}

              @if($portada->estado_aceptado_portada == 1 && $modificar != 4)

                <div class="alert alert-success text-center">

                  <span class="glyphicon glyphicon-ok-circle"></span>

                  <strong>

                    Ya te autorizaron la portada.

                  </strong>

                </div>

              @elseif($modificar == 4)

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

              {{-- =================================
                   COMENTARIOS DE DOCENTES
              ================================== --}}

              @foreach($comentarios_portada as $comentario)

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

</div> </div>
{{-- =============================================================
MODAL VERIFICAR
============================================================= --}}

<div id="modal_verificar" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"> <div class="modal-dialog modal-sm" role="document">
<div class="modal-content">

  <div class="modal-body">

    <p class="text-center">

      Primero se debe llenar el apartado de portada.

    </p>

  </div>

  <div class="modal-footer">

    <button type="button"
            class="btn btn-default"
            data-dismiss="modal">

      Cerrar

    </button>

  </div>

</div>

</div> </div>
{{-- =============================================================
MODAL ENVIAR ANTEPROYECTO
============================================================= --}}

<div id="modal_enviar" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"> <div class="modal-dialog modal-sm" role="document">
<div class="modal-content">

  <form
    action="{{url('/residencia/enviar_anteproyecto_corregido/')}}"
    method="POST"
    role="form">

    {{ csrf_field() }}

    <div class="modal-body">

      <p>

        ¿Realmente deseas enviar tu anteproyecto?

      </p>

      <input type="hidden"
             id="id_anteproyecto"
             name="id_anteproyecto"
             value="">

    </div>

    <div class="modal-footer">

      <button type="button"
              class="btn btn-default"
              data-dismiss="modal">

        Cancelar

      </button>

      <input
        id="confirma_elimina_oficio"
        type="submit"
        class="btn btn-danger"
        value="Aceptar">

    </div>

  </form>

</div>

</div> </div>
{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script type="text/javascript">
$(document).ready(function() {

/*
GUARDAR PORTADA
*/

$("#guardar_solicitud").click(function(event) {

event.preventDefault();

var nombre_proyecto = $("#nombre_proyecto").val();

if ($.trim(nombre_proyecto) != "") {

  $("#guardar_solicitud").attr("disabled", true);

  $("#form_portada").submit();

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
MENSAJES
*/

$("#mensaje").click(function(event) {

$('#modal_verificar').modal('show');

});

$("#mensaje1").click(function(event) {

$('#modal_verificar').modal('show');

});

$("#mensaje2").click(function(event) {

$('#modal_verificar').modal('show');

});

$("#mensaje3").click(function(event) {

$('#modal_verificar').modal('show');

});

$("#mensaje4").click(function(event) {

$('#modal_verificar').modal('show');

});

/*
ENVIAR ANTEPROYECTO
*/

$(".enviar").click(function(event) {

var id = $(this).attr('id');

$('#id_anteproyecto').val(id);

$('#modal_enviar').modal('show');

});

});

</script>
@endsection