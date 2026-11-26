<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <p><b>No. Cuenta: </b> {{$registro[0]->cuenta}}  <b>      Nombre del alumno:</b> {{$registro[0]->nombre}} {{$registro[0]->apaterno}} {{$registro[0]->amaterno}}</p>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <label>Ver  Carta de Presentación-Aceptación</label>
        <a  target="_blank" href="{{asset('/servicio_social_pdf/carta_presentacion/'.$datos_constancia[0]->pdf_constancia_presentacion)}}" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:disabled:opacity-60 tw:bg-white tw:text-brand-500 tw:ring-1 tw:ring-brand-300 tw:ring-inset tw:hover:bg-brand-50 tw:dark:bg-gray-800 tw:dark:text-brand-400 tw:dark:ring-brand-500/40 tw:dark:hover:bg-brand-500/10 tw:size-9 tw:text-base"><i class="fa fa-file"></i></a>
    </div>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        <p><b>Nombre del Periodo: </b>  {{$datos_constancia[0]->periodo}}</p>

    </div>
</div>