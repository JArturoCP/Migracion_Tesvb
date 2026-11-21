@extends('layouts.panel')
@section('title', 'Prof-Materia')
@include('partials.panel.recursos_app', ['datatables' => true])
@section('content')

<main class="tw-pantalla tw:space-y-6">
    <x-panel.encabezado titulo="RELACIÓN PROFESORES-MATERIAS" />

    <x-panel.tarjeta sin-relleno>
        <x-slot:acciones>
            <x-panel.boton tamano="sm" href="/excel/prof-mat" target="_blank">
                <span class="fa fa-external-link" aria-hidden="true"></span> Exportar Excel
            </x-panel.boton>
        </x-slot:acciones>

        <x-panel.tabla id="paginar_table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Grado</th>  
                    <th>Nombre Completo</th> 
                    <th>Cédula</th>
                    <th>Materias</th>
                    <th>Unidades</th>
                    <th>Grupo</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador=1; ?>
                @foreach($relacion as $rel)
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $rel->descripcion }}</td>
                    <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{ $rel->nombre }}</td>
                    <td>{{ $rel->cedula }}</td>
                    <td>{{ $rel->materia }}</td>
                    <td>{{ $rel->unidades }}</td>
                    <td>{{ $rel->grupo }}</td>
                    <?php $contador++; ?>
                </tr>
                @endforeach
            </tbody>
        </x-panel.tabla>
    </x-panel.tarjeta>
</main>

<script>
$(document).ready(function() {
    $('#paginar_table').DataTable();
});
</script>
@endsection
