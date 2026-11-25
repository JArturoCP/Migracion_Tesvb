@extends('layouts.panel')
@section('title', 'Solicitudes autorizadas liberadas')

@section('content')
    <x-panel.encabezado
        titulo="SOLICITUDES AUTORIZADAS LIBERADAS"
        pagina-actual="Solicitudes autorizadas liberadas"
        :migas="['Solicitudes del presupuesto autorizado' => url('/presupuesto_autorizado/agregar_req_solicitud_autorizadas')]"
    />

    <x-panel.tarjeta titulo="Solicitudes de requisiciones liberadas">
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

                        <x-panel.boton :href="url('/presupuesto_autorizado/ver_docu_solicitud_aut_departamento/'.$solicitud->id_solicitud)">
                            Ver datos de la solicitud
                        </x-panel.boton>
                    </div>
                </x-panel.tarjeta>
            @empty
                <x-panel.vacio titulo="No hay solicitudes autorizadas liberadas para mostrar." />
            @endforelse
        </div>
    </x-panel.tarjeta>
@endsection
