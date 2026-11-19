@section('editar_actalu')
{{--
    Modificar actividad del alumno (/consulta_actividades/{id}/edit, ConsultaRegActividadesController@edit): modal
    #modal_edit_actalu que se abre al cargar. Mismo formulario #modificar_actalu (POST con _method PUT a
    /consulta_actividades/{id}, @csrf, actividad_alumnos, horas_alumnoo, profesoredit; novalidate) y mismo script.
    En el original el <form> no se cierra: el botón "Modificar" del pie le pertenece; aquí el <form> envuelve
    cuerpo y pie. Versión anterior: tests/Fixtures/vistas_antes.
--}}

<div>
      <x-panel.modal id="modal_edit_actalu" tamano="lg" sin-relleno clase-cerrar="close" aria-labelledby="myModalLabel">
                  <form class="form-horizontal" id="modificar_actalu" role="form" method="POST" action="/consulta_actividades/{{ $editar_actalu->id_registro_alumno}}" novalidate>
                    <input type="hidden" name="_method" value="PUT" />
                      {{csrf_field()}}
                    <div class="tw:px-6 tw:pt-6 tw:pr-14">
                      <h3 class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90" id="myModalLabel">Modificar Actividad</h3>
                    </div>
                    <div class="tw-modal-cuerpo">
                      <div class="tw:grid tw:grid-cols-1 tw:gap-5 tw:md:grid-cols-2">
                        <x-panel.select etiqueta="Actividad" name="actividad_alumnos" id="actividad_alumnos">
                          <option disabled selected hidden>Selecciona Opción...</option>
                            @foreach($docente_actividad as $docente_actividad)
                              @if($editar_actalu->id_docente_actividad==$docente_actividad->id_docente_actividad)
                                <option selected="selected" value="{{$docente_actividad->id_actividad_comple}}" data-horas="{{$docente_actividad->horas}}" data-docente="{{$docente_actividad->titulo}}  {{$docente_actividad->nombre}}" data-profesoresedit="{{$docente_actividad->nombre}}">{{$docente_actividad->descripcion}}</option>
                              @else
                                <option value="{{$docente_actividad->id_actividad_comple}}" data-horas="{{$docente_actividad->horas}}" data-docente="{{$docente_actividad->titulo}}  {{$docente_actividad->nombre}}" data-profesoresedit="{{$docente_actividad->nombre}}">{{$docente_actividad->descripcion}}</option>
                              @endif
                            @endforeach
                        </x-panel.select>
                        <div>
                          <x-panel.input etiqueta="Número de Horas" id="horas_alumno" type="text" placeholder="Horas" name="horas_alumno" disabled />
                          <input id="horas_alumnoo" type="hidden" placeholder="Horas" name="horas_alumnoo">
                        </div>
                        <div class="tw:md:col-span-2">
                          <x-panel.input etiqueta="Encargado" id="docente" type="text" placeholder="Encargado" name="docente" disabled />
                          <input id="profesoredit" type="hidden"  value="" name="profesoredit">
                        </div>
                      </div>
                    </div>
                    <x-panel.modal-pie>
                      <x-panel.boton type="submit" id="modifica_actalu">Modificar</x-panel.boton>
                      <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
                    </x-panel.modal-pie>
                  </form>
      </x-panel.modal>
</div>


<script>
  $(document).ready(function(){
    $("#modal_edit_actalu").modal("show");


   $('#actividad_alumnos').on('change',function(){

       var selected = $(this).find('option:selected');
       var horas = selected.data('horas');
       var titulo = selected.data('docente');
       var nom_docenteedit=selected.data('profesoresedit');

       $("#docente").val(titulo);
       $("#horas_alumno").val(horas + " Horas");
        $("#horas_alumnoo").val(horas);

       $("#profesoredit").val(nom_docenteedit);
      });

  $("#modifica_actalu").click(function(event){

    $("#modificar_actalu").submit();

        });

      var selected = $(this).find('option:selected');
      var horas = selected.data('horas');
      var titulo = selected.data('docente');
      var nom_docenteedit=selected.data('profesoresedit');

      $("#docente").val(titulo);
      $("#horas_alumno").val(horas + " Horas");
      $("#profesoredit").val(nom_docenteedit);

    $("#modificar_actalu").validate({
            rules:{
              actividad_alumnos: "required"
            }
      });
    });
</script>
@endsection
