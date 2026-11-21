@once
    @if (old('_panel_formulario') || (is_string(session('success')) && session('success')))
        <script>
            window.PanelEnvioAnterior = {{ Illuminate\Support\Js::from([
                'clave' => old('_panel_formulario'),
                'valores' => collect(session()->getOldInput())->except(['_token', 'password', 'password_confirmation'])->all(),
                'errores' => $errors->getBag('default')->messages(),
                'exito' => is_string(session('success')) ? session('success') : null,
            ]) }};
        </script>
    @endif
    <script src="{{ asset('js/panel/formularios.js') }}?v={{ filemtime(public_path('js/panel/formularios.js')) }}"></script>
@endonce
