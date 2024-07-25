import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    build: {
        outDir: "../public/build",
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/sass/main.scss",
                "resources/sass/user-area.scss",
                "resources/sass/single.scss",
                "resources/sass/home.scss",
            ],
            refresh: true,
        }),
    ],
});
