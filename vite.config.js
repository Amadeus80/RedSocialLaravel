import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js', 'resources/css/index.css', 'resources/css/nav.css', 'resources/css/post.css'],
            refresh: true,
        }),
    ],
    resolve : {
        alias: {
            '$' : 'jQuery'
        },
    }
});
