// Punto de entrada del nuevo diseño (layouts/panel.blade.php).
import Alpine from './panel/alpine';
import dropdown from './panel/dropdown';
import registrarBuscador from './panel/buscador';
import selectorPeriodo from './panel/periodos';

Alpine.data('dropdown', dropdown);
Alpine.data('selectorPeriodo', selectorPeriodo);
registrarBuscador(Alpine);

window.Alpine = Alpine;
Alpine.start();
