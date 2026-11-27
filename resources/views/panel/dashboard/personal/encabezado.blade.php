
{{--
    Encabezado de los dashboards del PERSONAL: el mismo del alumno (x-panel.hero + estilos td-* de
    panel/dashboard/estudiante/estilos), con el alcance [data-panel-hero] y el logo TESVB, en su variante COMPACTA:
    sin avatar de iniciales ni etiqueta, el saludo en una sola fila en escritorio. Misma fuente, colores, fondo y
    decoración. Los estilos solo aplican a [data-panel-hero] (el alumno no cambia).
    Lo usan panel/dashboard/{consultas,finanzas,titulacion,residencia,computo,rh,escolar,desarrollo,jefe_division,docente}/encabezado.

    $tituloId: id del <h1>; $identidad: texto bajo el nombre (departamento); $meta: [etiqueta => valor] (null no se muestra).
    El nombre se muestra tal como está en la sesión (gnral_personales.nombre), igual que la bienvenida anterior.
--}}
<?php
$nombrePersonal = trim((string) Session::get('nombre'));
$nombreVisible = $nombrePersonal !== '' ? $nombrePersonal : null;
$logoTesvb = is_file(public_path('img/TESVB.png')) ? asset('img/TESVB.png') : null;
?>
@push('cabeza')
    @include('panel.dashboard.estudiante.estilos', ['alcanceTd' => '[data-panel-hero]'])
    <style>
        [data-panel-hero] .td-hero--compacto {
            min-height: 0;
            gap: .75rem;
            padding: clamp(2.25rem, 4cqi, 2.85rem) clamp(1.15rem, 3.6cqi, 2.25rem);
            align-items: center;
        }
        [data-panel-hero] .td-hero--compacto .td-hero-copy { max-width: none; min-width: 0; }
        [data-panel-hero] .td-hero--compacto h1 {
            margin: 0 0 .3rem;
            font-size: clamp(1.25rem, 3cqi, 1.9rem);
            line-height: 1.15;
            letter-spacing: -.025em;
        }
        [data-panel-hero] .td-hero--compacto .td-career { font-size: clamp(.95rem, 1.6cqi, 1.05rem); }
        [data-panel-hero] .td-hero--compacto .td-meta { margin-top: 1rem; align-items: stretch; }
        @container (min-width: 34rem) {
            [data-panel-hero] .td-hero--compacto.td-hero--logo { grid-template-columns: minmax(0, 1fr) 6.25rem; }
            [data-panel-hero] .td-hero--compacto .td-logo { width: 6.25rem; height: 6.25rem; }
        }
        /* Escritorio: el saludo en una sola fila; si un nombre muy largo no cupiera, se recorta sin romper el diseño. */
        @container (min-width: 48rem) {
            [data-panel-hero] .td-hero--compacto h1 { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        }
    </style>
@endpush
<div class="tw:col-span-12" data-panel-hero data-panel-bienvenida style="--td-accent: #153653">
    <x-panel.hero :titulo-id="$tituloId"
                  :titulo="$nombreVisible ? 'Hola, '.$nombreVisible : 'Te damos la bienvenida'"
                  :meta="$meta"
                  :logo="$logoTesvb"
                  :compacto="true">
        <x-slot:identidad>
            <p class="td-career" data-identidad-departamento>{{ $identidad }}</p>
        </x-slot:identidad>
    </x-panel.hero>
</div>
