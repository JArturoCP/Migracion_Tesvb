import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Breeze: se conservan para que el @vite de layouts/guest.blade.php siga funcionando.
                'resources/css/app.css',
                'resources/js/app.js',
                // Nuevo diseño (layouts/panel.blade.php).
                'resources/css/panel.css',
                'resources/js/panel.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        // ApexCharts (~1 MB) queda en un archivo aparte que solo se descarga en páginas con gráficas
        // (import dinámico en resources/js/panel/graficas.js); no afecta la carga del resto de la app.
        chunkSizeWarningLimit: 1100,
    },
});
