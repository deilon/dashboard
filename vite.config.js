import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // input: ['resources/css/style.min.css', 'resources/scss/app.scss', 'resources/js/app.js'],
            input: ['resources/css/app.css'],
            refresh: true,
        }),
    ],
});
