@extends('layouts.app')

@section('title', 'Anteproyectos en Proceso de Modificación')

@section('content')

<div class="residencia-container">

    {{-- =========================================================
         ENCABEZADO PRINCIPAL
    ========================================================== --}}

    <div class="page-header-custom">

        <div class="header-icon">
            <span class="glyphicon glyphicon-edit"></span>
        </div>

        <div class="header-info">

            <h2>
                Status de los Anteproyectos
            </h2>

            <p>
                Seguimiento de anteproyectos en proceso de modificación
            </p>

            <span class="periodo-badge">

                <span class="glyphicon glyphicon-calendar"></span>

                Periodo {{ $nombre_periodo }}

            </span>

        </div>

    </div>


    {{-- =========================================================
         SELECTOR DE CARRERA
    ========================================================== --}}

    <div class="card-custom">

        <div class="card-header-custom">

            <div class="card-header-icon">

                <span class="glyphicon glyphicon-education"></span>

            </div>

            <div>

                <h4>
                    Selección de carrera
                </h4>

                <small>
                    Selecciona la carrera que deseas consultar
                </small>

            </div>

        </div>


        <div class="card-body-custom">

            <div class="row">

                <div class="col-md-6 col-md-offset-3">

                    <div class="form-group">

                        <label for="carrera">

                            Carrera

                            <span class="required">*</span>

                        </label>


                        <div class="select-wrapper">

                            <span class="glyphicon glyphicon-education"></span>

                            <select
                                class="form-control select-custom"
                                id="carrera"
                                name="carrera"
                                required>

                                <option
                                    disabled
                                    hidden
                                    {{ $mostrar == 0 ? 'selected' : '' }}>

                                    Selecciona una carrera

                                </option>


                                @foreach($carreras as $carrera)

                                    <option
                                        value="{{ $carrera->id_carrera }}"
                                        {{ ($mostrar == 1 && $carrera->id_carrera == $id_carrera) ? 'selected' : '' }}>

                                        {{ $carrera->nombre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    @if($mostrar == 1)


        {{-- =====================================================
             TARJETAS DE ESTADO
        ====================================================== --}}

        <div class="row resumen-row">

            <div class="col-md-4">

                <div class="resumen-card resumen-blue">

                    <div class="resumen-icon">

                        <span class="glyphicon glyphicon-search"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO
                        </span>

                        <strong>
                            Revisión
                        </strong>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="resumen-card resumen-orange resumen-active">

                    <div class="resumen-icon">

                        <span class="glyphicon glyphicon-edit"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO ACTUAL
                        </span>

                        <strong>
                            Modificación
                        </strong>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="resumen-card resumen-green">

                    <div class="resumen-icon">

                        <span class="glyphicon glyphicon-ok"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO
                        </span>

                        <strong>
                            Autorizados
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             TABS
        ====================================================== --}}

        <div class="tabs-container">

            <div class="tabs-header">

                <div class="tabs-title">

                    <span class="glyphicon glyphicon-tasks"></span>

                    Seguimiento de anteproyectos

                </div>

            </div>


            <ul class="nav nav-tabs tabs-custom">

                {{-- =================================================
                     TAB REVISIÓN
                ================================================== --}}

                <li>

                    <a
                        href="{{ url('/residencia/proceso_revision_anteproyecto/'.$id_carrera) }}">

                        <span class="tab-icon tab-blue">

                            <span class="glyphicon glyphicon-search"></span>

                        </span>

                        <span class="tab-content-text">

                            <strong>
                                En revisión
                            </strong>

                            <small>
                                Anteproyectos pendientes
                            </small>

                        </span>

                    </a>

                </li>


                {{-- =================================================
                     TAB MODIFICACIÓN
                ================================================== --}}

                <li class="active">

                    <a href="#">

                        <span class="tab-icon tab-orange">

                            <span class="glyphicon glyphicon-edit"></span>

                        </span>

                        <span class="tab-content-text">

                            <strong>
                                En modificación
                            </strong>

                            <small>
                                Requieren cambios
                            </small>

                        </span>

                    </a>

                </li>


                {{-- =================================================
                     TAB AUTORIZADOS
                ================================================== --}}

                <li>

                    <a
                        href="{{ url('/residencia/ver_estados_alumnos/'.$id_carrera) }}">

                        <span class="tab-icon tab-green">

                            <span class="glyphicon glyphicon-ok"></span>

                        </span>

                        <span class="tab-content-text">

                            <strong>
                                Autorizados
                            </strong>

                            <small>
                                Anteproyectos aprobados
                            </small>

                        </span>

                    </a>

                </li>

            </ul>

        </div>


        {{-- =====================================================
             INFORMACIÓN
        ====================================================== --}}

        <div class="information-box information-orange">

            <div class="information-icon">

                <span class="glyphicon glyphicon-edit"></span>

            </div>

            <div>

                <strong>
                    Anteproyectos en proceso de modificación
                </strong>

                <p>

                    En esta sección aparecen los anteproyectos que
                    requieren modificaciones por parte del estudiante.

                    Una vez realizadas las modificaciones, el estudiante
                    deberá enviarlo nuevamente a sus revisores.

                </p>

            </div>

        </div>


        {{-- =====================================================
             TABLA
        ====================================================== --}}

        <div class="table-card">

            <div class="table-card-header">

                <div>

                    <span class="glyphicon glyphicon-list-alt"></span>

                    <strong>
                        Lista de anteproyectos en modificación
                    </strong>

                </div>

                <span class="status-general status-general-orange">

                    <span class="glyphicon glyphicon-edit"></span>

                    En modificación

                </span>

            </div>


            <div class="table-card-body">

                <div class="table-responsive">

                    <table
                        id="table_revision_asesor"
                        class="table table-bordered table-hover tabla-custom">

                        <thead>

                        <tr>

                            <th>

                                <span class="glyphicon glyphicon-credit-card"></span>

                                No. cuenta

                            </th>


                            <th>

                                <span class="glyphicon glyphicon-user"></span>

                                Nombre del alumno

                            </th>


                            <th>

                                <span class="glyphicon glyphicon-book"></span>

                                Nombre del anteproyecto

                            </th>


                            <th>

                                <span class="glyphicon glyphicon-info-sign"></span>

                                Estado

                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @foreach ($anteproyecto_autorizados as $anteproyecto)

                            <tr>


                                {{-- =========================================
                                     CUENTA
                                ========================================== --}}

                                <td class="text-center">

                                    <span class="cuenta-badge">

                                        {{ $anteproyecto->cuenta }}

                                    </span>

                                </td>


                                {{-- =========================================
                                     ALUMNO
                                ========================================== --}}

                                <td>

                                    <div class="alumno-row">

                                        <div class="avatar">

                                            <span class="glyphicon glyphicon-user"></span>

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $anteproyecto->nombre }}
                                                {{ $anteproyecto->apaterno }}
                                                {{ $anteproyecto->amaterno }}

                                            </strong>

                                            <small>
                                                Alumno de residencia
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- =========================================
                                     PROYECTO
                                ========================================== --}}

                                <td>

                                    <div class="proyecto-row">

                                        <span class="glyphicon glyphicon-book"></span>

                                        <span>

                                            {{ $anteproyecto->nom_proyecto }}

                                        </span>

                                    </div>

                                </td>


                                {{-- =========================================
                                     ESTADO
                                ========================================== --}}

                                <td class="text-center">


                                    @if($anteproyecto->estado_enviado == 0)

                                        <div class="estado-card estado-danger">

                                            <div class="estado-icon">

                                                <span class="glyphicon glyphicon-send"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    NO ENVIADO
                                                </strong>

                                                <small>

                                                    El estudiante aún no ha
                                                    enviado su proyecto a sus
                                                    revisores.

                                                </small>

                                            </div>

                                        </div>


                                    @elseif($anteproyecto->estado_enviado == 2)

                                        <div class="estado-card estado-warning">

                                            <div class="estado-icon">

                                                <span class="glyphicon glyphicon-edit"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    EN MODIFICACIÓN
                                                </strong>

                                                <small>

                                                    El estudiante debe realizar
                                                    las modificaciones y enviarlo
                                                    nuevamente a sus revisores.

                                                </small>

                                            </div>

                                        </div>

                                        
                                    @elseif($anteproyecto->estado_enviado == 4)

                                        <div class="estado-card estado-warning">

                                            <div class="estado-icon">

                                                <span class="glyphicon glyphicon-edit"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    EN MODIFICACIÓN 
                                                </strong>

                                                <small>

                                                    El estudiante debe realizar
                                                    las modificaciones y enviarlo
                                                    nuevamente para que el departamento de servicio social y residencia lo autorice.

                                                </small>

                                            </div>

                                        </div>




                                    @else

                                        <div class="estado-card estado-default">

                                            <div class="estado-icon">

                                                <span class="glyphicon glyphicon-question-sign"></span>

                                            </div>

                                            <div>

                                                <strong>
                                                    ESTADO DESCONOCIDO
                                                </strong>

                                                <small>
                                                    Consulte la información del proyecto.
                                                </small>

                                            </div>

                                        </div>

                                    @endif


                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    @endif


