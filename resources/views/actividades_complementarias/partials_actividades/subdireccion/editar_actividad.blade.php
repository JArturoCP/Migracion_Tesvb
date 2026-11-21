<x-panel.modal id="modal_edit_activad" tamano="lg" sin-relleno aria-labelledby="titulo_editar_actividad">
    <x-slot:encabezado>
        <h3 id="titulo_editar_actividad" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Modificación de Actividad</h3>
    </x-slot:encabezado>

    <form id="modificar_actividad" role="form" method="POST" action="/nueva_actividad/{{ $actividad->id_actividad_comple}}" novalidate
          class="tw:[&_label.error]:mt-1.5 tw:[&_label.error]:block tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600 tw:dark:[&_label.error]:text-red-400">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="tw-modal-cuerpo">
            <div class="tw:grid tw:gap-4 tw:md:grid-cols-2">
                <x-panel.input etiqueta="Nombre de Actividad" id="editar_actividad_sub" type="text" name="actividad_sub"
                               value="{{$actividad->descripcion}}" :error="$errors->first('actividad_sub')" />

                <x-panel.select etiqueta="Categoría" id="editar_categoria_sub" name="categoria_sub" :error="$errors->first('categoria_sub')">
                    <option disabled selected hidden>Selecciona Opción...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{$categoria->id_categoria}}" @selected($actividad->id_categoria == $categoria->id_categoria)>{{$categoria->descripcion_cat}}</option>
                    @endforeach
                </x-panel.select>

                <x-panel.select etiqueta="Número de Horas" id="editar_horas_sub" name="horas_sub" :error="$errors->first('horas_sub')">
                    <option disabled selected hidden>Selecciona Opción...</option>
                    @if($actividad->horas == 20)
                        <option value="20" selected>20</option>
                        <option value="40">40</option>
                    @else
                        <option value="40" selected>40</option>
                        <option value="20">20</option>
                    @endif
                </x-panel.select>

                <x-panel.select etiqueta="Departamento Encargado" id="editar_jefatura_sub" name="jefatura_sub" :error="$errors->first('jefatura_sub')">
                    <option disabled selected hidden>Selecciona Opción...</option>
                    @foreach($jefaturascar as $jefatura)
                        <option value="{{$jefatura->id_jefatura}}" @selected($actividad->id_jefatura == $jefatura->id_jefatura)>{{$jefatura->nom_jefatura}}</option>
                    @endforeach
                </x-panel.select>
            </div>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" id="modificaact_sub">Guardar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>


<script>
  $(document).ready(function(){

    $("#modal_edit_activad").modal("show");

  $("#modificaact_sub").click(function(event){
    
    $("#modificar_actividad").submit();
        
        });

          $("#modificar_actividad").validate({
            errorPlacement: function(error, element){
              error.insertAfter(element.is('select') ? element.parent() : element);
            },
            rules:{
              actividad_sub:
              {
                required: true,
                minlength: 8
              },
              categoria_sub:"required",
              horas_sub:"required",
              jefatura_sub:"required",
            },


      });


  });   
</script>
