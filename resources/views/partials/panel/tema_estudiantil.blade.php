@php($colorTemaVisual = $colorVistaPrevia ?? app(\App\Services\Panel\TemaVisualEstudiantil::class)->colorEfectivo(auth()->user()))
@if($colorTemaVisual !== null)
    <style id="tesvb-colores-estudiantiles">
        :root {
            --tema-visual-color: {{ $colorTemaVisual }};
        }

        :root, [data-tema-estudiantil] {
            --tema-visual-action: color-mix(in srgb, var(--tema-visual-color) 51%, #101827);
            --tema-visual-hover: color-mix(in srgb, var(--tema-visual-color) 42%, #101827);
            --tema-visual-on-primary: #fff;
            --tema-visual-soft-calendario: color-mix(in srgb, var(--tema-visual-color) 12%, #fff);
            --tema-visual-soft: var(--tema-visual-soft-calendario);
            --tema-visual-link: color-mix(in srgb, var(--tema-visual-color) 45%, #101827);
            --tema-visual-focus: color-mix(in srgb, var(--tema-visual-color) 58%, #101827);
            /* Las utilidades de TailAdmin consumen estos tokens incluso cuando son !important. */
            --tw-color-brand-50: var(--tema-visual-soft);
            --tw-color-brand-100: color-mix(in srgb, var(--tema-visual-color) 21%, #fff);
            --tw-color-brand-200: color-mix(in srgb, var(--tema-visual-color) 28%, #fff);
            --tw-color-brand-300: var(--tema-visual-focus);
            --tw-color-brand-400: var(--tema-visual-link);
            --tw-color-brand-500: var(--tema-visual-action);
            --tw-color-brand-600: var(--tema-visual-hover);
            --tw-color-brand-700: var(--tema-visual-link);
        }

        :root.dark, .dark [data-tema-estudiantil="tailadmin"] {
            --tema-visual-soft: color-mix(in srgb, var(--tema-visual-color) 15%, #1f2937);
            --tema-visual-link: color-mix(in srgb, var(--tema-visual-color) 43%, #f1f5f9);
            --tema-visual-focus: color-mix(in srgb, var(--tema-visual-color) 58%, #f1f5f9);
        }

        [data-tema-estudiantil] :is(.tw-pestana.active, .tw-pestana[aria-selected="true"]) {
            color: var(--tema-visual-link);
            border-bottom-color: var(--tema-visual-focus);
        }

        [data-tema-estudiantil="tailadmin"] :is(a[class*="hover:text-brand-"], a[aria-current="page"].tw-pestana):is(:hover, :focus-visible) {
            color: var(--tema-visual-link) !important;
        }
        [data-tema-estudiantil] [data-acento-carrera] {
            box-shadow: inset 3px 0 var(--tema-visual-color);
        }

        [data-tema-estudiantil] :is(a, button, summary, input:not([type="hidden"]), select, textarea):focus-visible:not([aria-invalid="true"], .is-invalid, .has-error *, .has-warning *, .has-success *) {
            outline: 2px solid var(--tema-visual-focus) !important;
            outline-offset: 2px !important;
        }

        [data-tema-estudiantil="bootstrap"] :is(.btn-primary:not(:disabled, .disabled), .pagination > .active > a, .pagination > .active > span) {
            background-color: var(--tema-visual-action);
            border-color: var(--tema-visual-action);
            color: var(--tema-visual-on-primary);
        }

        [data-tema-estudiantil="bootstrap"] .btn-primary:not(:disabled, .disabled):is(:hover, :focus, :active) {
            background-color: var(--tema-visual-hover);
            border-color: var(--tema-visual-hover);
            color: var(--tema-visual-on-primary);
        }

        [data-tema-estudiantil="bootstrap"] :is(.breadcrumb a, .pagination > li:not(.active, .disabled) > a, a[data-enlace-carrera]) {
            color: var(--tema-visual-link);
        }

        [data-tema-estudiantil="bootstrap"] :is(.nav-tabs > .active > a, .nav-tabs > li > a[aria-selected="true"]) {
            color: var(--tema-visual-link);
            border-bottom-color: var(--tema-visual-focus);
        }

        [data-tema-estudiantil="bootstrap"] .form-control:focus-visible:not([aria-invalid="true"], .is-invalid, .has-error *, .has-warning *, .has-success *) {
            border-color: var(--tema-visual-focus);
            outline: 2px solid var(--tema-visual-focus) !important;
            outline-offset: 2px !important;
        }

        [data-tema-estudiantil="bootstrap"] :is(input[type="checkbox"], input[type="radio"]):not([aria-invalid="true"], .is-invalid, .has-error *, .has-warning *, .has-success *) {
            accent-color: var(--tema-visual-action);
        }

        :is(aside.tw-marco, header.tw-marco) :is(a, button, input):focus-visible {
            outline: 2px solid var(--tema-visual-focus) !important;
            outline-offset: 2px;
        }

        aside.tw-marco :is([data-panel-enlace][aria-current], [data-panel-enlace].tw\\:menu-item-active, [data-panel-enlace].tw\\:menu-dropdown-item-active) {
            box-shadow: inset 3px 0 var(--tema-visual-color);
        }

        aside.tw-marco :is([data-panel-enlace], [data-panel-modulo]):hover {
            background-color: var(--tema-visual-soft) !important;
            color: var(--tema-visual-link) !important;
        }

        [data-tema-estudiantil="bootstrap"] :is(.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus) {
            background-color: var(--tema-visual-action);
            color: var(--tema-visual-on-primary);
        }

        [data-tema-estudiantil="bootstrap"] .btn-default[aria-pressed="true"]:not(:disabled, .disabled) {
            background-color: var(--tema-visual-soft);
            border-color: var(--tema-visual-focus);
            color: var(--tema-visual-link);
        }

        :root .tesvb-calendario {
            --fecha-acento: var(--calendario-acento, var(--tema-visual-action));
        }

        .tesvb-calendario :is(.flatpickr-prev-month, .flatpickr-next-month):hover svg {
            fill: var(--tema-visual-link);
        }

        .tesvb-calendario :is(.flatpickr-prev-month, .flatpickr-next-month, .flatpickr-day):focus-visible {
            outline: 2px solid var(--tema-visual-focus);
            outline-offset: -2px;
        }

        :root .datepicker table tr td.active:not(.disabled),
        :root .datepicker table tr td.range-start:not(.disabled),
        :root .datepicker table tr td.range-end:not(.disabled),
        :root .datepicker table tr td.selected:not(.disabled),
        :root .datepicker table tr td span.active:not(.disabled),
        .ui-datepicker .ui-datepicker-calendar .ui-state-active {
            background: var(--tema-visual-action);
            border-color: var(--tema-visual-action);
            color: var(--tema-visual-on-primary);
            text-shadow: none;
        }

        .datepicker table tr td.range:not(.disabled),
        .datepicker table tr td.day:not(.disabled, .active, .selected, .range-start, .range-end):hover,
        .datepicker :is(.prev, .next, .datepicker-switch):hover,
        .ui-datepicker :is(.ui-datepicker-prev, .ui-datepicker-next):hover {
            background: var(--tema-visual-soft-calendario);
        }

        .datepicker table tr td.today:not(.disabled, .active, .selected, .range-start, .range-end),
        .ui-datepicker .ui-datepicker-calendar .ui-state-highlight:not(.ui-state-active) {
            box-shadow: inset 0 0 0 1px var(--tema-visual-action);
        }

        :is(.datepicker, .ui-datepicker, .fc-toolbar) :is(a, button, [tabindex]):focus-visible {
            outline: 2px solid var(--tema-visual-action);
            outline-offset: 2px;
        }

        .fc-toolbar .fc-button:not(:disabled, .fc-state-disabled):hover {
            border-color: var(--tema-visual-action);
        }

        .fc-toolbar .fc-button.fc-state-active:not(.fc-state-disabled) {
            background: var(--tema-visual-action);
            border-color: var(--tema-visual-action);
            color: var(--tema-visual-on-primary);
            text-shadow: none;
        }
    </style>
@endif