</div>


{{-- =============================================================
     ESTILOS
============================================================= --}}

<style>


/* =============================================================
   CONTENEDOR GENERAL
============================================================= */

.residencia-container {
    width: 100%;
    max-width: 1500px;

    margin: 30px auto;

    padding: 25px;

    background: #f5f7fa;

    border-radius: 12px;

    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);

    min-height: auto;
}


/* =============================================================
   ENCABEZADO
============================================================= */

.page-header-custom {

    background: linear-gradient(
        135deg,
        #337ab7,
        #245580
    );

    color: white;

    border-radius: 10px;

    padding: 25px 30px;

    display: flex;

    align-items: center;

    margin-bottom: 25px;

    box-shadow:
        0 4px 15px rgba(0,0,0,.12);

}


.header-icon {

    width: 70px;

    height: 70px;

    background: rgba(255,255,255,.15);

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 32px;

    margin-right: 20px;

}


.header-info h2 {

    margin: 0 0 5px 0;

    font-weight: 600;

}


.header-info p {

    margin: 0 0 10px 0;

    opacity: .85;

}


.periodo-badge {

    display: inline-block;

    padding: 6px 12px;

    border-radius: 20px;

    background: rgba(255,255,255,.15);

}


/* =============================================================
   CARD SELECTOR
============================================================= */

