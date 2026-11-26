<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <p class="tw:w-full"></p>
</div>
<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">

        <div class="tw:w-full tw:px-2 tw:text-center" >
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:p-5 tw:sm:p-6">
        <p class="tw:text-center" >{{$nombre_alum}}</p>
                </div>
            </div>
        </div>
</div>
            @if($adeudo == 0)
                <x-panel.alerta tipo="exito" class="tw:mb-4">No tiene adeudo</x-panel.alerta>
        <?php
        $id_unidad_admin = Session::get('id_unidad_admin');
        $escolar = session()->has('escolar') ? session()->has('escolar') : false;
        ?>
        @if($id_unidad_admin == 16 || $escolar == true )
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2 tw:text-center" >
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/constancia_certificado_credencial_no_adeudo/'.$id_alumno.'/1')}}')">CERTIFICADO</a></div>

                        </div>
                    </div>
                </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2 tw:text-center" >
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/constancia_certificado_credencial_no_adeudo/'.$id_alumno.'/2')}}')">CREDENCIAL</a></div>

                        </div>
                    </div>
                </div>
            @else
            @if($adeudo_encuesta == 0)
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2 tw:text-center" >
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                            <div class="tw:p-5 tw:sm:p-6"><a class="tw:text-brand-500 tw:hover:underline" href="#"
                                                       onclick="window.open('{{url('/constancia_titulacion_noadeudo/'.$id_alumno)}}')">Titulación</a></div>

                        </div>
                    </div>
                </div>
            @else
                <x-panel.alerta tipo="error" class="tw:mb-4">Tiene adeudo con el departamento de bolsa de trabajo y seguimiento de egresados: debe la firma de encuesta<br></x-panel.alerta>
                @endif
            @endif
            @else
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <div class="tw:w-full tw:px-2">
                        <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4">
                            <h3 class="tw:text-base tw:font-medium tw:text-gray-800 tw:dark:text-white/90 tw:text-center">Tiene adeudo con los siguientes departamentos o carreras:</h3>
                            @foreach($departamento_carrera as $departamento_carrera)
                                <p class="tw:text-center" >{{$departamento_carrera['nombre']}}:- {{$departamento_carrera['comentario']}}</p>
                            @endforeach
                            @if($adeudo_encuesta == 0)
                            @else
                                <x-panel.alerta tipo="error" class="tw:mb-4">Tiene adeudo con el departamento de bolsa de trabajo y seguimiento de egresados: debe la firma de encuesta<br></x-panel.alerta>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            @endif
    <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
        <div class="tw:w-full tw:px-2">
            <button type="button" class="tw:inline-flex tw:cursor-pointer tw:items-center tw:justify-center tw:rounded-lg tw:font-medium tw:transition tw:disabled:cursor-not-allowed tw:bg-white tw:text-gray-700 tw:ring-1 tw:ring-gray-300 tw:ring-inset tw:shadow-theme-xs tw:hover:bg-gray-50 tw:dark:bg-gray-800 tw:dark:text-gray-400 tw:dark:ring-gray-700 tw:dark:hover:bg-white/[0.03] tw:gap-2 tw:px-4 tw:py-2.5 tw:text-sm tw:whitespace-nowrap" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
                <div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
                    <p class="tw:w-full"></p>
                </div>