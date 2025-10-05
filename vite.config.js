import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: 'localhost',
        port: 5174, // ✅ CAMBIADO de 5173 a 5174
        strictPort: false,
        hmr: {
            host: 'localhost',
        },
    },
});