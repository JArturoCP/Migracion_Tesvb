@extends('layouts.app')
@section('title', 'ConstanciaGeneral')
@section('content')

<main class="col-md-12">
  <form>
  <div class="row">
    <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">Constancia General</div>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <table class="table table-bordered tabla-grande2" id="paginacion">
          <thead>
            <tr>
              <th>No. Cuenta</th>
              <th>Alumno</th>
              <th>Créditos</th>
              <th>Promedio</th>
              <th>Imprimir</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cinco_creditos as $cinco_creditos)

              @if($cinco_creditos->creditos>=5)
                <tr>
              <td>{{$cinco_creditos->cuenta}}</td>
              <td>{{$cinco_creditos->nombre}} {{$cinco_creditos->apaterno}} {{$cinco_creditos->amaterno}}</td>
              <td>{{$cinco_creditos->creditos}}</td>
              <td>{{$cinco_creditos->promedio}}</td>

              <td><a href="{{url("/ConstanciaGeneral/".$cinco_creditos->id_alumno."/edit")}}" target="_blank"><span class="glyphicon glyphicon-print em"  aria-hidden="true"></span></a></td>
                </tr>
              @endif

            @endforeach  
          </tbody>
        </table>
      </div>
    </div>
</form>
</main>
<script>
    $(document).ready(function(){
  $('#paginacion').DataTable();
});
</script>

@endsection