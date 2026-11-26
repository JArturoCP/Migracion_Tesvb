// Punto de entrada del nuevo diseño (layouts/panel.blade.php).
import Alpine from './panel/alpine';
import dropdown from './panel/dropdown';
import registrarBuscador from './panel/buscador';
import selectorPeriodo from './panel/periodos';
import registrarModalPeriodoIngles from './panel/modal_periodo_ingles';
import iniciarGraficas from './panel/graficas';
import sidebar from './panel/sidebar';
import './carga'; // Indicador de carga al cambiar de pantalla o enviar formularios.

Alpine.data('dropdown', dropdown);
Alpine.data('selectorPeriodo', selectorPeriodo);
Alpine.data('sidebar', sidebar);
registrarBuscador(Alpine);
registrarModalPeriodoIngles();

window.Alpine = Alpine;
Alpine.start();

// Gráficas del dashboard (solo si la página tiene elementos [data-grafica]).
iniciarGraficas();
