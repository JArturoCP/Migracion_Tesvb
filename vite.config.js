import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { copyFileSync, mkdirSync } from 'node:fs';

// DataTables 1.13.6 (npm, misma versión que el CDN de layouts/app) se copia sin cambios a public/vendor:
// es el archivo UMD original, que como script normal se cuelga del jQuery global de cada pantalla
// ($.fn.dataTable / $.fn.DataTable), igual que el de cdn.datatables.net. Lo cargan las pantallas del panel.
function copiarDataTables() {
    return {
        name: 'tesvb-copiar-datatables',
        buildStart() {
            const destino = 'public/vendor/datatables/1.13.6';
            mkdirSync(destino, { recursive: true });
            copyFileSync('node_modules/datatables.net/js/jquery.dataTables.min.js', `${destino}/jquery.dataTables.min.js`);
            copyFileSync('node_modules/datatables.net/License.txt', `${destino}/License.txt`);
        },
    };
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Breeze: se conservan para que el @vite de layouts/guest.blade.php siga funcionando.
                'resources/css/app.css',
                'resources/js/app.js',
                // Nuevo diseño: /inicio (layouts/panel) y marco de los módulos (layouts/marco).
                'resources/css/marco.css',
                'resources/js/panel.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
        copiarDataTables(),
    ],
    build: {
        // ApexCharts (~1 MB) queda en un archivo aparte que solo se descarga en páginas con gráficas
        // (import dinámico en resources/js/panel/graficas.js); no afecta la carga del resto de la app.
        chunkSizeWarningLimit: 1100,
    },
});
