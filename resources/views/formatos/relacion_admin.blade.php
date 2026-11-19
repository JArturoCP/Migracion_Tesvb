@extends('layouts.panel')
@section('title', 'Relación Personal Docente')
@include('partials.panel.recursos_app')
@section('content')

    <script>
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  e.target // newly activated tab
  e.relatedTarget // previous active tab
})
    </script>
<main class="tw-pantalla tw:space-y-6">

   <?php $jefe_division=session()->has('jefe_division')?session()->has('jefe_division'):false;
 $directivo=session()->has('directivo')?session()->has('directivo'):false; ?>

    <x-panel.encabezado titulo="Relación de Personal Docente" />

        @if($directivo==1)
            <x-panel.tarjeta class="tw:max-w-xl">
                <div class="dropdown">
                   <x-panel.select etiqueta="Carrera" name="selectCarrera" id="selectCarrera">
                                  <option disabled selected>Selecciona carrera...</option>
                                @foreach($carreras as $carrera)
                                    @if($carrera->id_carrera==$id_carrera)
                                        <option value="{{$carrera->id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                    @else
                                        <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                    @endif
                                @endforeach
                                <option value="00" >Agrega Reticula</option>
                   </x-panel.select>
                </div>
            </x-panel.tarjeta>
@endif
@if(isset($ver))
<x-panel.tarjeta sin-relleno class="tabla-grande">
  <x-slot:acciones>
      <x-panel.boton tamano="sm" class="regis ml" href="/excel_relacion" target="_blank"><span class="fa fa-external-link"  aria-hidden="true"></span>Exportar Excel</x-panel.boton>
  </x-slot:acciones>
  <div class="tw:max-w-full tw:overflow-x-auto">
<table class="tw-tabla tw-tabla-bordes tw-tabla-compacta tw-tabla-encabezado tabla-grande3">
<tr>
        <td rowspan="2">NO CONTROL</td>
        <td>PERIODO ESCOlAR: {{ $periodo }}</td>
        <td rowspan="2">NOMBRAMIENTO</td>
        <td rowspan="2">FECHA DE INGRESO AL I.T.S</td>
        <td rowspan="2">TOTAL DE HORAS POR NOMBRAMINTO</td>
        <td colspan="2">NUMERO DE HORAS FRENTE A GRUPO</td>
        <td colspan="2">FACTIBILIDAD DE INCREMENTAR HORAS FRENTE A GRUPO CONFORME A SU CATEGORIA</td>
        <td rowspan="2">MATERIAS QUE IMPARTE</td>
        <td rowspan="2">DIVISION O DPTO</td>
        <td colspan="2">HORAS SEMESTRES POR MATERIA</td>
        <td rowspan="2">CANTIDAD DE GRUPOS</td>
        <td rowspan="2">CARRERA</td>
        <td rowspan="2"> ESCOLARIDAD DEL PROFESOR</td>
    </tr>  
    <tr>
        <td>NOMBRE DEL PROFESOR</td>
        <td>LIC.</td>
        <td>POSG.</td>
        <td>SI/NO</td>
        <td>CAUSA</td>
        <td>T</td>
        <td>P</td>
    </tr>
  

    @foreach($docentes as $docente)
      @foreach($docente["materias"] as $mates)
   
  <tr>
    <td>{{ $docente["clave"] }}</td>
    <td>{{ $docente["nombre"] }}</td>
    <td class="tw:text-center">{{ $docente["nombramiento"] }}</td>
    <td>{{ $docente["fecha_ingreso"] }}</td>
    <td>{{ $docente["hrs_max"] }}</td>
    <td>{{ $mates["t_lic"] }}</td>
    <td>0</td>
    <td>{{ $docente["caso"] }}</td>
    <td>{{ $docente["causa"] }}</td>
    <td>{{ $mates["nombre_materia"] }}</td>
    <td>{{ $ncarrera }}</td>
    <td>{{ $mates["hrs_teoria"] }}</td>
    <td>{{ $mates["hrs_practica"] }}</td>
    <td>{{ $mates["no_grupos"] }}</td>
    <td>{{ $ncarrera }}</td>
    <td>{{ $docente["escolaridad"] }}</td>
  </tr>
    @endforeach
  @endforeach
<tr>
  <td colspan="2" class="tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">TOTALES</td>
  <td></td>
  <td></td>
  <td></td>
  <td>{{ $t_nombra }}</td>
  <td>{{ $total_lic }}</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan="2">{{ $t_hrs }}</td>
  <td></td>
  <td></td>

</tr>

</table>
  </div>
</x-panel.tarjeta>
@endif

  <!--<div class="col-md-3 col-md-offset-5 ml">
         <button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
  </div>-->

</main>

<script>

  $(document).ready(function() {

    $("#selectCarrera").on('change',function(e){
      var id_carrera= $("#selectCarrera").val();
      window.location.href='/relacion/ver/'+id_carrera ;

    });
});

</script>
@endsection
