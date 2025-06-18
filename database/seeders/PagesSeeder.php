<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Page::create([
			'title' => 'Vendaval',
			'slug' => 'home',
			'type' => 'system',
			'content' => 'Este contenido se mostrará en la página de inicio.',
			'is_published' => true,
			'in_menu' => true,
		]);

		Page::create([
			'title' => 'Programa',
			'slug' => 'programa',
			'type' => 'system',
			'content' => 'Este contenido se mostrará al final del programa.

Se puede poner cualquier información relevante al programa aqui.',
			'is_published' => true,
			'in_menu' => true,
		]);

		Page::create([
			'title' => 'Filmes',
			'slug' => 'filmes',
			'type' => 'system',
			'content' => 'Este contenido se mostrará al principio de la página de filmes.',
			'is_published' => true,
			'in_menu' => true,
		]);

		Page::create([
			'title' => 'Espazos',
			'slug' => 'espazos',
			'type' => 'system',
			'content' => 'Este contenido se mostrará al principio de la página de espazos.',
			'is_published' => true,
			'in_menu' => true,
		]);

	}
}
