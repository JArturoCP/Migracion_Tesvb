<section class="td-hero{{ $estudiante['logo'] ? ' td-hero--logo' : '' }}" aria-labelledby="estudiante-saludo">
    <svg class="td-hero-waves" aria-hidden="true" focusable="false" viewBox="0 0 1100 300" preserveAspectRatio="none">
        <path fill="currentColor" opacity=".08" d="M0 270C210 305 315 170 510 171c220 1 318 111 590-104v233H0Z"/>
        <path fill="currentColor" opacity=".07" d="M326 300c157-118 308-52 458-110C919 137 967 82 1100 29v271Z"/>
        <path fill="none" stroke="currentColor" stroke-opacity=".18" d="M0 267C210 302 315 165 510 166c220 1 318 111 590-104"/>
    </svg>
    @if($estudiante['mascota'])
        <img src="{{ $estudiante['mascota'] }}" class="td-mascot" alt="" width="320" height="320" decoding="async">
    @endif
    <div class="td-hero-copy">
        <p class="td-label">Portal estudiantil TESVB</p>
        <h1 id="estudiante-saludo">{{ $estudiante['nombre'] ? 'Hola, '.$estudiante['nombre'] : 'Te damos la bienvenida' }}</h1>
        @include('panel.dashboard.estudiante.identidad')
        <dl class="td-meta">
            @if($estudiante['semestre'])
                <div><dt>Semestre registrado</dt><dd>{{ $estudiante['semestre'] }}</dd></div>
            @endif
            <div><dt>Periodo seleccionado</dt><dd>{{ $estudiante['periodo'] ?? 'No disponible' }}</dd></div>
        </dl>
    </div>
    @if($estudiante['logo'])
        <img src="{{ $estudiante['logo'] }}" class="td-logo" alt="" width="132" height="132" decoding="async">
    @endif
</section>
