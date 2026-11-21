const {test} = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const origen = fs.readFileSync('public/js/panel/formularios.js', 'utf8');

test('el envío nativo con PDF conserva el formulario y bloquea un segundo envío', () => {
    const attrs = new Map();
    const avisos = [];
    const eventos = {};
    const campo = {
        name: 'archivo', type: 'file', files: [{name: 'archivo.txt', size: 200}],
        dataset: {panelArchivo: 'pdf'}, validity: {valid: true}, willValidate: true,
        labels: [], closest: () => null, insertAdjacentElement() {}, getClientRects: () => [],
        setAttribute: (k, v) => attrs.set('archivo:' + k, v),
        getAttribute: k => attrs.get('archivo:' + k),
    };
    const form = {
        id: 'oficio', method: 'post', dataset: {}, elements: [campo],
        append: el => form.elements.push(el), querySelectorAll: () => [],
        setAttribute: (k, v) => attrs.set(k, v), getAttribute: k => attrs.get(k),
        removeAttribute: k => attrs.delete(k),
    };
    function $(elemento) {
        if (typeof elemento === 'function') { elemento(); return; }
        return {on: (evento, fn) => eventos[evento] = fn, triggerHandler() {}};
    }
    const window = {jQuery: $, Swal: {fire: datos => { avisos.push(datos); return Promise.resolve(); }}, addEventListener() {}};
    const document = {
        querySelectorAll: selector => selector === '[data-panel-envio]' ? [form] : [],
        createElement: () => ({}), addEventListener() {},
    };
    vm.runInNewContext(origen, {window, document});
    function enviar() {
        let cancelado = false;
        eventos['submit.panelEnvio']({isDefaultPrevented: () => false, preventDefault() { cancelado = true; }});
        return cancelado;
    }
    assert.equal(enviar(), true);
    assert.match(avisos[0].text, /PDF/);
    assert.equal(form.noValidate, true);
    campo.files = [{name: 'archivo.PDF', size: 200}];
    assert.equal(enviar(), false);
    assert.equal(form.getAttribute('aria-busy'), 'true');
    assert.equal(enviar(), true);
    assert.equal(form.elements[1].value, 'oficio');
});
