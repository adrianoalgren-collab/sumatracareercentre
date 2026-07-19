import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/css/app.css',
                'resources/css/button-bagikan-lowongan.css',
                'resources/css/button-lamar-sekarang.css',
                'resources/css/content.css',
                'resources/css/detail-lowongan.css',
                'resources/css/header.css',
                'resources/css/login.css',
                'resources/css/lowongan.css',
                'resources/css/modal-konfirmasi-hapus.css',
                'resources/css/modal-success.css',
                'resources/css/pelamar.css',
                'resources/css/register.css',
                'resources/css/sidebar.css',
                'resources/css/welcome.css',

                // JS
                'resources/js/app.js',
                'resources/js/about-us.js',
                'resources/js/button-bagikan-lowongan.js',
                'resources/js/detail-lowongan.js',
                'resources/js/home.js',
                'resources/js/login.js',
                'resources/js/lowongan.js',
                'resources/js/modal-konfirmasi-hapus.js',
                'resources/js/modal-success.js',
                'resources/js/register.js',
                'resources/js/pelamar.js',
                // tambahkan file js lain kalau ada yang belum ke-scroll di screenshot
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});