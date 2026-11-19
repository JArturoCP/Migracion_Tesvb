@extends('layouts.panel')
@section('title', 'Evaluación al Tutor')
@include('tutorias.partials.recursos_panel')
@section('content')
    @include('tutorias.alumnos.partial.navegacion_panel', ['titulo' => 'Evaluación al Tutor', 'activa' => '/tutoras_evaluacion/evaluacion_al_tutor/'])

    <x-panel.tarjeta class="tw-pantalla" titulo="Encuesta de evaluación al tutor" subtitulo="Parte 2 de 3 · Elige una opción en cada pregunta.">

    <form action="{{ url("/tutoras_evaluacion/guardar_evaluacion/dos/")  }}" class="" role="form" method="POST">
        {{ csrf_field() }}
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:w-full tw:px-2">
                <div class="tw:mb-4">
                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" type="hidden" id="id_asigna_tutor" name="id_asigna_tutor" value=" {{ $alumno->id_asigna_tutor }}">
                    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11 tw:dark:text-white/90 tw:dark:border-gray-700" type="hidden" id="id_asigna_alumno" name="id_asigna_alumno" value=" {{ $alumno->id_asigna_alumno }}">
                    <div class="tw:max-w-full tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:dark:border-gray-800">
                    <table class="tw-tabla tw-tabla-bordes tw-tabla-encuesta">
                        <thead>
                        <th>Nombre de la pregunta</th>
                        <th>Nada de acuerdo</th>
                        <th>Poco de acuerdo</th>
                        <th>De acuerdo</th>
                        <th>Totalmente de acuerdo</th>
                        </thead>
                        <tbody>
                        <td colspan="5"><label><strong>Percepción respecto a tu tutor(a) en la disponibilidad y confianza</strong></label></td>
                        </tbody>
                        <tbody>
                        <td><label>12. Mi tutor, ha estado disponible cuantas veces he requerido de su atención.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta1" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta1" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta1" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta1" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>13. Considero que el tiempo que me dedica mi tutor es suficiente.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta2" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta2" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta2" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta2" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>14. El clima durante las sesiones de tutoría ha sido de confianza.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta3" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta3" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta3" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta3" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>15. En las sesiones con mi tutor he podido plantear mis dificultades respecto a mi desarrollo académico.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta4" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta4" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta4" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta4" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>16. La retroalimentación de mi tutor, respecto a las actividades acordadas en las sesiones, ha sido oportuna.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta5" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta5" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta5" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion3_pregunta5" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td colspan="5"><label><strong>Percepción respecto a los servicios del Programa de Tutoría</strong></label></td>
                        </tbody>
                        <tbody>
                        <td><label>17. Considero importante el Programa de Tutorías.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta1" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta1" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta1" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta1" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>18. Considero que los espacios físicos dedicados a la tutoría son adecuados.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta2" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta2" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta2" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta2" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>19. Considero que el número de sesiones programadas para la tutoría, no interfieren con mis horarios de clase ni otras actividades académicas.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta3" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta3" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta3" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta3" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>20. Los materiales requeridos para las tutorías, están siempre disponibles.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta4" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta4" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta4" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta4" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>21. Las quejas respecto a la tutoría han sido atendidas oportunamente.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta5" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta5" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta5" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta5" value="4" required></label></center></td>
                        </tbody>
                        <tbody>
                        <td><label>22. La información respecto al Programa de Tutorías, ha sido puntual.</label></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta6" value="1" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta6" value="2" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta6" value="3" required></label></center></td>
                        <td> <center><label class="tw:mr-4 tw:inline-flex tw:cursor-pointer tw:items-center tw:gap-2 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300"><input class="tw:size-4 tw:shrink-0 tw:cursor-pointer tw:accent-brand-500" type="radio" name="secion4_pregunta6" value="4" required></label></center></td>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
            <div class="tw:flex tw:w-full tw:justify-end tw:px-2">
                <button type="submit" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-green-600 tw:text-white tw:shadow-theme-xs tw:hover:bg-green-700 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" onclick="operacion();">Siguiente</button>
            </div>
        </div>
    </form>
    </x-panel.tarjeta>
@endsection
