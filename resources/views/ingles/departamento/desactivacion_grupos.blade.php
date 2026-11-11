@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Desactivación de grupos')
@section('content')
    <main class="col-md-12">
        <div class="row">
            <div class="col-sm-4 col-md-offset-4">
                <div class="panel panel-info " >
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Desactivación de grupos<br>{{ $nombre_profesor->nombre }} {{ $nombre_profesor->apellido_paterno }} {{ $nombre_profesor->apellido_materno }}</h3>
                    </div>

                </div>

            </div>
        </div>
        @if($cuenta_niveles == 0)
            <div class="row">
                <div class="col-sm-4 col-md-offset-4">
                    <div class="panel panel-danger " >
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">No se le han asignado grupos en este periodo</h3>
                        </div>

                    </div>

                </div>
            </div>
        @else
            <div class="row">
                @foreach($niveles as $nivel)
                    <div class="col-sm-4 col-md-offset-1">
                        <div class="panel panel-default " style="border: 2px solid #43a1d2; border-radius: 7px; padding-right: 0">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">NIVEL: {{ $nivel->nivel }} <br> GRUPO: {{ $nivel->grupo }}
                                    @if($nivel->id_estado == 0)
                                    <br>
                                    <a href="/ingles/profesores/desactivar_grupo_prof/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}" class="btn btn-danger tooltip-options link" data-toggle="tooltip" data-placement="top" title="Desactivar">Desactivar</a>
                                    @else
                                        <br>
                                        <a href="/ingles/profesores/activar_grupo_prof/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}" class="btn btn-primary tooltip-options link" data-toggle="tooltip" data-placement="top" title="activar">Activar</a>
                                    {{-- <a href="/ingles/profesores/agregar_usuarios_grupo_prof/{{ $nivel->id_nivel }}/{{ $nivel->id_grupo }}" class="btn btn-success tooltip-options link" data-toggle="tooltip" data-placement="top" title="Agregar estudiantes">Agregar estudiantes</a>
--}}
                                    @endif
                                </h3>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        @endif


    </main>
@endsection