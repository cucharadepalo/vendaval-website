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
