@section('editar_planeacion')

<x-panel.modal id="modal_edit_planeacion" tamano="lg" sin-relleno aria-label="Modificación de Planeación">
    <x-slot:encabezado>
        <h3 id="myModalLabel" class="tw:text-lg tw:font-semibold tw:text-gray-800 tw:dark:text-white/90">Modificación de Planeación</h3>
    </x-slot:encabezado>

    <form id="modificar_planeacion" role="form" method="POST" action="/planeacion_actividad/{{ $planeacion->id_reg_coordinador}}" enctype="multipart/form-data"
          class="tw:[&_label.error]:mt-1.5 tw:[&_label.error]:block tw:[&_label.error]:text-sm tw:[&_label.error]:text-red-600 tw:dark:[&_label.error]:text-red-400">
        <input type="hidden" name="_method" value="PUT">
        {{csrf_field()}}
        <input name="fecha" type="hidden" id="fecha" value="{{ date('Y/m/d') }}">
        <input type="hidden" name="oculto" id="oculto" value="">

        <div class="tw-modal-cuerpo">
            <div class="tw:grid tw:grid-cols-1 tw:gap-4 tw:md:grid-cols-2">
                <x-panel.input etiqueta="Número de evidencias" id="editar_evidencias_doc" name="evidencias_doc" type="text"
                               value="{{$planeacion->no_evidencias}}" placeholder="Evidencias" />

                <div class="tw:space-y-3">
                    <x-panel.input etiqueta="Archivo actual" value="{{$planeacion->rubrica}}" type="text" id="nombre" name="nombre" />
                    <p id="demo"></p>
                    <x-panel.checkbox name="mayor_edad" value="1" id="si">Deseo cambiar el archivo</x-panel.checkbox>

                    <div id="formulariomayores" style="display: none;">
                        <x-panel.input etiqueta="Rúbrica de evaluación (.pdf)" type="file" name="urlImg" id="urlImg" accept=".pdf" required />
                    </div>
                </div>
            </div>
        </div>

        <x-panel.modal-pie>
            <x-panel.boton variante="secundario" data-dismiss="modal">Cancelar</x-panel.boton>
            <x-panel.boton type="submit" id="modifica_planeacion">Guardar</x-panel.boton>
        </x-panel.modal-pie>
    </form>
</x-panel.modal>


<script>
  $(document).ready(function(){
        $("#si").click(function(evento){
          $("#formulariomayores").css("display", "block");
      
   });


  $("#modal_edit_planeacion").modal("show");

    $("#modifica_planeacion").click(function(event){
      if($('input[name=mayor_edad]').is(':checked')){
            
            var valor=1;

            $('#oculto').val(valor);    
        }
        else
        {
           var valor=2;
           $('#oculto').val(valor);
         
        }

    $("#modificar_planeacion").submit();
        });
          $("#modificar_planeacion").validate({
            rules:{
              evidencias_doc: 
              {
                required:true,
                digits: true,
                minlength: 1,
                maxlength:1,
              },
              actividad_docen: "required",
            },

    
      });


  });   
</script>
@endsection