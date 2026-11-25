@extends('layouts.panel')
@section('title', 'Estímulo al Desempeño escolar')
@push('cabeza')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endpush

@section('content')

    <x-panel.modal id="modal_vulnerabilidad" tamano="lg" aria-labelledby="myModalLabel">
        <x-slot:encabezado>
            <h2 id="myModalLabel" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Solicitud del Estímulo al Desempeño Escolar</h2>
        </x-slot:encabezado>

        <form data-panel-envio id="form_enviar_encuesta" class="tw:space-y-4 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300" action="{{url("/beca_estimulo/vulnerabilidad_registrar")}}" role="form" method="POST">
            {{ csrf_field() }}
            <p>
                <b> QUE ES UN ESTUDIANTE VULNERABLE:</b> Un estudiante que presenta alguna de las siguientes condiciones a lo largo de su trayectoria escolar que le impida continuar en su preparación profesional.<br>
                <b>a) Ser madre de familia:</b> Para este caso se deberá entregar la siguiente documentación:<br>
                I. Copia del acta de nacimiento de los hijos.
                <br>
                <b>b)Tener una discapacidad:</b> Para este  se debera entregar  la siguiente documentación:<br>
                I. Constancia emitida por una institución gubernamental competente que determine la condición de discapacidad.
            </p>
            <p>En caso de que te declares como un estudiante con una condición de vulnerabilidad tal como se establece en el articulo 3 de estos criterios, deberas presentar la documentaciòn oficial que justifique dicha condición en la Subdirección de Estudios Profesionales en las fechas señaladas en la convocatoria.
            </p>
            <x-panel.alerta tipo="advertencia">Nota: También igual checa los demás requisitos que debes cumplir para el Estímulo al Desempeño Escolar en la convocatoria.</x-panel.alerta>
            <fieldset class="tw:space-y-2">
                <legend class="tw:mb-2 tw:font-semibold">Selecciona una respuesta por favor, para verificar si eres estudiante vulnerable:</legend>
                <label class="tw:flex tw:min-h-11 tw:items-center tw:gap-2"><input type="radio" name="pregunta1" data-panel-etiqueta="una respuesta" required id="pregunta1" value="1">Eres madre de familia</label>
                <label class="tw:flex tw:min-h-11 tw:items-center tw:gap-2"><input type="radio" name="pregunta1" data-panel-etiqueta="una respuesta" required id="pregunta1" value="2">Tienes alguna discapacidad</label>
                <label class="tw:flex tw:min-h-11 tw:items-center tw:gap-2"><input type="radio" name="pregunta1" data-panel-etiqueta="una respuesta" required id="pregunta1" value="3">Ninguna de las anteriores</label>
            </fieldset>
        </form>

        <x-slot:pie>
            <x-panel.boton type="button" variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" form="form_enviar_encuesta" class="contestar">Enviar respuesta</x-panel.boton>
        </x-slot:pie>
    </x-panel.modal>

<script>
$(function () {
    $("#modal_vulnerabilidad").modal("show");
});
</script>

@include('partials.panel.validacion_envio')
@endsection
