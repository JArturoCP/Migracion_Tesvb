(function ($) {
    'use strict';

    $(function () {
        const stepper = document.getElementById('stepper_alumno');
        if (!stepper) { return; }
        const tabs = Array.from(stepper.querySelectorAll('[role="tab"]'));
        const anterior = document.getElementById('paso_alumno_anterior');
        const siguiente = document.getElementById('paso_alumno_siguiente');
        const continuar = document.getElementById('paso_alumno_continuar');
        const fin = document.getElementById('paso_alumno_fin');
        const progreso = stepper.querySelector('[data-alumno-progreso]');
        const barra = stepper.querySelector('[data-alumno-barra]');
        const posicion = stepper.querySelector('[data-alumno-posicion]');
        let actual = tabs.findIndex(tab => tab.getAttribute('aria-selected') === 'true');

        function actualizar(indice) {
            actual = indice;
            const numero = actual + 1;
            const texto = 'Paso ' + numero + ' de ' + tabs.length;
            posicion.textContent = texto;
            progreso.setAttribute('aria-valuenow', numero);
            progreso.setAttribute('aria-valuetext', texto + ': ' + tabs[actual].querySelector('[data-alumno-etiqueta]').textContent.trim());
            barra.dataset.paso = String(numero);
            tabs.forEach((tab, i) => { tab.tabIndex = i === actual ? 0 : -1; });
            anterior.disabled = actual === 0;
            continuar.hidden = actual === tabs.length - 1;
            fin.hidden = actual !== tabs.length - 1;
        }

        function navegar(indice, enfocarTitulo) {
            const tab = tabs[indice];
            if (!tab) { return; }
            $(tab).tab('show');
            if (enfocarTitulo) {
                document.getElementById(tab.getAttribute('aria-controls')).querySelector('[data-alumno-titulo]').focus();
            } else {
                tab.focus();
            }
        }

        $(tabs).on('shown.bs.tab', function () {
            actualizar(tabs.indexOf(this));
        }).on('keydown', function (event) {
            const indice = tabs.indexOf(this);
            const destino = {
                ArrowLeft: (indice + tabs.length - 1) % tabs.length,
                ArrowRight: (indice + 1) % tabs.length,
                Home: 0, End: tabs.length - 1,
            }[event.key];
            if (destino === undefined) { return; }
            event.preventDefault();
            navegar(destino, false);
        });

        anterior.addEventListener('click', () => navegar(actual - 1, true));
        siguiente.addEventListener('click', () => navegar(actual + 1, true));
        actualizar(Math.max(actual, 0));
    });
})(window.jQuery);
