@php
    $estados = [
        'revision' => ['etiqueta' => 'Por autorizar', 'ruta' => 'autorizar_alumnos_doc_requisitos', 'vacio' => 'Sin expedientes por autorizar'],
        'correccion' => ['etiqueta' => 'En proceso de modificación', 'ruta' => 'proceso_modificacion_doc_requisitos', 'vacio' => 'Sin expedientes en corrección'],
        'autorizado' => ['etiqueta' => 'Autorizados', 'ruta' => 'autorizados_doc_requisitos', 'vacio' => 'Sin expedientes autorizados'],
    ];
    $pestanas = [];
    foreach ($estados as $clave => $estado) {
        $pestanas[] = [
            'etiqueta' => $estado['etiqueta'],
            'url' => url('/titulacion/'.$estado['ruta'].'/'.$id_carrera),
            'activa' => $clave === $seccion,
        ];
    }
@endphp

<x-panel.encabezado titulo="Documentación de requisitos de titulación"
    :migas="['Programas de estudio' => url('/titulacion/autorizar_doc_requisitos')]" />

<x-panel.tarjeta :titulo="$carrera->nombre">
    <x-panel.pestanas :items="$pestanas" />

    @if (count($array_alumnos))
        <x-panel.tabla id="tabla_revicion" compacta desplazable="Expedientes de titulación">
            <thead>
                <tr>
                    <th scope="col">No. de cuenta</th>
                    <th scope="col">Nombre del estudiante</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Correo electrónico</th>
                    @if ($seccion !== 'correccion')
                        <th scope="col">Acción</th>
                    @endif
                    @if ($seccion === 'autorizado')
                        <th scope="col">PDF</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($array_alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno['cuenta'] }}</td>
                        <td>{{ $alumno['nombre'] }}</td>
                        <td>{{ $alumno['carrera'] }}</td>
                        <td>{{ $alumno['correo_electronico'] }}</td>
                        @if ($seccion === 'revision')
                            <td>
                                <x-panel.boton :href="url('/titulacion/revisar_doc_requisitos/'.$alumno['id_alumno'])"
                                    tamano="sm" variante="contorno-primario">
                                    {{ $alumno['id_estado_enviado'] == 3 ? 'Autorizar modificación' : 'Autorizar' }}
                                </x-panel.boton>
                            </td>
                        @elseif ($seccion === 'autorizado')
                            <td>
                                <x-panel.boton :href="url('/titulacion/ver_documentacion_autorizada/'.$alumno['id_alumno'])"
                                    tamano="sm" variante="contorno-primario">Ver documentación</x-panel.boton>
                            </td>
                            <td>
                                <x-panel.boton :href="url('/titulacion/pdf_requisitos_tramite_titulacion/'.$alumno['id_alumno'])"
                                    tamano="sm" variante="secundario" target="_blank" rel="noopener">Imprimir</x-panel.boton>
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

@if (count($array_alumnos))
    @push('scripts')
        <script>
            $(function () {
                const tabla = document.getElementById('tabla_revicion');
                const acciones = tabla.querySelectorAll('thead th').length - 4;
                const opciones = acciones ? {
                    columnDefs: [{targets: acciones === 2 ? [-1, -2] : -1, orderable: false, searchable: false}],
                } : {};
                $(tabla).DataTable(opciones);
            });
        </script>
    @endpush
@endif
