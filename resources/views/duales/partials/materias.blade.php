@if($estado_alumno->estado_validacion == 8)

<div class="row">
    <div class="col-md-10 col-md-offset-1">

        <div class="alert alert-danger text-center alerta-autorizada">

            <span class="glyphicon glyphicon-lock icon-alerta"></span>

            <strong>La carga académica ha sido autorizada.</strong>

            <br>

            <span>
                No es posible realizar modificaciones.
            </span>

        </div>

    </div>
</div>

@else

<input type="hidden" id="id_duales_actuales" name="id_duales_actuales" value="{{ $id_duales_actuales }}">

<style>
    .reticula-container {
        margin-bottom: 20px;
    }

    .reticula-container .panel-heading {
        background: #337ab7;
        border-color: #337ab7;
        padding: 13px 15px;
    }

    .reticula-container .panel-heading a {
        display: block;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
    }

    .reticula-container .panel-heading a:hover,
    .reticula-container .panel-heading a:focus {
        text-decoration: none;
        color: #fff;
    }

    .reticula-container .panel-heading .glyphicon {
        margin-right: 8px;
    }

    .semestres {
        padding: 10px;
    }

    .semestres .list-group {
        margin-bottom: 0;
    }

    .semestres .list-group-item {
        cursor: pointer;
        transition: all .2s ease;
        border-left: 4px solid transparent;
        font-weight: 500;
    }

    .semestres .list-group-item:hover {
        background-color: #f5f5f5;
        border-left-color: #337ab7;
    }

    .semestres .list-group-item.active {
        background-color: #337ab7;
        border-color: #337ab7;
        border-left-color: #23527c;
        color: #fff;
    }

    .semestres .list-group-item .glyphicon {
        margin-right: 7px;
    }

    .materias-container {
        padding: 10px 20px 20px;
    }

    .titulo-semestre {
        margin-top: 0;
        margin-bottom: 15px;
        padding: 10px 15px;
        background: #f5f5f5;
        border-left: 4px solid #337ab7;
        border-radius: 3px;
        color: #333;
    }

    .titulo-semestre .glyphicon {
        color: #337ab7;
        margin-right: 6px;
    }

    .tabla-materias {
        margin-bottom: 0;
    }

    .tabla-materias thead th {
        background: #337ab7;
        color: #f8f3f3;
        text-align: center;
        vertical-align: middle !important;
    }

    .tabla-materias tbody td {
        vertical-align: middle !important;
    }

    .tabla-materias tbody tr:hover {
        background-color: #f9f9f9;
    }

    .tabla-materias .check-materia {
        width: 50px;
        text-align: center;
    }

    .check-materia input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .materia-nombre {
        font-weight: 500;
    }

    .materia-clave {
        color: #777;
        font-family: monospace;
        font-weight: bold;
    }

    .contador-materias {
        float: right;
        background: #337ab7;
        color: #fff;
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 11px;
    }

    .alerta-autorizada {
        margin-top: 10px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .icon-alerta {
        font-size: 25px;
        display: block;
        margin-bottom: 8px;
    }

    @media (max-width: 767px) {

        .reticula-container {
            margin-left: 0;
            margin-right: 0;
        }

        .semestres {
            margin-bottom: 15px;
        }

        .materias-container {
            padding: 10px;
        }

        .tabla-materias {
            font-size: 12px;
        }

        .tabla-materias th,
        .tabla-materias td {
            padding: 7px !important;
        }

    }
</style>

@foreach($reticulas as $reti)

<div class="row">

    <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-primary reticula-container">

            <!-- ENCABEZADO RETÍCULA -->

            <div class="panel-heading">

                <h4 class="panel-title">

                    <a data-toggle="collapse" data-parent="#accordion-reticulas"
                        href="#reticula{{ $reti["id_reticula"] }}">

                        <span class="glyphicon glyphicon-education"></span>

                        {{ $reti["reticula"] }}

                        <span class="glyphicon glyphicon-chevron-down pull-right"></span>

                    </a>

                </h4>

            </div>

            <!-- CONTENIDO RETÍCULA -->

            <div id="reticula{{ $reti["id_reticula"] }}" class="panel-collapse collapse">

                <div class="panel-body">

                    <div class="row">

                        <!-- ================================= -->
                        <!-- SEMESTRES -->
                        <!-- ================================= -->

                        <div class="col-md-3 semestres">

                            <div class="list-group">

                                @foreach($reti["semestres"] as $semes)

                                <a href="#tab{{ $reti["id_reticula"] }}{{ $semes["id_semestre"] }}" role="tab"
                                    data-toggle="tab" class="list-group-item">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                    {{ $semes["semestre"] }}

                                </a>

                                @endforeach

                            </div>

                        </div>

                        <!-- ================================= -->
                        <!-- MATERIAS -->
                        <!-- ================================= -->

                        <div class="col-md-9">

                            <div class="tab-content">

                                @foreach($reti["semestres"] as $semes)

                                <div role="tabpanel" class="tab-pane fade"
                                    id="tab{{ $reti["id_reticula"] }}{{ $semes["id_semestre"] }}">

                                    <div class="materias-container">

                                        <h4 class="titulo-semestre">

                                            <span class="glyphicon glyphicon-book"></span>

                                            Materias de
                                            <strong>
                                                {{ $semes["semestre"] }}
                                            </strong>

                                        </h4>

                                        <div class="table-responsive">

                                            <table class="table table-bordered table-hover tabla-materias">

                                                <thead>

                                                    <tr>

                                                        <th style="width:120;">
                                                            Seleccionar
                                                        </th>

                                                        <th>
                                                            Materia
                                                        </th>

                                                        <th style="width:120px;">
                                                            Clave
                                                        </th>

                                                    </tr>

                                                </thead>

                                                <tbody>

                                                    @foreach($semes["materias"] as $materias)

                                                    <?php $bandera = false; ?>

                                                    @foreach($materias_alumnos_duales as $ma_al_du)

                                                    @if($ma_al_du->id_materia == $materias["id_materia"])

                                                    <?php $bandera = true; ?>

                                                    @endif

                                                    @endforeach

                                                    <tr>

                                                        <!-- CHECKBOX -->

                                                        <td class="check-materia">

                                                            <input type="checkbox" name="materia[]"
                                                                id="materia{{ $materias["id_materia"] }}"
                                                                value="{{ $materias["id_materia"] }}"
                                                                {{ $bandera ? 'checked' : '' }}>

                                                        </td>

                                                        <!-- MATERIA -->

                                                        <td>

                                                            <label for="materia{{ $materias["id_materia"] }}"
                                                                style="cursor:pointer; margin:0; width:100%;">

                                                                <span class="materia-nombre">

                                                                    {{ $materias["materia"] }}

                                                                </span>

                                                            </label>

                                                        </td>

                                                        <!-- CLAVE -->

                                                        <td class="text-center">

                                                            <span class="materia-clave">

                                                                {{ $materias["clave"] }}

                                                            </span>

                                                        </td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endforeach

<script>
    $(document).ready(function() {
        /*
         * ====================================================
         * ABRIR AUTOMÁTICAMENTE EL PRIMER SEMESTRE
         * ====================================================
         */
        $('.reticula-container').each(function() {
            var primerSemestre = $(this)
                .find('.list-group-item')
                .first();
            if (primerSemestre.length) {
                primerSemestre.addClass('active');
                var target = primerSemestre.attr('href');
                $(target).addClass('in active');
            }
        });
        /*
         * ====================================================
         * CAMBIAR SEMESTRE
         * ====================================================
         */
        $('.semestres .list-group-item').on('click', function() {
            $(this)
                .closest('.list-group')
                .find('.list-group-item')
                .removeClass('active');
            $(this).addClass('active');
        });
    });
</script>

@endif