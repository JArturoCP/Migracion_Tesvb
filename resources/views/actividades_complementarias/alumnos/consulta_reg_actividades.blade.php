{{--
    Complementarias › Registrar del alumno (/consulta_actividades, ConsultaRegActividadesController@index;
    también @edit con el parcial partials_actividades.alumno.editar_actividad_alumno). Diseño del panel;
    la lógica no cambia: mismos datos, condiciones ($suma>=40, liberacion 0/1/2, $condicion, $edit), mismos
    formularios TAL COMO LOS ARMA EL NAVEGADOR (un <form> sin atributos envuelve la tabla y el modal de registro;
    el <form id="agregar_actividad_alu"> anidado del original lo ignoraba el navegador y no se incluye),
    #form_confirma (POST /consulta_actividades con @csrf y los campos ocultos), #form_delete (DELETE, su action
    lo pone el script), modales con los mismos id y el mismo script. Versión anterior: tests/Fixtures/vistas_antes.
--}}
@extends('layouts.panel')
@section('title', 'RegistroActividad')
@include('partials.panel.recursos_app', ['validacion' => true])
@section('content')


<main>
  <x-panel.encabezado titulo="Actividades Registradas" :migas="['Complementarias' => url('/consulta_actividades/')]" />
  <form>
    <x-panel.tarjeta sin-relleno>
      <div class="tw:flex tw:flex-wrap tw:items-center tw:justify-between tw:gap-3 tw:px-5 tw:py-4 tw:sm:px-6">
        <div>
          <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90">Actividades registradas</h3>
          <div class="tw:mt-1 tw:flex tw:items-center tw:gap-2" id="hhhh">
            <span class="tw:text-sm tw:text-gray-500 tw:dark:text-gray-400">Total Horas:</span>
            <x-panel.badge tono="{{ $suma >= 40 ? 'exito' : 'marca' }}">{{$suma}}</x-panel.badge>
            <input value="{{$suma}}" id="total_horas" style="visibility:hidden" class="tw:w-0">
          </div>
        </div>
        @if($suma>=40)
        @else
        <x-panel.boton variante="exito" class="flotante" data-target="#agrega_actalu" data-tooltip="true"
                       data-toggle="modal" data-placement="left" title="AGREGAR ACTIVIDAD" id="agrega">
          <i class="fa fa-plus" aria-hidden="true"></i> Agregar actividad</x-panel.boton>
        @endif
      </div>

      <div class="tw:border-t tw:border-gray-100 tw:dark:border-gray-800">
        <x-panel.tabla class="tabla-grande2">
          <thead>
            <tr>
              <th>Actividad</th>
              <th>Categoría</th>
              <th>Fecha</th>
              <th>Coordinador</th>
              <th>Horas</th>
              <th>Créditos</th>
              <th>Estado de la solicitud</th>
              {{-- <th>Editar</th>--}}
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            @foreach($consulta_alumno as $alumno)
              <tr>
                <td class="tw:font-medium tw:text-gray-800 tw:dark:text-white/90">{{$alumno->descripcion}}</td>
                <td>{{$alumno->descripcion_cat}}</td>
                <td>{{$alumno->fecha_registro}}</td>
                <td>{{$alumno->titulo}} {{$alumno->nombre}}</td>
                <td>{{$alumno->horas}}</td>
                <td>{{$alumno->creditos}}</td>
                  @if($alumno->liberacion == 0)
                  <td>
                  <x-panel.badge tono="advertencia">En espera Jefe de división...</x-panel.badge>
                  </td>
                   {{-- <td><a href="{{url("/consulta_actividades/".$alumno->id_registro_alumno."/edit")}}"><span class="glyphicon glyphicon-cog em" aria-hidden="true" ></span></a></td>--}}
                    <td><a class="elimina tw:inline-flex tw:size-9 tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:text-red-600 tw:hover:bg-red-50 tw:dark:text-red-500 tw:dark:hover:bg-red-500/10" id="{{$alumno->id_registro_alumno}}" title="Eliminar"><i class="fa fa-trash tw:text-lg" aria-hidden="true"></i></a></td>
                  @endif
                  @if($alumno->liberacion == 1)
                  <td>
                  <x-panel.badge tono="info">En espera subdirección...</x-panel.badge>
                  </td>
                  @endif
                  @if($alumno->liberacion == 2)
                  <td>
                  <x-panel.badge tono="exito">Aprobado</x-panel.badge>
                  </td>
                  <td></td>
                  <td></td>
                  @endif
              </tr>
             @endforeach
          </tbody>
        </x-panel.tabla>
      </div>
    </x-panel.tarjeta>






