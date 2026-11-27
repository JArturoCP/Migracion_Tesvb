@php
    $estados = [
        'revision' => ['etiqueta' => 'Por autorizar', 'ruta' => 'carrera_alum_reg_datos', 'vacio' => 'Sin datos por autorizar'],
        'modificacion' => ['etiqueta' => 'En proceso de modificación', 'ruta' => 'proceso_modificacion_datos_alumno', 'vacio' => 'Sin expedientes en modificación'],
        'entrega' => ['etiqueta' => 'Entrega pendiente', 'ruta' => 'faltante_datos_alumno', 'vacio' => 'Sin entregas pendientes en el Centro de Información'],
        'autorizados' => ['etiqueta' => 'Autorizados', 'ruta' => 'autorizados_datos_alumno', 'vacio' => 'Sin expedientes autorizados'],
    ];

    $pestanas = [];
    foreach ($estados as $clave => $estado) {
        $pestanas[] = [
            'etiqueta' => $estado['etiqueta'],
            'url' => url('/titulacion/'.$estado['ruta'].'/'.$id_carrera),
            'activa' => $clave === $seccion,
        ];
    }

    $mostrarAccion = $seccion !== 'modificacion';
@endphp

<x-panel.encabezado titulo="Datos personales de Titulación"
    :migas="['Programas de estudio' => url('/titulacion/autorizar_datos_personales')]" />

<x-panel.tarjeta :titulo="$carrera->nombre">
    <x-panel.pestanas :items="$pestanas" />

    @if (count($registro_alumnos))
        <x-panel.tabla id="tabla_revicion" compacta desplazable="Datos personales de Titulación">
            <thead>
                <tr>
                    <th scope="col">No. de cuenta</th>
                    <th scope="col">Nombre del estudiante</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Teléfono</th>
                    @if ($mostrarAccion)
                        <th scope="col">Acción</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($registro_alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->no_cuenta }}</td>
                        <td>{{ $alumno->apaterno }} {{ $alumno->amaterno }} {{ $alumno->nombre_al }}</td>
                        <td>{{ $alumno->carrera }}</td>
                        <td>{{ $alumno->correo_electronico }}</td>
                        <td>{{ $alumno->telefono }}</td>
                        @if ($mostrarAccion)
                            <td>
                                @if ($seccion === 'revision')
                                    <x-panel.boton :href="url('/titulacion/revisar_datos_generales/'.$alumno->id_alumno)"
                                        variante="contorno-primario" tamano="sm">
                                        {{ $alumno->id_estado_enviado == 3 ? 'Autorizar correcciones' : 'Autorizar' }}
                                    </x-panel.boton>
                                @else
                                    @php($rutaDetalle = $seccion === 'entrega' ? 'ver_datos_personales_alumno_ti' : 'ver_datos_per_ti_aut')
                                    <x-panel.boton :href="url('/titulacion/'.$rutaDetalle.'/'.$alumno->id_alumno.'/'.$id_carrera)"
                                        variante="contorno-primario" tamano="sm">Ver información</x-panel.boton>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    @else
        <x-panel.vacio :titulo="$estados[$seccion]['vacio']" />
    @endif
</x-panel.tarjeta>

@if (count($registro_alumnos))
    @push('scripts')
        <script>
            $(function () {
                const opciones = @json($mostrarAccion) ? {
                    columnDefs: [{targets: -1, orderable: false, searchable: false}],
                } : {};
                $('#tabla_revicion').DataTable(opciones);
            });
        </script>
    @endpush
@endif
