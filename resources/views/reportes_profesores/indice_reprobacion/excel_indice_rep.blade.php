<?php $i=1; ?>
<table class="table table-bordered table-resposive">
    <thead>
    <tr>
        <th></th>
        <th width="300px">Planes de estudios:</th>
        <th width="300px">{{ $carrera->nombre }}</th>
        <th></th>
        <th></th>
        <th width="300px"></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th>Categoria:</th>
        <th>{{ $categoria->cargo }}</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th>No.</th>
        <th>Docente</th>
        <th>Asignatura</th>
        <th>Grupo</th>
        <th>Unidades</th>
        <th>No. de estudiantes inscritos</th>
        <th>Unidad 1</th>
        <th>Unidad 2</th>
        <th>Unidad 3</th>
        <th>Unidad 4</th>
        <th>Unidad 5</th>
        <th>Unidad 6</th>
        <th>Unidad 7</th>
        <th>Unidad 8</th>
        <th>Unidad 9</th>
        <th>Unidad 10</th>
    </tr>
    </thead>
    <tbody>

    @foreach($array_materias as $materia)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{$materia['profesor'] }}</td>
            <td>{{$materia['materia'] }}</td>
            <td>{{$materia['id_semestre'].'0'.$materia['grupo'] }}</td>
            <td>{{$materia['unidades_mat'] }}</td>
            <td>{{$materia['total_estudiantes'] }}</td>
            @if($materia['max_unidad'] == 1)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'] }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 2)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 3)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 4)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 5)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 6)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 7)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 8)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
                <td></td>
            @elseif($materia['max_unidad'] == 9)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach
                <td></td>
            @elseif($materia['max_unidad'] == 10)
                @foreach($materia['unidades'] as $unidades)
                    <td style="background: lightblue">{{ $unidades['porcentaje_reprobacion'].'%' }}</td>
                @endforeach

            @else
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            @endif

        </tr>
    @endforeach


    </tbody>
</table>