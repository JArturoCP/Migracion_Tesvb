<x-panel.encabezado titulo="Encuestas contestadas" :migas="$migas" />

<x-panel.tarjeta :titulo="$carrera ? $carrera->nombre : $titulo" :subtitulo="$subtitulo ?? ($periodo_nom ? $titulo.' · Periodo '.$periodo_nom->periodo : null)">
    @if (count($estudiantes))
        <x-panel.tabla id="tabla_alumnos" compacta>
            <thead>
                <tr>
                    <th scope="col">No. de cuenta</th>
                    <th scope="col">Nombre del estudiante</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $alumno)
                    @php($nombre = trim($alumno->nombre.' '.$alumno->apaterno.' '.$alumno->amaterno))
                    <tr>
                        <td>{{ $alumno->cuenta }}</td>
                        <td>{{ $nombre }}</td>
                        <td>
                            <x-panel.boton :href="$urlEncuesta.'/'.$alumno->{$columnaEncuesta}" tamano="sm" variante="contorno-primario"
                                :aria-label="'Ver encuesta de '.$nombre">Ver encuesta</x-panel.boton>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    @else
        <x-panel.vacio titulo="Sin encuestas contestadas" mensaje="No hay respuestas para esta carrera en el periodo seleccionado." />
    @endif
</x-panel.tarjeta>

@if (count($estudiantes))
    @push('scripts')
        <script>
            $(function () {
                $('#tabla_alumnos').DataTable({ columnDefs: [{ targets: -1, orderable: false, searchable: false }] });
            });
        </script>
    @endpush
@endif