<!-- Modal PARA AGREGAR NUEVA ACTIVIDAD -->
{{-- [original] aquí se abría <form method="POST" id="agregar_actividad_alu"> dentro del <form> anterior: el navegador
     lo ignoraba (no existía ese formulario y $("#agregar_actividad_alu").validate() no hacía nada) y su </form>
     cerraba el <form> anónimo. Se quita y el </form> de abajo cierra el formulario anónimo, como antes. --}}
  <x-panel.modal id="agrega_actalu" tamano="lg" clase-cerrar="close" aria-labelledby="myModalLabel">
    <x-slot:encabezado>
      <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Registro de actividad</h3>
    </x-slot:encabezado>
    <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-2">
      <x-panel.select etiqueta="Actividad" name="actividad_alumnos" id="actividad_alumnos">
        <option disabled selected hidden>Selecciona Opción...</option>
          @foreach($docente_actividad as $docente_actividad)
            <option value="{{$docente_actividad->id_actividad_comple}}" data-horas="{{$docente_actividad->horas}}" data-docente="{{$docente_actividad->titulo}}  {{$docente_actividad->nombre}}" data-profesor="{{$docente_actividad->nombre}}">{{$docente_actividad->descripcion}} </option>
          @endforeach
      </x-panel.select>
      <x-panel.input etiqueta="Número de Horas" id="horas_alumno" type="text" placeholder="Horas" name="horas_alumno" disabled />
      <div class="tw:md:col-span-2">
        <x-panel.input etiqueta="Encargado" id="docente" type="text" placeholder="Encargado" name="docente" disabled />
        <input id="profesor" type="hidden" name="profesor">
      </div>
    </div>
    <input name="fecha" type="text" id="fecha"  value="<?php echo date("Y/m/d"); ?>" style="visibility:hidden" class="tw:h-0"/>
    <x-slot:pie>
      <x-panel.boton class="registra" id="registra">Registrar</x-panel.boton>
      <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
    </x-slot:pie>
  </x-panel.modal>
</form>

<!-- Modal PARA CONFIRMAR AGREGAR-->

<x-panel.modal id="modal_confirmacion" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
  <form id="form_confirma" class="form" role="form" method="POST">
    {{ csrf_field() }}
    <input type="hidden" id="actividad_alu" name="actividad_alu" value="">
    <input type="hidden" id="horas_alu" name="horas_alu" value="">
    <input type="hidden" id="docente_alu" name="docente_alu" value="">
    <input type="hidden" id="profesor_alu" name="profesor_alu" value="">
    <input type="hidden" id="fecha_alu" name="fecha_alu" value="">
    <div class="tw-modal-cuerpo tw:pt-10 tw:text-center tw:text-gray-700 tw:dark:text-gray-300">
          ¿Realmente deseas agregar esta actividad?
    </div>
    <x-panel.modal-pie>
      <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
      <input id="confirma_actividad" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:bg-red-500 tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-red-600" value="Aceptar">
    </x-panel.modal-pie>
  </form>
</x-panel.modal>

  <!--MODAL PARA ELIMINAR REGISTRO DEL ALUMNO-->
