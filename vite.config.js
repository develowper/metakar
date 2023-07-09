import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import manifestSRI from 'vite-plugin-manifest-sri';

export default defineConfig({
    plugins: [
        // manifestSRI(),
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
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
    server: {
        // cors: false,
        // proxy: {
        //     // string shorthand: http://localhost:5173/foo -> http://localhost:4567/foo
        //     '/foo': 'http://localhost:4567',
        //     // with options: http://localhost:5173/api/bar-> http://jsonplaceholder.typicode.com/bar
        //     '/api': {
        //         target: 'http://jsonplaceholder.typicode.com',
        //         changeOrigin: true,
        //         rewrite: (path) => path.replace(/^\/api/, ''),
        //     },
        //     // with RegEx: http://localhost:5173/fallback/ -> http://jsonplaceholder.typicode.com/
        //     '^/fallback/.*': {
        //         target: 'http://jsonplaceholder.typicode.com',
        //         changeOrigin: true,
        //         rewrite: (path) => path.replace(/^\/fallback/, ''),
        //     },
        //
        //     // Proxying websockets or socket.io: ws://localhost:5173/socket.io -> ws://localhost:5174/socket.io
        //     '/socket.io': {
        //         target: 'ws://localhost:5174',
        //         ws: true,
        //     },
        // },
    },
});
