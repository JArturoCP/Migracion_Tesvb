<style>
    .horario-documento { color: #222; background: #fff; font-family: Arial, sans-serif; margin-top: 24px; }
    .horario-documento .horario-encabezado { text-align: center; margin-bottom: 18px; }
    .horario-documento .horario-logo { width: 170px; max-width: 100%; height: auto; }
    .horario-documento h2 { font-size: 17px; font-weight: bold; margin: 12px 0 8px; line-height: 1.4; }
    .horario-documento .horario-grupo { font-size: 12px; font-weight: bold; }
    .horario-documento .horario-vigencia { text-align: right; font-size: 12px; margin-bottom: 8px; }
    .horario-documento .horario-scroll { overflow-x: auto; }
    .horario-documento table { width: 100%; border-collapse: collapse; table-layout: fixed; margin-bottom: 0; }
    .horario-documento .horario-tabla { min-width: 960px; }
    .horario-documento th, .horario-documento td { border: 1px solid #555; padding: 7px 6px; font-size: 11px; line-height: 1.4; overflow-wrap: break-word; vertical-align: middle; }
    .horario-documento th { font-weight: normal; text-align: center; background: #f5f5f5; }
    .horario-documento .horario-hora { width: 100px; text-align: center; white-space: nowrap; }
    .horario-documento .horario-total { width: 58px; text-align: center; }
    .horario-documento .horario-clase + .horario-clase { border-top: 1px dashed #888; margin-top: 6px; padding-top: 6px; }
    .horario-documento .horario-conflicto { background: #fff3cd; }
    .horario-documento .horario-aviso { color: #795000; font-size: 10px; display: block; margin-top: 3px; }
    .horario-documento .horario-docentes { max-width: 900px; margin: 24px auto 0; }
    .horario-documento .horario-docentes caption { color: #333; text-align: left; padding: 0 0 8px; font-size: 13px; }
    .horario-documento .horario-nota { color: #555; font-size: 12px; margin: 10px 0 0; }
</style>
<section class="horario-documento" aria-label="Horario semanal del estudiante">
    <div class="horario-encabezado">
        <img class="horario-logo" src="{{ asset('img/logos/tesvb.png') }}" alt="TESVB">
        <h2>TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO</h2>
        <p class="horario-grupo">GRUPO DEL ESTUDIANTE: {{ $alumno->grupo }}</p>
    </div>
    <p class="horario-vigencia"><strong>VIGENCIA DEL {{ \Illuminate\Support\Carbon::parse($periodo->fecha_inicio)->format('d/m/Y') }} AL {{ \Illuminate\Support\Carbon::parse($periodo->fecha_termino)->format('d/m/Y') }}</strong></p>
    <div class="horario-scroll" tabindex="0" role="region" aria-label="Cuadrícula semanal; desplázate horizontalmente para ver todos los días">
        <table class="horario-tabla">
            <thead><tr>
                <th class="horario-hora" scope="col">Hora y día</th>
                @foreach($dias as $dia)<th scope="col">{{ $dia }}</th>@endforeach
                <th class="horario-total" scope="col">Totales</th>
            </tr></thead>
            <tbody>
            @foreach($horas as $hora)
                @php($semana = $tabla[$hora] ?? [])
                <tr>
                    <th class="horario-hora" scope="row">{{ $hora }}</th>
                    @foreach($dias as $dia)
                        @php($bloque = $semana[$dia] ?? [])
                        <td @if(count($bloque) > 1) class="horario-conflicto" @endif>
                            @if(count($bloque) > 1)<strong>Clases superpuestas: solicita revisión.</strong>@endif
                            @foreach($bloque as $clase)
                                <div class="horario-clase">
                                    {{ $clase->materia }}. AULA: {{ $clase->aula ?: 'Por asignar' }}
                                    @if((string) $clase->aprobado !== '1')<span class="horario-aviso">Pendiente de aprobación</span>@endif
                                </div>
                            @endforeach
                        </td>
                    @endforeach
                    <td class="horario-total">{{ array_sum(array_map('count', $semana)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <p class="horario-nota">Totales: clases registradas en cada franja durante la semana. Los espacios vacíos no tienen clases.</p>
    <div class="horario-docentes">
        <table>
            <caption>Materias y docentes de tu horario</caption>
            <thead><tr><th scope="col">MATERIA</th><th scope="col">DOCENTE</th><th scope="col" class="horario-total">GRUPO</th></tr></thead>
            <tbody>
            @foreach($materiasDocentes as $materia)
                <tr><td>{{ $materia->materia }}</td><td>{{ $materia->docente }}</td><td class="horario-total">{{ $materia->grupo }}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
