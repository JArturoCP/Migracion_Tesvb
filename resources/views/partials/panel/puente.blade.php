{{--
    Puente de Bootstrap sin Bootstrap para las pantallas migradas al panel (layouts/panel).
    Script en línea y síncrono, justo después de las librerías de la pantalla (@stack('cabeza')), para que:
      - el código de siempre siga funcionando sin modificarlo:
          $('#id').modal('show' | 'hide' | 'toggle')   → abre/cierra el <x-panel.modal id="id">
          $('#pestana').tab('show')                    → activa la pestaña y su panel
          $('#bloque').collapse('show' | 'hide' | 'toggle')
        con los mismos eventos de Bootstrap (show/shown/hide/hidden.bs.modal, .bs.tab, .bs.collapse);
      - los atributos de siempre sigan funcionando: data-toggle="modal|tab|pill|collapse",
        data-target / href, data-dismiss="modal|alert", data-parent (acordeón), data-backdrop="static".
    Si la pantalla carga el Bootstrap JS dentro de otra librería (js_tutorias/app.js trae Bootstrap 4),
    se quitan sus manejadores data-api para que no muestren sus propios modales sin estilos.
    No depende de Alpine (los modales pueden estar dentro de plantillas Vue con x-ignore) ni de jQuery
    (si no hay jQuery, los eventos se disparan como CustomEvent nativos).
--}}
<script>
(function () {
    'use strict';
    if (window.PanelModal) { return; }

    var abiertos = [];

    function nodo(x) {
        if (!x) { return null; }
        if (typeof x === 'string') { return document.getElementById(x.replace(/^#/, '')); }
        return x.jquery ? x[0] : x;
    }
    function buscar(selector) {
        selector = (selector || '').trim();
        if (!selector || selector === '#' || selector.charAt(0) === 'j') { return null; }  // '#', 'javascript:…'
        // Como jQuery: "#id" se busca por id aunque empiece con número (href="#5"), que querySelector rechaza.
        if (/^#[\w-]+$/.test(selector)) { return document.getElementById(selector.slice(1)); }
        try { return document.querySelector(selector); } catch (e) { return null; }
    }
    function destino(disparador) {
        return buscar(disparador.getAttribute('data-target') || disparador.getAttribute('href'));
    }
    // Dispara un evento de Bootstrap; devuelve false si algún manejador lo canceló (preventDefault).
    function disparar(elemento, tipo, relacionado) {
        var $ = window.jQuery;
        if ($ && $.Event) {
            var e = $.Event(tipo, { relatedTarget: relacionado });
            $(elemento).trigger(e);
            return !e.isDefaultPrevented();
        }
        var ce = new CustomEvent(tipo, { bubbles: true, cancelable: true, detail: { relatedTarget: relacionado } });
        return elemento.dispatchEvent(ce);
    }
    function despues(fn) { window.setTimeout(fn, 0); }

    /* ---------- Modales (x-panel.modal) ---------- */
    function esModal(m) { return m && m.hasAttribute && m.hasAttribute('data-panel-modal'); }
    function abrir(x, relacionado) {
        var m = nodo(x);
        if (!esModal(m) || !m.hidden) { return; }
        if (!disparar(m, 'show.bs.modal', relacionado)) { return; }
        m.hidden = false;
        m.setAttribute('aria-hidden', 'false');
        m.classList.add('show', 'in');
        document.body.classList.add('tw-modal-abierto', 'modal-open');
        abiertos.push(m);
        if (relacionado && relacionado.focus) { m.panelDisparador = relacionado; }
        try { m.focus({ preventScroll: true }); } catch (e) {}
        despues(function () { disparar(m, 'shown.bs.modal', relacionado); });
    }
    function cerrar(x) {
        var m = nodo(x);
        if (!esModal(m) || m.hidden) { return; }
        if (!disparar(m, 'hide.bs.modal')) { return; }
        m.hidden = true;
        m.setAttribute('aria-hidden', 'true');
        m.classList.remove('show', 'in');
        abiertos = abiertos.filter(function (a) { return a !== m; });
        if (!abiertos.length) { document.body.classList.remove('tw-modal-abierto', 'modal-open'); }
        if (m.panelDisparador && m.panelDisparador.isConnected) { m.panelDisparador.focus(); }
        m.panelDisparador = null;
        despues(function () { disparar(m, 'hidden.bs.modal'); });
    }
    function alternar(x, relacionado) {
        var m = nodo(x);
        if (esModal(m)) { m.hidden ? abrir(m, relacionado) : cerrar(m); }
    }

    /* ---------- Pestañas (data-toggle="tab" | "pill") ---------- */
    function mostrarPestana(x) {
        var a = nodo(x);
        // Igual que Bootstrap: una pestaña deshabilitada no se activa.
        if (!a || a.classList.contains('disabled') || a.hasAttribute('disabled')) { return; }
        var panel = destino(a);
        var lista = a.closest('ul, ol, nav, [role="tablist"], .nav') || a.parentNode;
        var previa = null;
        lista.querySelectorAll('[data-toggle="tab"], [data-toggle="pill"]').forEach(function (otra) {
            if (otra !== a && (otra.classList.contains('active') || (otra.parentNode.tagName === 'LI' && otra.parentNode.classList.contains('active')))) { previa = otra; }
        });
        if (a.classList.contains('active') && panel && panel.classList.contains('active')) { return; }
        if (previa && !disparar(previa, 'hide.bs.tab', a)) { return; }
        if (!disparar(a, 'show.bs.tab', previa)) { return; }
        lista.querySelectorAll('[data-toggle="tab"], [data-toggle="pill"]').forEach(function (otra) {
            otra.classList.remove('active');
            otra.setAttribute('aria-selected', 'false');
            if (otra.parentNode.tagName === 'LI') { otra.parentNode.classList.remove('active'); }
        });
        a.classList.add('active');
        a.setAttribute('aria-selected', 'true');
        if (a.parentNode.tagName === 'LI') { a.parentNode.classList.add('active'); }
        if (panel && panel.parentNode) {
            Array.prototype.forEach.call(panel.parentNode.children, function (p) {
                if (p !== panel && p.classList.contains('tab-pane')) { p.classList.remove('active', 'show', 'in'); }
            });
            panel.classList.add('active', 'show', 'in');
        }
        if (previa) { disparar(previa, 'hidden.bs.tab', a); }
        disparar(a, 'shown.bs.tab', previa);
    }

    /* ---------- Colapsables (data-toggle="collapse") ---------- */
    function abierto(c) { return c.classList.contains('show') || c.classList.contains('in'); }
    function disparadoresDe(c) {
        if (!c.id) { return []; }
        return Array.prototype.slice.call(document.querySelectorAll('[data-toggle="collapse"]')).filter(function (d) {
            return destino(d) === c;
        });
    }
    function mostrarColapso(x) {
        var c = nodo(x);
        if (!c || abierto(c) || !disparar(c, 'show.bs.collapse')) { return; }
        var padre = null;
        disparadoresDe(c).forEach(function (d) { padre = padre || buscar(d.getAttribute('data-parent')); });
        if (padre) {
            padre.querySelectorAll('.collapse.show, .collapse.in').forEach(function (otro) { if (otro !== c) { ocultarColapso(otro); } });
        }
        c.classList.add('show', 'in');
        disparadoresDe(c).forEach(function (d) { d.classList.remove('collapsed'); d.setAttribute('aria-expanded', 'true'); });
        despues(function () { disparar(c, 'shown.bs.collapse'); });
    }
    function ocultarColapso(x) {
        var c = nodo(x);
        if (!c || !abierto(c) || !disparar(c, 'hide.bs.collapse')) { return; }
        c.classList.remove('show', 'in');
        disparadoresDe(c).forEach(function (d) { d.classList.add('collapsed'); d.setAttribute('aria-expanded', 'false'); });
        despues(function () { disparar(c, 'hidden.bs.collapse'); });
    }
    function alternarColapso(x) {
        var c = nodo(x);
        if (c) { abierto(c) ? ocultarColapso(c) : mostrarColapso(c); }
    }

    /* ---------- Atributos data-toggle / data-dismiss ---------- */
    document.addEventListener('click', function (ev) {
        var t = ev.target;
        if (!t || !t.closest) { return; }
        if (t.matches('.tw-modal-compat[data-panel-modal]')) {
            if (t.getAttribute('data-backdrop') !== 'static') { cerrar(t); }
            return;
        }

        var fondo = t.closest('[data-panel-modal-fondo]');
        if (fondo) {
            var mf = fondo.closest('[data-panel-modal]');
            if (mf && mf.getAttribute('data-backdrop') !== 'static') { cerrar(mf); }
            return;
        }
        var d = t.closest('[data-dismiss="modal"]');
        if (d) {
            var md = d.closest('[data-panel-modal]');
            if (md) { ev.preventDefault(); cerrar(md); }
            return;
        }
        d = t.closest('[data-dismiss="alert"]');
        if (d) {
            var alerta = d.closest('.alert, [role="alert"]');
            if (alerta) { ev.preventDefault(); alerta.parentNode.removeChild(alerta); }
            return;
        }
        d = t.closest('[data-toggle]');
        if (!d) { return; }
        var tipo = d.getAttribute('data-toggle');
        if (tipo === 'modal') {
            var m = destino(d);
            if (esModal(m)) { if (d.tagName === 'A') { ev.preventDefault(); } abrir(m, d); }
        } else if (tipo === 'tab' || tipo === 'pill') {
            ev.preventDefault();
            mostrarPestana(d);
        } else if (tipo === 'collapse') {
            if (d.tagName === 'A') { ev.preventDefault(); }
            var c = destino(d);
            if (c) { alternarColapso(c); }
        }
    });
    document.addEventListener('keydown', function (ev) {
        if ((ev.key === 'Escape' || ev.key === 'Esc') && abiertos.length) {
            var m = abiertos[abiertos.length - 1];
            if (m.getAttribute('data-keyboard') !== 'false') { cerrar(m); }
        }
    });

    /* ---------- Puente con jQuery ---------- */
    function instalar($) {
        if (!$ || !$.fn || $.fn.modal === puenteModal) { return; }
        // Bootstrap JS (si vino dentro de otra librería): sin sus manejadores data-toggle/data-dismiss.
        $(document).off('.data-api');
        $.fn.modal = puenteModal;
        $.fn.tab = function (op) {
            return this.each(function () { if (op === 'show' || op === undefined) { mostrarPestana(this); } });
        };
        $.fn.collapse = function (op) {
            return this.each(function () {
                if (op === 'show') { mostrarColapso(this); } else if (op === 'hide') { ocultarColapso(this); } else { alternarColapso(this); }
            });
        };
        // Tooltips y popovers de Bootstrap: sin Bootstrap se usa el title nativo del navegador.
        ['tooltip', 'popover'].forEach(function (n) {
            if (!$.fn[n] || $.fn[n].Constructor) { $.fn[n] = function () { return this; }; }
        });
    }
    function puenteModal(op) {
        return this.each(function () {
            if (op === 'hide') { cerrar(this); } else if (op === 'toggle') { alternar(this); } else if (op === undefined || op === 'show' || typeof op === 'object') { abrir(this); }
        });
    }

    instalar(window.jQuery);
    // Algunas pantallas cargan otra copia de jQuery dentro de su contenido: se instala también en esa.
    document.addEventListener('DOMContentLoaded', function () { instalar(window.jQuery); });
    window.addEventListener('load', function () { instalar(window.jQuery); });

    window.PanelModal = { abrir: abrir, cerrar: cerrar, alternar: alternar };
    window.PanelPuente = { instalar: instalar, mostrarPestana: mostrarPestana, mostrarColapso: mostrarColapso, ocultarColapso: ocultarColapso };
})();
</script>
