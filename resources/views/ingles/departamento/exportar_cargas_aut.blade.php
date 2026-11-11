<table  >
    <thead>
    <tr>
        <th width="100px">No. cuenta</th>
        <th width="300px">Nombre del usuario</th>
        <th width="100px">Genero</th>
        <th width="100px">Nivel</th>
        <th width="100px">Grupo</th>
        <th width="100px">Semestre</th>
        <th width="300px">Carrera</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alumnos as $alumno)
        <tr>
            <td >{{ $alumno->cuenta }}</td>
            <td >{{ $alumno->nombre }} {{ $alumno->apaterno }} {{ $alumno->amaterno }}</td>
            @if($alumno->genero == "M")
                <td>MASCULINO</td>
            @else
                <td>FEMENINO</td>
            @endif
            <td>{{ $alumno->nivel_ingles }}</td>
            <td>{{ $alumno->grupo_ingles }}</td>
            <td>{{ $alumno->semestre }}</td>
            <td>{{ $alumno->carrera }}</td>

        </tr>


    @endforeach


    </tbody>
</table>