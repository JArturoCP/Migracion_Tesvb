{{-- Estilos de las vistas estudiantiles de Inglés dentro del marco compartido. --}}
<style>
    .ingles-estudiante {
        --ingles-fondo: #f9fafb;
        --ingles-superficie: #fff;
        --ingles-texto: #101828;
        --ingles-secundario: #475467;
        --ingles-borde: #d0d5dd;
        --ingles-accion: var(--tema-visual-action, #3538cd);
        --ingles-accion-hover: var(--tema-visual-hover, #2d31a6);
        --ingles-foco: #3538cd;
        --ingles-info-fondo: #eff8ff;
        --ingles-info-texto: #1849a9;
        --ingles-exito-fondo: #ecfdf3;
        --ingles-exito-texto: #05603a;
        --ingles-error-fondo: #fef3f2;
        --ingles-error-texto: #912018;
        max-width: 1440px;
        min-width: 0;
        margin-inline: auto;
        padding: clamp(16px, 3vw, 32px);
        border-radius: 16px;
        background: var(--ingles-fondo);
        color: var(--ingles-texto);
        color-scheme: light;
    }
    .dark .ingles-estudiante {
        --ingles-fondo: #101828;
        --ingles-superficie: #1d2939;
        --ingles-texto: #f9fafb;
        --ingles-secundario: #d0d5dd;
        --ingles-borde: #667085;
        --ingles-foco: #a4bcfd;
        --ingles-info-fondo: #183453;
        --ingles-info-texto: #d1e9ff;
        --ingles-exito-fondo: #12392d;
        --ingles-exito-texto: #a6f4c5;
        --ingles-error-fondo: #471d20;
        --ingles-error-texto: #fecdca;
        color-scheme: dark;
    }
    .ingles-estudiante .ingles-titulo {
        margin: 0 0 20px;
        padding-inline-start: 14px;
        border-inline-start: 4px solid var(--tema-visual-color, #465fff);
        color: var(--ingles-texto);
        font-size: clamp(23px, 4vw, 30px);
        font-weight: 700;
        line-height: 1.25;
        overflow-wrap: anywhere;
    }
    .ingles-estudiante .ingles-tarjeta {
        max-width: 760px;
        padding: clamp(16px, 3vw, 24px);
        border: 1px solid var(--ingles-borde);
        border-radius: 14px;
        background: var(--ingles-superficie);
    }
    .ingles-estudiante .ingles-aviso {
        max-width: 760px;
        margin: 0 0 16px;
        padding: 14px 16px;
        border-radius: 12px;
        background: var(--ingles-info-fondo);
        color: var(--ingles-info-texto);
        overflow-wrap: anywhere;
    }
    .ingles-estudiante .ingles-aviso:last-child { margin-bottom: 0; }
    .ingles-estudiante .ingles-aviso--error {
        background: var(--ingles-error-fondo);
        color: var(--ingles-error-texto);
    }
    .ingles-estudiante .ingles-aviso--exito {
        background: var(--ingles-exito-fondo);
        color: var(--ingles-exito-texto);
    }
    .ingles-estudiante .ingles-acciones {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 20px;
    }
    .ingles-estudiante .ingles-campo { min-width: 0; margin-bottom: 16px; }
    .ingles-estudiante .ingles-campo:last-child { margin-bottom: 0; }
    .ingles-estudiante label {
        display: block;
        margin-bottom: 6px;
        color: var(--ingles-texto);
        font-weight: 600;
    }
    .ingles-estudiante .ingles-ayuda {
        margin: 6px 0 0;
        color: var(--ingles-secundario);
    }
    .ingles-estudiante .form-control:not([type="hidden"]) {
        display: block;
        width: 100%;
        min-height: 44px;
        height: auto;
        padding: 10px 12px;
        border: 1px solid var(--ingles-borde);
        border-radius: 8px;
        background: var(--ingles-superficie);
        color: var(--ingles-texto);
        font: inherit;
        box-shadow: none;
    }
    .ingles-estudiante .form-control::placeholder { color: var(--ingles-secundario); }
    .ingles-estudiante .form-control[type="file"] {
        padding: 8px;
        border-style: dashed;
    }
    .ingles-estudiante .form-control[type="file"]::file-selector-button {
        margin-inline-end: 10px;
        padding: 7px 9px;
        border: 0;
        border-radius: 6px;
        background: var(--ingles-info-fondo);
        color: var(--ingles-info-texto);
        font: inherit;
        cursor: pointer;
    }
    .ingles-estudiante .btn.ingles-boton {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 44px;
        max-width: 100%;
        padding: 9px 16px;
        border: 1px solid transparent;
        border-radius: 8px;
        background: var(--ingles-accion);
        color: #fff;
        font: inherit;
        font-weight: 600;
        white-space: normal;
        text-decoration: none;
    }
    .ingles-estudiante .btn.ingles-boton:is(:hover, :focus) {
        background: var(--ingles-accion-hover);
        color: #fff;
    }
    .ingles-estudiante .btn.ingles-boton--rojo { background: #a61b2b; }
    .ingles-estudiante .btn.ingles-boton--rojo:is(:hover, :focus) { background: #861222; }
    .ingles-estudiante .btn.ingles-boton--azul { background: #175cd3; }
    .ingles-estudiante .btn.ingles-boton--azul:is(:hover, :focus) { background: #1849a9; }
    .ingles-estudiante .btn.ingles-boton:disabled {
        border-color: var(--ingles-borde);
        background: var(--ingles-fondo);
        color: var(--ingles-secundario);
        opacity: 1;
        cursor: not-allowed;
    }
    .ingles-estudiante :is(a, button, input:not([type="hidden"]), select, [tabindex="0"]):focus-visible {
        outline: 2px solid var(--ingles-foco);
        outline-offset: 2px;
    }
    .ingles-estudiante.ingles-inicio { min-height: 128px; }
    .ingles-estudiante .modal-content {
        border: 1px solid var(--ingles-borde);
        border-radius: 16px;
        background: var(--ingles-superficie);
        color: var(--ingles-texto);
    }
    .ingles-estudiante .modal-header {
        border-bottom: 1px solid var(--ingles-borde);
        border-radius: 15px 15px 0 0;
        background: var(--ingles-superficie);
        color: var(--ingles-texto);
    }
    .ingles-estudiante .modal-title { color: var(--ingles-texto); font-weight: 700; }
    .ingles-estudiante .modal-header .close { color: var(--ingles-texto); opacity: 1; text-shadow: none; }
    .ingles-estudiante .modal-body .alert { margin: 0; }
    .ingles-estudiante .alert-danger {
        border-color: transparent;
        background: var(--ingles-error-fondo);
        color: var(--ingles-error-texto);
    }
    .ingles-estudiante .modal-footer { border-color: var(--ingles-borde); }
    .ingles-estudiante :is(.row, .panel-body) { margin: 0; padding: 0; }
    .ingles-estudiante :is(.row, .panel-body) > [class*="col-md-"] {
        float: none;
        width: auto;
        margin-inline: 0;
        padding-inline: 0;
    }
    .ingles-estudiante .row.ingles-selectores {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        padding: clamp(16px, 3vw, 24px);
        align-items: end;
    }
    .ingles-estudiante .ingles-selectores::before,
    .ingles-estudiante .ingles-selectores::after { display: none; }
    .ingles-estudiante .ingles-selectores .form-group { margin-bottom: 0; }
    .ingles-estudiante .ingles-selectores .ingles-elegir { grid-column: 1 / -1; }
    .ingles-estudiante .ingles-tipo-curso { max-width: 420px; }
    .ingles-estudiante #grupo_ingles { background: transparent !important; }
    .ingles-estudiante .panel {
        margin: 0 0 16px;
        border: 1px solid var(--ingles-borde);
        border-radius: 12px;
        background: var(--ingles-superficie);
        box-shadow: none;
    }
    .ingles-estudiante .panel-heading {
        padding: 14px 16px;
        border: 0;
        border-radius: 11px;
        background: var(--ingles-superficie);
        color: var(--ingles-texto);
    }
    .ingles-estudiante .panel-danger .panel-heading {
        background: var(--ingles-error-fondo);
        color: var(--ingles-error-texto);
    }
    .ingles-estudiante .panel-success .panel-heading {
        background: var(--ingles-exito-fondo);
        color: var(--ingles-exito-texto);
    }
    .ingles-estudiante .panel-title {
        color: inherit;
        text-align: start;
        font-weight: 600;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }
    .ingles-estudiante .ingles-tabla,
    .ingles-estudiante .ingles-tabs-notas {
        max-width: 100%;
        margin: 20px 0 16px;
        overflow-x: auto;
        border: 1px solid var(--ingles-borde);
        border-radius: 12px;
        background: var(--ingles-superficie);
    }
    .ingles-estudiante .table {
        width: 100%;
        margin: 0;
        border: 0;
        background: var(--ingles-superficie);
        color: var(--ingles-texto);
        text-align: start;
    }
    .ingles-estudiante #table_enviado { min-width: 660px; }
    .ingles-estudiante .table :is(th, td) {
        padding: 12px 10px;
        border: 0;
        border-bottom: 1px solid var(--ingles-borde);
        line-height: 1.45;
        text-align: start;
    }
    .ingles-estudiante .table thead th {
        background: var(--ingles-fondo);
        color: var(--ingles-secundario);
        font-weight: 700;
    }
    .ingles-estudiante .table tbody tr:last-child td { border-bottom: 0; }
    .ingles-estudiante .table :is(.bg-info, .bg-success) {
        padding: 8px;
        border-radius: 6px;
        background: var(--ingles-info-fondo);
        color: var(--ingles-info-texto);
    }
    @media (max-width: 600px) {
        .ingles-estudiante .row.ingles-selectores { grid-template-columns: minmax(0, 1fr); }
        .ingles-estudiante .ingles-acciones > .ingles-boton { flex: 1 1 100%; }
    }
    .ingles-estudiante .ingles-tabs-notas {
        max-width: 680px;
        padding-bottom: 16px;
    }
    .ingles-estudiante .ingles-tabs-notas .ingles-acciones { margin-inline: 16px; }
    .ingles-estudiante #table_calificacion tr:last-child td {
        border-top: 1px solid var(--ingles-borde);
        background: var(--ingles-fondo);
        font-weight: 700;
    }
    .ingles-estudiante #table_calificacion td.ingles-nota-baja {
        background: var(--ingles-error-fondo);
        color: var(--ingles-error-texto);
        font-weight: 700;
    }

    /* El marco de Inglés hereda el fondo de Bootstrap fuera del contenido. */
    #main-content[data-panel-contenido-modulo]:has(> .tesvb-contenido > .ingles-estudiante) {
        --ingles-pie-fondo: #fff;
        --ingles-pie-texto: #475467;
        --ingles-pie-enfasis: #101828;
        --ingles-pie-borde: #d0d5dd;
        display: flex;
        flex: 1;
        flex-direction: column;
        background-color: #f9fafb;
    }
    .dark #main-content[data-panel-contenido-modulo]:has(> .tesvb-contenido > .ingles-estudiante) {
        --ingles-pie-fondo: #1d2939;
        --ingles-pie-texto: #d0d5dd;
        --ingles-pie-enfasis: #f9fafb;
        --ingles-pie-borde: #344054;
        background-color: #101828;
    }

    /* Conserva el HTML institucional y sustituye solo su presentación en estas vistas. */
    #main-content > .tesvb-contenido:has(> .ingles-estudiante) ~ footer.colorfooter.footer-responsive {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px 24px;
        align-items: start;
        margin: auto 0 0 !important;
        padding: clamp(16px, 3vw, 24px) clamp(16px, 3vw, 32px);
        border-top: 1px solid var(--ingles-pie-borde);
        background-color: var(--ingles-pie-fondo);
        color: var(--ingles-pie-texto);
        box-shadow: none;
        font-size: 13px;
        line-height: 1.55;
        overflow-wrap: anywhere;
    }
    #main-content > .tesvb-contenido:has(> .ingles-estudiante) ~ footer.colorfooter.footer-responsive > div {
        float: none;
        width: auto;
        min-width: 0;
        margin: 0;
        padding: 0;
    }
    #main-content > .tesvb-contenido:has(> .ingles-estudiante) ~ footer.colorfooter.footer-responsive > .container {
        grid-column: 1 / -1;
        width: auto;
        padding-top: 12px;
        border-top: 1px solid var(--ingles-pie-borde);
    }
    #main-content > .tesvb-contenido:has(> .ingles-estudiante) ~ footer.colorfooter.footer-responsive strong {
        color: var(--ingles-pie-enfasis);
    }

    @media (max-width: 600px) {
        #main-content > .tesvb-contenido:has(> .ingles-estudiante) ~ footer.colorfooter.footer-responsive {
            grid-template-columns: minmax(0, 1fr);
            text-align: center;
        }
    }
</style>
