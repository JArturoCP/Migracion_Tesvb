


<table id="tabla_empresa" class="table table-bordered table-resposive">
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
        <th width="300px">Programa de Estudios</th>
        <th width="300px">Categoría Docente</th>
        <th width="300px">Asignatura</th>
        <th width="300px">Periodo</th>
        <th width="300px">Perfil</th>
        <th width="300px">Docente</th>
        <th width="110px">Horas por grupo</th>
        <th width="100px">Número de grupos</th>
        <th width="110px">Horas por Asignatura</th>

    </tr>
    </thead>
    <tbody>
    <?php $suma=0; $i=1; ?>
    @foreach($array_materia as $materia)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{$materia['carrera'] }}</td>
            <td>{{$materia['cargo'] }}</td>
            <td>{{$materia['materia'] }}</td>
            <td>{{ $periodo->periodo }}</td>
            <td>{{ $materia['perfil'] }}</td>
            <td>{{$materia['nombre'] }}</td>
            <td>{{$materia['horas_totales']  }}</td>
            <td>{{$materia['total_grupos']  }}</td>
            <td>{{$materia['total_horas_grupos']  }}</td>
        </tr>
    @endforeach


    </tbody>
</table>