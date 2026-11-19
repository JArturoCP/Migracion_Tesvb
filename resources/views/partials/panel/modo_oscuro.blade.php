{{-- Aplica el modo oscuro guardado (localStorage.darkMode, la misma clave de la plantilla) antes de pintar, para
     evitar el parpadeo. Lo incluyen layouts/panel y layouts/marco en el <head>. El botón está en
     partials/panel/tema (header). En el marco, el contenido del módulo no tiene clases tw:dark y se queda claro. --}}
<script>
    try {
        if (JSON.parse(localStorage.getItem('darkMode'))) document.documentElement.classList.add('dark');
    } catch (e) {}
</script>
