@extends('tutorias.app_tutorias')
@section('content')
    <div class="row">
        <div class="col-md-4 offset-4 ">
            <form id="form_registrar" action="{{url("/tutorias/registrar_inicio_expediente")}}" class="form" role="form" method="POST">

                {{ csrf_field() }}
            </form>
            <button type="button" class="btn btn-primary " id="registro">Iniciar registro de expediente</button>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#registro").click(function(event) {
                $("#registro").attr("disabled", true);
                $("#form_registrar").submit();
            });
        });
    </script>
@endsection