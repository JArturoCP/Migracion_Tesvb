@extends('layouts.app')
@section('title', 'Validación de cargas')
@section('content')

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">VALIDACIÓN DE CARGAS ACADÉMICAS POR PARTE DEL JEFE DE DIVISIÓN</h3>
                    </div>
                </div>
            </div>
        </div>
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <table class="table table-bordered " Style="background: white;" id="autorizar">
                  <thead>
                  <tr>
                      <th>No. CUENTA</th>
                      <th>NOMBRE DE ALUMNO(A)</th>
                      <th>SEMESTRE</th>
                      <th>GRUPO</th>
                      <th>CARRERA</th>
                      <th>CARGA ACADEMICA</th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($estudiantes_ins as $estudiante)
                      <tr>
                          <th>{{$estudiante['cuenta'] }}</th>
                          <td>{{$estudiante['nombre'] }} </td>
                          <td>{{$estudiante['semestre'] }} </td>
                          <td>{{$estudiante['grupo'] }} </td>
                          <td>{{ $estudiante['carrera'] }}</td>
                          <td >
                              <a onclick="window.open('{{ url('/revicion_carga_estudiante/'.$estudiante['id_alumno'].'/'.$estudiante['id_semestre'] ) }}')"><span class="glyphicon glyphicon-list-alt em5" aria-hidden="true"></span></a>
                          </td>

                      </tr>
                  @endforeach



                  </tbody>
              </table>
          </div>
      </div>
    <script>
        $(document).ready(function() {
            $('#autorizar').DataTable();
        });
    </script>
@endsection