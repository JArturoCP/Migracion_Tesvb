<script>
    $(function () {
        let cargando = false;

        $(document).on('click', '[data-modal-remoto]', function () {
            if (cargando) { return; }
            cargando = true;
            this.setAttribute('aria-busy', 'true');

            $.get(this.dataset.url)
                .done(html => {
                    $(this.dataset.contenedor).html(html);
                    PanelModal.abrir(this.dataset.modalRemoto.slice(1), this);
                })
                .fail(() => PanelFormularios.alerta('error', 'No se pudo cargar la información', 'Intenta de nuevo.'))
                .always(() => {
                    cargando = false;
                    this.removeAttribute('aria-busy');
                });
        });
    });
</script>
