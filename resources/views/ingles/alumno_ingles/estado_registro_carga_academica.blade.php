@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Revisión de Carga academica ingles')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Carga Academica Ingles</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-5">
                <form id="form_carga" class="form" action="{{url("/ingles_horarios/guardar_iniciar_carga_academica/")}}" role="form" method="POST" >

                {{ csrf_field() }}
                <input type="hidden" id="id_periodo" name="id_periodo" value="{{ $periodo_ingles }}">
                <input type="hidden" id="id_alumno" name="id_alumno" value="{{ $alumno }}">
                </form>
                Dar clic para iniciar con el registro de carga académica<br>
                <button class="btn btn-primary iniciar_registro">Iniciar registro de carga académica</button>
                <br><p><br></p>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready( function() {
            $(".iniciar_registro").click(function (){
               // alert('hola');
                $("#iniciar_registro").attr("disabled", true);
                $("#form_carga").submit();

            });
        });
    </script>
@endsection