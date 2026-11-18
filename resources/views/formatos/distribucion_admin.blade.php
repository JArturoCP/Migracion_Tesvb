@extends('layouts.panel')
@section('title', 'Distribucion de Hrs.')
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

    <x-panel.encabezado titulo="Distribución de Horas frente a Grupo" />

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
      <x-panel.badge tono="gris">Cantidad Total de Alumnos: {{ $t_alum }}</x-panel.badge>
      <x-panel.boton tamano="sm" class="regis" href="/excel_distribucion" target="_blank"><span class="fa fa-external-link"  aria-hidden="true"></span>Exportar Excel</x-panel.boton>
  </x-slot:acciones>
  <div class="tw:max-w-full tw:overflow-x-auto">
  <table class="tw-tabla tw-tabla-bordes tw-tabla-compacta tabla-grande3 ">
  <tr>
    <th rowspan="2">SEMESTRE</th>
    <th>PERIODO ESCOlAR: {{ $periodo }}</th>
    <th rowspan="2">HRS SEMESTRALES POR MATERIA</th>
    <th rowspan="2">NO. GRUPOS POR MATERIAS</th>
    <th rowspan="2">CANTIDAD TOTAL DE ALUMNOS POR MATERIA</th>
    <th rowspan="2" class="tw:min-w-56 tw:whitespace-normal">CUANDO EN LOS GUPOS EXISTAN ALUMNOS DE OTRAS CARRERAS INDICAR EL NOMBRE DE ESTAS PARA EVITAR QUE LOS GRUPOS SE DUPLIQUEN</th>
    <th rowspan="2" class="tw:min-w-56 tw:whitespace-normal">INDICAR EL NUMERO DEL PROFESOR QUE IMPARTE LA MATERIA SEGUN GRUPOS QUE ATIENDA. EL NUMERO DE PROFESOR DEBERA CONICIDIR CON EL ASIGNADO EN LA RELACION DE PERSONAL DOCENTE (FORMATO 03,04,05 ó 06)</th>
    <th colspan="4">TOTAL DE HORAS FRENTE A GRUPO CUBIERTAS POR PERSONAL CON CATEGORIA:</th>
  </tr>
  <tr>
    <th>NOMBRE DE LAS MATERIAS QUE SE OFRECEN POR SEMESTRE</th>
    <th>DOCENTE</th>
    <th>DIRECTIVO</th>
    <th>ATM</th>
    <th>HONORARIOS</th>
  </tr>
  @foreach($materiass as $materia)

  <tr>
    <td>{{ $materia ["id_semestre"] }}</td>
    <td class="tw:font-medium tw:text-gray-800">{{ $materia ["nombre_materia"] }}</td>
    <td>{{ $materia ["horas_totales"] }}</td>
    <td>{{ $materia ["no_grupos"] }}</td>
    <td>{{ $materia ["cantidad"] }}</td>
    <td>0</td>
    <td>{{ $materia["clave"] }} <br></td>
    <td>{{ $materia ["total"] }}<br></br> </td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr>
@endforeach
  <tr>
    <td>9</td>
    <td class="tw:font-medium tw:text-gray-800">RESIDENCIA PROFESIONAL</td>
    <td>{{ $resi_hrs }}</td>
    <td>{{ "N.A" }}</td>
    <td>0</td>
    <td>0</td>
    <td>
      @foreach($residencia as $resi)
        {{ $resi["claver"] }} <br></br>
      @endforeach
      </td>
    <td>{{ $resi_hrs }}</td>
    <td>0</td>
    <td>0</td>
    <td>0</td>
  </tr>
  <tr>
    <td colspan="2" class="tw:text-center tw:font-semibold tw:text-gray-800">TOTALES</td>
    <td>{{ $total_matr }}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>{{ $t_tr }}</td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
  </div>
</x-panel.tarjeta>
  <!--<div class="col-md-3 col-md-offset-5 ml">
         <button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
  </div>-->
@endif

</main>
<script>

  $(document).ready(function() {

    $("#selectCarrera").on('change',function(e){
      var id_carrera= $("#selectCarrera").val();
      window.location.href='/distribucion/'+id_carrera ;
    });

    $("#text_actualiza").keypress(function(e){
               if(e.which == 13){
                 TNotify.alert("Hola");
               }
              });

});

</script>



@endsection
