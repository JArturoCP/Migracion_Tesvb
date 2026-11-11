<table >
    <tr>
        <th></th>
        <th width="300px"></th>
        <th width="150px"></th>
        <th width="400px"></th>
        <th></th>

    </tr>
    <tr>
        <th></th>
        <th width="300px"></th>
        <th width="150px">Categoria:</th>
        <th width="400px">{{ $categoria->cargo }}</th>
        <th></th>

    </tr>
    <tr>
        <th></th>
        <th width="300px"></th>
        <th width="150px"></th>
        <th width="400px"></th>
        <th></th>

    </tr>
    <thead>
    <tr>
        <th>No.</th>
        <th width="300px">Docente</th>
        <th width="150px">Horas Asignatura</th>
        <th width="400px">Horas de Actividades de apoyo a la docencia</th>
        <th>Total de horas</th>

    </tr>
    </thead>
    <tbody>
    <?php $suma=0; $i=1; ?>
    @foreach($array_materia as $materia)
        <tr>
            <td>{{ $i++ }}</td>
            <td  width="300px">{{$materia['nombre'] }}</td>
            @if($materia['horas_asignatura'] <= 19 )
                <td width="150px">{{$materia['horas_asignatura']  }}</td>
            @else
                <td style="background: #942a25; width:150px;">{{$materia['horas_asignatura']  }}</td>
            @endif
            <td width="400px">{{$materia['horas_apoyo'] }}</td>
            <td width="100px">{{$materia['totales_horas'] }}</td>
            {{--    <td style="background: #b8daff">{{ $materia['horas_profesor'] }}</td> --}}
        </tr>
    @endforeach


    </tbody>
</table>