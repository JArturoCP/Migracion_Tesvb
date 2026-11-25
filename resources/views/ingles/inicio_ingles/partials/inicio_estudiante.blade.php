<div class="ingles-estudiante">
    <section class="ingles-estudiante__banner" data-panel-bienvenida aria-labelledby="ingles-bienvenida">
        <img class="ingles-estudiante__arte" src="{{ asset('img/ingles/banderas-inicio.svg') }}" alt="" width="900" height="360">
        <div class="ingles-estudiante__bienvenida">
            <p class="ingles-estudiante__portal">Portal de Inglés TESVB</p>
            <h1 id="ingles-bienvenida">{{ filled($nombre) ? 'Hello, ' . $nombre . '!' : 'Welcome!' }}</h1>
            <p class="ingles-estudiante__periodo">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M8 3v4m8-4v4M4 10h16M6 5h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/></svg>
                <span>{{ filled($nombre_periodo) ? 'Periodo de Inglés: ' . $nombre_periodo : 'Periodo de Inglés no disponible' }}</span>
            </p>
        </div>
    </section>

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