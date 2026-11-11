@extends('layouts.app')

@section('title', 'Servicio Social Carrera')

@section('content')

<?php $unidad = Session::get('id_unidad_admin'); ?>

<style>
#tableenviado th,
#tableenviado td {
    text-align: center;
    vertical-align: middle;
}

#table_enviado thead th {
    background-color: #337ab7;
    color: #fff;
    text-align: center;
}

.modal-header {
    background-color: #337ab7;
    color: #fff;
    text-align: center;
}

.modal-header .close {
    color: #fff;
    opacity: 1;
}

.modal-title {
    font-weight: bold;
}

.modal-body {
    padding: 25px;
}

.modal-body label {
    font-weight: bold;
}

.modal-footer {
    text-align: center;
}

.alumno-input {
    text-align: center;
    font-weight: bold;
    background-color: #f5f5f5;
}

.calificacion-input {
    text-align: center;
    font-size: 18px;
    font-weight: bold;
}

.fecha-input {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}
</style>


@if($unidad != 26)

<div class="row">

    <div class="row">

        <div class="col-md-2 col-md-offset-2" style="text-align:center;">

            <a href="#">

                <span class="glyphicon glyphicon-arrow-left" style="font-size:15px;color:#363636">
                </span>

                <br>

                Regresar

            </a>

        </div>

    </div>

</div>

@endif


<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <div class="panel panel-primary">

            <div class="panel-heading">

                <h3 class="panel-title text-center">
                    Seguimientos de Estudiantes de Servicio Social por Carreras
                </h3>

            </div>

        </div>

    </div>

</div>


@if($mostrar == 0)

<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <div class="dropdown">

            <label for="carrera">
                Elige carrera
                <b style="color:red;font-size:23px;">*</b>
            </label>

            <select class="form-control" id="carrera" name="carrera" required>

                <option value="" disabled selected>
                    Selecciona una Opción
                </option>

                @foreach($carreras as $carrera)

                <option value="{{ $carrera->id_carrera }}">
                    {{ $carrera->nombre }}
                </option>

                @endforeach

            </select>

            <br>

        </div>

    </div>

</div>

@endif


@if($mostrar == 1)

<div class="row">

    <div class="col-md-4 col-md-offset-4">

        <div class="dropdown">

            <label for="carrera">
                Elige una carrera
                <b style="color:red;font-size:23px;">*</b>
            </label>

            <select class="form-control" id="carrera" name="carrera" required>

                <option value="" disabled>
                    Selecciona una Opción
                </option>

                @foreach($carreras as $carrera)

                @if($carrera->id_carrera == $id_carrera)

                <option value="{{ $carrera->id_carrera }}" selected>
                    {{ $carrera->nombre }}
                </option>

                @else

                <option value="{{ $carrera->id_carrera }}">
                    {{ $carrera->nombre }}
                </option>

                @endif

                @endforeach

            </select>

            <br>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-primary">

            <div class="panel-heading text-center">

                <strong>
                    Estudiantes de Servicio Social
                </strong>

            </div>


            <div class="panel-body">

                <table id="table_enviado" class="table table-bordered table-hover table-responsive">

                    <thead>

                        <tr>

                            <th class="text-center">
                                No. cuenta
                            </th>

                            <th class="text-center">
                                Nombre del alumno
                            </th>

                            <th class="text-center">
                                Calificación
                            </th>

                            <th class="text-center">
                                Fecha término
                            </th>

                            <th class="text-center">
                                Clave
                            </th>

                            <th class="text-center">
                                Acción
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($estudiantes_servicio as $estudiante)

                        <tr>

                            <td class="text-center">
                                {{ $estudiante->cuenta }}
                            </td>


                            <td class="text-center">

                                {{ $estudiante->nombre }}
                                {{ $estudiante->apaterno }}
                                {{ $estudiante->amaterno }}

                            </td>


                            <td class="text-center">

                                {{ $estudiante->calificacion }}

                            </td>


                            <td class="text-center">

                                {{ $estudiante->fecha_termino }}

                            </td>


                            <td class="text-center">

                                {{ $estudiante->clave }}

                            </td>


                            <td class="text-center">

                                <button type="button" class="btn btn-success btn-sm btn-calificar" data-toggle="modal"
                                    data-target="#modalCalificar" data-id_alumno="{{ $estudiante->id_alumno }}"
                                    data-alumno="{{ $estudiante->nombre }} {{ $estudiante->apaterno }} {{ $estudiante->amaterno }}"
                                    data-calificacion="{{ $estudiante->calificacion }}"
                                    data-fecha_termino="{{ $estudiante->fecha_termino }}">

                                    <span class="glyphicon glyphicon-pencil"></span>

                                    Calificar

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

