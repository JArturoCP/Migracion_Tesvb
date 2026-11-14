/*
 * TESVB Notify: alertas del sistema sobre una sola librería, SweetAlert2 11 (js/sweetalert2.min.js).
 * Debe cargarse después de sweetalert2.min.js.
 *
 * 1) Compatibilidad: el código existente llama a swal(...) escrito para dos librerías distintas:
 *    - sweetalert 1/2 (t4t5):  swal({title, text, icon, buttons, dangerMode}).then(valor => if (valor) ...)
 *    - SweetAlert2 7:          swal({type, title, showCancelButton, ...}).then(r => if (r.value) ...)
 *    swal() detecta el estilo por sus opciones, lo traduce a SweetAlert2 11 y devuelve el resultado
 *    con la forma que espera cada estilo. Swal.fire(...) también acepta las opciones de la versión 7.
 *
 * 2) TNotify (reemplazo de alert()/confirm()/prompt() nativos), dibujado con SweetAlert2:
 *   TNotify.success|error|warning|info(mensaje, {title, duration})   -> toast
 *   TNotify.alert(mensaje [, tipo])                                   -> toast (tipo inferido si se omite)
 *   TNotify.confirm(mensaje, {title, okText, cancelText, type, onConfirm, onCancel}) -> Promise<boolean>
 *   TNotify.prompt(mensaje, valorInicial, {title, okText, cancelText}) -> Promise<string|null>
 *   TNotify.confirmAction(event, this, mensaje)  -> para onclick/onsubmit="return ..."
 *       Bloquea la acción, pregunta, y solo si se acepta la reanuda (submit / click).
 */
