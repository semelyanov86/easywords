import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from 'tailwindcss'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts', 'resources/css/app.css'],
            publicDirectory: 'public_html',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    css: {
        postcss: {
            plugins: [tailwindcss],
        },
    },
});
