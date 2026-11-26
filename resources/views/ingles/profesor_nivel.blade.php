@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Horario del facilitador')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3">
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">
                Horario de {{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}
            </h1>
            <div class="tw:flex tw:flex-wrap tw:gap-2">
                <x-panel.boton variante="secundario" href="{{ url('/ingles/mostrar_horarios_profesores') }}">
                    <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Regresar
                </x-panel.boton>
                <div id="imprimir">
                    <x-panel.boton href="/ingles_horarios/pdf_profesor_horarios/{{ $profesor->id_profesores }}"
                        class="btn btn-primary crear" target="_blank" rel="noopener" aria-label="Imprimir horario (abre en otra pestaña)">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir
                    </x-panel.boton>
                </div>
            </div>
        </header>

        <div id="consultar" class="tesvb-tabla-scroll">
            <x-panel.tabla id="table_enviado" class="table tw:mb-0" style="min-width: 720px !important"
                desplazable="Horario semanal del facilitador" aria-label="Horario semanal del facilitador">
                <thead>
                    <tr>
                        <th scope="col">Hora/Día</th>
                        <th scope="col">Lunes</th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miércoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                        <th scope="col">Sábado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador=1 ?>
                    @forelse($semanas as $semana)
                        @if($contador==1)
                            <tr>
                                <td class="horario">{{ $semana->hora }}</td>
                        @endif
                                <td id="{{ $semana->id_semana }}" class="horario">
                                    @foreach($array_ingles as $horario_ingles)
                                        @if($horario_ingles['id_semana']==$semana->id_semana)
                                            @if($horario_ingles['disponibilidad'] ==2)
                                                <div class="bg-success tw:rounded-lg tw:bg-green-50 tw:p-2 tw:dark:bg-gray-800 tw:dark:text-green-300">
                                                    {{ $horario_ingles['nivel'] }} <br><b>GRUPO:</b>{{ $horario_ingles['grupo'] }}<br>
                                                </div>
                                            @elseif($horario_ingles['disponibilidad'] == 3 )
                                                <div class=""></div>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                        <?php $contador++?>
                        @if($contador==7)
                            <?php $contador=1 ?>
                            </tr>
                        @endif
                    @empty
                        <tr><td colspan="7">No hay bloques de horario para mostrar.</td></tr>
                    @endforelse
                </tbody>
            </x-panel.tabla>
        </div>
    </main>
@endsection
