(function ($) {
    'use strict';

    function seguirValidacion(tabs, form) {
        if (!form) { return () => {}; }
        const { marcarCampo, limpiarCampo } = window.PanelFormularios;
        const guardados = new Set(['cero']);
        const versiones = {};
        const especiales = {};
        let cliente = {};
        let servidor = JSON.parse(form.dataset.alumnoErrores || '{}');
        let escuela = {};
        let envio;
        const revisados = new Set();
        let espera;

        function pasoDe(nombre) {
            const campo = Array.from(form.elements).find(el => el.name === nombre || el.id === nombre);
            return campo?.closest('.tab-pane')?.id;
        }

        function pintar() {
            const porPaso = {};
            form.querySelectorAll('[data-panel-error]').forEach(limpiarCampo);
            for (const [nombre, detalle] of Object.entries({...especiales, ...servidor, ...cliente})) {
                const paso = pasoDe(nombre);
                if (!paso) { continue; }
                porPaso[paso] = (porPaso[paso] || 0) + 1;
                marcarCampo(form, nombre, Array.isArray(detalle) ? detalle.join(' ') : detalle);
            }
            porPaso.cero = Object.keys(escuela).length;

            for (const tab of tabs) {
                const paso = tab.getAttribute('aria-controls');
                const cantidad = porPaso[paso] || 0;
                const activo = tab.getAttribute('aria-selected') === 'true';
                const estado = cantidad ? 'error' : guardados.has(paso) ? 'completado' : activo ? 'activo' : 'pendiente';
                const mensajes = {error: 'Con errores', completado: 'Completado', activo: 'En edición', pendiente: 'Pendiente'};
                tab.dataset.estado = estado;
                tab.querySelector('[data-alumno-estado]').textContent = mensajes[estado];
                document.getElementById(paso).querySelector('[data-alumno-aviso]').textContent = cantidad
                    ? (paso === 'cero'
                        ? 'Revisa tu selección en Modificar escuela.'
                        : (cantidad === 1 ? 'Corrige el campo marcado en esta sección.' : 'Corrige los ' + cantidad + ' campos marcados en esta sección.'))
                    : '';
            }
        }

        function revisarCampos() {
            const validador = $(form).data('validator');
            if (revisados.size && validador) {
                // Usa las reglas actuales sin disparar el aviso general al escribir.
                validador.checkForm();
                cliente = Object.fromEntries(Object.entries(validador.errorMap).filter(([nombre]) => revisados.has(pasoDe(nombre))));
            }
            pintar();
        }

        $(form).on('panel:errores', function (_, errores, origen) {
            if (origen === 'servidor') { servidor = errores; }
            else {
                cliente = errores;
                tabs.forEach(tab => revisados.add(tab.getAttribute('aria-controls')));
            }
            pintar();
        }).on('alumno:revisarPaso', function (_, paso) {
            if (paso !== 'cero') { revisados.add(paso); revisarCampos(); }
        }).on('alumno:campo', function (_, nombre, mensaje) {
            if (mensaje) { especiales[nombre] = mensaje; }
            else { delete especiales[nombre]; }
            pintar();
        }).on('panel:enviando', function () {
            envio = {...versiones};
            tabs.forEach(tab => revisados.add(tab.getAttribute('aria-controls')));
            cliente = {};
            pintar();
        }).on('panel:guardado', function () {
            servidor = {};
            for (const tab of tabs) {
                const paso = tab.getAttribute('aria-controls');
                if (paso !== 'cero' && (envio?.[paso] || 0) === (versiones[paso] || 0)) {
                    guardados.add(paso);
                }
            }
            revisarCampos();
        }).on('input change', 'input, select, textarea', function () {
            const paso = this.closest('.tab-pane')?.id;
            if (!paso || this.type === 'hidden') { return; }
            guardados.delete(paso);
            versiones[paso] = (versiones[paso] || 0) + 1;
            // Si el servidor rechazó un valor, solo el siguiente guardado puede confirmar la corrección.
            if (Object.hasOwn(servidor, this.name)) { servidor[this.name] = 'Guarda para volver a validar este campo.'; }
            clearTimeout(espera);
            espera = setTimeout(revisarCampos, 180);
        });

        $('#form_escuela_cct_modal').on('panel:errores', function (_, errores) {
            escuela = errores;
            pintar();
        }).on('panel:guardado', function () {
            escuela = {};
            pintar();
        });

        return pintar;
    }

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
        const form = document.getElementById('formgeneral');
        const pintar = seguirValidacion(tabs, form);
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
            pintar();
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
        siguiente.addEventListener('click', () => {
            if (form) { $(form).triggerHandler('alumno:revisarPaso', [tabs[actual].getAttribute('aria-controls')]); }
            navegar(actual + 1, true);
        });
        actualizar(Math.max(actual, 0));
    });
})(window.jQuery);
