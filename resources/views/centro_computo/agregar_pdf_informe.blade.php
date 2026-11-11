@extends('layouts.app')
@section('title', 'agregar informe')
@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title text-center">Informes de titulación</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-bordered " Style="background: white;" id="version_actual">
            <thead>
            <tr>
                <th>No. CUENTA</th>
                <th>NOMBRE DE ALUMNO(A)</th>
                <th>CARRERA</th>
                <th>VER PDF</th>
                <th>MODIFICAR PDF</th>

            </tr>
            </thead>
            <tbody>

            @foreach($titulados as $titulado)
            <tr>
                <th>{{$titulado->no_cuenta}}</th>
                <td>{{$titulado->apaterno}} {{$titulado->amaterno}} {{$titulado->nombre_al}}</td>

                <td>{{$titulado->carrera}}</td>
                <td> <button type="button" class="btn btn-primary center" onclick="window.open('{{url('/titulacion/'.$titulado->pdf_reporte_titulacion)}}')">Ver </button></td>
                <td><button type="button" class="btn btn-primary editar_reporte" data-id="{{ $titulado->id_alumno }}">Modificar</button></td>

            </tr>
            @endforeach



            </tbody>
        </table>
    </div>
</div>

{{--Modal de modificar--}}
<div class="modal fade" id="modal_modificar_reporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Editar PDF</h4>
            </div>
            <form id="form_modificacion_reporte" class="form" action="{{url("/titulacion/modificar_datos_estudiante_computo/")}}" role="form" method="POST" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="modal-body">

                    <div id="contenedor_modificar_reporte">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button  id="guardar_modificacion_reporte" type="button" style="" class="btn btn-primary"  >Guardar modificación</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">


    $(document).ready(function(){
        $('#version_actual').DataTable();

        $("#version_actual").on('click','.editar_reporte',function(){
            var id_alumno = $(this).data('id');
            $.get("/titulacion/editar_reporte_titulacion_centro/"+id_alumno,function (request) {
                $("#contenedor_modificar_reporte").html(request);
                $("#modal_modificar_reporte").modal('show');
            });

        });
        $("#guardar_modificacion_reporte").click(function(event) {


                        var file = $("#file").val();
                        if(file == ''){
                            swal({
                                position: "top",
                                type: "error",
                                title: "Selecciona el PDF del documento",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }else{

                            $("#form_modificacion_reporte").submit();
                            $("#guardar_modificacion_reporte").attr("disabled", true);
                            swal({
                                type: "success",
                                title: "Modificación exitosa",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }

        });



    });

</script>


@endsection
