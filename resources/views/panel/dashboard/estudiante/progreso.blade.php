@php($acreditados = $progreso['complementarios']['acreditados'])

<section aria-labelledby="progreso-academico" class="td-section">
    <h2 id="progreso-academico" class="td-heading">Mi progreso académico</h2>
    <div class="td-credits">
        <div class="td-stat">
            <h3>Avance total</h3>
            <p class="td-count">@if($progreso['requisito_total'] === null)
                    <strong>Por verificar</strong>
                @else
                    <strong>{{ $progreso['requisito_total'] }}</strong> <span class="td-muted">créditos requeridos</span>
                @endif</p>
            <p class="td-pill">Avance por verificar</p>
        </div>
        <div class="td-stat">
            <h3>Créditos académicos</h3>
            <p class="td-count">@if($progreso['requisito_academico'] === null)
                    <strong>Por verificar</strong>
                @else
                    <strong>{{ $progreso['requisito_academico'] }}</strong> <span class="td-muted">requeridos</span>
                @endif</p>
            <p class="td-pill">Acreditados y restantes por verificar</p>
        </div>
        <div class="td-stat">
            <h3>Créditos complementarios</h3>
            <p class="td-count">
                @if($acreditados !== null)
                    <strong>{{ $acreditados }}</strong> <span class="td-muted">de {{ $progreso['requisito_complementario'] }} acreditados</span>
                @else
                    @if($progreso['requisito_complementario'] === null)
                    <strong>Por verificar</strong>
                @else
                    <strong>{{ $progreso['requisito_complementario'] }}</strong> <span class="td-muted">requeridos</span>
                @endif
                @endif
            </p>
            <div class="td-segments" aria-hidden="true">
                @for($segmento = 1; $segmento <= $progreso['requisito_complementario']; $segmento++)
                    <span @class(['is-earned' => $acreditados !== null && $segmento <= $acreditados])></span>
                @endfor
            </div>
            <p>
                <span @class(['td-pill', 'td-pill--success' => $acreditados !== null, 'td-pill--pending' => $acreditados === null])>{{ $progreso['complementarios']['estado'] }}</span>
                @if($acreditados !== null)
                    <span class="td-muted">{{ $progreso['requisito_complementario'] - $acreditados }} restantes</span>
                @endif
            </p>
        </div>
    </div>
</section>
