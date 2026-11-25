@extends('layouts.app')
@section('title', 'Incidencias')
@push('styles')
    @vite('resources/css/marco.css')
@endpush
@section('content')
    
<main class="col-md-12">

  <div class="row">
        <div class="col-md-5 col-md-offset-4">
          <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title text-center">SOLICITUD DE OFICIOS</h3>
                </div>
          </div>  
        </div>
  </div>
<div>
    <div data-stepper-secciones  class="tw:space-y-5" data-stepper-errores="{{ json_encode($errors->messages()) }}">
        <x-panel.stepper id="incidencia" :pasos="['Motivo y artículo', 'Fecha y horario', 'Responsable y datos adicionales']" externo />
  <form data-stepper-formulario id="form_guardar_solicitud" action="{{url('/incidencias/guardar_incidencia_solicitada')}}" method="POST" role="form" >
  {{ csrf_field() }}
    <section id="incidencia-paso-0" data-stepper-seccion  class="tw:space-y-4 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
        <h4 data-stepper-titulo tabindex="-1" class="tw:text-sm tw:font-semibold tw:text-gray-800">Motivo y artículo</h4>
             <div class="row">
                <div class="col-md-8 col-md-offset-2">
                     <div class="form-group">
                         <label for="motivo_oficio">Motivo del oficio:</label>
                         <textarea class="form-control" id="motivo_oficio" name="motivo_oficio" data-stepper-requerido="Ingresa el motivo del oficio." rows="3" placeholder="Ingresa el motivo del oficio (La primera letra debe de ser en minusculas, debes tambien utilizar letras mayusculas y minusculas), por ejemplo: entregar documentación" style=""></textarea>
                     </div>
                </div>
             </div>
                
  <div class="row">

      <div class="col-md-4 col-md-offset-2">
          <div class= "dropdown">
             <label for="Tipo_of">Tipo de articulo/clausula aplicada:</label>
             <input type="hidden" id="estado_profesor" name="estado_profesor" value="{{$estado_profesor}}">
             <select class="form-control" placeholder="Seleciona una opción" id="id_articulo" name="id_articulo" data-stepper-requerido="Selecciona el artículo." required>
                <option disabled selected hidden> Selecciona una opción </option>
                @foreach($articulos as $articulo)
                <option value="{{$articulo->id_articulo}}" data-art="{{$articulo->nombre_articulo}}"> {{$articulo->nombre_articulo}} </option>
                
                @endforeach
             </select>
          </div>
      </div>

      </div>
    </section>
    <section id="incidencia-paso-1" data-stepper-seccion  class="tw:space-y-4 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
        <h4 data-stepper-titulo tabindex="-1" class="tw:text-sm tw:font-semibold tw:text-gray-800">Fecha y horario</h4>
      <div class="row">
                     <div style="display: none;" id="fecha_r1" class="col-md-2  col-md-offset-1 ">
                        <label for="fecha_requerida">Fecha requerida:</label>
                        <div class="form-group">
                            <input class="form-control datepicker fecha_requerida1"   type="text"  id="fecha_req1" name="fecha_req1" data-stepper-requerido="Selecciona la fecha requerida." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" >
                        </div>
                     </div>
                      <div style="display: none;" id="fecha_r2" class="col-md-2  col-md-offset-1 ">
                          <label for="fecha_requerida">Fecha requerida:</label>
                          <div class="form-group">
                              <input class="form-control datepicker fecha_requerida2"   type="text"  id="fecha_req2" name="fecha_req2" data-stepper-requerido="Selecciona la fecha requerida." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="DD/MM/AAAA" >
                          </div>
                      </div>
  </div>
      <div class="row">
          <div id="message" style="display:none">
              <div class="col-md-3 col-md-offset-2">
                  <div class="alert alert-danger">
                      <strong>Sin días disponibles </strong>
                  </div>
              </div>
          </div>
          <div id="message2" style="display:none">
              <div class="col-md-3  col-md-offset-2">
                  <div class="alert alert-success">
                      <strong>Puedes realizar tu solicitud </strong>
                  </div>   </div>
          </div>

      </div>

            {{-----------ARTICULO 64°-----------}}
    <div style="display: none;" id="articulo_64">

            <div class="row">
                  <div class="col-md-2 col-md-offset-2">
                    <label for="horario entrada">Horario de entrada</label><br>
                     <div class="form-group">
                             <input id="hora_e" class="form-control time" type="text" name="hora_e" data-stepper-requerido="Selecciona el horario de entrada." data-stepper-omitir placeholder="HORA" />
                     </div>
                  </div>
                  <div class="col-md-2 col-md-offset-1">
                     <label for="hora salida tarde">Horario de llegada tarde</label><br>
                     <div class="form-group">
                             <input id="hora_st" class="form-control time" type="text" name="hora_st" data-stepper-requerido="Selecciona el horario de llegada." data-stepper-omitir placeholder="HORA" />
                     </div>     
                  </div>
            </div>
    </div>
{{--------ARTICULO 73°----------}}
    <div style="display: none;" id="articulo_73">
            <div class="row">
                  <div class="col-md-3 col-md-offset-2">
                      <label for="fecha_invac">Fecha de inicio vacaciones</label>
                     <div class="form-group">
                         <input class="form-control datepicker fecha_invac"   type="text"  id="fecha_invac" name="fecha_invac" data-stepper-requerido="Selecciona la fecha de inicio de vacaciones." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
                  </div>
                  <div class="col-md-3 col-md-offset-1">
                     <label for="fecha_tervac">Fecha de termino de  vacaciones</label>
                     <div class="form-group">
                         <input class="form-control datepicker fecha_tervac"   type="text"  id="fecha_tervac" name="fecha_tervac" data-stepper-requerido="Selecciona la fecha de término de vacaciones." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                     </div>
                  </div>               
            </div>
    </div>
      {{--------ARTICULO 56°----------}}
      <div style="display: none;" id="articulo_56">

          <div class="row">
              <div class="col-md-3 col-md-offset-2">
                  <label for="fecha_invac">Fecha inicial</label>
                  <div class="form-group">
                      <input class="form-control datepicker fecha_invac3"   type="text"  id="fecha_invac3" name="fecha_invac3" data-stepper-requerido="Selecciona la fecha inicial." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                  </div>
              </div>
              <div class="col-md-3 col-md-offset-1">
                  <label for="fecha_tervac">Fecha de termino</label>
                  <div class="form-group">
                      <input class="form-control datepicker fecha_tervac3"   type="text"  id="fecha_tervac3" name="fecha_tervac3" data-stepper-requerido="Selecciona la fecha de término." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                  </div>
              </div>
          </div>
      </div>
      {{--------ARTICULO 75°----------}}
      <div style="display: none;" id="articulo_75">
          <div class="row">
              <div class="col-md-3 col-md-offset-2">
                  <label for="fecha_invac">Fecha de inicio vacaciones</label>
                  <div class="form-group">
                      <input class="form-control datepicker fecha_invac2"   type="text"  id="fecha_invac2" name="fecha_invac2" data-stepper-requerido="Selecciona la fecha de inicio de vacaciones." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                  </div>
              </div>
              <div class="col-md-3 col-md-offset-1">
                  <label for="fecha_tervac">Fecha de termino de  vacaciones</label>
                  <div class="form-group">
                      <input class="form-control datepicker fecha_tervac2"   type="text"  id="fecha_tervac2" name="fecha_tervac2" data-stepper-requerido="Selecciona la fecha de término de vacaciones." data-stepper-omitir data-date-format="yyyy/mm/dd" placeholder="AAAA/MM/DD" >
                  </div>
              </div>
          </div>
      </div>
{{------ARTICULO 68° 1/2 JORNADA SIN SINDICATO------}}
    <div style="display: none;" id="articuloM_68">
      <div class="row">
                  <div class="col-md-2 col-md-offset-2">
                     <label for="horario entrada">Horario de entrada</label><br>
                     <div class="form-group">
                             <input id="hora_e1" class="form-control time" type="text" name="hora_e1" data-stepper-requerido="Selecciona el horario de entrada." data-stepper-omitir placeholder="HORA" />
                     </div>
                  </div>
        <div class="col-md-2 col-md-offset-1">
            <label for="hora salida tarde">Horario de salida</label><br>
            <div class="form-group">
                  <input id="hora_s1" class="form-control time" type="text" name="hora_s1" data-stepper-requerido="Selecciona el horario de salida." data-stepper-omitir placeholder="HORA" />
            </div>
        </div>
      </div>
    </div>
{{------CLAUSULA 44° 1/2 JORNADA CON SINDICATO------}}
  <div style="display: none;" id="articuloM_44">
    <div class="row">
                <div class="col-md-2 col-md-offset-2">
                     <label for="horario entrada">Horario de entrada</label><br>
                     <div class="form-group">
                             <input id="hora_e2" class="form-control time" type="text" name="hora_e2" data-stepper-requerido="Selecciona el horario de entrada." data-stepper-omitir placeholder="HORA" />
                     </div>
                </div>
      <div class="col-md-2 col-md-offset-1">
            <label for="hora salida tarde">Horario de salida</label><br>
            <div class="form-group">
                <input id="hora_s2" class="form-control time" type="text" name="hora_s2" data-stepper-requerido="Selecciona el horario de salida." data-stepper-omitir placeholder="HORA" />
            </div>
      </div>
    </div>
  </div>
{{-------DESCRIPCIÓN CLAUSULA 44 DIAS ECONOMICOS SINDICATO------------}}
    </section>
    <section id="incidencia-paso-2" data-stepper-seccion  class="tw:space-y-4 tw:motion-safe:animate-in tw:motion-safe:fade-in tw:motion-safe:duration-200">
        <h4 data-stepper-titulo tabindex="-1" class="tw:text-sm tw:font-semibold tw:text-gray-800">Responsable y datos adicionales</h4>
      @if($estado_profesor==1)
          <div class="row">
                    <div class="col-md-3 col-md-offset-2" id="jefes" style="display:none;">
                        <div class="dropdown">
                            <label for="exampleInputEmail1">Dirigido a:</label>
                            <select class="form-control" placeholder="Seleciona una opción" id="id_jefe" name="id_jefe" data-stepper-requerido="Selecciona el jefe de división." data-stepper-omitir required>
                              <option disabled selected hidden> Selecciona una opción </option>
                                @foreach($array_carreras as $carrera)
                              <option value="{{$carrera['id_personal']}}" data-art="{{$carrera['nombre']}}">{{$carrera['titulo']}} {{$carrera['nombre']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
          </div>

      @endif
    <div style="display: none;" id="descripcionD_44">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="dia economico SIND" >El personal, después de laborar un año y hasta nueve años en el TESVB disfrutarán de 4 días económicos por año con goce de sueldo íntegro, después de nueve a quince años disfrutarán de 5 días económicos por año con goce de sueldo íntegro, y más de 15 años disfrutarán de 6 días económicos por año con goce de sueldo íntegro, estos no podrán ser fraccionados.</label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 69 OMISIÓN DE ENTRADA------------}}
    <div style="display: none;" id="descripcion_69">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="omisión de salida" >Toda incidencia deberá justificarse ante la Dirección de Administración y Finanzas en el caso del
                personal administrativo y a la Dirección de Académica para el personal docente, en un plazo no mayor a cinco días
                hábiles después de ocurrida; de no respetar el plazo de presentación, esta perderá su carácter de justificable y no
                será autorizada. </label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN CLAUSULA 44 MEDIAS JORNADAS SINDICATO------------}}
    <div style="display: none;" id="descripcionM_44">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="media jornada SIND">Los trabajadores gozaran de 4 medias jornadas al año para atender situaciones personales que se pudieran presentar; el Tecnológico está facultado para corroborar y/o solicitar la constancia correspondiente que constante tal situación. </label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 68 DIAS ECONOMICOS SIN SINDICATO------------}}
    <div style="display: none;" id="descripcionD_68">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="dia economico NO SIND">El personal, después de laborar un año y hasta nueve años en el TESVB disfrutarán de 4 días económicos por año con goce de sueldo íntegro, después de nueve a quince años disfrutarán de 5 días económicos por año con goce de sueldo íntegro, y más de 15 años disfrutarán de 6 días económicos por año con goce de sueldo íntegro, estos no podrán ser fraccionados.</label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 68 MEDIAS JORNADAS SIN SINDICATO------------}}
    <div style="display: none;" id="descripcionM_68">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="media jornada NO SIND">Los trabajadores gozaran de 4 medias jornadas al año para atender situaciones personales que se pudieran presentar; el Tecnológico está facultado para corroborar y/o solicitar la constancia correspondiente que constante tal situación. </label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 56 TITULACION O GRADO------------}}
    <div style="display: none;" id="descripcion_56">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <label for="titulacion">El personal adscrito al Tecnológico con más de un año de antigüedad, tendrán derecho a una licencia
              con goce de sueldo hasta por tres días hábiles por concepto de titulación o grado incluyendo el día de la presentación
              de la evaluación profesional o de grado, lo anterior a efecto de preparar la evaluación profesional que sustenten;
              debiendo presentar documento oficial que acredite la presentación del examen.</label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 61 DIA SIN GOCE DE SUELDO------------}}
    <div style="display: none;" id="descripcion_61">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <label for="dia sin goce">Para disfrutar de las licencias sin goce de sueldo, el personal adscrito al Tecnológico deberá contar con
                    la autorización de la jefatura correspondiente y con el visto bueno del Director General.
                    Las licencias podrán negarse si la ausencia del personal afecta el adecuado desempeño de las operaciones del
                    Tecnológico.</label>
            </div>
        </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 64 RETARDO------------}}
    <div style="display: none;" id="descripcion_64">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <label for="retardo"> La autorización de permisos de entrada y salida fuera del horario establecido y para desempeñar
            comisiones, deberá contar con la aprobación de la jefatura correspondiente, así como del visto bueno de la Dirección
            o Subdirección a la que corresponda en los siguientes casos:
            <br>I. Asistencia a laborar después de dieciséis minutos de los horarios correspondientes al inicio de la jornada y al
            regreso de la comida; y
            <br>II. Cualquier otra excepción para el cumplimiento del horario normal.</label>
        </div>
      </div>
    </div>
{{-------DESCRIPCIÓN ARTICULO 73 VACACIONES NO DISFRUTADAS------------}}
      <div style="display: none;" id="descripcion_73">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <label for="dia sin goce">El personal adscrito al Tecnológico, que durante periodos de vacaciones se encuentren incapacitados
               por enfermedad o gravidez, tendrá derecho a que se le repongan los días de vacaciones que no hubieren disfrutado,
               una vez concluida la incapacidad.</label>
          </div>
         </div>
      </div>
      {{-------DESCRIPCIÓN ARTICULO 75 PERIODOS DE VACACIONES------------}}
      <div style="display: none;" id="descripcion_75">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <label for="dia sin goce">Si por cualquier otro motivo, el personal no pudiera disfrutar de cualquiera de sus periodos vacacionales,
                      podrá hacerlo de manera escalonada dentro de los 12 meses siguientes a la fecha de inicio oficial del periodo vacacional,
                      en el entendido de que , de no hacerlo, los días de vacaciones no disfrutados se perderán y no se podrá exigir,
                      por estos, pago alguno.</label>
              </div>
          </div>
      </div>
    </section>
    </form> 

          <div class="row" style="display: inline" id="solicitar">
            <div class="col-md-2 col-md-offset-6">
                <button id="enviar_solicitud" type="submit" form="form_guardar_solicitud" class="btn btn-success btn-lg">Enviar</button>
            </div>    
          </div>
        <x-panel.stepper-navegacion />
    </div>
