@extends('layouts.panel')
@section('title', 'Evaluación al Tutor')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Evaluación al Tutor', 'activa' => '/tutoras_evaluacion/evaluacion_al_tutor/'])

    <x-panel.tarjeta class="tw-pantalla" titulo="Encuesta de evaluación al tutor" subtitulo="Parte 3 de 3 · Elige una opción en cada pregunta.">

    <form action="{{ url("/tutoras_evaluacion/guardar_evaluacion/tres/")  }}" class="" role="form" method="POST">
        {{ csrf_field() }}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4">
                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden" id="id_asigna_tutor" name="id_asigna_tutor" value=" {{ $alumno->id_asigna_tutor }}">
                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" type="hidden" id="id_asigna_alumno" name="id_asigna_alumno" value=" {{ $alumno->id_asigna_alumno }}">
                    <table class="tw-tabla tw-tabla-bordes tw-tabla-encuesta">
                        <thead>
                        <th>Nombre de la pregunta</th>
                        <th>Nada de acuerdo</th>
                        <th>Poco de acuerdo</th>
                        <th>De acuerdo</th>
                        <th>Totalmente de acuerdo</th>
                        </thead>
                        <tbody>
                        <td colspan="5"><label><strong>Percepción respecto a tus logros y avances.</strong></label></td>
                        </tbody>
                        <tbody>
                        <td><label>23. La tutoría ha sido un factor importante en mi desarrollo académico.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta1" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta1" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta1" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta1" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>24. Considero que la tutoría ha sido un factor positivo en mi capacidad de socializar.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta2" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta2" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta2" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta2" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>25. La tutoría ha facilitado mi integración a la institución.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta3" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta3" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta3" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta3" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>26. Considero que la tutoría ha influido positivamente en mis calificaciones.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta4" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta4" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta4" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta4" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>27. La tutoría me ha permitido desarrollar estrategias de aprendizaje.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta5" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta5" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta5" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta5" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>28. Considero que la tutoría ha favorecido en mí, el estudio independiente.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta6" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta6" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta6" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta6" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>29. La tutoría ha favorecido mi autonomía como estudiante.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta7" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta7" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta7" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta7" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>30. La tutoría me ha permitido visualizar las perspectivas laborales en el campo profesional.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta8" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta8" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta8" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta8" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>31. Considero que la tutoría ha contribuido a ampliar mis perspectivas académicas.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta9" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta9" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta9" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion5_pregunta9" value="4" required></label></center></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <p>Comentarios u opiniones: A continuación, podrás expresar tus comentarios u opiniones, respecto a Fortalezas del Programa de Tutorias.</p>
            <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" rows="3" name="comentarios" id="comentarios"></textarea>
        <p><br></p>
        </div>

        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:flex tw:w-full tw:justify-end tw:px-2">
                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="operacion();">Guardar</button>
            </div>
        </div>
    </form>
    </x-panel.tarjeta>
@endsection

<!--script>
    function operacion()
    {
        TNotify.alert( "Datos guardados" );
    }
</script-->
