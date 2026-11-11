@extends('layouts.app')
@section('title','Incidencias')
@section('content')

    <main class="col-md-12">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">HISTORIAL DE EVIDENCIAS DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO </h3>
                </div>
            </div>
        </div>
        @if($estado == 0)
            <div class="row" >
                <div class="col-md-3 col-md-offset-4">
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="ano_oficio">Seleccionar personal</label>
                            <select name="id_personal" id="id_personal" class="form-control " required>
                                @foreach($personal as $personal)
                                    <option disabled selected hidden>Selecciona una opción</option>
                                    <option value="{{$personal->id_personal}}" >{{$personal->nombre}} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @else
            <div class="row" >
                <div class="col-md-3 col-md-offset-4">
                    <div class="form-group">
                        <div class="dropdown">
                            <label for="ano_oficio">Seleccionar personal</label>
                            <select name="id_personal" id="id_personal" class="form-control " required>
                                @foreach($personal as $personal)
                                    @if($personal->id_personal==$id_personal)
                                        <option value="{{$personal->id_personal}}" selected="selected">{{$personal->nombre}}</option>
                                    @else
                                    <option value="{{$personal->id_personal}}" >{{$personal->nombre}} </option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table id="tabla_historial_docentes" class="table table-bordered table-resposive" align="center">
                    <thead >
                    <th class="text-center">No.</th>
                    <th>Nombre del solicitante</th>
                    <th class="text-center">Evidencia aplicada</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Fecha y hora de envio</th>
                    <th class="text-center">Ver evidencia</th>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach ($histEvi as $evidhist)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{$evidhist->nombre}}</td>
                                <td>{{$evidhist->nombre_evidencia}}
                                    @if($evidhist->id_tipo_evid == 1 || $evidhist->id_tipo_evid == 3 ||  $evidhist->id_tipo_evid == 5  ||  $evidhist->id_tipo_evid == 6)
                                        <br><b>Folio: {{ $evidhist->no_folio }} </b>
                                    @endif
                                </td>
                                @if($evidhist->no_fecha == 1)
                                    <?php
                                    $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                                    ?>
                                    <td>
                                        {{$fecha_solicita}}
                                    </td>
                                @else
                                    <?php
                                    $fecha_solicita= date('d-m-Y', strtotime($evidhist->fecha_solicita));
                                    $fecha_solicita_2= date('d-m-Y', strtotime($evidhist->fecha_solicita_2));
                                    ?>
                                    <td>
                                        {{$fecha_solicita}} al {{ $fecha_solicita_2 }}
                                    </td>

                                @endif
                                <?php  $fecha_envio=date_format(new DateTime($evidhist->fecha_envio), 'd-m-Y H:i:s');?>
                                <td>{{$fecha_envio}}</td>
                                <th>
                                    <a  target="_blank" href="/incidencias/{{$evidhist->arch_evidencia}}" class="btn btn-primary"> <i class=" glyphicon glyphicon-book em128" title="Ver PDF"> </i> Ver evidencia </a>
                                </th>

                            </tr>
                    @endforeach
                    <tbody>
                </table>
            </div>
        </div>

        @endif
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tabla_historial_docentes').DataTable( {

                } );
                $("#id_personal").on('change',function(e) {
                    // alert($("#grupos").val());
                    var id_personal = $("#id_personal").val();
                    window.location.href='/incidencias/historial_evidencias_conocimient/'+id_personal;
                });

            });
        </script>
    </main>
@endsection