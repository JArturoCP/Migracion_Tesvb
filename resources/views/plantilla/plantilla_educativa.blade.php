@extends('layouts.panel')
@section('title', 'Plantilla Educativa')
@include('partials.panel.recursos_app', ['graficas' => true])
@section('content')

    <script>
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  e.target // newly activated tab
  e.relatedTarget // previous active tab
})
    </script>

        <div id="contenedor_horarios">

    </div>

<main class="tw:w-full tw:lg:w-full tw:px-2">
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
	<div class="tw:w-full tw:px-2">
		<div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
	  		<div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4">
	    		<h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:text-center">Plantilla Educativa</h3>
	  		</div>
	  					              <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:p-5 tw:sm:grid-cols-2 tw:sm:p-6">
                            <div class="tw:w-full tw:lg:w-5/12 tw:md:w-6/12 tw:lg:ml-[8.3333%] tw:px-2">
                              <div class="dropdown">
                                <label for="SelectCarrera">Carrera</label>
                                 <select name="SelectCarrera" id="SelectCarrera" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option>Selecciona carrera...</option>
                                    @foreach($carreras as $carrera)
                                      @if($carrera->id_carrera==$id_carrera)
                                        <option value="{{$id_carrera}}" selected="selected">{{$carrera->nombre}}</option>
                                      @else
                                        <option value="{{$carrera->id_carrera}}" >{{$carrera->nombre}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                            </div> 
 @if(isset($ver))
                         <div class="tw:min-w-0" id="div_cargo">
                              <div class="dropdown-center">
                                <label for="selectcargo">Cargo</label>
                                 <select name="selectCargo" id="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona cargo...</option>
                                    @foreach($cargos as $cargo)
                                    @if($cargo->id_cargo==$id_cargo)
                                            <option value="{{$cargo->id_cargo}}" selected="selected">{{$cargo->cargo}}</option>
                                      @else
                                        <option value="{{$cargo->id_cargo}}" >{{$cargo->cargo}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                            </div>  
                              @else
                         <div class="tw:min-w-0" id="div_cargo" style="display:none;">
                              <div class="dropdown-center">
                                <label for="selectCargo">Cargo</label>
                                 <select name="selectCargo" id="selectCargo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                                  <option disabled selected>Selecciona cargo...</option>
                                    @foreach($cargos as $cargo)                             
                                        <option value="{{$cargo->id_cargo}}" >{{$cargo->cargo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div> 
@endif                        
              </div>
		</div>	
	</div>

 @if(isset($ver))

@foreach($docentes as $docente)
<div class="plantilla_c tw:w-full tw:lg:w-8/12 tw:lg:ml-[16.6667%] tw:px-2" id="accordion">
  <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:bg-white">
    <div class="link horario tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:bg-gray-50 tw:px-5 tw:py-4" style="color:<?php if($docente["aprobado"]==0){echo "#e05c5c";}else{echo "#409e45";} ?>">
      <h4 class="v{{$docente["id_horario"]}} tw:flex tw:flex-wrap tw:items-center tw:gap-3 tw:text-base tw:font-medium">
        <a data-toggle="collapse" data-parent="#accordion" href="#per_{{ $docente ["id_personal"]}}">{{ $docente ["nombre"]}}</a>
        <a class = "tooltip-options link em cont graficas" id="{{ $docente["id_personal"]}}" data-toggle="tooltip" data-placement="top" title ="GRÁFICA"><span class="fa fa-tasks" aria-hidden="true"></span></a>
<a class = "tooltip-options link em hr" id="{{ $docente["id_personal"]}}" data-toggle="tooltip" data-placement="top" title ="HORARIO DOCENTE"><span class="fa fa-list-alt" aria-hidden="true"></span></a>
      </h4>
    </div>
    <div id="per_{{ $docente ["id_personal"]}}" class="collapse">
      <div class="tw:p-5 tw:sm:p-6">

<?php $cont=true; ?>
          <ul class="tw-pestanas tw:mb-6 tw:flex tw:flex-wrap tw:gap-2 tw:border-b tw:border-gray-200">
            @if($docente["clases"]=="true")<li ><a data-toggle="tab" href="#clase{{ $docente["id_horario"] }}">HRS.CLASE</a></li>@endif
            @foreach($docente["actividades"] as $doc_act)
                <li>
                  <a data-toggle="tab" href="#act_{{ $doc_act["id_hrs_actividad_extra"] }}{{ $docente["id_horario"] }}">{{ $doc_act["descripcion"] }}</a>
                </li>
              <?php $cont=false; ?>
            @endforeach
          </ul>

<div class="tab-content">
@if($docente["clases"]=="true")
  <div id="clase{{ $docente["id_horario"] }}" class="tab-pane fade tw:text-center"> <!-- hrs_clase -->
    <h4>Aprobar Horario</h4>
    @if($docente["apro_h"]==1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-8{{ $docente["id_horario"] }}" data-act="20000" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" checked type="checkbox">
            <label for="cmn-toggle-8{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-8{{ $docente["id_horario"] }}" data-act="20000" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" type="checkbox">
            <label for="cmn-toggle-8{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @endif
    <p>Total de Hrs :<strong>{{ $docente["h_total"] }}</strong></p>
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla">
                          <thead>
                            <tr>
                                <th class="tw:text-center">Asignatura</th>
                                <th>No.Grupos</th>
                                <th class="tw:text-center">Hrs.Asignadas x materia</th>
                                <th>Hrs.totales asignadas</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($docente["materias"] as $mates)
                            <tr>
                              <td>{{ $mates["nombre"] }}</td>                  
                              <td class="tw:text-center">
                                @foreach($mates["grupos"] as $grupos)
                                {{ $grupos["grupo"] }}<br>
                                @endforeach
                              </td> 
                              <td>{{$mates["totales_mat"]}}</td>               
                              <td>{{ $mates["totales"] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
      </table>
</div>
    </div>
  </div>
@endif

  <div id="act_20005{{ $docente["id_horario"] }}" class="tab-pane fade tw:text-center"> <!-- gestion -->
    <h4>Aprobar Horario</h4>
    @if($docente["apro_g"]==1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-5{{ $docente["id_horario"] }}" data-act="20005" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" checked type="checkbox">
            <label for="cmn-toggle-5{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-5{{ $docente["id_horario"] }}" data-act="20005" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" type="checkbox">
            <label for="cmn-toggle-5{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @endif
    <p>Total de Hrs :<strong>{{ $docente["g_total"] }}</strong></p>
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla">
                          <thead>
                            <tr>
                                <th class="tw:text-center">Actividad</th>
                                <th>Grupos/Gestión</th>
                                <th>Hrs.Asignadas</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($docente["gestion"] as $doc_ges)
                            <tr>
                              <td>{{ $doc_ges["ges_act"] }}</td>
                              <td>{{ $doc_ges["ges_grupo"] }}</td>
                              <td>{{ $doc_ges["ges_t"] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
      </table>
</div>
    </div>
  </div>

  <div id="act_20003{{ $docente["id_horario"] }}" class="tab-pane fade tw:text-center"><!-- investigacion -->
        <h4>Aprobar Horario</h4>
            @if($docente["apro_i"]==1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-3{{ $docente["id_horario"] }}" data-act="20003" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" checked type="checkbox">
            <label for="cmn-toggle-3{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-3{{ $docente["id_horario"] }}" data-act="20003" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" type="checkbox">
            <label for="cmn-toggle-3{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @endif
    <p>Total de Hrs :<strong>{{ $docente["i_total"] }}</strong></p>
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla">
                          <thead>
                            <tr>
                                <th class="tw:text-center">Actividad</th>
                                <th>Hrs.Asignadas</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($docente["investigacion"] as $doc_inv)
                            <tr>
                              <td>{{ $doc_inv["inv_act"] }}</td>
                              <td>{{ $doc_inv["inv_t"] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
      </table>
</div>
    </div>
  </div>

    <div id="act_20006{{ $docente["id_horario"] }}" class="tab-pane fade tw:text-center"><!--vinculacion -->
        <h4>Aprobar Horario</h4>
        @if($docente["apro_v"]==1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-6{{ $docente["id_horario"] }}" data-act="20006" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" checked type="checkbox">
            <label for="cmn-toggle-6{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-6{{ $docente["id_horario"] }}" data-act="20006" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" type="checkbox">
            <label for="cmn-toggle-6{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @endif
    <p>Total de Hrs :<strong>{{ $docente["v_total"] }}</strong></p>
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla">
                          <thead>
                            <tr>
                                <th class="tw:text-center">Actividad</th>
                                <th>Hrs.Asignadas</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($docente["vinculacion"] as $doc_vin)
                            <tr>
                              <td>{{ $doc_vin["vin_act"] }}</td>
                              <td>{{ $doc_vin["vin_t"] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
      </table>
</div>
    </div>
  </div>

    <div id="act_20001{{ $docente["id_horario"] }}" class="tab-pane fade tw:text-center"><!-- residencia -->
            <h4>Aprobar Horario</h4>
            @if($docente["apro_r"]==1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-1{{ $docente["id_horario"] }}" data-act="20001" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" checked type="checkbox">
            <label for="cmn-toggle-1{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-1{{ $docente["id_horario"] }}" data-act="20001" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" type="checkbox">
            <label for="cmn-toggle-1{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @endif
    <p>Total de Hrs :<strong>{{ $docente["r_total"] }}</strong></p>
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla">
                          <thead>
                            <tr>
                                <th class="tw:text-center">Actividad</th>
                                <th>Hrs.Asignadas</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($docente["residencia"] as $doc_res)
                            <tr>
                              <td>{{ $doc_res["res_act"] }}</td>
                              <td>{{ $doc_res["res_t"] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
      </table>
</div>
    </div>
  </div>

    <div id="act_20002{{ $docente["id_horario"] }}" class="tab-pane fade tw:text-center"><!-- tutorias -->
            <h4>Aprobar Horario</h4>
            @if($docente["apro_t"]==1)
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input  id="cmn-toggle-2{{ $docente["id_horario"] }}" data-act="20002" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" checked type="checkbox">
            <label for="cmn-toggle-2{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @else
        <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
          <div class="switch-p">
            <input id="cmn-toggle-2{{ $docente["id_horario"] }}" data-act="20002" data-hr="{{ $docente["id_horario"] }}" class="cmn-toggle cmn-toggle-yes-no aprobar{{ $docente["id_horario"] }}" type="checkbox">
            <label for="cmn-toggle-2{{ $docente["id_horario"] }}" data-on="SI" data-off="NO"></label>
          </div>
        </div>
    @endif
    <p>Total de Hrs :<strong>{{ $docente["t_total"] }}</strong></p>
    <div class="tw:w-full tw:lg:w-10/12 tw:lg:ml-[8.3333%] tw:px-2">
      <div class="tw-tabla-contenedor tw:mb-6 tw:overflow-x-auto tw:rounded-xl tw:border tw:border-gray-200 tw:bg-white">
<table class="tw-tabla">
                          <thead>
                            <tr>
                                <th class="tw:text-center">Grupos</th>
                                <th>Hrs.Asignadas</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach($docente["tutorias"] as $doc_tut)
                            <tr>
                              <td>{{ $doc_tut["tut_grupo"] }}</td>
                              <td>{{ $doc_tut["tut_t"] }}</td>
                            </tr>
                          @endforeach
                          </tbody>
      </table>
</div>
    </div>
  </div>

</div>

      </div>
    </div>
  </div>
</div>
@endforeach

 @endif 

  </div>		
</main>

<!-- Modal para ver graficas -->
<x-panel.modal id="modal_graficas" tamano="lg" sin-relleno clase-cerrar="close" id-cerrar="acepta2" aria-labelledby="myModalLabel">
        <div class="tw:px-6 tw:pt-6 tw:pr-14">
          
          <h4 class="tw:text-lg tw:font-semibold tw:text-gray-800" id="myModalLabel">HISTORIAL DE HORAS DOCENTE</h4>
        </div>
        <div class="tw-modal-cuerpo">
          {{ csrf_field() }}
          <input type="hidden" id="prof" name="prof" value="">
          <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
              <div class="tw:w-full tw:lg:w-4/12 tw:lg:ml-[33.3333%] tw:px-2">
                <div class="dropdown">
                    <select name="selectCiclo" id="selectCiclo" class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11">
                      <option disabled selected>Selecciona ciclo...</option>
                      <option value="1" >{{ "Marzo-Agosto" }}</option>
                      <option value="2" >{{ "Septiembre-Febrero" }}</option>
                    </select>
                </div>
              </div> 
              <div id="contenedor_graficas">

              </div>
          </div>
        </div>
                      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-end tw:gap-3 tw:px-6 tw:pb-6">
              <button id="acepta" type="button" class="tw:inline-flex tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm" data-dismiss="modal">Aceptar</button>
          </div>
    
  
</x-panel.modal>

<script>
  $(document).ready(function() {

    $(".link").tooltip({html:true});


@foreach($docentes as $docente)
$('.aprobar{{ $docente["id_horario"] }}').change(function() {
var horario = $(this).data("hr");
var act = $(this).data("act");

//window.location.href='/aprobar_act/'+horario +'/'+act;
     $.get('/aprobar_act/'+horario+'/'+act,function(request){
        var datos=request['verde'];
        //console.log(datos);
        if(datos=="false")
        {
            $('.v{{ $docente["id_horario"] }}').css({
                /* 'visibility': 'visible', */
                'color': '#e05c5c',
            })

          $('.v{{ $docente["id_horario"] }}').removeClass('verde');
          $('.v{{ $docente["id_horario"] }}').addClass('rojo');
        }
        if(datos=="true")
        {
            $('.v{{ $docente["id_horario"] }}').css({
                /* 'visibility': 'visible', */
                'color': '#409e45',
            })
           // TNotify.alert("hola");
          $('.v{{ $docente["id_horario"] }}').removeClass('rojo');
          $('.v{{ $docente["id_horario"] }}').addClass('verde');
        }
      });
});
@endforeach


   $(".hr").click(function()
  {

    $("#contenedor_horarios").empty();
    var id=$(this).attr('id');

      $.get("/plantilla/horario/"+id,function(request)
        {
          $("#contenedor_horarios").html(request);

        });
    });

  $("#SelectCarrera").on('change',function(e){
      $("#div_cargo").show(1000);
      $('#selectCargo').val($('#selectCargo > option:first').val());
      $(".plantilla_c").hide();
    });

  $("#selectCargo").on('change',function(e){
      var id_carrera= $("#SelectCarrera").val();
      var id_cargo= $("#selectCargo").val();

      //var mensaje = TNotify.confirm('/p_educativa/datos/'+id_carrera +'/'+id_cargo);
      //Detectamos si el usuario acepto el mensaje
      //if (mensaje) 
      //{
        window.location.href='/p_educativa/datos/'+id_carrera +'/'+id_cargo;
     //  }

    });

  $(".graficas").click(function()
{
  var idp=$(this).attr('id');
  $('#selectCiclo').data('idp',idp);
  $('#modal_graficas').modal('show');
});

$("#selectCiclo").on('change',function(e)
{
  var idp=($(this).data('idp'));
  var idc= $("#selectCiclo").val();

    $("#contenedor_graficas").empty();
    $.get("/graficas_admin/"+idp+"/"+idc,function(request)
        {
          $("#contenedor_graficas").html(request);
        });
});
$("#acepta").click(function()
{
  $("#contenedor_graficas").empty();
  $('#selectCiclo').val($('#selectCiclo > option:first').val());
});
$("#acepta2").click(function()
{
  $("#contenedor_graficas").empty();
  $('#selectCiclo').val($('#selectCiclo > option:first').val());
});

});
</script>
@endsection
