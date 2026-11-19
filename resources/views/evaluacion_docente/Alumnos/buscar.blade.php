@extends('layouts.panel')
@section('title', 'Inicio')
@include('evaluacion_docente.partials.recursos_panel', ['datatables' => true])
@section('content')


<?php
  $direccion=Session::get('ip');
?>

<script type="text/javascript">



  $(document).ready(function() {

      $('#ejemplo1').DataTable();
      $('#ejemplo2').DataTable();
      $('#ejemplo3').DataTable();
      $('#ejemplo4').DataTable();
      $('#ejemplo5').DataTable();
      $('#ejemplo6').DataTable();
      $('#ejemplo7').DataTable();
      $('#ejemplo8').DataTable();
      $('#ejemplo9').DataTable();
      $('#ejemplo10').DataTable();
      $('#ejemplo11').DataTable();
      $('#ejemplo12').DataTable();
      $('#ejemplo13').DataTable();
      $('#ejemplo14').DataTable();
      $('#ejemplo15').DataTable();

      $('#ejemplos1').DataTable();
      $('#ejemplos2').DataTable();
      $('#ejemplos3').DataTable();
      $('#ejemplos4').DataTable();
      $('#ejemplos5').DataTable();
      $('#ejemplos6').DataTable();
      $('#ejemplos7').DataTable();
      $('#ejemplos8').DataTable();
      $('#ejemplos9').DataTable();
      $('#ejemplos10').DataTable();
      $('#ejemplos11').DataTable();
      $('#ejemplos12').DataTable();
      $('#ejemplos13').DataTable();
      $('#ejemplos14').DataTable();
      $('#ejemplos15').DataTable();



 $("#evaluar").click(function(){

      $('#modal_evaluar').modal('show');
  });
 $("#confirma_evaluar").click(function(){

     // $('#modal_confirma_evaluar').modal('show');
  //});
//$("#verificar").click(function(){

  //    var verifica=$("#contra").val();

    //  if (verifica==101918)
     //{
     $("#activar").attr("disabled","disabled");
        var direccion="{{$direccion}}";
         $('#modal_evaluar').modal('hide');
          $('#modal_confirma_evaluar').modal('hide');
           $('#mensaje').modal('show');
        window.location.href = "/Migrar";

      //}
      //else{
        //TNotify.alert("contraseña incorrecta");
      //}

  });



} );