.card-custom {

    background: white;

    border-radius: 8px;

    margin-bottom: 25px;

    box-shadow:
        0 2px 10px rgba(0,0,0,.06);

}


.card-header-custom {

    padding: 17px 20px;

    border-bottom: 1px solid #eee;

    display: flex;

    align-items: center;

}


.card-header-icon {

    width: 42px;

    height: 42px;

    background: #eaf3fb;

    color: #337ab7;

    border-radius: 8px;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 18px;

    margin-right: 12px;

}


.card-header-custom h4 {

    margin: 0 0 3px 0;

}


.card-header-custom small {

    color: #999;

}


.card-body-custom {

    padding: 25px;

}


/* =============================================================
   SELECTOR
============================================================= */

.form-group label {

    font-weight: 600;

    color: #444;

}


.required {

    color: #d9534f;

    font-size: 18px;

}


.select-wrapper {

    position: relative;

}


.select-wrapper > .glyphicon {

    position: absolute;

    left: 12px;

    top: 13px;

    color: #337ab7;

    z-index: 2;

}


.select-custom {

    padding-left: 35px;

    height: 44px;

    border-radius: 6px;

}


/* =============================================================
   RESUMEN
============================================================= */

.resumen-row {

    margin-bottom: 25px;

}


.resumen-card {

    background: white;

    border-radius: 8px;

    padding: 15px 18px;

    display: flex;

    align-items: center;

    box-shadow:
        0 2px 8px rgba(0,0,0,.06);

    border: 2px solid transparent;

}


