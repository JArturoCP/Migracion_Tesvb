@push('cabeza')
    <style>
        /* El marco compila las utilidades tw: con !important. */
        [data-datos-estudiante] :is(input:not([type="hidden"]), select, textarea):is([readonly], :disabled) {
            background-color: var(--tw-color-gray-50) !important;
            border-color: var(--tw-color-gray-300) !important;
            color: var(--tw-color-gray-700) !important;
            opacity: 1;
            -webkit-text-fill-color: currentColor;
        }

        [data-datos-estudiante] :is(input, select, textarea):disabled {
            cursor: not-allowed;
        }

        .dark [data-datos-estudiante] {
            color-scheme: dark;
        }

        .dark [data-datos-estudiante] :is(input, select, textarea):not([type="hidden"]):is([readonly], :disabled) {
            background-color: var(--tw-color-gray-800) !important;
            border-color: var(--tw-color-gray-600) !important;
            color: var(--tw-color-gray-200) !important;
        }

        [data-datos-estudiante] :is(input, select, textarea):focus-visible {
            outline: 2px solid var(--tw-color-brand-400) !important;
            outline-offset: 2px;
        }

        [data-datos-estudiante] input[type="date"],
        [data-datos-estudiante] .tesvb-fecha-control {
            min-width: 0;
            max-width: 100%;
        }
    </style>
@endpush
