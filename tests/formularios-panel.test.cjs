const { test } = require('node:test');
const assert = require('node:assert/strict');
const vm = require('node:vm');
const fs = require('node:fs');
const source = fs.readFileSync('public/js/panel/formularios.js', 'utf8');

function preparar() {
    const atributos = new Map();
    const atributosCampo = new Map();
    const elementos = new Map();
    const alertas = [];
    const visitas = [];
    let solicitudes = 0;
    const boton = {textContent: 'Guardar', disabled: false};
    const campo = {
        name: 'nombre', required: true, willValidate: true, type: 'text', value: '',
        validity: {valid: true}, labels: [{textContent: 'Nombre'}],
        setAttribute: (nombre, valor) => atributosCampo.set(nombre, valor),
        getAttribute: nombre => atributosCampo.get(nombre),
        closest: () => null, getClientRects: () => [],
        insertAdjacentElement: (_, aviso) => elementos.set(aviso.id, aviso),
    };
    const form = {
        action: '/docentes/create', method: 'POST', elements: [campo],
        querySelectorAll: () => [],
        setAttribute: (nombre, valor) => atributos.set(nombre, valor),
        getAttribute: nombre => atributos.get(nombre),
        removeAttribute: nombre => atributos.delete(nombre),
    };
    const request = {
        done(fn) { this.exito = fn; return this; },
        fail(fn) { this.error = fn; return this; },
    };
    const $ = () => ({ serialize: () => '_token=demo&nombre=Prueba' });
    $.ajax = () => { solicitudes++; return request; };
    const window = {
        jQuery: $, Swal: {fire: opciones => { alertas.push(opciones); return Promise.resolve(); }},
        location: { assign: url => visitas.push(url) },
    };
    vm.runInNewContext(source, {window, document: {createElement: () => ({})}});
    return {boton, campo, elementos, form, request, alertas, visitas, api: window.PanelFormularios,
        get solicitudes() { return solicitudes; }};
}

test('los espacios en un campo obligatorio muestran el error y no se envían', () => {
    const s = preparar();
    s.campo.value = '   ';
    s.api.enviar(s.form, s.boton);
    assert.equal(s.solicitudes, 0);
    assert.equal(s.alertas[0].icon, 'warning');
    assert.equal(s.campo.getAttribute('aria-invalid'), 'true');
    assert.match([...s.elementos.values()][0].textContent, /Nombre/);
});

test('un 422 conserva la captura y vuelve a habilitar el guardado', async () => {
    const s = preparar();
    s.campo.value = 'Mi captura';
    s.api.enviar(s.form, s.boton);
    s.api.enviar(s.form, s.boton);
    assert.equal(s.solicitudes, 1);
    assert.equal(s.boton.disabled, true);
    s.request.error({status: 422, responseJSON: {errors: {nombre: ['Revisa el nombre.']}}});
    await new Promise(resolve => setImmediate(resolve));
    assert.equal(s.alertas[0].icon, 'warning');
    assert.equal(s.campo.value, 'Mi captura');
    assert.equal(s.boton.disabled, false);
});

test('la confirmación espera la respuesta del servidor y después navega', async () => {
    const s = preparar();
    s.campo.value = 'Prueba';
    s.api.enviar(s.form, s.boton);
    assert.equal(s.alertas.length, 0);
    s.request.exito({message: 'Guardado correctamente.', redirect: '/home'});
    await new Promise(resolve => setImmediate(resolve));
    assert.equal(s.alertas[0].icon, 'success');
    assert.deepEqual(s.visitas, ['/home']);
});