.resumen-active {

    box-shadow:
        0 4px 15px rgba(240,173,78,.25);

    border-color: #f0ad4e;

}


.resumen-icon {

    width: 45px;

    height: 45px;

    border-radius: 50%;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 18px;

    margin-right: 12px;

}


.resumen-card span {

    display: block;

    font-size: 10px;

    color: #999;

    letter-spacing: 1px;

}


.resumen-card strong {

    font-size: 15px;

}


.resumen-blue .resumen-icon {

    background: #337ab7;

}


.resumen-orange .resumen-icon {

    background: #f0ad4e;

}


.resumen-green .resumen-icon {

    background: #5cb85c;

}


/* =============================================================
   TABS
============================================================= */

.tabs-container {

    background: white;

    border-radius: 8px 8px 0 0;

    box-shadow:
        0 2px 8px rgba(0,0,0,.05);

}


.tabs-header {

    padding: 15px 20px;

    border-bottom: 1px solid #eee;

}


.tabs-title {

    font-weight: 600;

    color: #444;

}


.tabs-title .glyphicon {

    color: #337ab7;

    margin-right: 8px;

}


.tabs-custom {

    border: 0;

    display: flex;

}


.tabs-custom > li {

    flex: 1;

    text-align: center;

}


.tabs-custom > li > a {

    border: 0 !important;

    border-bottom: 3px solid transparent !important;

    margin: 0;

    padding: 15px 10px;

    color: #777;

    transition: all .2s ease;

}


.tabs-custom > li > a:hover {

    background: #f8fafc;

    color: #337ab7;

}


.tabs-custom > li.active > a {

    color: #f0ad4e;

    background: white;

    border-bottom-color: #f0ad4e !important;

}


/* =============================================================
   ICONOS TABS
============================================================= */

.tab-icon {

    width: 38px;

    height: 38px;

    border-radius: 50%;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    color: white;

    margin-right: 8px;

}


.tab-blue {

    background: #337ab7;

}


.tab-orange {

    background: #f0ad4e;

}


.tab-green {

    background: #5cb85c;

}


.tab-content-text {

    display: inline-block;

    text-align: left;

    vertical-align: middle;

}


.tab-content-text strong {

    display: block;

}


.tab-content-text small {

    color: #999;

}


/* =============================================================
   INFORMACIÓN
============================================================= */

.information-box {

    background: #eef7ff;

    border-left: 4px solid #337ab7;

    padding: 15px 18px;

    margin: 20px 0;

    border-radius: 5px;

    display: flex;

    align-items: flex-start;

}


.information-orange {

    background: #fff8ed;

    border-left-color: #f0ad4e;

}


.information-icon {

    font-size: 22px;

    color: #337ab7;

    margin-right: 12px;

}


.information-orange .information-icon {

    color: #f0ad4e;

}


.information-box p {

    margin: 4px 0 0 0;

    color: #666;

}


/* =============================================================
   TABLA
============================================================= */

.table-card {

    background: white;

    border-radius: 8px;

    overflow: hidden;

    box-shadow:
        0 2px 10px rgba(0,0,0,.07);

}


.table-card-header {

    background: #fff;

    padding: 17px 20px;

    border-bottom: 1px solid #eee;

    display: flex;

    justify-content: space-between;

    align-items: center;

}


.table-card-header .glyphicon {

    color: #337ab7;

    margin-right: 8px;

}


.status-general {

    background: #e9f7ed;

    color: #3c763d;

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 12px;

}


.status-general-orange {

    background: #fff3df;

    color: #9a6a00;

}


.table-card-body {

    padding: 20px;

}


/* =============================================================
   ENCABEZADO TABLA
============================================================= */

.tabla-custom {

    margin-bottom: 0;

}


.tabla-custom thead th {

    background: #337ab7;

    color: white;

    text-align: center;

    vertical-align: middle;

    border-color: #286090 !important;

    padding: 13px 8px;

    font-size: 12px;

}


.tabla-custom thead th .glyphicon {

    margin-right: 4px;

}


