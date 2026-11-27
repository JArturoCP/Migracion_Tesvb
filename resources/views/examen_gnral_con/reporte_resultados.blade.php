@extends('layouts.panel')

@include('partials.panel.recursos_app')
@section('content')
<div class="tw-pantalla">

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

<div class="tw:w-full tw:py-6">

    {{-- TÍTULO --}}
    <h2 class="page-title tw:text-center tw:mb-4 tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
        📄 Reporte Final EGEL
    </h2>

    {{-- INFO ALUMNO --}}
    <div class="card-eval">
        <p class="tw:mb-1"><b>Estudiante:</b></p>
        <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
            {{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}
        </h4>

        @if($resultado)
            <hr>
            <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4 tw:text-center">
                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <p class="tw:mb-1"><b>Calificación general</b></p>
                    <span class="badge-soft tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium tw:bg-brand-500 tw:text-white">
                        {{ $resultado->calificacion_general }}%
                    </span>
                </div>

                <div class="tw:w-full tw:lg:w-6/12 tw:px-2">
                    <p class="tw:mb-1"><b>Nivel</b></p>
                    <span class="badge-soft tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium tw:bg-green-100">
                        {{ $resultado->nivel }}
                    </span>
                </div>
            </div>
        @endif
    </div>

    {{-- RESULTADOS --}}
    <div class="card-eval">
        <h4 class="tw:text-center tw:mb-4 tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">📊 Resultados por módulo</h4>

        <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
<table class="table-custom tw-tabla-centrada tw-tabla">
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
                        <span class="tw:inline-flex tw:items-center tw:rounded-full tw:px-2.5 tw:py-0.5 tw:text-sm tw:font-medium tw:bg-sky-100 tw:text-gray-800 tw:dark:text-white/90">
                            {{ $m->porcentaje }}%
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
    </div>

    {{-- BOTÓN --}}
    <div class="tw:text-center">
        <a href="{{ route('egel.pdf.oficial') }}"
           target="_blank"
           class="btn-imprimir tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-red-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:bg-red-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">
            Descargar Reporte Oficial
        </a>
    </div>
</div>

</div>
@endsection