(function ($, Swal) {
    'use strict';

    $(function () {
        var form = document.getElementById('form_docente_edita');
        if (!form || !Swal) { return; }
        var button = document.getElementById('guarda_docente');
        if (!button) { return; }
        var originalLabel = button.innerHTML;
        var saving = false;
        var settings = window.docenteEdicion || {};
        var modal = settings.modal && document.getElementById(settings.modal);
        var opener = modal && document.getElementById('abrir_edicion_docente');
        var panel = window.PanelModal;
        var formularios = window.PanelFormularios;

        function field(name) { return form.elements.namedItem(name); }

        function alertar(options) {
            return Swal.fire(Object.assign({
                customClass: { container: settings.alertaClase },
                keydownListenerCapture: true
            }, options));
        }

        if (modal) {
            $(modal).on('hide.bs.modal', function (event) {
                if (saving) { event.preventDefault(); }
            }).on('hidden.bs.modal', function () { opener.focus(); });
            if (settings.advertenciaFecha || Object.keys(settings.errors || {}).length) {
                panel.abrir(modal, opener);
            }
        }
        if (settings.errors && Object.keys(settings.errors).length) { formularios.errores(form, settings.errors, 'servidor'); }
        else if (settings.success) {
            alertar({icon: 'success', title: 'Datos actualizados', text: settings.success, confirmButtonText: 'Aceptar'});
        }

        $(form).on('submit.docente', function (event) {
            event.preventDefault();
            if (saving || !formularios.validar(form)) { return; }

            saving = true;
            button.disabled = true;
            button.textContent = 'Guardando…';
            form.setAttribute('aria-busy', 'true');
            $(form).triggerHandler('panel:enviando');

            $.ajax({
                url: form.action, type: 'POST', data: $(form).serialize(), dataType: 'json',
                headers: {Accept: 'application/json'}
            }).done(function (data) {
                if (!data || typeof data.message !== 'string') {
                    alertar({icon: 'error', title: 'Respuesta inesperada', text: 'Verifica los datos guardados antes de volver a enviar.', confirmButtonText: 'Aceptar'});
                    return;
                }
                $(form).triggerHandler('panel:guardado');
                alertar({icon: 'success', title: 'Datos actualizados', text: data.message, confirmButtonText: 'Aceptar', returnFocus: false})
                    .then(function () {
                        if (modal) { window.location.reload(); }
                    });
            }).fail(function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    formularios.errores(form, xhr.responseJSON.errors, 'servidor');
                    return;
                }
                var messages = {
                    401: 'Tu sesión terminó. Inicia sesión en otra pestaña y vuelve a intentar guardar.',
                    403: 'No tienes permiso para modificar este registro.',
                    404: 'El registro ya no está disponible. Verifica con el administrador.',
                    419: 'La sesión o el formulario expiró. Copia tus cambios antes de recargar la página.',
                    500: 'No se pudieron guardar los cambios. Conservamos lo que escribiste; intenta nuevamente.'
                };
                alertar({
                    icon: 'error', title: 'No se pudo completar el guardado', confirmButtonText: 'Aceptar',
                    text: messages[xhr.status] || 'No se pudo confirmar el resultado. Conservamos tus datos; revisa la conexión y verifica el registro antes de reenviar.'
                });
            }).always(function () {
                saving = false;
                button.disabled = false;
                button.innerHTML = originalLabel;
                form.removeAttribute('aria-busy');
            });
        });

        if (!modal) { return; }
        document.querySelectorAll('[data-docente-catalogo]').forEach(function (catalogo) {
            var dialogo = catalogo.closest('[data-panel-modal]');
            var inputs = Array.from(catalogo.querySelectorAll('input'));
            var guardar = catalogo.querySelector('button[type="submit"]');
            var mensaje = catalogo.querySelector('[data-catalogo-error]');
            var select = field(catalogo.dataset.select);
            var disparador;

            $(dialogo).on('shown.bs.modal', function (event) {
                disparador = event.relatedTarget;
                inputs[0].focus();
            }).on('hide.bs.modal', function (event) {
                if (guardar.disabled) { event.preventDefault(); }
            }).on('hidden.bs.modal', function () {
                catalogo.reset();
                mensaje.textContent = '';
                if (disparador && !modal.hidden) { disparador.focus(); }
            });

            catalogo.addEventListener('submit', function (event) {
                event.preventDefault();
                if (guardar.disabled) { return; }
                var valores = inputs.map(function (input) { return input.value.trim(); });
                if (valores.some(function (valor) { return !valor; })) {
                    mensaje.textContent = 'Completa todos los campos.';
                    return;
                }

                var idsAnteriores = new Set(Array.from(select.options, function (option) { return option.value; }));
                var nuevoId;
                mensaje.textContent = '';
                guardar.disabled = true;
                $.getJSON(catalogo.dataset.url + '/' + valores.map(encodeURIComponent).join('/'))
                    .done(function (data) {
                        var registros = data && data[catalogo.dataset.recurso];
                        if (!Array.isArray(registros)) {
                            mensaje.textContent = 'No se pudo confirmar el guardado.';
                            return;
                        }
                        registros.forEach(function (registro) {
                            var id = String(registro[catalogo.dataset.clave]);
                            var titulo = registro[catalogo.dataset.texto];
                            if (!idsAnteriores.has(id)) {
                                select.add(new Option(titulo, id));
                                if (titulo === valores[0] && (!nuevoId || Number(id) > Number(nuevoId))) {
                                    nuevoId = id;
                                }
                            }
                        });
                        if (nuevoId) {
                            select.value = nuevoId;
                            select.dispatchEvent(new Event('change', {bubbles: true}));
                        }
                    }).fail(function () {
                        mensaje.textContent = 'No se pudo agregar el registro. Intenta nuevamente.';
                    }).always(function () {
                        guardar.disabled = false;
                        if (!mensaje.textContent) { panel.cerrar(dialogo); }
                    });
            });
        });
    });
})(window.jQuery, window.Swal);
