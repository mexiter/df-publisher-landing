import inertia from '@inertiajs/vite';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts', 'resources/css/app.css'],
            // Avoid full-page reloads on every filesystem touch (routes/views/lang).
            // Vue/CSS still hot-reload via Vite. Turn on when you want PHP edits to hard-refresh:
            // refresh: true,
            refresh: false,
        }),
        tailwindcss(),
        vue(),
        // Client-only Inertia (no SSR server / __inertia_ssr). Fine for this landing + waitlist.
        inertia({ ssr: false }),
    ],
});
