<h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>NÚMERO DE SOLICITUD:<b>{{ $solicitud->numero_solicitud }}</b> </p>
        <p>DEPARTAMENTO O JEFATURA: <b> {{ $solicitud->nom_departamento }}</b> </p>
        <p>NOMBRE DEL PROYECTO:  <b>{{ $solicitud->nombre_proyecto }}</b> </p>
                <p>AÑO DEL PRESUPUESTO:  <b>{{ $solicitud->year_presupuesto }}</b></p>
                <p>DESCRIPCIÓN DE LA SOLICITUD: <b>{{ $solicitud->descripcion_solicitud }}</b> </p></h3>
<form id="form_enviar_partida_solicitud" class="" action="{{url("/presupuesto_autorizado/guardar_enviar_solicitud/".$solicitud->id_solicitud)}}" role="form" method="POST" >
    {{ csrf_field() }}
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="contar_req" name="contar_req" type="hidden"  value="{{ $contar_req }}" required>
    <input class="tw:w-full tw:rounded-lg tw:border tw:border-gray-300 tw:dark:border-gray-700 tw:bg-transparent tw:px-4 tw:py-2.5 tw:text-sm tw:text-gray-800 tw:dark:text-white/90 tw:shadow-theme-xs tw:placeholder:text-gray-400 tw:focus:border-brand-300 tw:focus:ring-3 tw:focus:ring-brand-500/10 tw:focus:outline-hidden tw:disabled:bg-gray-50 tw:disabled:text-gray-500 tw:h-11" id="presupuesto_dado" name="presupuesto_dado" type="hidden"  value="{{ $presupuesto_dado }}" required>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
     <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">¿Segura (o) que quiere enviar la solicitud?</h4>
    </div>
</div>
</form>