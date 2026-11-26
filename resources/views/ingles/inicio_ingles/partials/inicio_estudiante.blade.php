<div class="ingles-estudiante">
    @include('ingles.inicio_ingles.partials.bienvenida')

    @if(filled($men))
        <div class="ingles-estudiante__aviso" data-panel-avisos>
            <p data-panel-aviso="men">{{ $men }}</p>
        </div>
    @endif

    <nav aria-labelledby="ingles-accesos" data-panel-accesos>
        <h2 id="ingles-accesos">Accesos</h2>
        <ul class="ingles-estudiante__cuadricula">
            @foreach($accesosEstudiante as [$texto, $href, $icono])
                <li>
                    <a class="ingles-estudiante__acceso" href="{{ $href }}">
                        <span class="ingles-estudiante__icono" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="{{ $icono }}"/></svg>
                        </span>
                        <span>{{ $texto }}</span>
                        <svg class="ingles-estudiante__flecha" viewBox="0 0 24 24" aria-hidden="true"><path d="m9 6 6 6-6 6"/></svg>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>