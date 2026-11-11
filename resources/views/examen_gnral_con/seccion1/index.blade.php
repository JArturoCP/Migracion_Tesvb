@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 40px; max-width: 900px;">

    <div class="panel panel-warning">

        {{-- ENCABEZADO --}}
        <div class="panel-heading text-center" style="background-color: #f0ad4e; color: white;">
            <h3 style="margin: 0;">
                <i class="glyphicon glyphicon-info-sign"></i>
                INSTRUCCIONES GENERALES
            </h3>
        </div>

        <div class="panel-body">

            {{-- TÍTULO DINÁMICO --}}
            <h4 class="text-center" style="font-weight: bold; margin-top: 10px;">Examen de Conocimientos Generales </h4>

            <h5 class="text-center text-muted">
                Modalidad en Línea (aplicación en institución)
            </h5>

            <hr>

            {{-- INSTRUCCIONES --}}
            <div class="alert alert-info text-center">
                Lea cuidadosamente las siguientes indicaciones antes de iniciar el examen
            </div>

            <ul class="list-group" style="margin-top: 20px;">
                <li class="list-group-item">Permanezca en su lugar durante toda la aplicación del examen.</li>
                <li class="list-group-item">No se permitirá el uso de teléfonos celulares, audífonos, libros, cuadernos o apuntes.</li>
                <li class="list-group-item">Siga en todo momento las instrucciones del personal aplicador.</li>
                <li class="list-group-item">Mantenga una conducta respetuosa y en silencio.</li>
                <li class="list-group-item">No abandone el área de aplicación sin autorización.</li>
                <li class="list-group-item">
                    Cualquier intento de copia o uso de dispositivos no permitidos será motivo de cancelación inmediata del examen.
                </li>
            </ul>

            {{-- ALERTA --}}
            <div class="alert alert-danger text-center" style="margin-top: 20px;">
                <strong>
                    Al continuar, usted acepta cumplir con estas disposiciones.
                </strong>
            </div>

            {{-- BOTÓN --}}
            <div class="text-center" style="margin-top: 30px;">
                <a href="{{ route('examen_general.seccion.pregunta', ['id_seccion' => $id_seccion]) }}"
                   class="btn btn-success btn-lg">
                    <i class="glyphicon glyphicon-play"></i>
                    Iniciar Examen
                </a>
            </div>

        </div>
    </div>

</div>

@endsection