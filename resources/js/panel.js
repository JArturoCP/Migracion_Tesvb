// Punto de entrada del nuevo diseño (layouts/panel.blade.php).
import Alpine from './panel/alpine';
import dropdown from './panel/dropdown';
import registrarBuscador from './panel/buscador';
import selectorPeriodo from './panel/periodos';
import registrarModalPeriodoIngles from './panel/modal_periodo_ingles';
import iniciarGraficas from './panel/graficas';

Alpine.data('dropdown', dropdown);
Alpine.data('selectorPeriodo', selectorPeriodo);
registrarBuscador(Alpine);
registrarModalPeriodoIngles();

window.Alpine = Alpine;
Alpine.start();

// Gráficas del dashboard (solo si la página tiene elementos [data-grafica]).
iniciarGraficas();
