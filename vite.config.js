import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/vendor/bootstrap.js',
                'resources/js/style.js',
                'resources/js/dynamic-add-input.js',
                'resources/css/loader.css',
                'resources/css/upload.css',
                'resources/css/timeline.css',
                'resources/css/page-auth.css',
                'resources/js/loader.js',
                'resources/js/approvement.js',
            ],
            refresh: true,
        }),
    ],
});