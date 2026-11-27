{{--
    Encabezado grande del dashboard ("hero"): el del portal estudiantil (panel/dashboard/estudiante/bienvenida),
    reutilizable por otros perfiles con el mismo diseño. Usa las clases td-* de panel/dashboard/estudiante/estilos,
    que se incluyen con el alcance del contenedor: [data-panel-estudiante] (alumno) o [data-panel-hero] (personal).

    <x-panel.hero etiqueta="Portal estudiantil TESVB" titulo="Hola, Ana" titulo-id="estudiante-saludo"
                  :meta="['Semestre registrado' => 'PRIMERO', 'Periodo seleccionado' => 'AGO 2026']"
                  :mascota="$urlMascota" :logo="$urlLogo" iniciales="AK">
        <x-slot:identidad><p class="td-career">INGENIERÍA…</p></x-slot:identidad>
    </x-panel.hero>

    meta: [etiqueta => valor]; los valores null no se muestran. iniciales (opcional): círculo con iniciales.
    etiqueta (opcional): texto pequeño sobre el saludo. compacto (opcional): variante compacta (clase td-hero--compacto,
    sus estilos los da quien la usa; el personal: panel/dashboard/personal/encabezado). Sin estas dos, el HTML es el de
    siempre (el del alumno no cambia).
--}}
@props(['etiqueta' => null, 'titulo', 'tituloId' => 'panel-hero-saludo', 'meta' => [], 'mascota' => null, 'logo' => null, 'iniciales' => null, 'compacto' => false])
<section class="td-hero{{ $logo ? ' td-hero--logo' : '' }}{{ $compacto ? ' td-hero--compacto' : '' }}" aria-labelledby="{{ $tituloId }}">
    <svg class="td-hero-waves" aria-hidden="true" focusable="false" viewBox="0 0 1100 300" preserveAspectRatio="none">
        <path fill="currentColor" opacity=".08" d="M0 270C210 305 315 170 510 171c220 1 318 111 590-104v233H0Z"/>
        <path fill="currentColor" opacity=".07" d="M326 300c157-118 308-52 458-110C919 137 967 82 1100 29v271Z"/>
        <path fill="none" stroke="currentColor" stroke-opacity=".18" d="M0 267C210 302 315 165 510 166c220 1 318 111 590-104"/>
    </svg>
    @if($mascota)
        <img src="{{ $mascota }}" class="td-mascot" alt="" width="320" height="320" decoding="async">
    @endif
    <div class="td-hero-copy">
        @if($iniciales)
            <span class="td-avatar" aria-hidden="true">{{ $iniciales }}</span>
        @endif
        @if($etiqueta !== null)
            <p class="td-label">{{ $etiqueta }}</p>
        @endif
        <h1 id="{{ $tituloId }}">{{ $titulo }}</h1>
        {{ $identidad ?? '' }}
        <dl class="td-meta">
            @foreach($meta as $dt => $dd)
                @if($dd !== null)
                    <div><dt>{{ $dt }}</dt><dd>{{ $dd }}</dd></div>
                @endif
            @endforeach
        </dl>
    </div>
    @if($logo)
        <img src="{{ $logo }}" class="td-logo" alt="" width="132" height="132" decoding="async">
    @endif
</section>