.tabla-custom tbody td {

    vertical-align: middle;

    padding: 13px 10px;

}


.tabla-custom tbody tr {

    transition: all .2s;

}


.tabla-custom tbody tr:hover {

    background-color: #fffaf2;

}


/* =============================================================
   CUENTA
============================================================= */

.cuenta-badge {

    display: inline-block;

    background: #eef5fb;

    color: #337ab7;

    padding: 7px 10px;

    border-radius: 15px;

    font-weight: 600;

}


/* =============================================================
   ALUMNO
============================================================= */

.alumno-row {

    display: flex;

    align-items: center;

}


.avatar {

    width: 40px;

    height: 40px;

    min-width: 40px;

    border-radius: 50%;

    background: #eaf3fb;

    color: #337ab7;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 10px;

}


.alumno-row strong {

    display: block;

    color: #333;

}


.alumno-row small {

    color: #999;

}


/* =============================================================
   PROYECTO
============================================================= */

.proyecto-row {

    display: flex;

    align-items: flex-start;

    line-height: 1.5;

    color: #444;

}


.proyecto-row .glyphicon {

    color: #337ab7;

    margin-right: 8px;

    margin-top: 3px;

}


/* =============================================================
   ESTADOS
============================================================= */

.estado-card {

    display: flex;

    align-items: center;

    text-align: left;

    padding: 10px;

    border-radius: 6px;

}


.estado-icon {

    width: 38px;

    height: 38px;

    min-width: 38px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    color: white;

    margin-right: 10px;

}


.estado-card strong {

    display: block;

    font-size: 11px;

    margin-bottom: 3px;

}


.estado-card small {

    display: block;

    line-height: 1.4;

    color: #666;

}


.estado-danger {

    background: #fff1f1;

    border: 1px solid #f3cccc;

}


.estado-danger .estado-icon {

    background: #d9534f;

}


.estado-danger strong {

    color: #a94442;

}


.estado-warning {

    background: #fff8e8;

    border: 1px solid #f5dfad;

}


.estado-warning .estado-icon {

    background: #f0ad4e;

}


.estado-warning strong {

    color: #9a6a00;

}


.estado-default {

    background: #f5f5f5;

    border: 1px solid #ddd;

}


.estado-default .estado-icon {

    background: #777;

}


/* =============================================================
   RESPONSIVE
============================================================= */

@media(max-width: 768px) {


    .residencia-container {

        padding: 10px;

    }


    .page-header-custom {

        padding: 18px;

    }


    .header-icon {

        width: 50px;

        height: 50px;

        font-size: 22px;

    }


    .header-info h2 {

        font-size: 20px;

    }


    .resumen-card {

        margin-bottom: 10px;

    }


    .tabs-custom {

        display: block;

    }


    .tabs-custom > li {

        display: block;

    }


    .tabs-custom > li > a {

        text-align: left;

    }


    .tab-content-text {

        text-align: left;

    }


    .table-card-body {

        padding: 10px;

    }


    .estado-card {

        min-width: 220px;

    }

}

</style>


{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

$(document).ready(function () {


    /*
    =============================================================
    DATATABLE
    =============================================================
    */

    $('#table_revision_asesor').DataTable({

        language: {

            search: "Buscar:",

            lengthMenu:
                "Mostrar _MENU_ registros",

            zeroRecords:
                "No se encontraron resultados",

            info:
                "Mostrando _START_ a _END_ de _TOTAL_ registros",

            infoEmpty:
                "No hay registros disponibles",

            infoFiltered:
                "(filtrado de _MAX_ registros)",

            paginate: {

                first: "Primero",

                last: "Último",

                next: "Siguiente",

                previous: "Anterior"

            }

        }

    });


    /*
    =============================================================
    CAMBIO DE CARRERA
    =============================================================
    */

    $("#carrera").on('change', function () {

        var id_carrera = $(this).val();


        if (id_carrera) {

            window.location.href =
                '/residencia/proceso_mod_anteproyecto/' +
                id_carrera;

        }

    });

});

</script>

@endsection
