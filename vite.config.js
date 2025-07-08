import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
<<<<<<< HEAD
            input: ['resources/css/app.css', 'resources/js/app.js'],
=======
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
>>>>>>> 82222bc52ccb8b3cd430cfa57b880d708a18ee3d
            refresh: true,
        }),
    ],
});