<x-panel.modal id="modal_elimina" tamano="sm" sin-relleno aria-labelledby="mySmallModalLabel">
  <form action="" method="POST" role="form" id="form_delete">
    {{method_field('DELETE') }}
    {{ csrf_field() }}
    <div class="tw-modal-cuerpo tw:pt-10 tw:text-center tw:text-gray-700 tw:dark:text-gray-300">
          ¿Realmente deseas eliminar éste elemento?
    </div>
    <x-panel.modal-pie>
      <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
      <input id="confirma_elimina" type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:bg-red-500 tw:px-4 tw:py-2.5 tw:text-sm tw:font-medium tw:text-white tw:hover:bg-red-600" value="Aceptar">
    </x-panel.modal-pie>
  </form>
</x-panel.modal>

<x-panel.modal id="mensaje_actividad" tamano="sm">
  <p class="tw:pt-6 tw:text-center tw:font-bold tw:text-red-700 tw:dark:text-red-500">Selecciona una actividad.</p>
</x-panel.modal>

<x-panel.modal id="actividad_registrada" tamano="sm">
  <p class="tw:pt-6 tw:text-center tw:font-bold tw:text-red-700 tw:dark:text-red-500">La actividad que intentas registrar ya existe.</p>
</x-panel.modal>
<?php
  $direccion=Session::get('ip');
?>

</main>
@if(isset($edit))
@section('editar_actalu')
    @include('actividades_complementarias.partials_actividades.alumno.editar_actividad_alumno')
@show
@endif

<script>
   $(document).ready(function(){

   $(".elimina").click(function(){
            var id=$(this).attr('id');
            $('#confirma_elimina').data('id',id);
            $('#modal_elimina').modal('show');
        });



    $(".registra").click(function(event){
      var confirma=$("#actividad_alumnos").val();

      $("#agregar_actividad_alu").validate({
            rules:{
              actividad_alumnos: "required"
            }

      });
      var actividad=$('#actividad_alumnos').val();
      var horas=$('#horas_alumno').val();
      var docente=$('#docente').val();
      var docentes=$('#profesor').val();
      var fecha=$('#fecha').val();
      var horas_act=$('#total_horas').val();



      $('#actividad_alu').val(actividad);
      $('#horas_alu').val(horas);
      $('#docente_alu').val(docente);
      $('#profesor_alu').val(docentes);
      $('#fecha_alu').val(fecha);


      horas_total=(parseInt(horas)+parseInt(horas_act));
      if(horas_total>40)
      {
        TNotify.alert("Excede el número de horas");
      }
      else
      {
        if(confirma!=null)
        {
          $('#agrega_actalu').modal('hide');
          $('#modal_confirmacion').modal('show');
        }
        else
        {
            $('#mensaje_actividad').modal('show');
              setTimeout(myFunction, 2000);

              function myFunction(){
              $('#mensaje_actividad').modal('hide');
              }
        }
      }


    });

   $("#confirma_actividad").click(function(event){
      $("#form_confirma").submit();


   });

    @if($condicion==0)

    @else
    <?php
      Session::put('entra',0);
    ?>
            $('#actividad_registrada').modal('show');
              var direccion="{{$direccion}}";
              setTimeout(myFunction, 2000);

              function myFunction(){
              window.location.href=direccion+"/consulta_actividades/";
              }
    @endif

   $('#actividad_alumnos').on('change',function(){

       var selected = $(this).find('option:selected');
       var extra = selected.data('horas');
       var titulo = selected.data('docente'); //lo que se coloca dentro del parentesis es el data-docente
       var docentes = selected.data('profesor');

       $("#docente").val(titulo);
       $("#horas_alumno").val(extra + " Horas");
       $("#profesor").val(docentes);


      });

    $("#confirma_elimina").click(function(event){
          var id_sit=($(this).data('id'));
          $("#form_delete").attr("action","{{url("/consulta_actividades_elimina/")}}"+"/"+id_sit)
          $("#form_delete").submit();
          });


    });

</script>

@endsection
