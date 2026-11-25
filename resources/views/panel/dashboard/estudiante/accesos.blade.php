<section aria-labelledby="estudiante-accesos">
    <h2 id="estudiante-accesos" class="td-heading">Accesos rápidos</h2>
    <ul class="td-access-grid">
        @foreach($estudiante['accesos'] as $acceso)
            <li>
                @if($acceso['url'])
                    <a href="{{ $acceso['url'] }}" class="td-access">
                        @include('panel.dashboard.estudiante.acceso', ['detalle' => $acceso['detalle']])
                    </a>
                @else
                    <div class="td-access">
                        @include('panel.dashboard.estudiante.acceso', ['detalle' => 'Acceso no disponible'])
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</section>
