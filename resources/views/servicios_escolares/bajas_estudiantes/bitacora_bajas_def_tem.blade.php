@extends('layouts.app')
@section('title', 'Bitacoras Bajas Estudiantes')
@section('content')

    <main>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-xs-10 col-md-offset-1">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Bitácora de Bajas de Estudiantes</h3>
                        </div>
                    </div>
                </div>
            </div>


            @if($ver == 1)

                <ul class="nav nav-tabs" id="bajasTabs" role="tablist">
                    <li class="active">
                        <a href="#temporales" data-toggle="tab">Bajas Temporales</a>
                    </li>
                    <li>
                        <a href="#definitivas" data-toggle="tab">Bajas Definitivas</a>
                    </li>
                </ul>


                <div class="tab-content mt-4" id="bajasTabsContent">

                    <!-- TAB: TEMPORALES -->
                    <div class="tab-pane fade in active" id="temporales">
                        <div class="card">
                            <div class="card-body p-0">
                                <table id="table_temporales" class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">No.Cuenta</th>
                                        <th class="text-center">Nombre del Alumno</th>
                                        <th class="text-center">No. de Oficio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos_temporales as $alum_temp)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-center">{{$alum_temp->cuenta}}</td>
                                            <td class="text-center">{{$alum_temp->nombre}} {{$alum_temp->apaterno}}  {{$alum_temp->amaterno}}</td>
                                            <td class="text-center">{{$alum_temp->observaciones}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: DEFINITIVAS -->
                    <div class="tab-pane fade" id="definitivas">
                        <div class="card">
                            <div class="card-body p-0">
                                <table id="table_definitivas" class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">No.Cuenta</th>
                                        <th class="text-center">Nombre del Alumno</th>
                                        <th class="text-center">No. de Oficio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos_definitivos as $alum_def)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-center">{{$alum_def->cuenta}}</td>
                                            <td class="text-center">{{$alum_def->nombre}} {{$alum_def->apaterno}}  {{$alum_def->amaterno}}</td>
                                            <td class="text-center">{{$alum_def->observaciones}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


            @endif

        </div>
    </main>


    <script>
        $(document).ready(function () {
            $('#bajasTabs a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>


@endsection