@once
    @push('cabeza')
        <script src="{{ asset('js/panel/formularios.js') }}?v={{ filemtime(public_path('js/panel/formularios.js')) }}"></script>
    @endpush
@endonce
