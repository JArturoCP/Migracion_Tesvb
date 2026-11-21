(function ($) {
    'use strict';

    function iniciar(form) {
        const panel = window.PanelFormularios;
        const controles = form.querySelector('[data-panel-stepper-controls]');
        const pasos = Array.from(controles.querySelectorAll('[data-stepper-ir]'));
        const secciones = pasos.map(paso => document.getElementById(paso.getAttribute('aria-controls')));
        const anterior = form.querySelector('[data-stepper-anterior]');
        const siguiente = form.querySelector('[data-stepper-siguiente]');
        const progreso = controles.querySelector('[data-stepper-progreso]');
        const posicion = controles.querySelector('[data-stepper-posicion]');
        const revisados = new Set();
        const completados = new Set();
        const cambios = pasos.map(() => 0);
        let servidor = JSON.parse(form.dataset.stepperErrores || '{}');
        let envio = [];
        let actual = 0;

        function seccionDe(campo) {
            return secciones.indexOf(campo?.closest('[data-stepper-seccion]'));
        }

        function pasoDe(nombre) {
            const campo = Array.from(form.elements).find(el => el.name === nombre || el.id === nombre);
            return seccionDe(campo);
        }

        function pintar() {
            const encontrados = {...servidor};
            for (const [nombre, mensaje] of Object.entries(panel.revisarCampos(form))) {
                if (revisados.has(pasoDe(nombre))) { encontrados[nombre] = mensaje; }
            }
            const cantidades = pasos.map(() => 0);
            form.querySelectorAll('[data-panel-error]').forEach(panel.limpiarCampo);
            for (const [nombre, mensaje] of Object.entries(encontrados)) {
                const paso = pasoDe(nombre);
                if (paso === -1) { continue; }
                cantidades[paso] += 1;
                panel.marcarCampo(form, nombre, Array.isArray(mensaje) ? mensaje.join(' ') : mensaje);
            }
            pasos.forEach((paso, indice) => {
                const activo = indice === actual;
                const cantidad = cantidades[indice];
                const estado = cantidad ? 'error' : completados.has(indice) ? 'completado' : activo ? 'activo' : 'pendiente';
                paso.dataset.estado = estado;
                paso.querySelector('[data-stepper-alerta]').hidden = cantidad === 0;
                paso.querySelector('[data-stepper-estado]').textContent = {
                    error: 'Con errores', completado: 'Completado', activo: 'En edición', pendiente: 'Pendiente'
                }[estado];
            });
        }

        function mostrar(indice, enfocar = false) {
            if (!pasos[indice]) { return; }
            actual = indice;
            secciones.forEach((seccion, i) => { seccion.hidden = i !== actual; });
            pasos.forEach((paso, i) => {
                if (i === actual) { paso.setAttribute('aria-current', 'step'); }
                else { paso.removeAttribute('aria-current'); }
            });
            posicion.textContent = 'Paso ' + (actual + 1) + ' de ' + pasos.length;
            progreso.value = actual + 1;
            anterior.disabled = actual === 0;
            siguiente.hidden = actual === pasos.length - 1;
            pintar();
            if (enfocar) { secciones[actual].querySelector('legend').focus(); }
        }

        pasos.forEach((paso, indice) => paso.addEventListener('click', () => {
            if (indice !== actual) { revisados.add(actual); }
            mostrar(indice, true);
        }));
        anterior.addEventListener('click', () => mostrar(actual - 1, true));
        siguiente.addEventListener('click', () => {
            revisados.add(actual);
            mostrar(actual + 1, true);
        });

        $(form).on('panel:errores', function (_, errores, origen) {
            if (origen === 'servidor') { servidor = errores; }
            else { pasos.forEach((paso, indice) => revisados.add(indice)); }
            const primero = Object.keys(errores).map(pasoDe).find(indice => indice >= 0);
            mostrar(primero ?? actual);
        }).on('panel:enviando', function () {
            envio = [...cambios];
        }).on('panel:guardado', function () {
            servidor = {};
            cambios.forEach((revision, indice) => {
                if (revision === envio[indice]) { completados.add(indice); }
            });
            pintar();
        }).on('input change', 'input, select, textarea', function () {
            const indice = seccionDe(this);
            if (indice === -1 || this.type === 'hidden') { return; }
            cambios[indice] += 1;
            completados.delete(indice);
            if (Object.hasOwn(servidor, this.name)) {
                servidor[this.name] = 'Guarda para volver a validar este campo.';
            }
            pintar();
        });

        controles.hidden = false;
        form.querySelector('[data-stepper-navegacion]').hidden = false;
        mostrar(Object.keys(servidor).map(pasoDe).find(indice => indice >= 0) ?? 0);
    }

    $(function () {
        document.querySelectorAll('form[data-panel-stepper]').forEach(iniciar);
    });
})(window.jQuery);
