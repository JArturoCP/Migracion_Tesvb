@extends('layouts.app')

@section('title', 'Status de los Anteproyectos')

@section('content')

<div class = "main">
    <div class="residencia-container">

    {{-- =========================================================
         ENCABEZADO PRINCIPAL
    ========================================================== --}}

    <div class="page-header-custom">

        <div class="header-icon">
            <span class="glyphicon glyphicon-education"></span>
        </div>

        <div class="header-info">

            <h2>
                Status de los Anteproyectos
            </h2>

            <p>
                Gestión y seguimiento de los anteproyectos de los alumnos
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
                                    {{ $mostrar == 0 ? 'selected' : '' }}
                                    hidden>

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
             RESUMEN
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

                <div class="resumen-card resumen-orange">

                    <div class="resumen-icon">

                        <span class="glyphicon glyphicon-edit"></span>

                    </div>

                    <div>

                        <span>
                            ESTADO
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
             TABS PRINCIPALES
        ====================================================== --}}

        <div class="tabs-container">

            <div class="tabs-header">

                <div class="tabs-title">

                    <span class="glyphicon glyphicon-tasks"></span>

                    Seguimiento de anteproyectos

                </div>

            </div>


            <ul class="nav nav-tabs tabs-custom">

                {{-- TAB 1 --}}

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


                {{-- TAB 2 --}}

                <li>

                    <a
                        href="{{ url('/residencia/proceso_mod_anteproyecto/'.$id_carrera) }}">

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


                {{-- TAB 3 --}}

                <li class="active">

                    <a href="#">

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

        <div class="information-box">

            <div class="information-icon">

                <span class="glyphicon glyphicon-info-sign"></span>

            </div>

            <div>

                <strong>
                    Anteproyectos autorizados
                </strong>

                <p>

                    Los anteproyectos que aparecen en esta sección
                    han sido autorizados por los revisores.

                    También puedes administrar el permiso de modificación.

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
                        Lista de anteproyectos autorizados
                    </strong>

                </div>

                <span class="status-general">

                    <span class="glyphicon glyphicon-ok-circle"></span>

                    Autorizados

                </span>

            </div>


            <div class="table-card-body">

                <div class="table-responsive">

                    <table
                        id="table_autorizar_doc_final"
                        class="table table-bordered table-hover tabla-custom">

                        <thead>

                        <tr>

                            <th>
                                <span class="glyphicon glyphicon-credit-card"></span>
                                No. cuenta
                            </th>

                            <th>
                                <span class="glyphicon glyphicon-user"></span>
                                Alumno
                            </th>

                            <th>
                                <span class="glyphicon glyphicon-book"></span>
                                Anteproyecto
                            </th>

                            <th>
                                <span class="glyphicon glyphicon-file"></span>
                                Documento
                            </th>

                            <th>
                                <span class="glyphicon glyphicon-edit"></span>
                                Permiso de modificación
                            </th>

                        </tr>

                        </thead>


                        <tbody>

                        @foreach ($array_anteproyecto as $anteproyecto)

                            <tr>


                                {{-- ================================================
                                     CUENTA
                                ================================================= --}}

                                <td class="text-center">

                                    <span class="cuenta-badge">

                                        {{ $anteproyecto['cuenta'] }}

                                    </span>

                                </td>


                                {{-- ================================================
                                     ALUMNO
                                ================================================= --}}

                                <td>

                                    <div class="alumno-row">

                                        <div class="avatar">

                                            <span class="glyphicon glyphicon-user"></span>

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $anteproyecto['nombre'] }}

                                            </strong>

                                            <small>
                                                Alumno de residencia
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- ================================================
                                     PROYECTO
                                ================================================= --}}

                                <td>

                                    <div class="proyecto-row">

                                        <span class="glyphicon glyphicon-book"></span>

                                        <span>

                                            {{ $anteproyecto['nom_proyecto'] }}

                                        </span>

                                    </div>

                                </td>


                                {{-- ================================================
                                     DOCUMENTO
                                ================================================= --}}

                                <td class="text-center">

                                    @if($anteproyecto['estado_empresa'] == 2)

                                        <button
                                            type="button"
                                            class="action-btn btn-print"
                                            onclick="window.open('{{ url('/pdf_documento_presentacion_residencia/'.$anteproyecto['id_anteproyecto']) }}')">

                                            <span class="glyphicon glyphicon-print"></span>

                                            Imprimir

                                        </button>


                                    @elseif($anteproyecto['estado_empresa'] == 1)

                                        <span class="status-label status-warning">

                                            <span class="glyphicon glyphicon-warning-sign"></span>

                                            Sin asesor interno

                                        </span>


                                    @elseif($anteproyecto['estado_empresa'] == 0)

                                        <span class="status-label status-danger">

                                            <span class="glyphicon glyphicon-remove"></span>

                                            Sin empresa

                                        </span>

                                    @else

                                        <span class="status-label status-default">

                                            <span class="glyphicon glyphicon-minus"></span>

                                            No disponible

                                        </span>

                                    @endif

                                </td>


                                {{-- ================================================
                                     PERMISO
                                ================================================= --}}

                                <td class="text-center">

                                    @if(
                                        isset($anteproyecto['permiso_modificacion']) &&
                                        $anteproyecto['permiso_modificacion'] == 1
                                    )

                                        <div class="permission-card permission-active">

                                            <div class="permission-status">

                                                <span class="permission-icon permission-green">

                                                    <span class="glyphicon glyphicon-ok"></span>

                                                </span>

                                                <div>

                                                    <strong>
                                                        PERMISO ACTIVO
                                                    </strong>

                                                    <small>
                                                        Puede modificar
                                                    </small>

                                                </div>

                                            </div>


                                            <button
                                                type="button"
                                                class="action-btn btn-danger-custom btn-quitar-permiso"
                                                data-id="{{ $anteproyecto['id_anteproyecto'] }}"
                                                data-nombre="{{ $anteproyecto['nombre'] }}">

                                                <span class="glyphicon glyphicon-lock"></span>

                                                Quitar permiso

                                            </button>

                                        </div>


                                    @else

                                        <div class="permission-card permission-inactive">

                                            <div class="permission-status">

                                                <span class="permission-icon permission-gray">

                                                    <span class="glyphicon glyphicon-lock"></span>

                                                </span>

                                                <div>

                                                    <strong>
                                                        SIN PERMISO
                                                    </strong>

                                                    <small>
                                                        Modificación bloqueada
                                                    </small>

                                                </div>

                                            </div>


                                           <button
    type="button"
    class="action-btn btn-warning-custom btn-permiso-modificacion"
    data-id="{{ $anteproyecto['id_anteproyecto'] }}"
    data-nombre="{{ $anteproyecto['nombre'] }}"
    data-proyecto="{{ $anteproyecto['nom_proyecto'] }}">

    <span class="glyphicon glyphicon-pencil"></span>

    Dar permiso

