/* Piloto SweetAlert2: solo el formulario de datos personales del docente. */
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
        var labels = {
            nombre_docente: 'Nombre', clave_docente: 'Clave', rfc: 'RFC', esc_p: 'Escuela de procedencia',
            dir: 'Dirección', correo: 'Correo', telefono: 'Teléfono', celular: 'Celular', cedula: 'Cédula',
            o_nac: 'Origen de nacimiento', f_nac: 'Fecha de nacimiento', f_ingreso: 'Fecha de ingreso',
            f_contrata: 'Fecha de contratación', selectPerfil: 'Perfil', selectSituacion: 'Situación',
            selectNombra: 'Nombramiento', selectEsc: 'Escolaridad', selectSexo: 'Sexo',
            selectAbreviacion: 'Abreviación', numero_empleado: 'Número de empleado'
        };

        function field(name) { return form.elements.namedItem(name); }

        function alertar(options) {
            return Swal.fire(Object.assign({
                customClass: { container: settings.alertaClase },
                keydownListenerCapture: true
            }, options));
        }

        function clearErrors() {
            form.querySelectorAll('[data-docente-error]').forEach(function (el) { el.remove(); });
            Object.keys(labels).forEach(function (name) {
                var el = field(name);
                if (!el) { return; }
                el.removeAttribute('aria-invalid');
                el.removeAttribute('aria-describedby');
            });
        }

        function showErrors(errors) {
            clearErrors();
            var messages = [], first = null;
            Object.keys(errors).forEach(function (name) {
                var list = Array.isArray(errors[name]) ? errors[name] : [errors[name]];
                list.forEach(function (message) { messages.push(String(message)); });
                var el = field(name);
                if (!el || el.type === 'hidden') { return; }
                first = first || el;
                var hint = document.createElement('span');
                hint.id = 'docente-error-' + name;
                hint.className = settings.errorClase || '';
                hint.setAttribute('data-docente-error', '');
                hint.textContent = list.join(' ');
                el.insertAdjacentElement('afterend', hint);
                el.setAttribute('aria-invalid', 'true');
                el.setAttribute('aria-describedby', hint.id);
            });
            alertar({
                icon: 'warning', title: 'Revisa el formulario', text: messages.join('\n'),
                confirmButtonText: 'Revisar', returnFocus: false
            }).then(function () {
                if (first && (!modal || !modal.hidden)) { first.focus(); }
            });
        }

        if (modal) {
            $(modal).on('hide.bs.modal', function (event) {
                if (saving) { event.preventDefault(); }
            }).on('hidden.bs.modal', function () { opener.focus(); });
            if (settings.advertenciaFecha || Object.keys(settings.errors || {}).length) {
                panel.abrir(modal, opener);
            }
        }
        if (settings.errors && Object.keys(settings.errors).length) { showErrors(settings.errors); }
        else if (settings.success) {
            alertar({icon: 'success', title: 'Datos actualizados', text: settings.success, confirmButtonText: 'Aceptar'});
        }

        $(form).on('submit.docente', function (event) {
            event.preventDefault();
            if (saving) { return; }
            clearErrors();
            var errors = {};
            Object.keys(labels).forEach(function (name) {
                var el = field(name);
                if (!el || !String(el.value || '').trim()) { errors[name] = ['El campo ' + labels[name] + ' es obligatorio.']; }
            });
            var email = field('correo');
            if (!errors.correo && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
                errors.correo = ['Ingresa un correo electrónico válido.'];
            }
            if (Object.keys(errors).length) { showErrors(errors); return; }

            saving = true;
            button.disabled = true;
            button.textContent = 'Guardando…';
            form.setAttribute('aria-busy', 'true');

            $.ajax({
                url: form.action, type: 'POST', data: $(form).serialize(), dataType: 'json',
                headers: {Accept: 'application/json'}
            }).done(function (data) {
                if (!data || typeof data.message !== 'string') {
                    alertar({icon: 'error', title: 'Respuesta inesperada', text: 'Verifica los datos guardados antes de volver a enviar.', confirmButtonText: 'Aceptar'});
                    return;
                }
                alertar({icon: 'success', title: 'Datos actualizados', text: data.message, confirmButtonText: 'Aceptar', returnFocus: false})
                    .then(function () {
                        if (modal) { window.location.reload(); }
                    });
            }).fail(function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    showErrors(xhr.responseJSON.errors);
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
                        if (nuevoId) { select.value = nuevoId; }
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