</div>
      <div class="modal fade" id="modal_mostrar2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Informacion Adicional</h4>
                    </div>
                    <div class="modal-body">
                        <div id="contenedor_mostrar2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @include('partials.panel.stepper-secciones')

<script>
   $(document).ready( function() {
       function contar_dias(id_articulo) {
          /// TNotify.alert(id_articulo);
           let sabados = 0;
           let domingos = 0;

           // Obtener la fecha actual
           let fechaActual = new Date();

           // Iterar desde hoy hasta 5 días posteriores
           for (let i = 0; i <= 5; i++) {
               let diaSemana = fechaActual.getDay(); // 0 = Domingo, 6 = Sábado

               if (diaSemana === 6) {
                   sabados++;
               } else if (diaSemana === 0) {
                   domingos++;
               }

               // Avanzar al siguiente día
               fechaActual.setDate(fechaActual.getDate() + 1);
           }
           let dias=sabados+domingos;
           let dias_a;
           if(dias > 0){
                dias_a=6;
           }else{
                dias_a=5;
           }

           return dias_a;
       }
   $("#id_articulo").change(function(){

    var id_articulo=$(this).val();
    const fechasPorArticulo = {
        1: ['fecha_req2'], 2: ['fecha_invac3', 'fecha_tervac3'], 4: ['fecha_req2'],
        5: ['fecha_req1', 'hora_e', 'hora_st'], 6: ['fecha_req2'], 7: ['fecha_req1'],
        8: ['fecha_invac', 'fecha_tervac'], 9: ['fecha_req2', 'hora_e2', 'hora_s2'],
        10: ['fecha_req2', 'hora_e1', 'hora_s1'], 11: ['fecha_invac2', 'fecha_tervac2']
    };
    const requeridos = new Set(fechasPorArticulo[id_articulo] || []);
    if ($('#estado_profesor').val() === '1' && fechasPorArticulo[id_articulo]) { requeridos.add('id_jefe'); }
    $('#form_guardar_solicitud [data-stepper-requerido]').not('#motivo_oficio, #id_articulo').each(function () {
        this.toggleAttribute('data-stepper-omitir', !requeridos.has(this.name));
    });
    $('#enviar_solicitud').prop('disabled', true);
    this.removeAttribute('data-stepper-error');
    $('#message, #message2').hide();
    if (!Object.hasOwn(fechasPorArticulo, id_articulo)) {
        this.dataset.stepperError = 'Selecciona un artículo disponible para esta solicitud.';
        $('#form_guardar_solicitud').trigger('stepper:revisar');
        return;
    }


       let diass=contar_dias(id_articulo);

       if( id_articulo == 5 || id_articulo == 7){
           $("#fecha_r1").css("display", "block");
           $("#fecha_r2").css("display", "none");
           $( '.fecha_requerida1').datepicker({
               pickTime: false,
               autoclose: true,
               language: 'es',
               startDate: '-'+diass+'d',
           });
       }
       else if(id_articulo == 2 || id_articulo == 8 || id_articulo == 11){
           $("#fecha_r1").css("display", "none");
           $("#fecha_r2").css("display", "none");
       }
       else{
           $("#fecha_r1").css("display", "none");
           $("#fecha_r2").css("display", "block");
               /* id 1,4,6,8,9,10,11*/
           $( '.fecha_requerida2').datepicker({
               pickTime: false,
               autoclose: true,
               language: 'es',
               startDate: '+0d',
           });
       }


    //TNotify.alert(id_articulo);

    $.get("/incidencias/solicitud/validar/"+id_articulo,function (data) {
          
          if ($('#id_articulo').val() !== id_articulo) { return; }
          var dias_dis=data;
          
          if(dias_dis==0)
          {
            $('#id_articulo').attr('data-stepper-error', 'El artículo seleccionado no tiene días disponibles.');
            
            $("#message").css("display", "block");
            $("#message2").css("display", "none");
            $("#enviar_solicitud").attr("disabled", true);
          }
          if(dias_dis>0)
          {
           
            $("#message2").css("display", "block");
            $("#message").css("display", "none");
            $("#enviar_solicitud").attr("disabled", false);
          }
          $('#form_guardar_solicitud').trigger('stepper:revisar');
        }).fail(function () {
          if ($('#id_articulo').val() !== id_articulo) { return; }
          $('#id_articulo').attr('data-stepper-error', 'No se pudo comprobar la disponibilidad. Vuelve a seleccionar el artículo.');
          $('#form_guardar_solicitud').trigger('stepper:revisar');
        });
     if(id_articulo == 5){
         $("#articulo_56").css("display", "none");
      $("#articulo_64").css("display", "block");
      $("#articulo_73").css("display", "none");
         $("#articulo_75").css("display", "none");
      $("#articuloM_68").css("display", "none");
      $("#articuloM_44").css("display", "none");
      $("#descripcion_64").css("display", "block"); 
      $("#descripcionD_44").css("display", "none"); 
      $("#descripcionM_44").css("display", "none"); 
      $("#descripcionD_68").css("display", "none");
      $("#descripcionM_68").css("display", "none"); 
      $("#descripcion_56").css("display", "none");  
      $("#descripcion_61").css("display", "none");
      $("#descripcion_73").css("display", "none"); 
      $("#descripcion_69").css("display", "none");
         $("#descripcion_75").css("display", "none");
      var id_estado_prof="<?php echo $estado_profesor;?>";
      if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
     
      //TNotify.alert('hola');
      
     }
      if(id_articulo == 8 ){
          $("#articulo_56").css("display", "none");
      $("#articulo_73").css("display", "block");
      $("#descripcion_73").css("display", "block");

          $("#articulo_75").css("display", "none");
      $("#articuloM_68").css("display", "none");
      $("#articuloM_44").css("display", "none");
      $("#articulo_64").css("display", "none");
      $("#descripcion_64").css("display", "none");
      $("#descripcion_61").css("display", "none"); 
      $("#descripcion_56").css("display", "none"); 
      $("#descripcionM_68").css("display", "none"); 
      $("#descripcionD_68").css("display", "none"); 
      $("#descripcionM_44").css("display", "none");
      $("#descripcionD_44").css("display", "none"); 
      $("#descripcion_69").css("display", "none");
      $("#descripcion_75").css("display", "none");
          var id_estado_prof="<?php echo $estado_profesor;?>";
          if(id_estado_prof==1){
              $("#jefes").css("display", "block");

          }
      }
       if(id_articulo == 11){
           $("#articulo_56").css("display", "none");
           $("#articulo_75").css("display", "block");
           $("#descripcion_75").css("display", "block");
           $("#articulo_73").css("display", "none");
           $("#articuloM_68").css("display", "none");
           $("#articuloM_44").css("display", "none");
           $("#articulo_64").css("display", "none");
           $("#descripcion_64").css("display", "none");
           $("#descripcion_61").css("display", "none");
           $("#descripcion_56").css("display", "none");
           $("#descripcionM_68").css("display", "none");
           $("#descripcionD_68").css("display", "none");
           $("#descripcionM_44").css("display", "none");
           $("#descripcionD_44").css("display", "none");
           $("#descripcion_69").css("display", "none");
           var id_estado_prof="<?php echo $estado_profesor;?>";
           if(id_estado_prof==1){
               $("#jefes").css("display", "block");

           }

       }
      if (id_articulo == 1){
          $("#articulo_56").css("display", "none");
        $("#descripcionD_44").css("display", "block");
        $("#descripcion_75").css("display", "none");
          $("#articulo_75").css("display", "none");
        $("#descripcionM_44").css("display", "none");
        $("#descripcionD_68").css("display", "none");
        $("#descripcionM_68").css("display", "none");
        $("#descripcion_56").css("display", "none");
        $("#descripcion_61").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#articulo_64").css("display", "none");
        $("#articulo_73").css("display", "none");
        $("#descripcion_69").css("display", "none");
          $("#descripcion_75").css("display", "none");
        var id_estado_prof="<?php echo $estado_profesor;?>";
      if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
      }
      if (id_articulo == 6){
          $("#articulo_56").css("display", "none");
        $("#descripcionD_68").css("display", "block");
        $("#descripcionD_44").css("display", "none");
        $("#descripcionM_44").css("display", "none");
        $("#descripcionM_68").css("display", "none");
        $("#descripcion_56").css("display", "none");
        $("#descripcion_61").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#articulo_64").css("display", "none");
        $("#articulo_73").css("display", "none");
        $("#descripcion_69").css("display", "none");
          $("#articulo_75").css("display", "none");
          $("#descripcion_75").css("display", "none");
        var id_estado_prof="<?php echo $estado_profesor;?>";
      if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
      }
      if (id_articulo == 10){
          $("#articulo_56").css("display", "none");
        $("#descripcionM_68").css("display", "block");
        $("#descripcionD_44").css("display", "none");
        $("#descripcionM_44").css("display", "none");
        $("#descripcionD_68").css("display", "none");
        $("#descripcion_56").css("display", "none");
        $("#descripcion_61").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#articuloM_68").css("display", "block");
        $("#articuloM_44").css("display", "none");
        $("#articulo_64").css("display", "none");
        $("#articulo_73").css("display", "none");
        $("#descripcion_69").css("display", "none");
          $("#articulo_75").css("display", "none");
          $("#descripcion_75").css("display", "none");
        var id_estado_prof="<?php echo $estado_profesor;?>";
      if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
      }
      if (id_articulo == 9){
          $("#articulo_56").css("display", "none");
        $("#articuloM_44").css("display", "block");
        $("#descripcionM_44").css("display", "block");
        $("#descripcionD_44").css("display", "none");
        $("#descripcionD_68").css("display", "none");
        $("#descripcionM_68").css("display", "none");
        $("#descripcion_56").css("display", "none");
        $("#descripcion_61").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#articuloM_68").css("display", "none");
        $("#articulo_64").css("display", "none");
        $("#articulo_73").css("display", "none");
        $("#descripcion_69").css("display", "none");
          $("#articulo_75").css("display", "none");
          $("#descripcion_75").css("display", "none");
        var id_estado_prof="<?php echo $estado_profesor;?>";
        if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
      }
      if (id_articulo == 2){
          $("#articulo_56").css("display", "block");
        $("#descripcion_56").css("display", "block");
        $("#descripcionM_44").css("display", "none");
        $("#descripcionD_44").css("display", "none");
        $("#descripcionD_68").css("display", "none");
        $("#descripcionM_68").css("display", "none");
        $("#descripcion_61").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#descripcion_69").css("display", "none");
          $("#articulo_64").css("display", "none");
          $("#articulo_75").css("display", "none");
          $("#descripcion_75").css("display", "none");
        var id_estado_prof="<?php echo $estado_profesor;?>";
      if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
      }
      if(id_articulo==4){
          $("#articulo_56").css("display", "none");
        $("#descripcion_61").css("display", "block");
        $("#descripcionM_44").css("display", "none");
        $("#descripcionD_44").css("display", "none");
          $("#articulo_64").css("display", "none");
        $("#descripcionD_68").css("display", "none");
        $("#descripcionM_68").css("display", "none");
        $("#descripcion_56").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#descripcion_69").css("display", "none");
          $("#articulo_75").css("display", "none");
          $("#descripcion_75").css("display", "none");
        var id_estado_prof="<?php echo $estado_profesor;?>";
        if(id_estado_prof==1){
         $("#jefes").css("display", "block");

      }
      }
      if(id_articulo == 7){
          $("#articulo_56").css("display", "none");
        $("#descripcion_69").css("display", "block")
        $("#descripcionM_44").css("display", "none");
        $("#descripcionD_44").css("display", "none");
        $("#descripcionD_68").css("display", "none");
        $("#descripcionM_68").css("display", "none");
        $("#descripcion_56").css("display", "none");
        $("#descripcion_61").css("display", "none");
        $("#descripcion_64").css("display", "none");
        $("#descripcion_73").css("display", "none");
        $("#articuloM_44").css("display", "none");
        $("#articuloM_68").css("display", "none");
          $("#articulo_75").css("display", "none");
          $("#descripcion_75").css("display", "none");
          var id_estado_prof="<?php echo $estado_profesor;?>";
          if(id_estado_prof==1){
              $("#jefes").css("display", "block");

          }
      }
      
    });
   $('#hora_e').pickatime({
       min: [7, 0],       // Hora mínima: 7:00 a.m.
       max: [20, 0],
       format: 'HH:i',
       interval: 30
     });
     $('#hora_st').pickatime({
         min: [7, 0],       // Hora mínima: 7:00 a.m.
         max: [20, 0],
         format: 'HH:i',
         interval: 1
     });
     $('#hora_e1').pickatime({
         min: [7, 0],       // Hora mínima: 7:00 a.m.
         max: [20, 0],
         format: 'HH:i',
         interval: 30
     });
     $('#hora_s1').pickatime({
         min: [7, 0],       // Hora mínima: 7:00 a.m.
         max: [20, 0],
         format: 'HH:i',
         interval: 30
     });
     $('#hora_e2').pickatime({
         min: [7, 0],       // Hora mínima: 7:00 a.m.
         max: [20, 0],
         format: 'HH:i',
         interval: 30
     });
     $('#hora_s2').pickatime({
         min: [7, 0],       // Hora mínima: 7:00 a.m.
         max: [20, 0],
         format: 'HH:i',
         interval: 30
     });

     $( '.fecha_req').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            }).on('changeDate',
                function (selected) {
                  $('.fecha_req').datepicker('setStartDate', getDate(selected));
                });
                $( '.fecha_invac').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            }).on('changeDate',
                function (selected) {
                  $('.fecha_invac').datepicker('setStartDate', getDate(selected));
                });
                $( '.fecha_tervac').datepicker({
                pickTime: false,
                autoclose: true,
                language: 'es',
                startDate: '+0d',
            }).on('changeDate',
                function (selected) {
                    $('.fecha_tervac').datepicker('setStartDate', getDate(selected));
                });
       $( '.fecha_invac2').datepicker({
           pickTime: false,
           autoclose: true,
           language: 'es',
           startDate: '+0d',
       }).on('changeDate',
           function (selected) {
               $('.fecha_invac2').datepicker('setStartDate', getDate(selected));
           });
       $( '.fecha_tervac2').datepicker({
           pickTime: false,
           autoclose: true,
           language: 'es',
           startDate: '+0d',
       }).on('changeDate',
           function (selected) {
               $('.fecha_tervac2').datepicker('setStartDate', getDate(selected));
           });

       $( '.fecha_invac3').datepicker({
           pickTime: false,
           autoclose: true,
           language: 'es',
           startDate: '+0d',
       }).on('changeDate',
           function (selected) {
               $('.fecha_invac3').datepicker('setStartDate', getDate(selected));
           });
       $( '.fecha_tervac3').datepicker({
           pickTime: false,
           autoclose: true,
           language: 'es',
           startDate: '+0d',
       }).on('changeDate',
           function (selected) {
               $('.fecha_tervac3').datepicker('setStartDate', getDate(selected));
           });

  });
</script>
</main>
@endsection
