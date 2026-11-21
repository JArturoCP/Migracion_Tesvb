const normalizarRuta = (ruta) => ruta.replace(/\/+$/, '') || '/';

function longitudCoincidencia(enlace, pagina) {
    const href = enlace.getAttribute('href')?.trim();
    if (!href || href.startsWith('#')) return 0;

    const destino = new URL(href, pagina);
    if (destino.origin !== pagina.origin || destino.protocol !== pagina.protocol) return 0;

    const ruta = normalizarRuta(destino.pathname);
    const actual = normalizarRuta(pagina.pathname);
    if (actual === ruta || (ruta !== '/' && actual.startsWith(ruta + '/'))) {
        return ruta.length;
    }

    return 0;
}

export default function sidebar() {
    return {
        selected: this.$persist('').as('panel_menu_abierto'),

        init() {
            const pagina = new URL(window.location.href);
            let activo;
            let mejorCoincidencia = 0;

            for (const enlace of this.$el.querySelectorAll('[data-panel-enlace]')) {
                if (enlace.closest('[hidden], .tw\\:hidden, [style*="display: none"], [style*="display:none"]')) continue;

                const coincidencia = longitudCoincidencia(enlace, pagina);
                if (coincidencia > mejorCoincidencia) {
                    activo = enlace;
                    mejorCoincidencia = coincidencia;
                }
            }

            if (!activo) return;

            if (activo.classList.contains('tw:menu-dropdown-item')) {
                activo.classList.replace('tw:menu-dropdown-item-inactive', 'tw:menu-dropdown-item-active');
            } else {
                activo.classList.replace('tw:menu-item-inactive', 'tw:menu-item-active');
            }
            activo.setAttribute('aria-current', normalizarRuta(activo.pathname) === normalizarRuta(pagina.pathname) ? 'page' : 'location');

            let elemento = activo.closest('li');
            while (elemento && this.$el.contains(elemento)) {
                const modulo = elemento.querySelector(':scope > [data-panel-modulo]');
                if (modulo) {
                    elemento.setAttribute('data-panel-rama-activa', '');
                    if (modulo.dataset.panelModulo) this.selected = modulo.dataset.panelModulo;
                }
                elemento = elemento.parentElement.closest('li');
            }
        },
    };
}