(function (window, document) {
    'use strict';

    var Swal = window.Swal;
    if (!Swal || window.TNotify) { return; }

    var ICONOS = ['success', 'error', 'warning', 'info', 'question'];

    function esObjeto(v) {
        return v !== null && typeof v === 'object' && !(window.Node && v instanceof window.Node) && !Array.isArray(v);
    }

    // Un modal de Bootstrap abierto regresa el foco a sí mismo (enforceFocus, listener 'focusin.bs.modal'
    // en document) y no deja escribir ni usar el teclado en la alerta. Mientras la alerta está abierta
    // se suspende esa vigilancia y al cerrarla se restaura en el modal que siga abierto.
    function suspenderFocoBootstrap() {
        var $ = window.jQuery;
        if ($) { $(document).off('focusin.bs.modal'); }
    }

    function restaurarFocoBootstrap() {
        var $ = window.jQuery;
        if (!$ || Swal.isVisible()) { return; }
        $('.modal.in, .modal.show').each(function () {
            var m = $(this).data('bs.modal');
            if (m && typeof m.enforceFocus === 'function') { m.enforceFocus(); }        // Bootstrap 3
            else if (m && typeof m._enforceFocus === 'function') { m._enforceFocus(); } // Bootstrap 4
        });
    }

    // willOpen corre antes de que SweetAlert enfoque el botón o el campo de captura.
    function conProteccionFoco(o) {
        var previoAbrir = o.willOpen, previoCerrado = o.didClose;
        o.willOpen = function () {
            suspenderFocoBootstrap();
            if (typeof previoAbrir === 'function') { return previoAbrir.apply(this, arguments); }
        };
        o.didClose = function () {
            restaurarFocoBootstrap();
            if (typeof previoCerrado === 'function') { return previoCerrado.apply(this, arguments); }
        };
        return o;
    }

    /* ---------- Opciones de SweetAlert2 7 -> 11 ---------- */
    var RENOMBRES = {
        onBeforeOpen: 'willOpen', onOpen: 'didOpen', onRender: 'didRender',
        onClose: 'willClose', onAfterClose: 'didClose', onDestroy: 'didDestroy'
    };

    function normalizarV2(entrada) {
        var o = {};
        for (var k in entrada) { if (Object.prototype.hasOwnProperty.call(entrada, k)) { o[k] = entrada[k]; } }
        if (o.type !== undefined) {
            if (o.icon === undefined) { o.icon = o.type; }
            delete o.type;
        }
        if (o.icon !== undefined && ICONOS.indexOf(o.icon) === -1) { delete o.icon; }
        for (var viejo in RENOMBRES) {
            if (o[viejo] !== undefined) {
                if (o[RENOMBRES[viejo]] === undefined) { o[RENOMBRES[viejo]] = o[viejo]; }
                delete o[viejo];
            }
        }
        if (typeof o.customClass === 'string') { o.customClass = { popup: o.customClass }; }
        if (o.confirmButtonClass || o.cancelButtonClass) {
            o.customClass = esObjeto(o.customClass) ? o.customClass : {};
            if (o.confirmButtonClass) { o.customClass.confirmButton = o.confirmButtonClass; }
            if (o.cancelButtonClass) { o.customClass.cancelButton = o.cancelButtonClass; }
        }
        if (o.animation === false) { o.showClass = { popup: '' }; o.hideClass = { popup: '' }; }
        ['confirmButtonClass', 'cancelButtonClass', 'animation', 'useRejections', 'cancelButton'].forEach(function (x) { delete o[x]; });
        return conProteccionFoco(o);
    }

    /* ---------- Llamadas al estilo sweetalert 1/2 (t4t5) ---------- */
    var OPCIONES_V1 = ['buttons', 'dangerMode', 'content', 'closeOnClickOutside', 'closeOnEsc', 'className'];

    function esEstiloV1(o) {
        for (var i = 0; i < OPCIONES_V1.length; i++) { if (o[OPCIONES_V1[i]] !== undefined) { return true; } }
        return false;
    }

    function textoBoton(b, porDefecto) {
        if (b === true || b === undefined || b === null) { return porDefecto; }
        if (typeof b === 'string') { return b; }
        if (esObjeto(b) && b.text) { return b.text; }
        return porDefecto;
    }

    function desdeV1(v1) {
        var o = {};
        ['title', 'text', 'icon', 'timer'].forEach(function (k) { if (v1[k] !== undefined) { o[k] = v1[k]; } });
        // Opciones de SweetAlert2 que también pudieran venir mezcladas
        for (var k in v1) {
            if (Object.prototype.hasOwnProperty.call(v1, k) && OPCIONES_V1.indexOf(k) === -1 && o[k] === undefined) { o[k] = v1[k]; }
        }
        var valorConfirmar = true, valorCancelar = null, b = v1.buttons;
        if (b === false) {
            o.showConfirmButton = false;
        } else if (b === true) {
            o.showCancelButton = true;
        } else if (typeof b === 'string') {
            o.confirmButtonText = b;
        } else if (Array.isArray(b)) {
            if (b[0]) { o.showCancelButton = true; o.cancelButtonText = textoBoton(b[0], 'Cancelar'); }
            if (b[1] === false) { o.showConfirmButton = false; } else { o.confirmButtonText = textoBoton(b[1], 'Aceptar'); }
        } else if (esObjeto(b)) {
            if (b.cancel) { o.showCancelButton = true; o.cancelButtonText = textoBoton(b.cancel, 'Cancelar'); if (b.cancel.value !== undefined) { valorCancelar = b.cancel.value; } }
            if (b.confirm === false) { o.showConfirmButton = false; }
            else if (b.confirm) { o.confirmButtonText = textoBoton(b.confirm, 'Aceptar'); if (b.confirm.value !== undefined) { valorConfirmar = b.confirm.value; } }
        }
        if (o.showCancelButton && o.cancelButtonText === undefined) { o.cancelButtonText = 'Cancelar'; }
        if (o.confirmButtonText === undefined) { o.confirmButtonText = 'Aceptar'; }
        if (v1.dangerMode) { o.confirmButtonColor = '#d33'; o.focusCancel = true; }
        if (v1.closeOnClickOutside === false) { o.allowOutsideClick = false; }
        if (v1.closeOnEsc === false) { o.allowEscapeKey = false; }
        var conEntrada = false;
        if (v1.content === 'input') { o.input = 'text'; conEntrada = true; }
        else if (esObjeto(v1.content) && v1.content.element === 'input') {
            o.input = (v1.content.attributes && v1.content.attributes.type) || 'text';
            o.inputAttributes = v1.content.attributes || {};
            conEntrada = true;
        } else if (window.Node && v1.content instanceof window.Node) { o.html = v1.content; }
        if (v1.className) { o.customClass = { popup: v1.className }; }
        // En sweetalert 1/2 la promesa resuelve true / el valor del botón al confirmar y null al cancelar o cerrar.
        return Swal.fire(normalizarV2(o)).then(function (r) {
            if (r.isConfirmed) { return conEntrada ? r.value : valorConfirmar; }
            return valorCancelar;
        });
    }

    /* ---------- swal() unificado ---------- */
    function swal() {
        var a = arguments;
        if (a.length === 1 && esObjeto(a[0])) {
            return esEstiloV1(a[0]) ? desdeV1(a[0]) : Swal.fire(normalizarV2(a[0]));
        }
        // swal(titulo [, texto [, icono]])
        var o = { title: a[0] };
        if (a[1] !== undefined) {
            if (/<[a-z][\s\S]*>/i.test(String(a[1]))) { o.html = a[1]; } else { o.text = a[1]; }
        }
        if (a[2] !== undefined) { o.icon = a[2]; }
        return Swal.fire(normalizarV2(o));
    }

    var swalCompat = typeof Proxy === 'function'
        ? new Proxy(swal, {
            get: function (destino, prop) {
                if (prop in destino) { return destino[prop]; }
                var v = Swal[prop];
                return typeof v === 'function' ? v.bind(Swal) : v;
            }
        })
        : swal;
    if (swalCompat === swal) {
        Object.keys(Swal).forEach(function (k) { if (!(k in swal)) { swal[k] = typeof Swal[k] === 'function' ? Swal[k].bind(Swal) : Swal[k]; } });
    }
    window.swal = window.sweetAlert = swalCompat;

    // Swal.fire con opciones de la versión 7 (type, onOpen, ...).
    var fireOriginal = Swal.fire;
    Swal.fire = function () {
        var a = Array.prototype.slice.call(arguments);
        if (a.length === 1 && esObjeto(a[0])) { a[0] = normalizarV2(a[0]); }
        else if (a.length > 1 && typeof a[2] === 'string' && ICONOS.indexOf(a[2]) === -1) { a.length = 2; }
        return fireOriginal.apply(this, a);
    };

    /* ---------------- TNotify ---------------- */
    var TITULOS = { success: 'Éxito', error: 'Error', warning: 'Advertencia', info: 'Información', confirm: 'Confirmar' };
    var DURACIONES = { success: 4500, info: 5000, warning: 6500, error: 8000 };

    function normalizeType(type) {
        type = String(type || '').toLowerCase();
        return ['success', 'error', 'warning', 'info'].indexOf(type) > -1 ? type : 'info';
    }

    function toText(value) {
        if (value === undefined || value === null) { return ''; }
        if (typeof value === 'object') {
            try { return JSON.stringify(value); } catch (e) { return String(value); }
        }
        return String(value);
    }

    function inferType(message) {
        var m = toText(message).toLowerCase();
        if (m.normalize) { m = m.normalize('NFD').replace(/[̀-ͯ]/g, ''); }
        if (/error|no se pudo|no se puede|no es posible|fall[oa]|incorrect|invalid|denegad|rechazad/.test(m)) { return 'error'; }
        if (/debe|debes|seleccion|ingres|introduc|falta|agrega|requerid|obligatori|llen|captur|verifi|revis|maxim|minim|excede|supera|no ha|no hay|ya existe|ya esta|solo se|por favor|asegur/.test(m)) { return 'warning'; }
        if (/correctamente|exito|exitos|guardad|registrad|actualizad|eliminad|enviad|agregad|modificad|realizad/.test(m)) { return 'success'; }
        return 'info';
    }

    function hayModalAbierto() {
        if (!Swal.isVisible()) { return false; }
        var p = Swal.getPopup();
        return !(p && p.classList.contains('swal2-toast'));
    }

    // SweetAlert2 muestra una sola alerta a la vez: el toast espera a que se cierre un modal abierto
    // para no cancelarlo; si lo visible es otro toast, lo reemplaza.
    function toast(type, message, opts) {
        opts = opts || {};
        type = normalizeType(type);
        var duration = opts.duration === undefined ? DURACIONES[type] : opts.duration;
        var cerrado = false;
        function mostrar() {
            if (cerrado) { return; }
            if (hayModalAbierto()) { setTimeout(mostrar, 250); return; }
            fireOriginal.call(Swal, {
                toast: true,
                position: 'top-end',
                icon: type,
                title: opts.title || TITULOS[type],
                text: toText(message),
                showConfirmButton: false,
                showCloseButton: true,
                timer: duration > 0 ? duration : undefined,
                timerProgressBar: duration > 0,
                didOpen: function (popup) {
                    popup.addEventListener('mouseenter', Swal.stopTimer);
                    popup.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        }
        if (document.body) { mostrar(); } else { document.addEventListener('DOMContentLoaded', mostrar); }
        return {
            close: function () {
                cerrado = true;
                var p = Swal.getPopup();
                if (p && p.classList.contains('swal2-toast')) { Swal.close(); }
            }
        };
    }

    function dialog(kind, message, opts) {
        opts = opts || {};
        var type = ['success', 'error', 'warning', 'info'].indexOf(opts.type) > -1 ? opts.type : 'question';
        var o = {
            icon: type,
            title: opts.title || (kind === 'prompt' ? 'Captura requerida' : (TITULOS[opts.type] || TITULOS.confirm)),
            text: toText(message),
            showCancelButton: true,
            confirmButtonText: opts.okText || 'Aceptar',
            cancelButtonText: opts.cancelText || 'Cancelar',
            reverseButtons: true,
            focusConfirm: !!opts.focusOk,
            focusCancel: !opts.focusOk && kind !== 'prompt'
        };
        conProteccionFoco(o);
        if (kind === 'prompt') {
            o.input = 'text';
            o.inputValue = opts.defaultValue === undefined || opts.defaultValue === null ? '' : String(opts.defaultValue);
        }
        return fireOriginal.call(Swal, o).then(function (r) {
            var aceptado = !!r.isConfirmed;
            var result = kind === 'prompt' ? (aceptado ? String(r.value === undefined ? '' : r.value) : null) : aceptado;
            if (aceptado && typeof opts.onConfirm === 'function') { opts.onConfirm(result); }
            if (!aceptado && typeof opts.onCancel === 'function') { opts.onCancel(); }
            return result;
        });
    }

    function confirm(message, opts) {
        return dialog('confirm', message, opts);
    }

    function prompt(message, defaultValue, opts) {
        opts = opts || {};
        opts.defaultValue = defaultValue;
        return dialog('prompt', message, opts);
    }

    /*
     * Para atributos inline: onclick="return TNotify.confirmAction(event, this, '¿...?')"
     * o onsubmit="return TNotify.confirmAction(event, this, '¿...?')".
     * Cancela la acción original y solo la reanuda si el usuario acepta.
     */
    function confirmAction(event, element, message, opts) {
        event = event || window.event;
        if (element && element.__tnConfirmed) {
            element.__tnConfirmed = false;
            return true;
        }
        if (event && event.preventDefault) { event.preventDefault(); }
        var submitter = event && event.submitter ? event.submitter : null;

        confirm(message, opts).then(function (ok) {
            if (!ok || !element) { return; }
            if (element.tagName === 'FORM') {
                if (typeof element.requestSubmit === 'function') {
                    element.__tnConfirmed = true;
                    if (submitter) { element.requestSubmit(submitter); } else { element.requestSubmit(); }
                } else {
                    HTMLFormElement.prototype.submit.call(element);
                }
            } else {
                element.__tnConfirmed = true;
                element.click();
            }
            // requestSubmit()/click() despachan el evento de forma síncrona; si la
            // validación HTML5 lo frenó, la bandera no debe quedar activa.
            element.__tnConfirmed = false;
        });
        return false;
    }

    window.TNotify = {
        toast: function (type, message, opts) { return toast(type, message, opts); },
        success: function (message, opts) { return toast('success', message, opts); },
        error: function (message, opts) { return toast('error', message, opts); },
        warning: function (message, opts) { return toast('warning', message, opts); },
        info: function (message, opts) { return toast('info', message, opts); },
        alert: function (message, type, opts) { return toast(type || inferType(message), message, opts); },
        confirm: confirm,
        prompt: prompt,
        confirmAction: confirmAction
    };
})(window, document);
