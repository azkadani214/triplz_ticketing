import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import FullReload from 'vite-plugin-full-reload';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        FullReload([
            'app/**/*.php',
            'routes/**/*.php',
            'resources/views/**/*.blade.php',
        ]),
    ],
});
