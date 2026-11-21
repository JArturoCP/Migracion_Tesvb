@extends('layouts.app')

@section('content')

<div class="container main">

    <!-- Encabezado -->
    <div class="row text-center">
        <div class="col-md-12">
            <h2>📊 Resultado EGEL</h2>
        </div>
    </div>

    <!-- Resultado general -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h3 class="panel-title">Resultado General</h3>
                </div>
                <div class="panel-body">
                    @if($resultado)
                        <h1 style="font-size:60px; margin: 10px 0;">
                            {{ $resultado->calificacion_general }}%
                        </h1>
                        <p class="lead">
                            Nivel: <strong>{{ $resultado->nivel }}</strong>
                        </p>
                    @else
                        <p class="text-muted">Aún no hay resultado generado</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- Resultados por módulo -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">📚 Resultados por módulo</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Módulo</th>
                                    <th class="text-center">Puntos obtenidos</th>
                                    <th class="text-center">Total puntos</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($porModulo as $m)
                                    <tr>
                                        <td class="text-center">{{ $m->nombre }}</td>

                                        <td class="text-center">
                                            {{ number_format($m->puntos, 2) }}
                                        </td>

                                        <td class="text-center">
                                            {{ number_format($m->total_valor, 2) }}
                                        </td>

                                        <td class="text-center">
                                            <span class="label label-primary">
                                                {{ $m->porcentaje }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultados por sección -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">📑 Resultados por sección</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Sección</th>
                                    <th class="text-center">Puntos obtenidos</th>
                                    <th class="text-center">Total puntos</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($porSeccion as $s)
                                    <tr>
                                        <td class="text-center">Sección {{ $s->id_seccion }}</td>

                                        <td class="text-center">
                                            {{ number_format($s->puntos, 2) }}
                                        </td>

                                        <td class="text-center">
                                            {{ number_format($s->total_valor, 2) }}
                                        </td>

                                        <td class="text-center">
                                            <span class="label label-success">
                                                {{ $s->porcentaje }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón final -->
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:30px;">
            <a href="{{ route('egel.resultados.reporte') }}" class="btn btn-primary btn-lg">
                📄 Reporte final
            </a>
        </div>
    </div>
<br>
</div>

@endsection