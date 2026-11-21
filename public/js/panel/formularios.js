(function ($, Swal) {
    'use strict';

    function alerta(icon, title, text, returnFocus = true) {
        return Swal.fire({
            icon, title, text, returnFocus, keydownListenerCapture: true,
            customClass: { container: 'tw:z-[100001]' }
        });
    }

    function limpiarCampo(campo) {
        if (!campo.hasAttribute('data-panel-error')) { return; }
        const id = campo.getAttribute('data-panel-error');
        document.getElementById(id)?.remove();
        const descripciones = (campo.getAttribute('aria-describedby') || '').split(' ').filter(item => item && item !== id);
        if (descripciones.length) { campo.setAttribute('aria-describedby', descripciones.join(' ')); }
        else { campo.removeAttribute('aria-describedby'); }
        campo.removeAttribute('aria-invalid');
        campo.removeAttribute('data-panel-error');
    }

    let consecutivo = 0;
    function marcarCampo(form, nombre, mensaje) {
        const nombreLista = nombre.replace(/\.\d+$/, '') + '[]';
        const campo = Array.from(form.elements).find(el => (el.name === nombre || el.name === nombreLista || el.id === nombre) && !el.disabled && el.type !== 'hidden');
        if (campo) {
            if (campo.hasAttribute?.('data-panel-error')) { limpiarCampo(campo); }
            const aviso = document.createElement('span');
            aviso.id = 'panel-error-campo-' + (++consecutivo);
            aviso.className = 'tw:mt-1 tw:block tw:text-xs tw:text-red-600 tw:dark:text-red-400';
            aviso.textContent = mensaje;
            (campo.closest('.tw-campo') || campo).insertAdjacentElement('afterend', aviso);
            campo.setAttribute('data-panel-error', aviso.id);
            campo.setAttribute('aria-invalid', 'true');
            campo.setAttribute('aria-describedby', [campo.getAttribute('aria-describedby'), aviso.id].filter(Boolean).join(' '));
        }
        return campo;
    }

    function notificar(form, evento, ...args) {
        if (form.dataset?.panelSeguimiento) { $(form).triggerHandler(evento, args); }
    }

    function errores(form, lista, origen = 'cliente') {
        form.querySelectorAll('[data-panel-error]').forEach(limpiarCampo);
        const mensajes = [];
        let primero;
        for (const [nombre, detalle] of Object.entries(lista)) {
            const mensaje = Array.isArray(detalle) ? detalle.join(' ') : String(detalle);
            mensajes.push(mensaje);
            const campo = marcarCampo(form, nombre, mensaje);
            primero ||= campo;
        }
        notificar(form, 'panel:errores', lista, origen);

        const pestana = primero?.closest('.tab-pane');
        if (pestana) {
            const enlace = Array.from(document.querySelectorAll('[data-toggle="tab"]')).find(el => el.getAttribute('href') === '#' + pestana.id);
            if (enlace) { $(enlace).tab('show'); }
        }
        return alerta('warning', 'Revisa el formulario', mensajes.join('\n'), false).then(() => {
            if (primero?.getClientRects().length) { primero.focus(); }
        });
    }

    function validar(form) {
        const lista = {};
        for (const campo of form.elements) {
            const nombre = campo.name || campo.id;
            if (!nombre || !campo.willValidate) { continue; }
            const vacio = campo.required && (
                (['text', 'email', 'tel', 'textarea'].includes(campo.type) && !campo.value.trim()) ||
                (campo.type === 'select-one' && campo.selectedOptions[0]?.disabled)
            );
            const etiqueta = campo.dataset?.panelEtiqueta || campo.labels?.[0]?.textContent.trim() || 'este campo';
            if (campo.type === 'file' && campo.files?.length && campo.dataset?.panelArchivo) {
                const extensiones = campo.dataset.panelArchivo.split(',');
                if (Array.from(campo.files).some(archivo => !extensiones.some(ext => archivo.name.toLowerCase().endsWith('.' + ext)))) {
                    lista[nombre] = 'Selecciona un archivo ' + extensiones.join(' o ').toUpperCase() + '.';
                    continue;
                }
            }
            if (campo.type === 'file' && campo.dataset?.panelMaxBytes && Array.from(campo.files || []).some(archivo => archivo.size > Number(campo.dataset.panelMaxBytes))) {
                lista[nombre] = 'El archivo no debe superar ' + Number(campo.dataset.panelMaxBytes) / 1048576 + ' MB.';
                continue;
            }
            if (campo.validity.valid && !vacio) { continue; }
            lista[nombre] = campo.validity.valueMissing || vacio
                ? 'Completa ' + etiqueta + '.'
                : etiqueta + ': ' + campo.validationMessage;
        }
        if (!Object.keys(lista).length) { return true; }
        errores(form, lista);
        return false;
    }

    function fallo(form, xhr, mensaje) {
        const lista = xhr.responseJSON?.errors;
        if (xhr.status === 422 && lista && Object.keys(lista).length) {
            return errores(form, lista, 'servidor');
        }
        const porEstado = {
            401: 'La sesión terminó. Inicia sesión de nuevo para continuar.',
            403: 'No tienes permiso para realizar esta acción.',
            404: 'El registro ya no está disponible.',
            419: 'La sesión expiró. Conserva tus datos antes de recargar.',
        };
        return alerta('error', 'No se pudo completar la acción', porEstado[xhr.status] || mensaje || 'Revisa la conexión e intenta de nuevo.');
    }

    function enviar(form, boton) {
        if (form.getAttribute('aria-busy') === 'true' || !validar(form)) { return; }
        form.querySelectorAll('[data-panel-error]').forEach(limpiarCampo);
        const leyenda = boton?.textContent;
        if (boton) { boton.disabled = true; boton.textContent = 'Guardando…'; }
        form.setAttribute('aria-busy', 'true');
        notificar(form, 'panel:enviando');

        function liberar() {
            form.removeAttribute('aria-busy');
            if (boton) { boton.disabled = false; boton.textContent = leyenda; }
        }
        $.ajax({
            url: form.action, type: form.method, data: $(form).serialize(),
            dataType: 'json', headers: { Accept: 'application/json' }
        }).done(function (respuesta) {
            if (typeof respuesta?.message !== 'string') {
                alerta('error', 'Respuesta inesperada', 'Verifica los datos antes de volver a enviar.').then(liberar);
                return;
            }
            notificar(form, 'panel:guardado');
            alerta('success', 'Cambios guardados', respuesta.message).then(() => {
                if (respuesta.redirect) { window.location.assign(respuesta.redirect); }
                else { liberar(); }
            });
        }).fail(function (xhr) {
            fallo(form, xhr, 'No se pudieron guardar tus cambios. Revisa la conexión e intenta de nuevo.').then(liberar);
        });
    }

    $(function () {
        const formulariosNativos = Array.from(document.querySelectorAll('[data-panel-envio]'));
        formulariosNativos.forEach((form, i) => {
            form.noValidate = true;
            const clave = form.dataset.panelEnvio || form.id || form.getAttribute('action') || 'formulario-' + i;
            form.dataset.panelClave = clave;
            if (form.method.toLowerCase() === 'post') {
                const marcador = document.createElement('input');
                marcador.type = 'hidden';
                marcador.name = '_panel_formulario';
                marcador.value = clave;
                form.append(marcador);
            }
            $(form).on('submit.panelEnvio', function (event) {
                if (event.isDefaultPrevented()) { return; }
                if (form.getAttribute('aria-busy') === 'true' || !validar(form)) {
                    event.preventDefault();
                    return;
                }
                form.setAttribute('aria-busy', 'true');
                $(form).triggerHandler('panel:enviando');
                const boton = event.originalEvent?.submitter;
                if (boton) {
                    // Mantiene el nombre y valor del botón en el POST nativo.
                    setTimeout(() => {
                        boton.disabled = true;
                        boton.dataset.panelBloqueado = 'true';
                    }, 0);
                }
            });
        });
        const anterior = window.PanelEnvioAnterior;
        if (formulariosNativos.length) {
            window.addEventListener('pageshow', () => formulariosNativos.forEach(form => {
                form.removeAttribute('aria-busy');
                form.querySelectorAll('[data-panel-bloqueado]').forEach(boton => {
                    boton.disabled = false;
                    delete boton.dataset.panelBloqueado;
                });
            }));
            const form = anterior?.clave && formulariosNativos.find(el => el.dataset.panelClave === anterior.clave);
            if (form && Object.keys(anterior.errores).length) {
                for (const campo of form.elements) {
                    if (!Object.hasOwn(anterior.valores, campo.name) || ['file','hidden','password','submit','button'].includes(campo.type)) { continue; }
                    const valor = anterior.valores[campo.name];
                    if (campo.type === 'radio' || campo.type === 'checkbox') {
                        campo.checked = String(valor) === campo.value;
                    } else if (typeof valor === 'string' || typeof valor === 'number' || valor === null) {
                        campo.value = valor ?? '';
                    }
                }
                const modal = form.closest('[data-panel-modal], .modal');
                if (modal && !$(modal).hasClass('in') && !$(modal).hasClass('show')) {
                    $(modal).one('shown.bs.modal', () => errores(form, anterior.errores)).modal('show');
                } else {
                    errores(form, anterior.errores);
                }
            }
        }
        if (anterior?.exito && !Object.keys(anterior.errores).length) {
            alerta('success', 'Cambios guardados', anterior.exito);
        }
        document.querySelectorAll('[data-panel-guardar]').forEach(form => {
            form.noValidate = true;
            form.addEventListener('submit', event => {
                event.preventDefault();
                enviar(form, event.submitter || form.querySelector('[type="submit"]'));
            });
            $(form.closest('[data-panel-modal]')).on('hide.bs.modal', event => {
                if (form.getAttribute('aria-busy') === 'true') { event.preventDefault(); }
            });
        });
        document.querySelectorAll('[data-panel-validar]').forEach(form => { form.noValidate = true; });
        for (const evento of ['input', 'change']) {
            document.addEventListener(evento, event => {
                if (event.target instanceof HTMLElement && !event.target.form?.dataset?.panelSeguimiento) { limpiarCampo(event.target); }
            });
        }
    });

    window.PanelFormularios = { alerta, errores, validar, fallo, enviar, marcarCampo, limpiarCampo };
})(window.jQuery, window.Swal);
