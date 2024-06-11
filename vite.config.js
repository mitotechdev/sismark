import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/fonts/boxicons.css',
                'resources/css/core.min.css',
                'resources/css/timeline.css',
                'resources/css/upload.css',
                'resources/css/loader.css',
                'resources/css/theme-default.css',
                'resources/css/demo.css',
                'resources/css/perfect-scrollbar.css',
                'resources/css/dataTables-bootstrap5.min.css',
                'resources/css/page-auth.css',
                'resources/js/loader.js',
                'resources/js/confirm.js',
                'resources/js/select-box.js',
                'resources/js/vendor/helpers.js',
                'resources/js/vendor/config.js',
                'resources/js/vendor/popper.js',
                'resources/js/vendor/perfect-scrollbar.js',
                'resources/js/vendor/menu.js',
                'resources/js/vendor/main.js',
                'resources/js/table.js',
                'resources/js/approvement.js',
                'resources/js/dynamic-add-input.js',
            ],
            refresh: true,
        }),
    ],
});