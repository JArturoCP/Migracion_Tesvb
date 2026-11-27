@use('App\View\EncuestaEscolar')

<div class="tw:mx-auto tw:max-w-4xl">
    <x-panel.encabezado titulo="Encuesta contestada" :migas="$migas" />

    @if ($estudiante)
        @php
            $nombre = trim($estudiante->nombre.' '.$estudiante->apaterno.' '.$estudiante->amaterno);
        @endphp
        <x-panel.tarjeta :titulo="$nombre" :subtitulo="$titulo.' · No. de cuenta '.$estudiante->cuenta">
            <dl class="tw:divide-y tw:divide-gray-100 tw:dark:divide-gray-800">
                @foreach (EncuestaEscolar::PREGUNTAS as $numero => $pregunta)
                    @php
                        $valor = $estudiante->{'cal_preg_'.$numero};
                        $opciones = $numero === 10 ? EncuestaEscolar::RECHAZADO : EncuestaEscolar::ESCALA;
                        $respuesta = $opciones[$valor] ?? null;
                    @endphp
                    <div class="tw:grid tw:gap-2 tw:py-4 tw:first:pt-0 tw:sm:grid-cols-[minmax(0,1fr)_auto] tw:sm:gap-x-4">
                        <dt class="tw:text-sm tw:leading-relaxed tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">
                            {{ $numero }}. {{ $pregunta }}
                        </dt>
                        <dd class="tw:sm:text-right">
                            <x-panel.badge :tono="$respuesta !== null ? 'marca' : 'gris'">{{ $respuesta ?? 'Sin respuesta' }}</x-panel.badge>
                        </dd>

                        @if ($numero === 10 && (string) $valor === '1')
                            <dd class="tw:mt-2 tw:space-y-1 tw:text-sm tw:sm:col-span-2">
                                <p class="tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Motivo o requisito faltante</p>
                                <p class="tw:whitespace-pre-wrap tw:break-words tw:text-gray-600 tw:dark:text-gray-300">{{ filled($estudiante->comentario_res_preg_10) ? $estudiante->comentario_res_preg_10 : 'Sin motivo registrado' }}</p>
                            </dd>
                        @endif
                    </div>
                @endforeach
                <div class="tw:space-y-2 tw:pt-4">
                    <dt class="tw:text-sm tw:font-medium tw:text-gray-800 tw:dark:text-gray-200">Comentarios</dt>
                    <dd class="tw:whitespace-pre-wrap tw:break-words tw:text-sm tw:text-gray-600 tw:dark:text-gray-300">{{ filled($estudiante->comentario) ? $estudiante->comentario : 'Sin comentarios' }}</dd>
                </div>
            </dl>
        </x-panel.tarjeta>
    @else
        <x-panel.vacio titulo="Encuesta no disponible" mensaje="Vuelve a Programas de estudio para consultar las encuestas de una carrera." />
    @endif
</div>