</button>


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


    {{-- =========================================================
         MODAL DAR PERMISO
    ========================================================== --}}

    <div
        class="modal fade"
        id="modalPermisoModificacion"
        tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content modal-custom">

                <div class="modal-header modal-warning">

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                    <h4>

                        <span class="glyphicon glyphicon-edit"></span>

                        Dar permiso de modificación

                    </h4>

                </div>


                <div class="modal-body">

                    <div class="modal-big-icon modal-icon-warning">

                        <span class="glyphicon glyphicon-pencil"></span>

                    </div>


                    <h3 class="text-center">

                        ¿Dar permiso de modificación?

                    </h3>


                    <p class="text-center text-muted">

                        El alumno podrá modificar su anteproyecto.

                    </p>


                    <div class="modal-alumno">

                        <div class="modal-avatar">

                            <span class="glyphicon glyphicon-user"></span>

                        </div>

                        <div>

                            <small>
                                ALUMNO
                            </small>

                            <strong id="nombreAlumno">
                                -
                            </strong>

                        </div>

                    </div>


                    <div class="alert alert-warning">

                        <span class="glyphicon glyphicon-warning-sign"></span>

                        <strong>Importante:</strong>

                        Al otorgar el permiso, el alumno podrá realizar
                        modificaciones a su anteproyecto.

                    </div>


                    <input
                        type="hidden"
                        id="id_anteproyecto_modificacion">

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="action-btn btn-cancel"
                        data-dismiss="modal">

                        <span class="glyphicon glyphicon-remove"></span>

                        Cancelar

                    </button>


                    <button
                        type="button"
                        class="action-btn btn-warning-custom"
                        id="btnConfirmarPermiso">

                        <span class="glyphicon glyphicon-ok"></span>

                        Sí, dar permiso

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MODAL QUITAR PERMISO
    ========================================================== --}}

    <div
        class="modal fade"
        id="modalQuitarPermiso"
        tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content modal-custom">

                <div class="modal-header modal-danger">

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                    <h4>

                        <span class="glyphicon glyphicon-lock"></span>

                        Quitar permiso de modificación

                    </h4>

                </div>


                <div class="modal-body">

                    <div class="modal-big-icon modal-icon-danger">

                        <span class="glyphicon glyphicon-lock"></span>

                    </div>


                    <h3 class="text-center">

                        ¿Quitar permiso?

                    </h3>


                    <p class="text-center text-muted">

                        El alumno dejará de poder modificar su anteproyecto.

                    </p>


                    <div class="modal-alumno modal-alumno-danger">

                        <div class="modal-avatar">

                            <span class="glyphicon glyphicon-user"></span>

                        </div>

                        <div>

                            <small>
                                ALUMNO
                            </small>

                            <strong id="nombreAlumnoQuitar">
                                -
                            </strong>

                        </div>

                    </div>


                    <div class="alert alert-danger">

                        <span class="glyphicon glyphicon-warning-sign"></span>

                        <strong>Atención:</strong>

                        Se desactivará el permiso de modificación.

                    </div>


                    <input
                        type="hidden"
                        id="id_anteproyecto_quitar">

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="action-btn btn-cancel"
                        data-dismiss="modal">

                        <span class="glyphicon glyphicon-remove"></span>

                        Cancelar

                    </button>


                    <button
                        type="button"
                        class="action-btn btn-danger-custom"
                        id="btnConfirmarQuitarPermiso">

                        <span class="glyphicon glyphicon-lock"></span>

                        Quitar permiso

                    </button>

                </div>

            </div>

        </div>

    </div>