</script>

    <x-panel.encabezado titulo="ALUMNOS EVALUACIÓN DOCENTE" />

    {{-- Botones que MODIFICAN datos: /activar cambia el estado de la evaluación y "Evaluar" → /Migrar hace los cálculos del periodo. --}}
    <div class="tw:mb-6 tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3">
        @if($activa_eva==1)
            <x-panel.boton variante="exito" type="button" href="/activar">Activar Evaluación <span class="fa fa-check" aria-hidden="true"></span></x-panel.boton>
        @else
            <x-panel.boton variante="peligro" type="button" href="/activar">Desactivar Evaluación <span class="fa fa-times" aria-hidden="true"></span></x-panel.boton>
        @endif
        @if($evaluar==1)
            <x-panel.boton variante="exito" id="evaluar">Evaluar <span class="fa fa-check" aria-hidden="true"></span></x-panel.boton>
        @else
            <x-panel.boton variante="peligro" disabled="disabled">Evaluar <span class="fa fa-check" aria-hidden="true"></span></x-panel.boton>
        @endif
    </div>

    <div class="tw-pantalla tw:space-y-3" id="accordion">
        @foreach($carreras as $carrera)
            <div class="tw:overflow-hidden tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white tw:dark:bg-white/3 tw:dark:border-gray-800">
                <div class="tw:flex tw:flex-wrap tw:items-center tw:gap-4 tw:px-5 tw:py-4">
                    <h4 class="tw:min-w-0 tw:flex-1 tw:text-base">
                        <a data-toggle="collapse" data-parent="#accordion" href="#carrera_{{$carrera->id_carrera}} " class="tw:inline-flex tw:items-center tw:gap-2 tw:text-gray-800 tw:hover:text-brand-500 tw:dark:text-white/90">
                            <span class="fa fa-chevron-down tw:text-xs tw:text-gray-400 tw:dark:text-gray-500" aria-hidden="true"></span>
                            {{$carrera->nombre}}</a>
                    </h4>
                    <div class="tw:w-full tw:sm:w-72">
                        @if($carrera->por>=0&&$carrera->por<=33)
                            <div class="tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-red-400 tw:text-xs tw:font-medium" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$carrera->por}}%;color:black;">
                                    {{$carrera->por}}%
                                </div>
                            </div>
                        @endif
                        @if($carrera->por>=34&&$carrera->por<=66)
                            <div class="tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-amber-400 tw:text-xs tw:font-medium" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$carrera->por}}%;color:black;">
                                    {{$carrera->por}}%
                                </div>
                            </div>
                        @endif
                        @if($carrera->por>=67&&$carrera->por<=100)
                            <div class="tw:flex tw:h-5 tw:w-full tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-green-400 tw:text-xs tw:font-medium" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$carrera->por}}%;color:black;">
                                    {{$carrera->por}}%
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div id="carrera_{{$carrera->id_carrera}}" class="panel-collapse collapse">
                    <div class="tw:border-t tw:border-gray-100 tw:p-5 tw:sm:p-6 tw:dark:border-gray-800">
                        <div class="tw:mb-5 tw:flex tw:flex-wrap tw:gap-2">
                            <x-panel.badge tono="gris">TOTAL DE ALUMNOS: {{$carrera->total}}</x-panel.badge>
                            <x-panel.badge tono="exito">ALUMNOS QUE YA EVALUARON: {{$carrera->ya}}</x-panel.badge>
                        </div>

                        <ul class="tw-pestanas tw:mb-5 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200 tw:dark:border-gray-800">
                            <li><a data-toggle="tab" href="#si{{$carrera->id_carrera}}">Alumnos que ya evaluaron</a></li>
                            <li><a data-toggle="tab" href="#no{{$carrera->id_carrera}}">Alumnos que no han evaluado</a></li>
                        </ul>
                        <div class="tab-content" >

                            <div id="si{{$carrera->id_carrera}}" class="tab-pane active">
                                <x-panel.tabla id="ejemplo{{$carrera->id_carrera}}" compacta>
                                    <thead>
                                    <tr>
                                        <th>No. Cuenta</th>

                                        <th>Alumno(a)</th>
                                        <th>Semestre</th>
                                        <th>Estado</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos as $alu)
                                        @if($carrera->id_carrera==$alu->id_carrera&& $alu->no_pregunta==1000)
                                            <tr>

                                                <td>{{$alu->cuenta}}</td>
                                                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$alu->nombre}} {{$alu->apaterno}} {{$alu->amaterno}}</td>
                                                <td>{{$alu->id_semestre}}</td>
                                                @if($alu->no_pregunta==1000)
                                                    <td>
                                                        <div class="tw:flex tw:items-center tw:gap-3">
                                                            <div class="tw:flex tw:h-4 tw:min-w-24 tw:flex-1 tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                                                <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-[10px] tw:font-medium tw:text-white" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                                    100%
                                                                </div>
                                                            </div>
                                                            <span class="fa fa-check-circle" style="color:green; font-size:18px;" aria-hidden="true"></span>
                                                        </div>
                                                    </td>

                                                @endif

                                            </tr>
                                        @endif
                                    @endforeach




                                    </tbody>
                                </x-panel.tabla>


                            </div>
                            <div id="no{{$carrera->id_carrera}}" class="tab-pane ">

                                <x-panel.tabla id="ejemplos{{$carrera->id_carrera}}" compacta>
                                    <thead>
                                    <tr>
                                        <th>No. Cuenta</th>

                                        <th>Alumno(a)</th>
                                        <th>Semestre</th>
                                        <th>Estado</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnoss as $aluu)
                                        @if($carrera->id_carrera==$aluu->id_carrera&& $aluu->no_pregunta < 1000)
                                            <tr>

                                                <td>{{$aluu->cuenta}}</td>
                                                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$aluu->nombre}} {{$aluu->apaterno}} {{$aluu->amaterno}}</td>
                                                <td>{{$aluu->id_semestre}}</td>
                                                @if($aluu->no_pregunta==1000)
                                                    <td>
                                                        <div class="tw:flex tw:items-center tw:gap-3">
                                                            <div class="tw:flex tw:h-4 tw:min-w-24 tw:flex-1 tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                                                <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-[10px] tw:font-medium tw:text-white" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                                    100%
                                                                </div>
                                                            </div>
                                                            <span class="fa fa-check-circle" style="color:green; font-size:18px;" aria-hidden="true"></span>
                                                        </div>
                                                    </td>

                                                @endif
                                                @if($aluu->no_pregunta==0)
                                                    <td>
                                                        <div class="tw:flex tw:items-center tw:gap-3">
                                                            <div class="tw:flex tw:h-4 tw:min-w-24 tw:flex-1 tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                                                <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-500 tw:text-[10px] tw:font-medium" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;color:black;">
                                                                    0%
                                                                </div>
                                                            </div>
                                                            <span class="fa fa-times-circle" style="color:red; font-size:18px;" aria-hidden="true"></span>
                                                        </div>
                                                    </td>

                                                @endif
                                                @if($aluu->no_pregunta>=1 && $aluu->no_pregunta <=99)

                                                    <td>
                                                        <div class="tw:flex tw:h-4 tw:min-w-24 tw:overflow-hidden tw:rounded-full tw:bg-gray-200 tw:dark:bg-gray-800">
                                                            <div class="tw:flex tw:h-full tw:items-center tw:justify-center tw:bg-brand-300 tw:text-[10px] tw:font-medium" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$aluu->no_pregunta}}%;color:black;">
                                                                {{$aluu->no_pregunta}}%
                                                            </div>
                                                        </div>


                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach




                                    </tbody>
                                </x-panel.tabla>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

