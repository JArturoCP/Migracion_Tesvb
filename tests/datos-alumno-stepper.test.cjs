const {test} = require('node:test');
const assert = require('node:assert/strict');
const {readFileSync} = require('node:fs');
const vm = require('node:vm');
const codigo = readFileSync('public/js/alumnos/datos-stepper.js', 'utf8');

function preparar() {
    let foco;
    const nodo = (id, attrs = {}) => ({
        id,
        dataset: {},
        eventos: {},
        textContent: id,
        getAttribute: clave => attrs[clave],
        setAttribute: (clave, valor) => { attrs[clave] = String(valor); },
        addEventListener(evento, fn) { this.eventos[evento] = fn; },
        focus() { foco = this.id; },
    });
    const secciones = ['cero', 'uno', 'dos', 'tres', 'cuatro'];
    const titulos = Object.fromEntries(secciones.map(id => [id, nodo('titulo-' + id)]));
    const tabs = secciones.map((id, i) => Object.assign(nodo('tab-' + id, {'aria-controls': id, 'aria-selected': String(i === 0)}), {
        querySelector: () => ({textContent: id}),
    }));
    const anterior = nodo('paso_alumno_anterior');
    const siguiente = nodo('paso_alumno_siguiente');
    const continuar = nodo('paso_alumno_continuar');
    const fin = nodo('paso_alumno_fin');
    const progreso = nodo('progreso');
    const barra = nodo('barra');
    const posicion = nodo('posicion');
    const stepper = {
        querySelectorAll: () => tabs,
        querySelector: clave => ({'[data-alumno-progreso]': progreso, '[data-alumno-barra]': barra, '[data-alumno-posicion]': posicion}[clave]),
    };
    const nodos = Object.fromEntries([anterior, siguiente, continuar, fin].map(nodo => [nodo.id, nodo]));
    nodos.stepper_alumno = stepper;
    secciones.forEach(id => { nodos[id] = {querySelector: () => titulos[id]}; });
    function jquery(objeto) {
        if (typeof objeto === 'function') { objeto(); return; }
        return {
            on(evento, fn) {
                objeto.forEach(el => { el.eventos[evento] = fn; });
                return this;
            },
            tab() {
                tabs.forEach(tab => tab.setAttribute('aria-selected', tab === objeto));
                objeto.eventos['shown.bs.tab'].call(objeto);
            },
        };
    }
    vm.runInNewContext(codigo, {window: {jQuery: jquery}, document: {getElementById: id => nodos[id]}});
    return {anterior, siguiente, continuar, fin, progreso, barra, posicion, tabs, jquery, foco: () => foco};
}

test('Anterior y Siguiente actualizan el progreso y solo muestran Guardar en el último paso', () => {
    const s = preparar();
    assert.equal(s.anterior.disabled, true);
    assert.equal(s.fin.hidden, true);
    s.siguiente.eventos.click();
    assert.equal(s.posicion.textContent, 'Paso 2 de 5');
    assert.equal(s.foco(), 'titulo-uno');
    for (let i = 0; i < 3; i++) { s.siguiente.eventos.click(); }
    assert.equal(s.barra.dataset.paso, '5');
    assert.equal(s.fin.hidden, false);
    assert.equal(s.continuar.hidden, true);
    s.anterior.eventos.click();
    assert.equal(s.fin.hidden, true);
    assert.equal(s.progreso.getAttribute('aria-valuenow'), '4');
});

test('las flechas y un cambio programático por validación actualizan el mismo stepper', () => {
    const s = preparar();
    let cancelado = false;
    s.tabs[0].eventos.keydown.call(s.tabs[0], {key: 'End', preventDefault() { cancelado = true; }});
    assert.equal(cancelado, true);
    assert.equal(s.foco(), 'tab-cuatro');
    assert.equal(s.tabs[4].tabIndex, 0);
    s.jquery(s.tabs[2]).tab('show');
    assert.equal(s.progreso.getAttribute('aria-valuenow'), '3');
    assert.equal(s.tabs[2].tabIndex, 0);
    assert.equal(s.tabs[4].tabIndex, -1);
    assert.equal(s.fin.hidden, true);
});
