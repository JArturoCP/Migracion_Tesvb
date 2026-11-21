const {test} = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');

test('el envío ignora los campos condicionales inactivos y abre el paso con errores al activarlos', () => {
    const eventos = new Map();
    const paneles = Array.from({length: 3}, () => ({hasAttribute: () => false}));
    const botones = paneles.map(() => ({
        dataset: {}, addEventListener() {}, setAttribute() {}, removeAttribute() {}, querySelector: () => ({}),
    }));
    const controles = {querySelector: () => ({}), querySelectorAll: () => botones};
    const nav = {addEventListener() {}};
    let aplica = false;
    const campo = {
        name: 'dependencia2', value: '', dataset: {stepperRequerido: 'Ingresa la segunda dependencia.'},
        matches: () => aplica, closest: selector => selector === '[data-stepper-seccion]' ? paneles[1] : null,
        focus() {},
    };
    const form = {dataset: {}, elements: Object.assign([campo], {namedItem: () => campo})};
    const root = {
        dataset: {}, querySelector: selector => selector === '[data-panel-stepper-controls]' ? controles : nav,
        querySelectorAll: selector => ({
            '[data-stepper-seccion]': paneles, 'form[data-stepper-formulario]': [form],
        })[selector] || [],
    };
    const $ = value => typeof value === 'function' ? value() : {
        on(evento, ...args) { eventos.set(evento, args.at(-1)); return this; },
        val: () => value.value,
    };
    const alertas = [];
    const panel = {
        alerta: (_, __, mensaje) => { alertas.push(mensaje); return Promise.resolve(); },
        marcarCampo() {}, limpiarCampo() {},
    };
    vm.runInNewContext(fs.readFileSync('public/js/panel/stepper-secciones.js', 'utf8'), {
        document: {querySelectorAll: () => [root]},
        window: {jQuery: $, PanelFormularios: panel, addEventListener() {}},
    });

    const enviar = eventos.get('submit.stepper');
    const intento = {isDefaultPrevented: () => false, preventDefault() { this.bloqueado = true; }};
    enviar(intento);
    assert.equal(form.dataset.stepperEnviando, 'true');
    delete form.dataset.stepperEnviando;

    aplica = true;
    enviar(intento);
    assert.equal(intento.bloqueado, true);
    assert.equal(paneles[1].hidden, false);
    assert.equal(botones[1].dataset.estado, 'error');
    assert.match(alertas[0], /segunda dependencia/);

    aplica = false;
    eventos.get('stepper:revisar')();
    assert.equal(botones[1].dataset.estado, 'activo');
});

test('Tutorías valida la foto solo en alta y el tipo de beca solo si corresponde', () => {
    const window = {PanelFormularios: {alerta: () => Promise.resolve()}};
    vm.runInNewContext(fs.readFileSync('public/js/tutorias/expediente-stepper.js', 'utf8'), {window});
    const generales = Object.fromEntries([
        'estado', 'nivel_economico', 'materias_especial', 'materias_repeticion', 'direccion', 'id_periodo',
        'no_hijos', 'id_grupo', 'sexo', 'id_estado_civil', 'trabaja', 'turno',
    ].map(campo => [campo, 0]));
    const instancia = {
        alu: {generales: {...generales, beca: 2, id_expbeca: null}},
        expRevisadas: new Set(), pintarExpediente() {}, irAlPasoExpediente() {}, $el: {querySelector: () => null},
    };
    const validarAlta = window.TutoriasStepper.crear(false).methods.validarExpediente;
    const validarEdicion = window.TutoriasStepper.crear(true).methods.validarExpediente;
    assert.equal(validarAlta.call(instancia, ['generales']), false);
    assert.equal(validarEdicion.call(instancia, ['generales']), true);
    instancia.imagenMiniatura = 'foto.png';
    instancia.alu.generales.beca = '1';
    assert.equal(validarAlta.call(instancia, ['generales']), false);
    instancia.alu.generales.id_expbeca = '3';
    assert.equal(validarAlta.call(instancia, ['generales']), true);
});