<!--        -->
<x-panel.modal id="modal_evaluar" tamano="sm" aria-labelledby="mySmallModalLabel" sin-relleno>
    <div class="tw-modal-cuerpo tw:pt-12 tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
        Una vez que se realicen los cálculos de la evaluación docente no se podrá realizar ningún cambio en este periodo
    </div>
    <x-panel.modal-pie>
        <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
        <input id="confirma_evaluar" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:bg-red-600 tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700 tw:disabled:opacity-60" value="Aceptar"></input>
    </x-panel.modal-pie>
</x-panel.modal>

<x-panel.modal id="modal_confirma_evaluar" tamano="sm" aria-labelledby="mySmallModalLabel" sin-relleno>
    <div class="tw-modal-cuerpo tw:pt-12">
        <x-panel.input etiqueta="Contraseña:" type="password" id="contra" />
    </div>
    <x-panel.modal-pie>
        <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
        <input id="verificar" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:bg-red-600 tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-white tw:shadow-theme-xs tw:hover:bg-red-700" value="Aceptar"></input>
    </x-panel.modal-pie>
</x-panel.modal>


<x-panel.modal id="mensaje" tamano="sm" aria-labelledby="mySmallModalLabel">
    <div class="tw:flex tw:flex-col tw:items-center tw:gap-3 tw:pt-6 tw:text-center tw:text-sm tw:text-gray-700 tw:dark:text-gray-300">
        Este proceso puede demorar algunos minutos...
        <img id="logo1" src="img/loading.gif">
    </div>
</x-panel.modal>

@endsection
