const {test} = require('node:test');
const assert = require('node:assert/strict');
const {readFileSync} = require('node:fs');
const vm = require('node:vm');
const codigo = readFileSync('public/js/alumnos/datos-stepper.js', 'utf8');

function preparar(conFormulario = false) {
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
    const avisos = Object.fromEntries(secciones.map(id => [id, nodo('aviso-' + id)]));
    const estados = secciones.map(id => nodo('estado-' + id));
    const tabs = secciones.map((id, i) => Object.assign(nodo('tab-' + id, {'aria-controls': id, 'aria-selected': String(i === 0)}), {
        querySelector: selector => selector === '[data-alumno-estado]' ? estados[i] : {textContent: id},
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
    secciones.forEach(id => {
        nodos[id] = {querySelector: selector => selector === '[data-alumno-aviso]' ? avisos[id] : titulos[id]};
    });
    const campos = [
        {name: 'correoalu', closest: () => ({id: 'uno'})},
        {name: 'calle_alu', closest: () => ({id: 'dos'})},
        {name: 'fecha_nac_tutor', closest: () => ({id: 'tres'})},
    ];
    const marcas = new Map();
    const form = {...nodo('formgeneral'), elements: campos, querySelectorAll: () => campos};
    const escuela = nodo('form_escuela_cct_modal');
    const validador = {errorMap: {}, checkForm() {}};
    if (conFormulario) { nodos.formgeneral = form; }
    function jquery(objeto) {
        if (typeof objeto === 'function') { objeto(); return; }
        if (objeto === '#form_escuela_cct_modal') { objeto = escuela; }
        return {
            on(evento, selector, fn) {
                (Array.isArray(objeto) ? objeto : [objeto]).forEach(el => { el.eventos[evento] = fn || selector; });
                return this;
            },
            triggerHandler(evento, args = []) { objeto.eventos[evento]?.call(objeto, {}, ...args); },
            data: () => validador,
            tab() {
                tabs.forEach(tab => tab.setAttribute('aria-selected', tab === objeto));
                objeto.eventos['shown.bs.tab'].call(objeto);
            },
        };
    }
    const PanelFormularios = {
        marcarCampo: (_, nombre, mensaje) => marcas.set(nombre, mensaje),
        limpiarCampo: campo => marcas.delete(campo.name),
    };
    vm.runInNewContext(codigo, {
        window: {jQuery: jquery, PanelFormularios}, document: {getElementById: id => nodos[id]},
        setTimeout: fn => fn(), clearTimeout() {},
    });
    return {anterior, siguiente, continuar, fin, progreso, barra, posicion, tabs, jquery, foco: () => foco,
        avisos, marcas, campos, form, escuela, validador};
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

test('Siguiente revisa solo la sección que se deja y conserva su alerta al navegar', () => {
    const s = preparar(true);
    assert.equal(s.tabs[0].dataset.estado, 'completado');
    assert.equal(s.tabs[1].dataset.estado, 'pendiente');
    s.siguiente.eventos.click();
    assert.equal(s.tabs[1].dataset.estado, 'activo');
    s.validador.errorMap = {correoalu: 'Correo obligatorio', calle_alu: 'Calle obligatoria'};
    s.siguiente.eventos.click();
    assert.equal(s.tabs[1].dataset.estado, 'error');
    assert.equal(s.tabs[2].dataset.estado, 'activo');
    assert.equal(s.marcas.get('correoalu'), 'Correo obligatorio');
    assert.equal(s.marcas.has('calle_alu'), false);
    s.jquery(s.tabs[1]).tab('show');
    assert.match(s.avisos.uno.textContent, /campo marcado/);
    s.validador.errorMap = {calle_alu: 'Calle obligatoria'};
    s.form.eventos['input change'].call(s.campos[0]);
    assert.equal(s.tabs[1].dataset.estado, 'activo');
    assert.equal(s.marcas.has('correoalu'), false);
});

test('los errores de distintas secciones y los del servidor se quitan solo tras la corrección correspondiente', () => {
    const s = preparar(true);
    s.jquery(s.form).triggerHandler('panel:errores', [{correoalu: 'Correo inválido', calle_alu: 'Calle obligatoria'}, 'cliente']);
    assert.deepEqual(s.tabs.slice(1, 3).map(tab => tab.dataset.estado), ['error', 'error']);
    s.jquery(s.form).triggerHandler('panel:enviando');
    s.jquery(s.form).triggerHandler('panel:errores', [{fecha_nac_tutor: ['Fecha rechazada']}, 'servidor']);
    assert.equal(s.tabs[3].dataset.estado, 'error');
    s.form.eventos['input change'].call(s.campos[2]);
    assert.equal(s.tabs[3].dataset.estado, 'error');
    assert.match(s.marcas.get('fecha_nac_tutor'), /volver a validar/);
    s.jquery(s.form).triggerHandler('panel:enviando');
    s.jquery(s.form).triggerHandler('panel:guardado');
    assert.equal(s.tabs[3].dataset.estado, 'completado');
    assert.equal(s.marcas.size, 0);
    s.jquery(s.escuela).triggerHandler('panel:errores', [{id_escuela: 'No disponible'}]);
    assert.equal(s.tabs[0].dataset.estado, 'error');
    s.jquery(s.escuela).triggerHandler('panel:guardado');
    assert.equal(s.tabs[0].dataset.estado, 'completado');
});
