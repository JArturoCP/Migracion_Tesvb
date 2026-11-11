<table>
  <tr ></tr>
  <tr>

    <th style="width: 200px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 150px;"></th>
    <th style="width: 200px; text-align: center"><img src="img/tes.png"  width="50" height="50"></th>
  </tr>
  <tr >
    <th style="width: 200px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 150px;"></th>
    <th style="width: 200px; text-align: center"><b>TECNOLÓGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO</b></th>
  </tr>
  <tr ></tr>
  <tr ></tr>
</table>
<table>
  <tr>
    <th style="width: 200px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 150px;"></th>
  </tr>
  <tr>
    <th style="width: 200px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 300px;"></th>
    <th style="width: 150px;"></th>
    <th style="width: 200px;"><b>PLANTILLA DOCENTE</b></th>
    </tr>
    <tr></tr>
    <tr>
    <th></th>
    <th style="width: 70px;" ><b>CARGO:  {{$impr_cargo}}</b></th>
    <th></th><th></th><th></th><th></th>
    <th></th><th></th><th></th><th></th>
    <th><b>PERIODO:  {{$periodo}}</b></th>
  </tr>
</table>
    <table >
  <tr>
    <th  style="width: 200px;"></th>
    <th  style="width: 300px;"><b>Nombre</b></th>
    <th  style="width: 300px;"><b>Asignatura</b></th>
    <th  style="width: 150px;"><b>No. Grupos</b></th>
    <th  style="width: 200px;"><b>NO. HORAS X ASIGNATURA</b></th>
    <th  style="width: 100px;"><b>TOTAL HORAS X ASIGNATURA</b></th>
    <th  style="width: 200px;"><b>TOTAL HORAS DOCENTE</b></th>
    <th   style="width: 200px;"><b>RFC</b></th>
    <th   style="width: 150px;"><b>CLAVE ISSEMYM</b></th>
    <th  style="width: 150px;"><b>FECHA INGRESO TESVB</b></th>
    <th  style="width: 150px;"><b>FECHA NUEVO C.</b></th>
    <th  style="width: 350px;"><b>PERFIL</b></th>
    <th  style="width: 350px;"><b>OBSERVACIONES</b></th>
  </tr>

@foreach($docentes as $docente)
    <?php
    $num_col=count($docente["materias"]);
    $first=true;
    ?>
  @foreach($docente["materias"] as $dat_materia)

    @if($first)
    <?php $first=false;?>
    <tr>
      <td></td>

      <td rowspan="{{ $num_col }}" style="width: 300px;" valign="middle" >{{ $docente["nombre"]}}</td>
      <td style="width: 300px;">{{ $dat_materia['nombre_materia'] }}</td>
      <td>{{ $dat_materia['no_grupos'] }}</td>
      <td>{{ $dat_materia['horas_totales'] }}</td>
      <td>{{ $dat_materia['total'] }}</td>
      <td valign="middle" rowspan="{{ $num_col }}">{{ $docente["f_total"]}}</td>
      <td valign="middle" rowspan="{{ $num_col }}"  style="width: 200px;">{{ $docente["rfc"]}}</td>
      <td valign="middle" rowspan="{{ $num_col }}"   style="width: 150px;">{{ $docente["clave"]}}</td>
      <td valign="middle" rowspan="{{ $num_col }}" style="width: 150px;">{{ $docente["fch_ingreso_tesvb"]}}</td>
      <td rowspan="{{ $num_col }}">
        @if($fecha_nuevo > $docente['fch_ingreso_tesvb'])
          {{ $fecha_nuevo }}
        @else
          {{ $docente['fch_ingreso_tesvb'] }}
        @endif
      </td>
      <td valign="middle" rowspan="{{ $num_col }}" style="width: 350px;">{{ $docente["descripcion"]}}</td>
      <td valign="middle" rowspan="{{ $num_col }}" style="width: 350px;">{{ $docente["observaciones"] }}</td>
    </tr>
    @else
    <tr>
      <td></td>
      <td>{{ $dat_materia['nombre_materia'] }}</td>
      <td>{{ $dat_materia['no_grupos'] }}</td>
      <td>{{ $dat_materia['horas_totales'] }}</td>
      <td>{{ $dat_materia['total'] }}</td>
      <td></td>
      <td  style="width: 200px;"></td>
      <td  style="width: 150px;"></td>
      <td style="width: 150px;"></td>
      <td style="width: 150px;"></td>
      <td></td>
      <td></td>
    </tr>
    @endif
  @endforeach
@endforeach
</table>

<table>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <th align="right"><b>Totales:</b></th>
    <th align="left"><b>{{$total_plantilla}}</b></th>
  </tr>
</table>

<table>
  <tr>
    <th></th>
    <th></th>
    <th align="center"><b>ELABORÓ</b></th>
    <th></th>
    <th></th>
    <th align="center"><b>REVISÓ</b></th>
    <th></th>
    <th  style="width: 200px;"></th>
    <th  style="width: 150px;"></th>
    <th align="center"><b>AUTORIZÓ</b></th>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <th></th>
    <th></th>
    <th align="center"><b>{{$jefe}}</b></th>
    <th></th>
    <th></th>
    <th align="center"><b>I.Q. LORENA GUADARRAMA SALAZAR</b></th>
    <th></th>
    <th></th>
    <th></th>
    <th align="center"><b>DR. LÁZARO ABNER HERNÁNDEZ REYES</b></th>
  </tr>
  <tr>
    <th></th>
    <th></th>
    <th align="center"><b>{{$jefatura}}</b></th>
    <th></th>
    <th></th>
    <th align="center"><b>SUBDIRECCIÓN DE ESTUDIOS PROFESIONALES</b></th>
    <th></th>
    <th></th>
    <th></th>
    <th align="center"><b>DIRECCIÓN ACADÉMICA</b></th>
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
    <th><b>F147-PSGOE-40 V. 1- 28/06/2024</b></th>
    <th></th>
  </tr>
</table>
  