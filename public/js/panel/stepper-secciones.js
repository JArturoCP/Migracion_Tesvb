(function ($) {
    'use strict';

    function controles(root, navegar) {
        const barra = root.querySelector('[data-panel-stepper-controls]');
        const pasos = Array.from(barra.querySelectorAll('[data-stepper-ir]'));
        pasos.forEach((paso, indice) => paso.addEventListener('click', () => navegar(indice)));
        barra.hidden = false;

        return function actualizar(actual, estados, bloqueados = []) {
            barra.querySelector('[data-stepper-progreso]').value = actual + 1;
            barra.querySelector('[data-stepper-posicion]').textContent = `Paso ${actual + 1} de ${pasos.length}`;
            pasos.forEach((paso, i) => {
                if (i === actual) { paso.setAttribute('aria-current', 'step'); }
                else { paso.removeAttribute('aria-current'); }
                const estado = estados[i] || (i === actual ? 'activo' : 'pendiente');
                paso.dataset.estado = estado;
                paso.disabled = Boolean(bloqueados[i]);
                paso.querySelector('[data-stepper-alerta]').hidden = estado !== 'error';
                paso.querySelector('[data-stepper-estado]').textContent = {
                    error: 'Con errores', completado: 'Completado', activo: 'En edición', pendiente: 'Pendiente'
                }[estado];
            });
        };
    }

    function secciones(root) {
        const paneles = Array.from(root.querySelectorAll('[data-stepper-seccion]'));
        const detalles = Array.from(root.querySelectorAll('[data-stepper-detalle]'));
        const formularios = Array.from(root.querySelectorAll('form[data-stepper-formulario]'));
        const revisados = new Set();
        const servidor = JSON.parse(root.dataset.stepperErrores || '{}');
        const panel = window.PanelFormularios;
        const anterior = root.querySelector('[data-stepper-anterior]');
        const siguiente = root.querySelector('[data-stepper-siguiente]');
        let actual = Number(root.dataset.stepperInicio || 0);

        function campos(form) {
            return Array.from(form.elements).filter(campo => campo.matches('[data-stepper-requerido]:not([data-stepper-omitir])') && !campo.disabled);
        }

        function seccion(campo) {
            const detalle = campo.closest('[data-stepper-detalle]');
            return detalle ? Number(detalle.dataset.stepperDetalle) : paneles.indexOf(campo.closest('[data-stepper-seccion]'));
        }

        function errores(form) {
            const lista = {};
            for (const campo of campos(form)) {
                const nombre = campo.name;
                const valor = $(campo).val();
                if (servidor[nombre]) { lista[nombre] = servidor[nombre]; }
                if (valor == null || !String(valor).trim()) { lista[nombre] ||= campo.dataset.stepperRequerido; }
                if (campo.dataset.stepperError) { lista[nombre] = campo.dataset.stepperError; }
            }
            return lista;
        }

        function pintar() {
            const estados = paneles.map(el => el.hasAttribute('data-stepper-guardado') ? 'completado' : undefined);
            root.querySelectorAll('[data-panel-error]').forEach(panel.limpiarCampo);
            for (const form of formularios) {
                for (const [nombre, mensaje] of Object.entries(errores(form))) {
                    const campo = form.elements.namedItem(nombre);
                    const indice = seccion(campo);
                    if (indice < 0 || (!revisados.has(indice) && !servidor[nombre] && !campo.dataset.stepperError)) { continue; }
                    estados[indice] = 'error';
                    const texto = Array.isArray(mensaje) ? mensaje.join(' ') : mensaje;
                    if (campo.type === 'hidden') {
                        const visible = campo.parentElement.querySelector('input:not([type="hidden"])');
                        if (visible) { panel.marcarCampo(form, visible.name, texto); }
                    } else { panel.marcarCampo(form, nombre, texto); }
                }
            }
            actualizar(actual, estados);
        }

        function mostrar(indice, enfocar = false) {
            if (!paneles[indice]) { return; }
            actual = indice;
            paneles.forEach((el, i) => { el.hidden = i !== actual; });
            detalles.forEach(el => { el.hidden = Number(el.dataset.stepperDetalle) !== actual; });
            anterior.disabled = actual === 0;
            siguiente.hidden = actual === paneles.length - 1;
            pintar();
            if (enfocar) { paneles[actual].querySelector('[data-stepper-titulo]')?.focus(); }
        }

        const actualizar = controles(root, indice => {
            if (indice !== actual) { revisados.add(actual); }
            mostrar(indice, true);
        });
        anterior.addEventListener('click', () => mostrar(actual - 1, true));
        siguiente.addEventListener('click', () => {
            revisados.add(actual);
            mostrar(actual + 1, true);
        });

        for (const form of formularios) {
            form.noValidate = true;
            $(form).on('submit.stepper', function (evento) {
                if (evento.isDefaultPrevented()) { return; }
                if (form.dataset.stepperEnviando) { evento.preventDefault(); return; }
                if (Array.from(form.elements).some(campo => campo.type === 'submit' && campo.disabled)) {
                    evento.preventDefault();
                    return;
                }
                const lista = errores(form);
                const primero = campos(form).find(campo => Object.hasOwn(lista, campo.name));
                if (primero) {
                    evento.preventDefault();
                    campos(form).forEach(campo => revisados.add(seccion(campo)));
                    mostrar(seccion(primero));
                    panel.alerta('warning', 'Revisa el formulario', Object.values(lista).join('\n'), false)
                        .then(() => {
                            if (primero.type === 'hidden') { paneles[actual].querySelector('[data-stepper-titulo]')?.focus(); }
                            else { primero.focus(); }
                        });
                    return;
                }
                form.dataset.stepperEnviando = 'true';
            });
        }
        $(root).on('input change changeDate', 'input,select,textarea', function () {
            delete servidor[this.name];
            pintar();
        }).on('stepper:revisar', pintar);
        window.addEventListener('pageshow', () => formularios.forEach(form => delete form.dataset.stepperEnviando));
        const rechazado = formularios.flatMap(campos).find(campo => servidor[campo.name]);
        root.querySelector('[data-stepper-navegacion]').hidden = false;
        mostrar(rechazado ? seccion(rechazado) : actual);
    }

    window.PanelStepperSecciones = {controles};
    $(function () { document.querySelectorAll('[data-stepper-secciones]').forEach(secciones); });
})(window.jQuery);
