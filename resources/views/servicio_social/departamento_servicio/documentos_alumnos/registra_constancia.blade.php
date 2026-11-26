<form id="formulario_carta_presentacion" action="{{url("/servicio_social/guardar_carta_presentacion/")}}" role="form" method="POST" enctype="multipart/form-data" >
    {{ csrf_field() }}
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">

                      <p><b>No. Cuenta: </b> {{$registro[0]->cuenta}}  <b>      Nombre del alumno:</b> {{$registro[0]->nombre}} {{$registro[0]->apaterno}} {{$registro[0]->amaterno}}</p>
                      <label for="nombre_proyecto">Agregar pdf de  la Carta de Presentación-Aceptación.<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
                      <input type="hidden"  id="id_alumno" name="id_alumno" value="{{{$registro[0]->id_alumno}}}"   required/>
                        <input class="tw:h-11 tw:w-full tw:overflow-hidden tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:text-sm tw:text-gray-500 tw:dark:text-gray-400 tw:shadow-theme-xs tw:file:mr-5 tw:file:border-0 tw:file:border-r tw:file:border-solid tw:file:border-gray-200 tw:file:bg-gray-50 tw:file:py-3 tw:file:pr-3 tw:file:pl-3.5 tw:file:text-sm tw:file:text-gray-700 tw:hover:file:bg-gray-100 tw:focus:outline-hidden"  id="pdf_documento_carta" name="pdf_documento_carta" type="file"   accept="application/pdf" required/>

                    </p>



    </div>
</div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <label for="nombre_proyecto">Seleccionar el Periodo que se registrara el estudiante<b class="tw:text-red-600 tw:dark:text-red-400 tw:text-lg">*</b></label>
            <select class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="id_periodo" name="id_periodo" required>
                <option disabled selected hidden>Selecciona una opción</option>
                @foreach($periodos as $periodos)
                        <option value="{{$periodos->id_periodo}}"> {{$periodos->periodo }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <p></p>
        </div></div>

</form>
