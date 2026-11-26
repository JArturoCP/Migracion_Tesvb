<h3 class="tw:mb-4 tw:text-center tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90"><p>NÚMERO DE SOLICITUD:<b>{{ $solicitud->numero_solicitud }}</b> </p>
                <p>DEPARTAMENTO O JEFATURA: <b> {{ $solicitud->nom_departamento }}</b> </p>
                <p>NOMBRE DEL PROYECTO:  <b>{{ $solicitud->nombre_proyecto }}</b> </p>
                <p>AÑO DEL PRESUPUESTO:  <b>{{ $solicitud->year_presupuesto }}</b></p>
                <p>DESCRIPCIÓN DE SOLICITUD: <b>{{ $solicitud->descripcion_solicitud }}</b> </p></h3>
<form id="form_guardar_eliminacion_solicitud" class="" action="{{url("/presupuesto_autorizado/guardar_eliminacion_solicitud/".$solicitud->id_solicitud)}}" role="form" method="POST" >
    {{ csrf_field() }}
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <h4 class="tw:mb-3 tw:text-base tw:font-semibold tw:text-gray-800 tw:dark:text-white/90 tw:text-center">¿Segura (o) que quiere eliminar la solicitud?</h4>
        </div>
    </div>
</form>


