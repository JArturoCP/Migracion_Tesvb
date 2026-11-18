
@extends('layouts.panel')
@section('title', 'Concentrado Estruct. Académica')
@include('partials.panel.recursos_app')
@section('content')
<main class="tw-pantalla">
    <x-panel.encabezado titulo="Concentrado Estructura Educativa">
        <x-slot:extra>
            <x-panel.badge>PERIODO ESCOlAR: {{ $periodo }}</x-panel.badge>
        </x-slot:extra>
    </x-panel.encabezado>

    <x-panel.tarjeta sin-relleno class="tabla-grande">
        <x-slot:acciones>
            <x-panel.boton tamano="sm" href="/excel_concentrado" target="_blank"><span class="fa fa-external-link"  aria-hidden="true"></span>Exportar Excel</x-panel.boton>
        </x-slot:acciones>
        <div class="tw:max-w-full tw:overflow-x-auto">
                    <table class="tw-tabla tw-tabla-bordes tw-tabla-compacta tabla-grande3">
  <tr>
    <th rowspan="2">NUMERO</th>
    <th>PERIODO ESCOlAR: {{ $periodo }}</th>
    <th rowspan="2">HORAS SEMANALES POR CARRERA</th>
    <th rowspan="2">NO DE GRUPOS POR CARRERA</th>
    <th rowspan="2">CANTIDAD TOTAL DE ALUMNOS POR CARRERA</th>
    <th rowspan="2">PROMEDIO DE ALUMNOS ATENDIDOS POR CARRERA</th>
    <th rowspan="2">MATRICULA SEMESTRE ANTERIOR</th>
    <th colspan="2">TOTAL DE HORAS CUBIERTAS CON CATEORIA</th>
    <th colspan="3">DISTRIBUCION CANTIDAD DE HORAS CUBIERTAS POR PERSONAL CON CATEGORIA DE:</th>
  </tr>
  <tr>
    <th>NOMBRE DE LAS CARRERAS QUE OFRECE LA INSTITUCION</th>
    <th>DOCENTE</th>
    <th>DIRECTIVA, A.T.M,HONORARIOS</th>
    <th>DIRECTIVA</th>
    <th>A.T.M.</th>
    <th>HONORARIOS</th>
  </tr>
  <?php $contador=1 ?>
@foreach($carreras as $carrera)
 @foreach($carrera["semanas"] as $semana)
  <tr>
    <td>{{ $contador }}</td>
    <td class="tw:font-medium tw:text-gray-800">{{ $carrera ["nombre_carrera"] }}</td>
    <td>{{ $semana ["hrs_semanas"] }}</td>
      <td>{{ $carrera ["g_carreras"] }}</td>
      <td>{{ $carrera["total_alumnos"] }}</td>
      <td>0</td>
      <td>0</td>
      <td>{{ $carrera["t_docente"] }}</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <?php $contador++ ?>
  </tr>
  @endforeach
@endforeach
<tr class="tw:font-semibold">
  <td colspan="2" class="tw:text-center tw:font-semibold tw:text-gray-800">TOTALES:</td>
  <td>{{ $t_sem }}</td>
  <td>{{ $total_g }}</td>
  <td></td>
  <td></td>
  <td></td>
  <td>{{ $t_td }}</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
</table>
        </div>
    </x-panel.tarjeta>

<!--<div class="col-md-2 regis">
  <a href="/pdf_estructura" class="btn btn-primary crear" target="_blank"><span class="glyphicon glyphicon-print"  aria-hidden="true"></span> Imprimir PDF</a>
                        </div>-->

</main>

@endsection
