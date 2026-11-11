<head>
  <style>
    #lista-opciones {
    position: absolute;
    top: 32px;
    left: 0;
    right: 0;
    background-color: white;
    border: 1px solid #ccc;
    list-style: none;
    padding: 0;
    margin: 0;
    z-index: 1;
    }
  </style>
</head>
@extends('tutorias.app_tutorias')
@section('content')
<div class="row">
    <div class="col-5 offset-3">
        <div class="card bg-success text-dark text-center">
            <h3>Seguiminto a los Coordinadores de Carreras</h3>
        </div>
    </div>
</div>
<div>
    <p></p>
</div>

<form action="{{ url('/tutorias/FO-40/guarda/')}}" class="form" role="form" method="POST">
    {{ csrf_field() }}
    <input class="form-control" type="hidden" id="id_personal" name="id_personal" value=" {{ $id_usuario }}">
    <div class="row">
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-bordered table-responsive-lg">
                    <tr>
                        <th>PROGRAMA DE ESTUDIO</th>
                        <th>COORDINADOR</th>
                        <th>{{$per->per}}</th>
                        <th>{{$per2->per}}</th>
                        <th>OBSERVACIONES</th>
                    </tr>
                    @foreach ($cordinadores as $cordinador)                        
                        <input class="form-control" type="hidden" id="id_asigna_coordinador" name="id_asigna_coordinador[]" value=" {{ $cordinador->id_asigna_coordinador }}">
                        <tr>
                            <td>{{$cordinador->carrera}}</td>
                            <th>{{$cordinador->nombre}}</th>
                            <th>
                            @if($con == 0)
                            <input class="form-control" type="hidden" id="i" name="i" value="1">
                            <select class="form-select-plaintext" name="se1[]" required>
                                <option value="">Selecciona una opción</option>
                                <option value="1">Cumplió</option>
                                <option value="2">No cumplió</option>
                                <option value="3">Avance 75%</option>
                                <option value="4">Avance 50%</option>
                                <option value="5">Avance 25%</option>
                            </select>
                            @else
                                <a>La evaluacion del seguimeinto 1 ya se ha registrado</a>
                            @endif
                            </th>    
                            <th>
                            @if($con == 1)
                            <input class="form-control" type="hidden" id="i" name="i" value="2">
                                <select class="form-select-plaintext" name="se2[]" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="1">Cumplió</option>
                                    <option value="2">No cumplió</option>
                                    <option value="3">Avance 75%</option>
                                    <option value="4">Avance 50%</option>
                                    <option value="5">Avance 25%</option>
                                </select>
                            @else
                                <a>La evaluacion del seguimeinto 1 no se ha registrado</a>
                            @endif
                            </th>
                            <th>
                                <div class="col-20">
                                    <textarea  class="form-control" rows="1" name="com[]" id="com" placeholder="" ></textarea>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <p>

    </p>
    <div class="row">
        <div class="col-md-2 col-md-offset-9">
            <button type="submit" id="siguiente" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>
@endsection