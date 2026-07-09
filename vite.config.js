import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
	build: {
		outDir: "./www/build/"
	},
	plugins: [
		laravel({
			publicDirectory: "www",
			input: [
				"resources/css/app.css",
				"resources/js/app.js",
				"resources/images/poster_placeholder.svg",
				"resources/images/still_placeholder.svg",
				"resources/images/lgo-vndvl-26-hrz-lirio.webp",
				"resources/images/lgo-vndvl-26-hrz-laranja-boho.webp",
				"resources/images/lgo-vndvl-26-hrz-branco.webp"
			],
			refresh: [
				"resources/views/**/*",
				"app/Filament/**/*"
			],
		}),
		tailwindcss(),
	],
	server: {
		cors: true,
	},
});