@endif



<!-- ========================================= -->
<!-- MODAL PARA CALIFICAR SERVICIO SOCIAL -->
<!-- ========================================= -->

<div class="modal fade" id="modalCalificar" tabindex="-1" role="dialog" aria-labelledby="modalCalificarLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content">


            <form method="POST" action="{{ url('/servicio_social/calificar') }}">

                {{ csrf_field() }}


                <!-- HEADER -->

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">

                        <span>
                            &times;
                        </span>

                    </button>


                    <h4 class="modal-title" id="modalCalificarLabel">

                        <span class="glyphicon glyphicon-education"></span>

                        Calificar Servicio Social

                    </h4>

                </div>


                <!-- BODY -->

                <div class="modal-body">


                    <!-- ID DEL ALUMNO -->

                    <input type="hidden" name="id_alumno" id="id_alumno">


                    <!-- NOMBRE DEL ALUMNO -->

                    <div class="form-group">

                        <label for="nombre_alumno">

                            Nombre del Estudiante

                        </label>


                        <input type="text" class="form-control alumno-input" id="nombre_alumno" readonly>

                    </div>


                    <!-- CALIFICACIÓN -->

                    <div class="form-group">

                        <label for="calificacion">

                            Calificación

                            <b style="color:red;">
                                *
                            </b>

                        </label>


                        <input type="number" class="form-control calificacion-input" name="calificacion"
                            id="calificacion" min="0" max="100" step="1" required>

                    </div>


                    <div class="text-center">

                        <small class="text-muted">

                            La calificación debe estar entre 0 y 100.

                        </small>

                    </div>


                    <br>


                    <!-- FECHA DE TÉRMINO -->

                    <div class="form-group">

                        <label for="fecha_termino">

                            Fecha de término

                            <b style="color:red;">
                                *
                            </b>

                        </label>


                        <input type="date" class="form-control fecha-input" name="fecha_termino" id="fecha_termino"
                            required>

                    </div>


                </div>


                <!-- FOOTER -->

                <div class="modal-footer">


                    <button type="button" class="btn btn-default" data-dismiss="modal">

                        <span class="glyphicon glyphicon-remove"></span>

                        Cancelar

                    </button>


                    <button type="submit" class="btn btn-primary">

                        <span class="glyphicon glyphicon-floppy-disk"></span>

                        Guardar calificación

                    </button>


                </div>


            </form>

        </div>

    </div>

</div>



<script type="text/javascript">
$(document).ready(function() {


    /*
    |--------------------------------------------------------------------------
    | DATATABLE
    |--------------------------------------------------------------------------
    */

    if ($('#table_enviado').length) {

        $('#table_enviado').DataTable();

    }


    /*
    |--------------------------------------------------------------------------
    | CAMBIO DE CARRERA
    |--------------------------------------------------------------------------
    */

    $('#carrera').on('change', function() {

        var carrera = $(this).val();

        if (carrera) {

            window.location.href =
                '/servicio_social/departamento_carreras/' + carrera;

        }

    });


    /*
    |--------------------------------------------------------------------------
    | ABRIR MODAL PARA CALIFICAR
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.btn-calificar', function() {

        // Limpiar campos
        $('#id_alumno').val('');

        $('#nombre_alumno').val('');

        $('#calificacion').val('');

        $('#fecha_termino').val('');


        // Obtener datos del botón

        var id_alumno =
            this.getAttribute('data-id_alumno');

        var alumno =
            this.getAttribute('data-alumno');

        var calificacion =
            this.getAttribute('data-calificacion');

        var fecha_termino =
            this.getAttribute('data-fecha_termino');


        // Colocar ID del alumno

        $('#id_alumno').val(id_alumno);


        // Colocar nombre

        $('#nombre_alumno').val(alumno);


        // Colocar calificación si existe

        if (calificacion !== null &&
            calificacion !== '') {

            $('#calificacion').val(calificacion);

        }


        // Colocar fecha si existe

        if (fecha_termino !== null &&
            fecha_termino !== '') {
            $('#fecha_termino').val(fecha_termino);

        }

    });


});
</script>


@endsection