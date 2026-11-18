// Punto de entrada del nuevo diseño (layouts/panel.blade.php).
import Alpine from './panel/alpine';
import dropdown from './panel/dropdown';

Alpine.data('dropdown', dropdown);

window.Alpine = Alpine;
Alpine.start();
