@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h1 class="panel-title text-center">SUBIR EVIDENCIA DE CONOCIMIENTO QUE NO REQUIERE AUTORIZACIÓN DE JEFE INMEDIATO</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
            <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class= "dropdown">
                            <label for="Tipo_evi">Tipo de evidencia: </label>
                            <select class="form-control" placeholder="Seleciona una opción" id="id_tipo_evid" name="id_tipo_evid" required>
                                <option disabled selected hidden> Selecciona una opción </option>
                                @foreach($tipo_evidencia as $tipo_evidencia)
                                    <option value="{{$tipo_evidencia->id_tipo_evid}}" data-evid="{{$tipo_evidencia->nombre_evidencia}}"> {{$tipo_evidencia->nombre_evidencia}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
                <div class="row">
                    <p><br></p>
                </div>
                <div class="row">
                    <div class="col-md-5 col-md-offset-2">
                        <label class="radio-inline"><input type="radio" id="optradio1" name="optradio" value="1" >La incidencia es en una fecha determinada</label>
                    </div>
                    <div class="col-md-5">
                        <label class="radio-inline"><input type="radio" id="optradio2" name="optradio" value="2">La incidencia es un periodo determinado</label>
                    </div>
                </div>


            <div class="row" >
                <br>
                <div class="col-md-4 col-md-offset-5">
                    <button id="siguiente" type="button" class="btn btn-primary ">Siguiente</button>
                </div>
            </div>
        </div>
        <script>
            $(document).ready( function() {



                $("#siguiente").click(function(){

                    var id_tipo_evid= $('#id_tipo_evid').val();
//alert(id_tipo_evid);
                    if(id_tipo_evid == null)
                    {
                        swal({
                            position: "top",
                            type: "error",
                            title: "Selecciona tipo de evidencia",
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    else{

                        var seleccionado = document.querySelector('input[name="optradio"]:checked');

                            if (seleccionado) {

                                var tipo_fecha= seleccionado.value;

                                window.location.href='/incidencias/cargar_evidencia_tipo_fecha/'+id_tipo_evid+'/'+tipo_fecha;

                            } else {
                                swal({
                                    position: "top",
                                    type: "error",
                                    title: "Selecciona tipo de fecha",
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }



                    }


///////seecion de evidencia////
                });
            });
        </script>
    </main>
@endsection