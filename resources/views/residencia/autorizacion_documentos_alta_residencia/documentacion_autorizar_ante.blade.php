@extends('layouts.app')
@section('title', 'Autorizar documentación Anteproyecto')
@section('content')
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <p>
                <span class="glyphicon glyphicon-arrow-right"></span>
                <a href="{{url("/residencia/autorizar_documentacion_anteproyecto")}}">Programas de Estudios</a>
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span>Autorizar documentación</span>

            </p>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8  col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Autorizar documentación de Alta de Residencia del periodo {{ $nombre_periodo }}<br>Carrreras</h3>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-body">

                    <table id="table_anteproyecto" class="table table-bordered table-resposive">
                        <thead>
                        <tr>
                            <th>No. cuenta</th>
                            <th>Nombre del alumno</th>
                            <th>Nombre del anteproyecto</th>
                            <th>Autorizar documentación de alta de residencia</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($array_anteproyecto as $anteproyecto)

                            <tr>
                                <td>{{$anteproyecto['cuenta']}}</td>
                                <td>{{$anteproyecto['nombre']}}</td>
                                <td>{{ $anteproyecto['nom_proyecto']}}</td>

                                @if($anteproyecto['autorizacion_departamento'] == 0)
                                @if($anteproyecto['estado_empresa']== 2)
                                    <td>
                                        <button class="btn btn-primary autorizar_documentos" id="{{ $anteproyecto['id_anteproyecto'] }}">Autorizar</button>
                                    </td>
                                @elseif($anteproyecto['estado_empresa']== 1)
                                    <td>
                                        No se le ha asignado asesor interno
                                    </td>

                                @elseif($anteproyecto['estado_empresa']== 0)
                                    <td>
                                        No ha registrado el alumno su empresa
                                    </td>
                                @endif
                                @else
                                    <td>Documentación Autorizada</td>
                                @endif

                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_enviar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Autorizar documentación de Alta de Residencia</h4>
                    </div>
                <form class="form" action="{{url("/residencia/guardar_autorizacion_documentacion_alumn/")}}" role="form" method="POST" >
                    {{ csrf_field() }}
                    <div id="contenedor_enviar">


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input  type="submit" class="btn btn-primary" value="Aceptar"/>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_anteproyecto').DataTable( {

            } );
            $("#table_anteproyecto").on('click','.autorizar_documentos',function(){
                var id_anteproyecto = $(this).attr('id');

                $.get("/residencia/ver_datos_anteproyecto_alum/"+id_anteproyecto,function (request) {
                    $("#contenedor_enviar").html(request);
                    $("#modal_enviar").modal('show');
                });
            });

        });
    </script>
@endsection

