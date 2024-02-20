import{defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from 'node:url'


export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: [
                'resources/js/app.js',
            ],
            refresh: true,
        }),

    ],
    resolve: {
        alias: {
            '@resources': fileURLToPath(new URL('./resources', import.meta.url)),
            '@assets': fileURLToPath(new URL('./resources/assets', import.meta.url)),
            '@components': fileURLToPath(new URL('./resources/js/components', import.meta.url)),
            '@layouts': fileURLToPath(new URL('./resources/js/layouts', import.meta.url)),
            '@stores': fileURLToPath(new URL('./resources/stores', import.meta.url)),

        },
    },
    base:'/Shop-ChaykaShop/'
});

