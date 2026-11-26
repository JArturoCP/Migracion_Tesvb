<div class="tw:-mx-2 tw:flex tw:flex-wrap tw:gap-y-4 tw:not-last:mb-4">
    <div class="tw:w-full tw:px-2">
        @if( $comentario_portada == 0)
            <x-panel.alerta tipo="error" class="tw:mb-4">
                No hay ningún comentario
            </x-panel.alerta>

        @else
        @foreach($comentarios_profesores as $comentario_prof )
                @if($comentario_prof->id_estado_evaluacion==1)
            <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center"> <b>NOMBRE DEL DOCENTE:</b> {{$comentario_prof->nombre}}<br>
                        <b>STATUS DEL ANTEPROYECTO: </b>AUTORIZADO
                </div>
                <div class="tw:p-5 tw:sm:p-6">
                    {{$comentario_prof->comentario}}

                </div>
            </div>
                @elseif($comentario_prof->id_estado_evaluacion==2)
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center"> <b>NOMBRE DEL DOCENTE:</b> {{$comentario_prof->nombre}}<br>

                                <b>STATUS DEL ANTEPROYECTO: </b>AUTORIZADO CON CAMBIOS

                        </div>
                        <div class="tw:p-5 tw:sm:p-6">
                            {{$comentario_prof->comentario}}

                        </div>
                    </div>
                @elseif($comentario_prof->id_estado_evaluacion==3)
                    <div class="tw:mb-4 tw:rounded-2xl tw:border tw:border-gray-200 tw:dark:border-gray-800 tw:bg-white tw:dark:bg-white/[0.03]">
                        <div class="tw:rounded-t-2xl tw:border-b tw:border-gray-100 tw:dark:border-gray-800 tw:bg-gray-50 tw:dark:bg-gray-900 tw:px-5 tw:py-4 tw:text-center"> <b>NOMBRE DEL DOCENTE:</b> {{$comentario_prof->nombre}}<br>

                            <b>STATUS DEL ANTEPROYECTO: </b>RECHAZADO

                        </div>
                        <div class="tw:p-5 tw:sm:p-6">
                            {{$comentario_prof->comentario}}

                        </div>
                    </div>
                @endif
        @endforeach
            @endif
    </div>
</div>
