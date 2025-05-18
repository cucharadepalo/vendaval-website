<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Edition;
use App\Models\Film;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// User::factory(10)->create();

		User::factory()->create([
			'name' => 'Abraham',
			'email' => 'abs@vendaval.test',
			'password' => 'zirvyb-Xekfy1-pinzuw'
		]);

		$edition_1 = Edition::create([
			'name' => '2024',
			'start_date' => Carbon::create(2024, 8, 23, 0, 0, 0),
			'end_date' => Carbon::create(2024, 8, 25, 0, 0, 0),
			'title' => '1ª Mostra de cinema portugués da Ribeira Sacra',
			'is_active' => false,
			'colors' => config('custom.edition.default_colors')
		]);

		$edition_2 = Edition::create([
			'name' => '2024 Inverno',
			'start_date' => Carbon::create(2024, 11, 10, 0, 0, 0),
			'end_date' => Carbon::create(2024, 11, 12, 0, 0, 0),
			'title' => '1ª Mostra de cinema portugués da Ribeira Sacra',
			'is_active' => true,
			'colors' => config('custom.edition.default_colors')
		]);

		$film_1 = Film::factory()->create([
			'title' => 'Cartas a uma ditadura',
			'director' => 'Inês de Medeiros',
			'year' => 2008,
			'genre' => 'Documentario',
			'language' => 'PT',
			'version' => 'Versión orixinal subtitulada ao español',
			'duration' => '01:00:00',
			'text' => 'Unha centena de cartas, escritas por mulleres portuguesas en 1958, foran encontradas por casualidade por un coleccionador de libros e documentos antigos, que non as leu por pensar que eran cartas de amor. As cartas respondían a unha circular enviada por un misterioso “Movimento de Apoio à Ditadura” do cal non hai ningunha referencia nos libros de Historia. A circular orixinal nunca foi encontrada, pero, polas respostas, enténdese que era un convite para que as mulleres se mobilizasen en nome da paz, da orde e, sobre todo, en defensa do “salvador da patria”: António de Oliveira Salazar (1889-1970).\n\nPremio á Mellor Longametraxe Nacional no DocLisboa (2006), Fipa de Prata no FipaDoc (2007), premio do Público na Mostra de Cinema de São Paulo (2007) e premio Femina Rio de Janeiro (2008).'
		]);

		$film_2 = Film::factory()->create([
			'title' => '48',
			'director' => 'Susana Sousa Dias',
			'year' => 2009,
			'genre' => 'Documentario',
			'language' => 'PT',
			'version' => 'Versión orixinal subtitulada ao español',
			'duration' => '01:33:00',
			'text' => 'O que pode unha fotografía de un rostro revelar sobre un sistema político? O que pode unha imaxe tirada fai mais de 35 anos dicir sobre a nosa actualidade?\n\nPartindo de un núcleo de fotografías do rexistro de prisioneiros políticos da ditadura portuguesa (1926-1974), 48 procura mostrar os mecanismos a través dos que un sistema autoritario se intentou auto perpetuar.\n\nGrande premio do Cinéma du reel (2010), premio Opus Bonum no festival de Jihlava (2010), Premio FIPRESCI no Dok Leipzig (2010), entre outros.'
		]);

		$film_3 = Film::factory()->create([
			'title' => 'O Casaco Rosa',
			'director' => 'Mónica Santos',
			'year' => 2022,
			'genre' => 'Animación',
			'language' => 'PT',
			'version' => 'Versión orixinal subtitulada ao español',
			'duration' => '00:08:00',
			'text' => 'No conforto do seu lar, Casaco Rosa cose e tortura os opositores do sistema. Baseado en Rosa Casaco, o inspector da PIDE (policía política portuguesa durante a ditadura) que foi xefe da brigada que asasinou ao Xeneral Humberto Delgado.'
		]);

		$activity_1 = Activity::factory()->create([
			'title' => 'DJ Jufra',
			'summary' => 'DJ set en vinilo de discográficas independientes dos anos 70 e bandas sonoras, ES',
			'text' => 'DJ Jufra comezou a súa traxectoria artística no colectivo “La familia feliz”, na Compostela dos anos 90, pertencendo a varias formacións musicais, entre elas Taxi Driver e Hemisferio Izquierdo, formación coa que chegaría a gravar disco no programa Diario Pop de Radio 3. Máis tarde creou o seu propio proxecto musical baixo o nome de Almax, conseguido que unha das súas maquetas fose recoñecida como a segunda mellor maqueta do ano para a revista “Rock de Lux”. Destaca tamén o seu traballo como responsable dos teclados e samplers na banda Mequetrefe.DJ Jufra comezou a súa traxectoria artística no colectivo “La familia feliz”, na Compostela dos anos 90, pertencendo a varias formacións musicais, entre elas Taxi Driver e Hemisferio Izquierdo, formación coa que chegaría a gravar disco no programa Diario Pop de Radio 3. Máis tarde creou o seu propio proxecto musical baixo o nome de Almax, conseguido que unha das súas maquetas fose recoñecida como a segunda mellor maqueta do ano para a revista “Rock de Lux”. Destaca tamén o seu traballo como responsable dos teclados e samplers na banda Mequetrefe.\n\nNos últimos tempos compaxina a súa faceta de músico coa de DJ, realizando sesións en diferentes locais da noite galega baixo o alias de “DJ Jufra”, moitas delas có vinilo como protagonista, principalmente en Santiago de Compostela. Nas súas sesións intercámbianse os sons de Manchester, o pop-rock de discográficas independentes como Creation 4AD ou Rought Trade, os ecos dub de Bristol e o noise máis duro e tamén o máis delicado kraut, low-fi… Conta tamén con música de baile da década dos 80 e dos 90, en sesións máis comerciais e nostálxicas.',
		]);

		$activity_2 = Activity::factory()->create([
			'title' => 'Fíos de Fado',
			'summary' => 'Iria Estévez e Gonzo Piña',
			'text' => 'Iria Estévez presenta Fíos de Fado, un concerto dinámico no que explora os distintos estilos de fado, poñéndoo en diálogo con outras músicas, como a cantiga galega e a música brasileira, entre outras, e ofrecendo unha visión ampla do que o fado supón, a partir daqueles aspectos que comparte con outros estilos musicais.',
		]);

		$activity_3 = Activity::factory()->create([
			'title' => 'FITA – CINEMA COM OLHOS DE VER',
			'summary' => 'Taller para nenos',
			'text' => 'A partir do visionamento atento da curtametraxe “O Casaco Rosa” (O Abrigo Rosa), unha animación musical e política sobre un abrigo rosa sempre con un as na manga, o colectivo FITA – Cinema com olhos de ver impartirá un taller para nenos, nenas e xoves a partir dos 8 anos. Nun exercicio intuitivo e lúdico, escudriñaranse as claves narrativas do filme e xogarase a criar unha escena con algunhas personaxes da historia portuguesa. O taller será impartido en galego e portugués.\n\nFITA – Cinema com olhos de ver é un colectivo educativo que nace có obxectivo de fomentar a curiosidade e a creatividade a través de un ollar atento sobre o cinema e a animación. Crendo na educación como motor de cambio e na paixón como vehículo para a aprendizaxe, Marta Ramírez Cores e Tamara González xuntaron os seus coñecementos en ilustración, deseño, cinema e pedagoxía neste proxecto de educación informal baseado na creatividade, a exploración persoal e a experiencia propia.',
		]);

		Venue::create([
			'name' => 'A Casa da Memoria',
			'town' => 'Xullán, Bóveda',
			'address' => 'Rúa Maior, 1. Xullán, Bóveda 27343 Lugo',
			'map' => 'https://www.google.com/maps/place/Casa+da+memoria/@42.6392777,-7.4717012,17z/data=!3m1!4b1!4m6!3m5!1s0xd303f99e14d7301:0xdd44240b739d5051!8m2!3d42.6392738!4d-7.4691263!16s%2Fg%2F11sw2wf03p!5m1!1e4?hl=gl-ES&entry=ttu',
			'website' => 'https://acasadamemoria.com',
			'has_page' => false,
			'in_menu' => false
		]);

		DB::table('media')->insert([
			[
				'model_type' => 'film',
				'model_id' => 1,
				'uuid' => 'abf9bc44-b05f-403d-827e-1a94b5a32fce',
				'collection_name' => 'poster',
				'name' => 'image004',
				'file_name' => '01JS2E6YFRPCCM05Z6A6F41VE3.jpg',
				'mime_type' => 'image\/jpeg',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 118339,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 1,
				'created_at' => '2025-04-17 17:54:40',
				'updated_at' => '2025-04-17 17:54:41'
			],
			[
				'model_type' => 'activity',
				'model_id' => 1,
				'uuid' => '243dec80-9387-418c-b46e-234e761c2fd1',
				'collection_name' => 'image',
				'name' => 'dj_jufra',
				'file_name' => '01JS4F83FHEWWZFRNTDDH5RMYW.jpg',
				'mime_type' => 'image\/jpeg',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 22260,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 1,
				'created_at' => '2025-04-18 12:51:16',
				'updated_at' => '2025-04-18 12:51:16'
			],
			[
				'model_type' => 'activity',
				'model_id' => 2,
				'uuid' => '30eb52e6-8e00-4d46-9a08-6f7abacb7ccd',
				'collection_name' => 'image',
				'name' => 'fios_de_fado',
				'file_name' => '01JS4FCP65G5P2M17VXDTP1P2T.jpg',
				'mime_type' => 'image\/jpeg',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 17610,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 1,
				'created_at' => '2025-04-18 12:53:46',
				'updated_at' => '2025-04-18 12:53:46'
			],
			[
				'model_type' => 'activity',
				'model_id' => 3,
				'uuid' => '618d213b-8cd3-41fa-bd50-879b45c1f872',
				'collection_name' => 'image',
				'name' => 'fita',
				'file_name' => '01JS4G0F6888AQYM4EAR8JFTRK.png',
				'mime_type' => 'image\/png',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 34339,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 1,
				'created_at' => '2025-04-18 13:04:34',
				'updated_at' => '2025-04-18 13:04:34'
			],
			[
				'model_type' => 'film',
				'model_id' => 2,
				'uuid' => '85643a4a-0353-4bd0-a2ae-75d432e2d43e',
				'collection_name' => 'poster',
				'name' => '48-POSTER',
				'file_name' => '01JS4G7MRC6VZ7B8R7E97NAM83.jpg',
				'mime_type' => 'image\/jpeg',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 96219,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 1,
				'created_at' => '2025-04-18 13:08:29',
				'updated_at' => '2025-04-18 13:08:29'
			],
			[
				'model_type' => 'film',
				'model_id' => 2,
				'uuid' => 'f34660bc-f291-4aae-9962-3e7aaee0e695',
				'collection_name' => 'stills',
				'name' => '48_ssd_01a',
				'file_name' => '01JS4G7MTM9772SVTXG93T5FD8.jpg',
				'mime_type' => 'image\/jpeg',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 17386,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 2,
				'created_at' => '2025-04-18 13:08:29',
				'updated_at' => '2025-04-18 13:08:29'
			],
			[
				'model_type' => 'film',
				'model_id' => 3,
				'uuid' => '54afb455-5f99-4973-bc4a-51f9ebe50f5c',
				'collection_name' => 'poster',
				'name' => 'cartaz_ocr',
				'file_name' => '01JS4GESZH904AKH08XY20VQSN.jpg',
				'mime_type' => 'image\/jpeg',
				'disk' => 'media',
				'conversions_disk' => 'media',
				'size' => 130011,
				'manipulations' => '[]',
				'custom_properties' => '[]',
				'generated_conversions' => "{\"preview\": true}",
				'responsive_images' => '[]',
				'order_column' => 1,
				'created_at' => '2025-04-18 13:12:24',
				'updated_at' => '2025-04-18 13:12:24'
			]
		]);

		DB::table('edition_film')->insert([
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_1->id,
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_2->id,
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_3->id,
			],
			[
				'edition_id' => $edition_2->id,
				'film_id' => $film_1->id,
			],
			[
				'edition_id' => $edition_2->id,
				'film_id' => $film_2->id,
			],
			[
				'edition_id' => $edition_2->id,
				'film_id' => $film_3->id,
			]
		]);

		DB::table('activity_edition')->insert([
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_1->id,
			],
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_2->id,
			],
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_3->id,
			],
			[
				'edition_id' => $edition_2->id,
				'activity_id' => $activity_1->id,
			],
			[
				'edition_id' => $edition_2->id,
				'activity_id' => $activity_2->id,
			],
			[
				'edition_id' => $edition_2->id,
				'activity_id' => $activity_3->id,
			],
		]);
	}
}
