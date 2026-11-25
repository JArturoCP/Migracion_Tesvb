@extends('layouts.panel')
@section('title', 'Requisiciones de materiales del anteproyecto')

@include('partials.panel.recursos_app')

@section('content')
    <x-panel.encabezado
        titulo="REQUISICIONES DE MATERIALES DEL ANTEPROYECTO"
        pagina-actual="Registrar requisición de materiales"
        :migas="['Req. de Mat. Anteproyecto' => url('/presupuesto_anteproyecto/registrar_requerimientos_anteproyecto')]"
    />

    <x-panel.tarjeta :titulo="'Requisiciones de materiales '.$year">
        <div class="tw:space-y-4">
            @if ($estado_periodo == 0)
                <x-panel.alerta tipo="advertencia">
                    No se ha registrado el periodo de envío de requisiciones de materiales.
                </x-panel.alerta>
            @elseif ($estado_fecha == 1)
                @if ($registros == null)
                    <x-panel.boton data-toggle="modal" data-target="#modal_envia_requisicion">
                        Iniciar envío de requisiciones de materiales
                    </x-panel.boton>
                @else
                    @if ($registros->id_estado_requisicion == 0)
                        <p>Año de las requisiciones de materiales del anteproyecto: {{ $registros->year_requisicion }}</p>
                        <x-panel.boton :href="url('/presupuesto_anteproyecto/registro_inicio_req_ant/'.$registros->id_req_mat_ante)">
                            Registrar requisiciones de materiales
                        </x-panel.boton>
                    @endif

                    @if ($registros->id_estado_requisicion == 1)
                        <x-panel.alerta tipo="exito">
                            Se enviaron correctamente tus requisiciones de materiales del anteproyecto: {{ $registros->year_requisicion }}
                        </x-panel.alerta>
                    @endif

                    @if ($registros->id_estado_requisicion == 2)
                        <p>Año de requisiciones de materiales de anteproyecto: {{ $registros->year_requisicion }}</p>
                        <x-panel.alerta tipo="advertencia">
                            Hacer las modificaciones correspondientes que aparecen en los comentarios al ingresar
                        </x-panel.alerta>
                        <x-panel.boton variante="exito" :href="url('/presupuesto_anteproyecto/modificar_requisicones/'.$registros->id_req_mat_ante)">
                            Modificaciones de requisiciones de materiales
                        </x-panel.boton>
                    @endif

                    @if ($registros->id_estado_requisicion == 3)
                        <x-panel.alerta tipo="exito">
                            Se enviaron correctamente tus modificaciones de tus requisiciones de materiales del anteproyecto: {{ $registros->year_requisicion }}
                        </x-panel.alerta>
                    @endif

                    @if ($registros->id_estado_requisicion == 4)
                        <x-panel.alerta tipo="exito">
                            Tus requisiciones ya fueron revisadas.
                        </x-panel.alerta>
                        <p>Año de requisiciones de materiales de anteproyecto: {{ $registros->year_requisicion }}</p>
                        <p>Ver las requisiciones autorizadas</p>
                        <x-panel.boton variante="exito" :href="url('/presupuesto_anteproyecto/ver_requisiciones_autorizadas/'.$registros->id_req_mat_ante)">
                            Requisiciones de materiales
                        </x-panel.boton>
                    @endif
                @endif
            @elseif ($estado_fecha == 2)
                @php
                    $fecha_inicio = date('d-m-Y', strtotime($periodo->fecha_inicio));
                    $fecha_final = date('d-m-Y', strtotime($periodo->fecha_final));
                @endphp

                <x-panel.alerta tipo="advertencia">
                    El periodo todavía no empieza o ya terminó. Las fechas establecidas para el envío de requisiciones de materiales son del {{ $fecha_inicio }} al {{ $fecha_final }}.
                </x-panel.alerta>
            @elseif ($estado_fecha == 3)
                <x-panel.alerta tipo="advertencia">
                    El periodo ya fue finalizado por la Dirección de Administración y Finanzas.
                </x-panel.alerta>
            @endif
        </div>
    </x-panel.tarjeta>

    @if ($estado_periodo != 0 && $estado_fecha == 1 && $registros == null)
        <x-panel.modal id="modal_envia_requisicion" titulo="Notificación de inicio de envío" aria-label="Notificación de inicio de envío">
            <form id="form_envio" class="form" action="{{ url('/presupuesto_anteproyecto/registrar_inicio_req_ant/') }}" role="form" method="POST">
                {{ csrf_field() }}
                <p>Iniciar envío de requisiciones de materiales</p>
            </form>

            <x-slot:pie>
                <x-panel.boton variante="secundario" data-dismiss="modal">Cerrar</x-panel.boton>
                <x-panel.boton id="guardar_envio">Aceptar</x-panel.boton>
            </x-slot:pie>
        </x-panel.modal>
    @endif
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready( function() {
            $("#guardar_envio").click(function (){
                $("#form_envio").submit();
                $("#guardar_envio").attr("disabled", true);
            });
        });
    </script>
@endpush
