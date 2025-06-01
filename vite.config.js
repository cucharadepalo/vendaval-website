import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
	plugins: [
		laravel({
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
