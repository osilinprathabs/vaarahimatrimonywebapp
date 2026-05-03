import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/vendor.js',
                'resources/js/pages/dashboard-analytics.js',
                'resources/js/pages/datatables-basic.js',
                'resources/js/pages/form-select2.js',
                'resources/js/pages/plugins-sweetalerts.js',
            ],
            refresh: true,
        }),
    ],
});
