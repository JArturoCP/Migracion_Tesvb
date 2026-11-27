@extends('ingles.inicio_ingles.layout_ingles')
@section('title', 'Revisión de Carga academica ingles')
@section('content')
    <main class="tw-modulo tw:mx-auto tw:max-w-5xl tw:min-w-0 tw:space-y-4 tw:rounded-2xl tw:bg-gray-50 tw:p-4 tw:sm:p-6 tw:dark:bg-gray-900">
        <header>
            <h1 class="tw:m-0 tw:text-xl tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Carga académica de inglés</h1>
            <p class="tw:mt-1 tw:text-gray-600 tw:dark:text-gray-400">Estudiante: {{ $datosalumno[0]->nombre }} {{ $datosalumno[0]->apaterno }} {{ $datosalumno[0]->amaterno }}</p>
        </header>

        <x-panel.tarjeta>
            <p class="tw:m-0">Facilitador: {{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</p>
        </x-panel.tarjeta>

        <div id="consultar" class="tesvb-tabla-scroll">
                <x-panel.tabla id="table_enviado" class="table text-center tw:mb-0" style="min-width: 720px !important" desplazable="Horario semanal de la carga" aria-label="Horario semanal de la carga">
                    <thead>
                    <tr>
                        <th scope="col">Hora/Día</th>
                        <th scope="col">Lunes </th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miercoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                        <th scope="col">Sabado</th>
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

                                                <div class="bg-success">{{$horario_ingles['nivel']}} <br><b>GRUPO:</b>{{$horario_ingles['grupo']}}<br>

                                                </div>
                                            @elseif($horario_ingles['disponibilidad'] == 3 )
                                                <div class="">
                                                </div>

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

    <style>
        #table_enviado .horario .bg-success {
            border-radius: 8px;
            padding: 8px;
        }

        .dark #table_enviado .horario .bg-success {
            background: #12392c;
            color: #a6f4c5;
        }
    </style>
@endsection
