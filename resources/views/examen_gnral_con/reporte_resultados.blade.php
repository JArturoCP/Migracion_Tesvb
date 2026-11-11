@extends('layouts.app')

@section('content')

<style>
body {
    background: #6c737d;
}

/* TÍTULO */
.page-title {
    font-weight: 700;
    margin-bottom: 20px;
}

/* TARJETAS */
.card-eval {
    border: none;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    padding: 20px;
    background: #fff;
    margin-bottom: 20px;
}

/* BADGES */
.badge-soft {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
}

/* TABLA */
.table-custom {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
}

.table-custom thead {
    background: #343a40;
    color: #fff;
}

.table-custom th, .table-custom td {
    vertical-align: middle !important;
}

/* BOTÓN */
.btn-imprimir {
    border-radius: 30px;
    padding: 12px 28px;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.btn-imprimir:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
}
</style>

<div class="container py-4">

    {{-- TÍTULO --}}
    <h2 class="text-center page-title">
        📄 Reporte Final EGEL
    </h2>

    {{-- INFO ALUMNO --}}
    <div class="card-eval">
        <p class="mb-1"><b>Estudiante:</b></p>
        <h4>
            {{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}
        </h4>

        @if($resultado)
            <hr>
            <div class="row text-center">
                <div class="col-md-6">
                    <p class="mb-1"><b>Calificación general</b></p>
                    <span class="badge bg-primary badge-soft">
                        {{ $resultado->calificacion_general }}%
                    </span>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><b>Nivel</b></p>
                    <span class="badge bg-success badge-soft">
                        {{ $resultado->nivel }}
                    </span>
                </div>
            </div>
        @endif
    </div>

    {{-- RESULTADOS --}}
    <div class="card-eval">
        <h4 class="text-center mb-3">📊 Resultados por módulo</h4>

        <table class="table table-custom table-hover text-center">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Puntos obtenidos</th>
                    <th>Total puntos</th>
                    <th>%</th>
                </tr>
            </thead>

            <tbody>
            @foreach($porModulo as $m)
                <tr>
                    <td><b>{{ $m->nombre }}</b></td>
                    <td>{{ number_format($m->puntos, 2) }}</td>
                    <td>{{ number_format($m->total_valor, 2) }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $m->porcentaje }}%
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- BOTÓN --}}
    <div class="text-center">
        <a href="{{ route('egel.pdf.oficial') }}"
           target="_blank"
           class="btn btn-danger btn-lg btn-imprimir">
            Descargar Reporte Oficial
        </a>
    </div>
<br>
</div>

@endsection