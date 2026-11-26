<form id="form_modificar_profesores_ingles" action="{{url("/constancia_alumno_editado/".$comentario->id_adeudo_departamento)}}" class="" role="form" method="POST">
    {{ csrf_field() }}
    <div clas="row">
        <div class="tw:w-full tw:px-2">
            <p>No. Cuenta: {{ $comentario->cuenta }}</p>
           <p>Nombre del Estudiante: {{ $comentario->nombre }} {{ $comentario->apaterno }} {{ $comentario->amaterno }}</p>
        </div>
    </div>
    <div clas="row">
        <div class="tw:w-full tw:px-2">
            <div class="tw:mb-4">
                <label for="nombre_docente">Comentario</label>
                <textarea class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500" type="text" id="comentario" name="comentario"  required>{{  $comentario->comentario }}</textarea>
     </div>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cancelar</button>
            <button  type="submit" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-brand-500 tw:text-white tw:shadow-theme-xs tw:hover:bg-brand-600 tw:disabled:bg-brand-300 tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap">Guardar</button>
        </div>
    </div>
</form>