@extends('layouts.panel')
@section('title', 'Requisiciones del presupuesto autorizado')

@section('content')
    <x-panel.encabezado
        titulo="REQUISICIONES DEL PRESUPUESTO AUTORIZADO"
        pagina-actual="Registrar requisiciones"
        :migas="['Solicitudes del presupuesto autorizado' => url('/presupuesto_autorizado/agregar_req_solicitud_autorizadas')]"
    />

    <x-panel.tarjeta
        titulo="Solicitudes de requisiciones autorizadas"
        subtitulo="Registrar documentación a las solicitudes de requisiciones del presupuesto autorizado"
    >
        <div class="tw:space-y-4">
            @forelse ($solicitudes as $solicitud)
                <x-panel.tarjeta>
                    <div class="tw:space-y-4">
                        <dl class="tw:space-y-2 tw:wrap-break-word">
                            <div>
                                <dt class="tw:inline tw:font-semibold">Solicitud:</dt>
                                <dd class="tw:inline">{{ $solicitud->descripcion_solicitud }}</dd>
                            </div>
                            <div>
                                <dt class="tw:inline tw:font-semibold">Proyecto:</dt>
                                <dd class="tw:inline">{{ $solicitud->nombre_proyecto }}</dd>
                            </div>
                            <div>
                                <dt class="tw:inline tw:font-semibold">Meta:</dt>
                                <dd class="tw:inline">{{ $solicitud->meta }}</dd>
                            </div>
                            <div>
                                <dt class="tw:inline tw:font-semibold">Mes:</dt>
                                <dd class="tw:inline">{{ $solicitud->mes }}</dd>
                            </div>
                        </dl>

                        @if ($solicitud->id_estado_enviado == 1)
                            <x-panel.alerta tipo="advertencia">Registrar la documentación correspondiente</x-panel.alerta>
                            <x-panel.boton :href="url('/presupuesto_autorizado/registrar_documentacion_solicitud/'.$solicitud->id_solicitud)">
                                Registrar datos en la solicitud
                            </x-panel.boton>
                        @elseif ($solicitud->id_estado_enviado == 3)
                            <x-panel.alerta tipo="error" titulo="Comentario">{{ $solicitud->comentario_solicitud }}</x-panel.alerta>
                            <x-panel.boton :href="url('/presupuesto_autorizado/registrar_documentacion_solicitud/'.$solicitud->id_solicitud)">
                                Modificar datos en la solicitud
                            </x-panel.boton>
                        @elseif ($solicitud->id_estado_enviado == 2)
                            <x-panel.alerta tipo="exito">Se envió correctamente la solicitud</x-panel.alerta>
                        @elseif ($solicitud->id_estado_enviado == 4)
                            <x-panel.alerta tipo="exito">Solicitud autorizada</x-panel.alerta>
                            <x-panel.boton :href="url('/presupuesto_autorizado/ver_documentacion_solicitud_aut/'.$solicitud->id_solicitud)">
                                Ver datos de la solicitud
                            </x-panel.boton>
                        @endif
                    </div>
                </x-panel.tarjeta>
            @empty
                <x-panel.vacio titulo="Sin solicitudes de requisiciones para mostrar" />
            @endforelse
        </div>
    </x-panel.tarjeta>
@endsection
