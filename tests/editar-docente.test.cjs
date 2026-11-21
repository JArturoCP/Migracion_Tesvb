const test = require('node:test');
const assert = require('node:assert/strict');
const vm = require('node:vm');
const fs = require('node:fs');
const source = fs.readFileSync('public/js/docentes/editar.js', 'utf8');
const panelSource = fs.readFileSync('public/js/panel/formularios.js', 'utf8');

function setup() {
    const fields = new Map();
    let submit, request;
    const alerts = [];
    let calls = 0;
    const button = { innerHTML: 'Guardar cambios', disabled: false };
    const elements = ['nombre_docente', 'correo'].map(name => ({
        name, type: name === 'correo' ? 'email' : 'text',
        value: name === 'correo' ? 'prueba@example.com' : '1',
        required: true, willValidate: true, validity: {valid: true},
        labels: [{textContent: name === 'correo' ? 'Correo' : 'Nombre'}],
        hasAttribute: () => false, getAttribute: () => null, setAttribute() {},
        closest: () => null, getClientRects: () => [], insertAdjacentElement() {},
    }));
    elements.forEach(field => fields.set(field.name, field));
    elements.namedItem = name => fields.get(name);
    const form = {
        action: '/docente/7',
        elements,
        querySelectorAll: () => [], setAttribute() {}, removeAttribute() {},
    };
    const document = {
        getElementById: id => id === 'form_docente_edita' ? form : button,
        createElement: () => ({setAttribute() {}}),
        querySelectorAll: () => [],
        addEventListener() {},
    };
    function $(value) {
        if (typeof value === 'function') return value();
        return {
            on(event, handler) { submit = handler; },
            serialize: () => '_method=PUT&_token=test',
            triggerHandler() {},
            closest: () => ({addClass() {}, removeClass() {}}),
        };
    }
    $.ajax = options => {
        calls++;
        request = { options,
            done(fn) { this.success = fn; return this; },
            fail(fn) { this.failure = fn; return this; },
            always(fn) { this.finish = fn; return this; },
        };
        return request;
    };
    const Swal = { fire(options) { alerts.push(options); return Promise.resolve(); } };
    const context = vm.createContext({document, window: {jQuery: $, Swal}});
    vm.runInContext(panelSource, context);
    vm.runInContext(source, context);
    return { fields, alerts, button, form, submit: () => submit({preventDefault() {}}),
        get calls() { return calls; }, get request() { return request; } };
}

test('missing name prevents submission and displays a validation alert', () => {
    const s = setup();
    s.form.elements.namedItem('nombre_docente').value = '';
    s.submit();
    assert.equal(s.calls, 0);
    assert.equal(s.alerts[0].icon, 'warning');
    assert.match(s.alerts[0].text, /Nombre/);
});

test('double submit is blocked and success waits for the server', () => {
    const s = setup();
    s.submit(); s.submit();
    assert.equal(s.calls, 1);
    assert.equal(s.button.disabled, true);
    assert.equal(s.alerts.length, 0);
    s.request.success({message: 'Datos actualizados correctamente.'});
    s.request.finish();
    assert.equal(s.alerts[0].icon, 'success');
    assert.equal(s.button.disabled, false);
});

test('422 keeps input and unlocks the button for correction', () => {
    const s = setup();
    s.form.elements.namedItem('nombre_docente').value = 'Mi nombre';
    s.submit();
    s.request.failure({status: 422, responseJSON: {errors: {correo: ['Correo inválido.']}}});
    s.request.finish();
    assert.equal(s.alerts[0].icon, 'warning');
    assert.equal(s.fields.get('nombre_docente').value, 'Mi nombre');
    assert.equal(s.button.disabled, false);
});

test('server errors do not expose SQL or report success', () => {
    const s = setup(); s.submit();
    s.request.failure({status: 500, responseJSON: {message: 'SQLSTATE secret'}});
    s.request.finish();
    assert.equal(s.alerts[0].icon, 'error');
    assert.doesNotMatch(s.alerts[0].text, /SQLSTATE/);
    assert.equal(s.button.disabled, false);
});
