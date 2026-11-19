// Inicialización de Alpine para el panel (persist y collapse, igual que la plantilla TailAdmin).
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';

Alpine.plugin(persist);
Alpine.plugin(collapse);

export default Alpine;
