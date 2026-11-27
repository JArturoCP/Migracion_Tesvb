<x-panel.encabezado :titulo="$titulo" />

<x-panel.tarjeta titulo="Selecciona un programa de estudio">
    @if (count($carreras))
        <ul class="tw:grid tw:gap-3 tw:sm:grid-cols-2">
            @foreach ($carreras as $carrera)
                <li>
                    <x-panel.boton :href="url($ruta.'/'.$carrera->id_carrera)" variante="secundario"
                        class="tw:h-full tw:w-full tw:justify-start tw:text-left">
                        {{ $carrera->nombre }}
                    </x-panel.boton>
                </li>
            @endforeach
        </ul>
    @else
        <x-panel.vacio titulo="Sin programas de estudio" />
    @endif
</x-panel.tarjeta>
