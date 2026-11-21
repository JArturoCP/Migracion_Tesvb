const test = require('node:test');
const assert = require('node:assert/strict');
const vm = require('node:vm');
const fs = require('node:fs');

test('conserva las alertas por paso y solo completa secciones cuando se guardan', () => {
    const eventos = new Map();
    const visibles = new Map();
    const nombres = ['nombre', 'perfil'];
    const secciones = nombres.map(() => ({querySelector: () => ({focus() {}})}));
    const elemento = () => ({addEventListener(_, accion) { this.click = accion; }});
    const pasos = nombres.map((nombre, i) => {
        const subelementos = {'[data-stepper-alerta]': {}, '[data-stepper-estado]': {}};
        return Object.assign(elemento(), {
            dataset: {}, getAttribute: () => nombre,
            setAttribute(_, valor) { this.actual = valor; }, removeAttribute() { delete this.actual; },
            querySelector: selector => subelementos[selector],
        });
    });
    const elementos = nombres.map((name, i) => ({name, closest: () => secciones[i]}));
    const barra = {
        querySelectorAll: () => pasos,
        querySelector: () => ({}),
    };
    const siguiente = elemento();
    const controles = {
        '[data-panel-stepper-controls]': barra,
        '[data-stepper-anterior]': elemento(),
        '[data-stepper-siguiente]': siguiente,
        '[data-stepper-navegacion]': {},
    };
    const form = {
        dataset: {}, elements: elementos,
        querySelector: selector => controles[selector],
        querySelectorAll: () => [...visibles.keys()],
    };
    const document = {
        getElementById: id => secciones[nombres.indexOf(id)],
        querySelectorAll: () => [form],
    };
    const jquery = value => typeof value === 'function' ? value() : {
        on(evento, ...args) { eventos.set(evento, args.at(-1)); return this; },
    };
    let cliente = {nombre: 'Completa el nombre.'};
    const panel = {
        revisarCampos: () => cliente,
        limpiarCampo: nombre => visibles.delete(nombre),
        marcarCampo: (_, nombre, mensaje) => visibles.set(nombre, mensaje),
    };
    vm.runInNewContext(fs.readFileSync('public/js/panel/stepper.js', 'utf8'), {
        document, window: {jQuery: jquery, PanelFormularios: panel},
    });
    const estados = () => pasos.map(paso => paso.dataset.estado);
    assert.deepEqual(estados(), ['activo', 'pendiente']);
    siguiente.click();
    assert.deepEqual(estados(), ['error', 'activo']);
    pasos[0].click();
    assert.equal(secciones[0].hidden, false);
    assert.equal(visibles.get('nombre'), 'Completa el nombre.');

    cliente = {};
    eventos.get('panel:errores')(null, {perfil: ['Perfil inválido.']}, 'servidor');
    assert.equal(secciones[1].hidden, false);
    assert.deepEqual(estados(), ['pendiente', 'error']);
    eventos.get('input change').call(elementos[1]);
    assert.equal(pasos[1].querySelector('[data-stepper-alerta]').hidden, false);
    assert.equal(visibles.get('perfil'), 'Guarda para volver a validar este campo.');
    eventos.get('panel:enviando')();
    eventos.get('panel:guardado')();
    assert.deepEqual(estados(), ['completado', 'completado']);
    assert.equal(pasos[1].querySelector('[data-stepper-alerta]').hidden, true);
    assert.equal(visibles.size, 0);
});
