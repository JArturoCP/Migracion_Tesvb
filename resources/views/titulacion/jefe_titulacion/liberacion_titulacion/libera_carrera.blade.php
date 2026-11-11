@extends('layouts.app')
@section('title', 'Titulacion')
@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Ver titulados liberados <br>(PROGRAMAS DE ESTUDIO) </h3>
                </div>
                <div class="panel-body " >
                    <div class="row">
                        <div class="col-md-2 col-md-offset-8">
                            <button type="button" class="btn btn-success" id="exportar_est">Exportar titulados por año</button>
                        </div>
                        <div class="col-md-2 ">

                            <button type="button" class="btn btn-success" onclick="window.location='{{ url('/titulacion/exportar_alumnos_liberados/' ) }}'">Exportar titulados</button>
                            <p><br><br></p>
                        </div>
                    </div>

                    <div class="col-md-6 col-md-offset-3">
                        <ul class="nav nav-pills nav-stacked" style="background-color:white;border: 2px solid black; border-radius: 7px; padding-right: 0px">
                            @foreach($carreras as $carrera)
                                <li style="margin-top: 0px"><a style="border-bottom: 2px solid black;" data-toggle="pill" href="#" onclick="window.location='{{ url('/titulacion/registro_titulados_carrera/'.$carrera->id_carrera ) }}'" >   {{$carrera->nombre}}</a></li>

                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fullscreen-modal fade" id="modal_sel_year" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Busqueda de titulados por años</h4>
                    </div>
                    <div class="modal-body">
                        <div id="contenedor_sel_year">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button  type="button" style="" id="buscar" class="btn btn-primary"  >Buscar</button>
                    </div>

            </div>
        </div>
    </div>

    <script>

        $(document).ready(function() {
           $("#exportar_est").click(function (){
               $.get("/titulacion/seleccionar_year/",function(request){
                   $("#contenedor_sel_year").html(request);
                   $("#modal_sel_year").modal('show');

               });
           });
           $("#buscar").click(function (){
               var id_year=$("#id_year").val();

               if(id_year == null){
                   swal({
                       position: "top",
                       type: "warning",
                       title: "Selecciona año",
                       showConfirmButton: false,
                       timer: 3500
                   });
               }else{
                   window.location.href='/titulacion/exportar_excel_yeartitulados/'+id_year ;

               }
           })


        });
    </script>


@endsection