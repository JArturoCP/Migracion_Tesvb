<table  class="table table-bordered tabla-grande3">
    <thead>
    <tr>
        <th width="10" style="background: #b8daff;">No.cuenta</th>
        <th width="20" style="background: #b8daff;">Nombre</th>
        <th width="50" style="background: #b8daff;">Carrera</th>
    </thead>
    <tr>
        <th width="10">{{ $no_cuenta }}</th>
        <th width="20">{{ $nombre }}</th>
        <th width="50">{{ $carrera }}</th>
    </tr>
    <tr>
        <th width="10"></th>
        <th width="20"></th>
        <th width="50"></th>
    </tr>
    <tbody>
    <tr>
        <th width="10" style="background: #b8daff;">Sem.</th>
        <th width="20" style="background: #b8daff;">Clave</th>
        <th width="50" style="background: #b8daff;">Nombre de la materia</th>
        <th width="10" style="background: #b8daff;">Cr.</th>
        <th width="10" style="background: #b8daff;">Cal.</th>
        <th width="10" style="background: #b8daff;">Acr.</th>
        <th width="10" style="background: #b8daff;">Periodo</th>
        <th width="10" style="background: #b8daff;">Año</th>
        <th width="10" style="background: #b8daff;">Fech. Esp.</th>
    </tr>
    @foreach($materias_actualizadas as $alumno)
        <tr>
        <td width="10">{{ $alumno['id_semestre'] }}</td>
        <td width="20">{{ $alumno['clave'] }}</td>
        <td width="50">{{ $alumno['nombre_materia']  }}</td>
        <td width="10">{{ $alumno['creditos'] }}</td>
        @if($alumno['promedio']  <70 )
        <td width="10">N.A.</td>
        @else
            <td width="10">{{ $alumno['promedio'] }}</td>
        @endif
        <td width="10">{{ $alumno['esc'] }}</td>
        <td width="10">{{ $alumno['periodo'] }}</td>
        <td width="10">{{ $alumno['year'] }}</td>
        <td width="10"></td>
        </tr>
    @endforeach

    @if($residencia > 0)

     <?php
    $num=$datos_residencia->fecha_termino;
    $year =substr($num, 0,4);
    $mes =substr($num, 5,2);
    $dia =substr($num, 8,2);
    $fecha_re= $dia.'/'.$mes.'/'.$year;
    ?>
     <tr>
         <td>9</td>
         <td>RES-0001</td>
         <td>RESIDENCIA PROFESIONAL</td>
         @if($datos_residencia->calificacion < 70)
             <td>0</td>
             <td>N.A.</td>
         @else
             <td>10</td>
             <td>{{$datos_residencia->calificacion}}</td>
         @endif
         <td></td>
         <td></td>
         <td></td>
         <td>{{ $fecha_re}}</td>

     </tr>
    @endif
    @if($servicio > 0)
    <?php
    $num=$datos_servicio->fecha_termino;
    $year =substr($num, 0,4);
    $mes =substr($num, 5,2);
    $dia =substr($num, 8,2);

    $fecha_s= $dia.'/'.$mes.'/'.$year;
    ?>
    <tr>
        <td>9</td>
        <td>SSC-0001</td>
        <td>SERVICIO SOCIAL</td>
        @if($datos_servicio->calificacion < 70)
            <td>0</td>
            <td>N.A.</td>
        @else
            <td>10</td>
            <td>{{$datos_servicio->calificacion}}</td>
        @endif
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $fecha_s }}</td>

    </tr>
    @endif
    @if($actividades > 0)
        <tr>
            <td>9</td>
            <td>ACC-0001</td>
            <td>ACTIVIDADES COMPLEMENTARIAS</td>
            <td>5</td>
            <td>ACA</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    @endif
    <tr>
    <td></td>
    <td></td>
    <td>Totales:</td>
    <td>{{$contar_creditos}}</td>
    <td>{{ $promedio_f }}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>

    </tbody>
</table>