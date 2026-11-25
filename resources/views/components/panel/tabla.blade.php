{{--
    Tabla con el estilo de la plantilla (TailAdmin "BasicTable"). Las filas van en el slot sin cambios
    (mismos id, clases, @foreach y celdas) y los atributos (id, class, data-*) pasan al <table>,
    así DataTables y los scripts siguen encontrando la misma tabla.
    <x-panel.tabla id="tabla_profesores">
        <thead><tr><th>Nombre</th></tr></thead>
        <tbody>@foreach ($filas as $f)<tr><td>{{ $f->nombre }}</td></tr>@endforeach</tbody>
    </x-panel.tabla>
    compacta: celdas más bajas.
--}}
@props(['compacta' => false, 'desplazable' => null])
<div class="tw-tabla-contenedor tw:overflow-hidden tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white tw:dark:border-gray-800 tw:dark:bg-white/[0.03]">
    <div class="tw:max-w-full tw:overflow-x-auto{{ $desplazable ? ' tw-tabla-desplazable' : '' }}"
        @if ($desplazable) tabindex="0" role="region" aria-label="{{ $desplazable }}" @endif>
        <table {{ $attributes->class(['tw-tabla tw:min-w-full', 'tw-tabla-compacta' => $compacta]) }}>
            {{ $slot }}
        </table>
    </div>
</div>
