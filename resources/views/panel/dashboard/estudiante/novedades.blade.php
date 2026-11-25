<section aria-labelledby="estudiante-novedades" class="td-section td-news">
    <h2 id="estudiante-novedades" class="td-heading">Novedades y pendientes</h2>

    @if(!$estudiante['contexto'])
        <p class="td-empty td-muted" role="status">Los datos del periodo no están disponibles.</p>
    @elseif(!$novedades)
        <p class="td-empty td-muted">No hay novedades ni pendientes para mostrar.</p>
    @else
        <ul>
            @foreach($novedades as $novedad)
                <li>
                    <p @class(['td-pill', 'td-pill--pending' => $novedad['tipo'] === 'Pendiente', 'td-pill--info' => $novedad['tipo'] === 'Aviso institucional'])>{{ $novedad['tipo'] }}</p>
                    <p class="td-news-title">{{ $novedad['titulo'] }}</p>
                    @if(isset($novedad['detalle']))
                        <p class="td-muted">{{ $novedad['detalle'] }}</p>
                    @endif
                    @if(isset($novedad['url']))
                        <a href="{{ $novedad['url'] }}">Abrir {{ $novedad['titulo'] }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</section>
