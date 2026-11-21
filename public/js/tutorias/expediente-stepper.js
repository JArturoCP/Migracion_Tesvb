(function ($) {
    'use strict';

    const requeridos = {
        generales: ['estado', 'nivel_economico', 'materias_especial', 'materias_repeticion', 'direccion', 'id_periodo',
            'no_hijos', 'id_grupo', 'sexo', 'id_estado_civil', 'trabaja', 'turno'],
        academicos: ['teestimula_familia', 'tegusta_carrera_elegida', 'otra_carrera_ini'],
        familiares: ['nombre_padre', 'nombre_madre', 'lugar_residencia_madre', 'lugar_residencia_padre', 'etnia_indigena',
            'hablas_lengua_indigena', 'id_opc_vives', 'id_familia_union', 'nombre_tutor', 'id_parentesco'],
        estudio: ['forma_estudio', 'tiempo_empleado_estudiar', 'id_opc_intelectual'],
        integral: ['enfermedad_cronica', 'enf_cron_padre', 'operacion', 'enfer_visual', 'medicamento_controlado',
            'practica_deporte', 'practica_artistica', 'actividades_culturales', 'usas_lentes'],
        area: ['trabajo_equipo', 'rendimiento_escolar', 'conocimiento_compu', 'comprension', 'concentracion',
            'otro_idioma', 'solucion_problemas', 'preparacion', 'busqueda_bibliografica']
    };
    const grupos = Object.keys(requeridos);
    const vacio = valor => valor == null || valor === 'null' || (typeof valor === 'string' && !valor.trim());

    function faltantes(alu, edicion, imagen, secciones) {
        const errores = {};
        for (const grupo of secciones) {
            for (const campo of requeridos[grupo]) {
                if (vacio(alu[grupo][campo])) { errores[`${grupo}.${campo}`] = 'Completa este campo.'; }
            }
        }
        if (secciones.includes('generales')) {
            const {beca, id_expbeca: tipoBeca} = alu.generales;
            if (!['1', '2'].includes(String(beca))) { errores['generales.beca'] = 'Indica si tienes una beca.'; }
            else if (String(beca) === '1' && vacio(tipoBeca)) { errores['generales.id_expbeca'] = 'Selecciona el tipo de beca.'; }
            if (!edicion && !imagen) { errores['generales.foto'] = 'Selecciona una fotografía.'; }
        }
        return errores;
    }

    function crear(edicion) {
        return {
            data: () => ({guardandoExpediente: false}),
            mounted() {
                const navegacion = this.$el.querySelector('[data-tutoria-tabs]');
                this.expTabs = Array.from(navegacion.querySelectorAll('[role="tab"]'));
                this.expRevisadas = new Set();
                this.expServidor = {};
                this.expGuardado = false;
                this.expPintar = window.PanelStepperSecciones.controles(this.$el, indice => {
                    this.irAlPasoExpediente(indice);
                    this.$nextTick(() => this.$el.querySelectorAll('[role="tabpanel"]')[indice].querySelector('h4')?.focus());
                });
                navegacion.hidden = true;
                $(this.expTabs).on('shown.bs.tab', this.pintarExpediente);
                this.pintarExpediente();
            },
            watch: {
                alu: {deep: true, handler() {
                    this.expGuardado = false;
                    this.$nextTick(this.pintarExpediente);
                }},
                imagenMiniatura() { this.$nextTick(this.pintarExpediente); }
            },
            methods: {
                irAlPasoExpediente(indice) {
                    const tab = this.expTabs[indice];
                    if (!tab || tab.classList.contains('disabled')) { return; }
                    tab.click();
                    this.$nextTick(this.pintarExpediente);
                },
                pintarExpediente() {
                    if (!this.expPintar) { return; }
                    const panel = window.PanelFormularios;
                    const errores = {...this.expServidor, ...faltantes(this.alu, edicion, this.imagenMiniatura, [...this.expRevisadas])};
                    const campos = Array.from(this.$el.querySelectorAll('[data-tutoria-campo]'));
                    campos.forEach(panel.limpiarCampo);
                    const mapa = {};
                    for (const campo of campos) {
                        const nombre = campo.dataset.tutoriaCampo;
                        if (!(nombre in errores) || Object.hasOwn(mapa, nombre)) { continue; }
                        mapa[nombre] = campo;
                        panel.marcarCampo({elements: [campo]}, campo.name || campo.id, errores[nombre]);
                    }
                    const hayError = new Set(Object.keys(errores).map(nombre => nombre.split('.')[0]));
                    const actual = this.expTabs.findIndex(tab => document.getElementById(tab.getAttribute('aria-controls'))?.classList.contains('active'));
                    this.expPintar(Math.max(actual, 0), grupos.map(grupo => hayError.has(grupo)
                        ? 'error' : this.expGuardado ? 'completado' : undefined), this.expTabs.map(tab => tab.classList.contains('disabled')));
                },
                validarExpediente(secciones = grupos) {
                    secciones.forEach(grupo => this.expRevisadas.add(grupo));
                    const errores = faltantes(this.alu, edicion, this.imagenMiniatura, secciones);
                    this.pintarExpediente();
                    const primerCampo = Object.keys(errores)[0];
                    if (!primerCampo) { return true; }
                    this.irAlPasoExpediente(grupos.indexOf(primerCampo.split('.')[0]));
                    window.PanelFormularios.alerta('warning', 'Revisa el expediente', 'Completa los campos marcados en las secciones con alerta.', false)
                        .then(() => this.$el.querySelector(`[data-tutoria-campo="${primerCampo}"]`)?.focus());
                    return false;
                },
                expedienteGuardado() {
                    this.expServidor = {};
                    this.expGuardado = true;
                    this.pintarExpediente();
                },
                errorExpediente(error) {
                    const errores = error.response?.data?.errors || {};
                    this.expServidor = {};
                    for (const [clave, mensajes] of Object.entries(errores)) {
                        const nombre = clave.replace(/^alu\./, '');
                        if (grupos.includes(nombre.split('.')[0])) {
                            this.expServidor[nombre] = Array.isArray(mensajes) ? mensajes.join(' ') : mensajes;
                        }
                    }
                    this.pintarExpediente();
                    const primerCampo = Object.keys(this.expServidor)[0];
                    if (primerCampo) { this.irAlPasoExpediente(grupos.indexOf(primerCampo.split('.')[0])); }
                    window.PanelFormularios.alerta('error', 'No se pudo guardar el expediente', primerCampo
                        ? 'Revisa los campos marcados e intenta de nuevo.' : 'Conservamos los datos de la captura. Intenta nuevamente.');
                }
            }
        };
    }

    window.TutoriasStepper = {crear};
})(window.jQuery);
