@extends('layouts.app')
@section('title', 'Historial de encuestas')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Historial de Encuestas de Satisfacción de Cliente (Titulación)</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row" >
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <div class="dropdown">
                                    <label for="ano_oficio">Seleccionar año de ver historial de encuestas</label>
                                    <select name="year" id="year" class="form-control " required>
                                        @foreach($year_historial as $year)
                                            <option disabled selected hidden>Selecciona una opción</option>
                                            <option value="{{$year->year }}" >{{$year->year}} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#year").on('change',function(e) {
                // alert($("#grupos").val());
                var year = $("#year").val();
                window.location.href='/encuestas_satisfaccion/menu_historial_titulacion_year/'+year;
            });

        });

    </script>
@endsection