</div>
</div>


{{-- =============================================================
     ESTILOS
============================================================= --}}

<style>

/* =============================================================
   CONTENEDOR
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
   HEADER
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
   CARDS
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
   SELECT
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

    top: 12px;

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

    color: #337ab7;

    background: white;

    border-bottom-color: #337ab7 !important;

}


/* ICONOS TABS */

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


.information-icon {

    font-size: 22px;

    color: #337ab7;

    margin-right: 12px;

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


.table-card-body {

    padding: 20px;

}


/* =============================================================
   TABLA
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

    padding: 12px 10px;

}


.tabla-custom tbody tr {

    transition: all .2s;

}


.tabla-custom tbody tr:hover {

    background-color: #f8fbff;

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

.status-label {

    display: inline-block;

    padding: 7px 10px;

    border-radius: 15px;

    font-size: 11px;

}


.status-warning {

    background: #fff4df;

    color: #9a6a00;

}


.status-danger {

    background: #fdeaea;

    color: #a94442;

}


.status-default {

    background: #eee;

    color: #666;

}


/* =============================================================
   BOTONES
============================================================= */

.action-btn {

    border: 0;

    border-radius: 5px;

    padding: 8px 13px;

    font-weight: 600;

    transition: all .2s;

}


.action-btn:hover {

    transform: translateY(-1px);

    box-shadow:
        0 3px 8px rgba(0,0,0,.15);

}


/* IMPRIMIR */

.btn-print {

    background: #337ab7;

    color: white;

}


.btn-print:hover {

    background: #286090;

    color: white;

}


/* DAR PERMISO */

.btn-warning-custom {

    background: #f0ad4e;

    color: white;

}


.btn-warning-custom:hover {

    background: #ec971f;

    color: white;

}


/* QUITAR */

.btn-danger-custom {

    background: #d9534f;

    color: white;

}


.btn-danger-custom:hover {

    background: #c9302c;

    color: white;

}


/* CANCELAR */

.btn-cancel {

    background: #eee;

    color: #555;

}


.btn-cancel:hover {

    background: #ddd;

}


/* =============================================================
   PERMISOS
============================================================= */

.permission-card {

    padding: 10px;

    border-radius: 6px;

}


.permission-active {

    background: #f1fff4;

    border: 1px solid #c8e6cf;

}


.permission-inactive {

    background: #fafafa;

    border: 1px solid #ddd;

}


.permission-status {

    display: flex;

    justify-content: center;

    align-items: center;

    margin-bottom: 8px;

    text-align: left;

}


.permission-icon {

    width: 35px;

    height: 35px;

    min-width: 35px;

    border-radius: 50%;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 8px;

}


.permission-green {

    background: #5cb85c;

}


.permission-gray {

    background: #777;

}


.permission-status strong {

    display: block;

    font-size: 10px;

}


.permission-status small {

    display: block;

    color: #888;

    font-size: 10px;

}


/* =============================================================
   MODALES
============================================================= */

.modal-custom {

    border-radius: 8px;

    overflow: hidden;

}


.modal-warning {

    background: #f0ad4e;

    color: white;

    border: 0;

}


.modal-danger {

    background: #d9534f;

    color: white;

    border: 0;

}


.modal-header h4 {

    font-weight: 600;

}


.modal-header .close {

    color: white;

    opacity: .9;

}


.modal-big-icon {

    width: 75px;

    height: 75px;

    margin: 10px auto 20px;

    border-radius: 50%;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 30px;

}


.modal-icon-warning {

    background: #f0ad4e;

}


.modal-icon-danger {

    background: #d9534f;

}


/* =============================================================
   ALUMNO MODAL
============================================================= */

.modal-alumno {

    display: flex;

    align-items: center;

    background: #f7f9fb;

    border-left: 4px solid #f0ad4e;

    padding: 15px;

    border-radius: 5px;

    margin: 20px 0;

}


.modal-alumno-danger {

    border-left-color: #d9534f;

}


.modal-avatar {

    width: 45px;

    height: 45px;

    border-radius: 50%;

    background: #337ab7;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 12px;

    font-size: 18px;

}


.modal-alumno small {

    display: block;

    color: #999;

    font-size: 10px;

}


.modal-alumno strong {

    display: block;

    margin-top: 4px;

    color: #333;

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


    .permission-card {

        min-width: 160px;

    }


    .action-btn {

        width: 100%;

        margin-bottom: 4px;

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

    $('#table_autorizar_doc_final').DataTable({

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
                '/residencia/ver_estados_alumnos/' +
                id_carrera;

        }

    });


    /*
    =============================================================
    DAR PERMISO
    =============================================================
    */

    $("#table_autorizar_doc_final").on(
        'click',
        '.btn-permiso-modificacion',
        function () {

            var id =
                $(this).data('id');

            var nombre =
                $(this).data('nombre');


            $("#id_anteproyecto_modificacion")
                .val(id);


            $("#nombreAlumno")
                .text(nombre);


            $("#modalPermisoModificacion")
                .modal('show');

        }
    );


    /*
    =============================================================
    CONFIRMAR DAR PERMISO
    =============================================================
    */

    $("#btnConfirmarPermiso").on(
        'click',
        function () {

            var boton = $(this);

            var id =
                $("#id_anteproyecto_modificacion")
                .val();


            if (!id) {

                alert(
                    "No se encontró el anteproyecto."
                );

                return;

            }


            boton.prop(
                'disabled',
                true
            );


            boton.html(
                '<span class="glyphicon glyphicon-refresh"></span> Guardando...'
            );


            $.ajax({

                url:
                    "{{ url('/residencia/permiso_modificacion_anteproyecto') }}",

                type: "POST",

                data: {

                    id_anteproyecto: id,

                    _token:
                        "{{ csrf_token() }}"

                },


                success: function (response) {

                    $("#modalPermisoModificacion")
                        .modal('hide');


                    location.reload();

                },


                error: function (xhr) {

                    console.log(
                        xhr.responseText
                    );


                    alert(
                        "Ocurrió un error al otorgar el permiso."
                    );


                    boton.prop(
                        'disabled',
                        false
                    );


                    boton.html(
                        '<span class="glyphicon glyphicon-ok"></span> Sí, dar permiso'
                    );

                }

            });

        }
    );


    /*
    =============================================================
    QUITAR PERMISO
    =============================================================
    */

    $("#table_autorizar_doc_final").on(
        'click',
        '.btn-quitar-permiso',
        function () {

            var id =
                $(this).data('id');

            var nombre =
                $(this).data('nombre');


            $("#id_anteproyecto_quitar")
                .val(id);


            $("#nombreAlumnoQuitar")
                .text(nombre);


            $("#modalQuitarPermiso")
                .modal('show');

        }
    );


    /*
    =============================================================
    CONFIRMAR QUITAR
    =============================================================
    */

    $("#btnConfirmarQuitarPermiso").on(
        'click',
        function () {

            var boton = $(this);

            var id =
                $("#id_anteproyecto_quitar")
                .val();


            if (!id) {

                alert(
                    "No se encontró el anteproyecto."
                );

                return;

            }


            boton.prop(
                'disabled',
                true
            );


            boton.html(
                '<span class="glyphicon glyphicon-refresh"></span> Guardando...'
            );


            $.ajax({

                url:
                    "{{ url('/residencia/quitar_permiso_modificacion_anteproyecto') }}",

                type: "POST",

                data: {

                    id_anteproyecto: id,

                    _token:
                        "{{ csrf_token() }}"

                },


                success: function (response) {

                    $("#modalQuitarPermiso")
                        .modal('hide');


                    location.reload();

                },


                error: function (xhr) {

                    console.log(
                        xhr.responseText
                    );


                    alert(
                        "Ocurrió un error al quitar el permiso."
                    );


                    boton.prop(
                        'disabled',
                        false
                    );


                    boton.html(
                        '<span class="glyphicon glyphicon-lock"></span> Quitar permiso'
                    );

                }

            });

        }
    );

});

</script>

@endsection
