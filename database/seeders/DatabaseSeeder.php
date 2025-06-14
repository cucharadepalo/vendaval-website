<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Edition;
use App\Models\Film;
use App\Models\Schedule;
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

		$edition_1 = Edition::create([
			'name' => '2024',
			'start_date' => Carbon::create(2024, 8, 23, 0, 0, 0),
			'end_date' => Carbon::create(2024, 8, 26, 0, 0, 0),
			'title' => '1ª Mostra de Cinema Portugués',
			'is_active' => true,
			'colors' => config('custom.edition.default_colors')
		]);

		$edition_2 = Edition::create([
			'name' => '2025',
			'start_date' => Carbon::create(2025, 8, 20, 0, 0, 0),
			'end_date' => Carbon::create(2025, 8, 24, 0, 0, 0),
			'title' => '2ª Mostra de Cinema Portugués',
			'is_active' => false,
			'colors' => config('custom.edition.default_colors')
		]);

		$film_1 = Film::factory()->create([
			'title' => 'Cartas a uma ditadura',
			'slug' => 'cartas-a-uma-ditadura',
			'director' => 'Inês de Medeiros',
			'year' => 2008,
			'genre' => 'Documentario',
			'country' => 'PT',
			'version' => 'Versión orixinal subtitulada ao español',
			'duration' => '01:00:00',
			'text' => 'Unha centena de cartas, escritas por mulleres portuguesas en 1958, foran encontradas por casualidade por un coleccionador de libros e documentos antigos, que non as leu por pensar que eran cartas de amor. As cartas respondían a unha circular enviada por un misterioso “Movimento de Apoio à Ditadura” do cal non hai ningunha referencia nos libros de Historia. A circular orixinal nunca foi encontrada, pero, polas respostas, enténdese que era un convite para que as mulleres se mobilizasen en nome da paz, da orde e, sobre todo, en defensa do “salvador da patria”: António de Oliveira Salazar (1889-1970).

Premio á Mellor Longametraxe Nacional no DocLisboa (2006), Fipa de Prata no FipaDoc (2007), premio do Público na Mostra de Cinema de São Paulo (2007) e premio Femina Rio de Janeiro (2008).'
		]);

		$film_2 = Film::factory()->create([
			'title' => '48',
			'slug' => '48',
			'director' => 'Susana Sousa Dias',
			'year' => 2009,
			'genre' => 'Documentario',
			'country' => 'PT',
			'version' => 'Versión orixinal subtitulada ao español',
			'duration' => '01:33:00',
			'text' => 'O que pode unha fotografía de un rostro revelar sobre un sistema político? O que pode unha imaxe tirada fai mais de 35 anos dicir sobre a nosa actualidade?

Partindo de un núcleo de fotografías do rexistro de prisioneiros políticos da ditadura portuguesa (1926-1974), 48 procura mostrar os mecanismos a través dos que un sistema autoritario se intentou auto perpetuar.

Grande premio do Cinéma du reel (2010), premio Opus Bonum no festival de Jihlava (2010), Premio FIPRESCI no Dok Leipzig (2010), entre outros.'
		]);

		$film_3 = Film::factory()->create([
			'title' => 'O Casaco Rosa',
			'slug' => 'o-casaco-rosa',
			'director' => 'Mónica Santos',
			'year' => 2022,
			'genre' => 'Animación',
			'country' => 'PT',
			'version' => 'Versión orixinal subtitulada ao español',
			'duration' => '00:08:00',
			'text' => 'No conforto do seu lar, Casaco Rosa cose e tortura os opositores do sistema. Baseado en Rosa Casaco, o inspector da PIDE (policía política portuguesa durante a ditadura) que foi xefe da brigada que asasinou ao Xeneral Humberto Delgado.'
		]);

		$film_4 = Film::factory()->create([
			'title' => 'O Corno',
			'slug' => 'o-corno',
			'director' => 'Jaoine Camborda',
			'year' => 2023,
			'genre' => 'Ficción',
			'country' => 'ES / PT / BE',
			'version' => 'Versión orixinal subtitulada ao galego',
			'duration' => '01:43:00',
			'text' => 'Illa de Arousa, 1971. María é unha muller que se gaña a vida mariscando. Tamén é coñecida na illa por axudar a outras mulleres nos seus partos con especial dedicación e coidado. Tras un inesperado suceso, vese obrigada a fuxir e comeza unha perigosa travesía que lle fará loitar pola súa supervivencia. Buscando a súa liberdade, María decide cruzar a fronteira por un dos camiños do contrabando entre Galicia e Portugal.

Concha de Ouro ao Mellor Filme no Festival de San Sebastián (2023) e Goya á Mellor Actriz Revelación: Janet Novás (2024), entre outros premios.'
		]);

		$film_5 = Film::factory()->create([
			'title' => 'Tão pequeninas, tinham o ar de serem já crescidas',
			'slug' => 'tao-pequeninas-tinham-o-ar-de-serem-ja-crescidas',
			'director' => 'Tânia Dinis',
			'year' => 2024,
			'genre' => 'Documentario',
			'country' => 'PT',
			'version' => 'Versión orixinal subtitulada ao galego',
			'duration' => '00:20:00',
			'text' => '“Tão pequeninas, tinham o ar de serem já crescidas” (Tan pequeniñas, parecían xa adultas) combina o tratamento ficcional e documental, e parte do arquivo fotográfico, de imaxes reais e do testemuño oral de varias mulleres das rexións portuguesas de Trás-os-Montes, Beira, Alto e Baixo Minho que, entre os anos 40 e 70, foran para o Porto traballar como criadas domésticas.

Premio á Mellor Curtametraxe Nacional no Indie Lisboa (2024)'
		]);

		$film_6 = Film::factory()->create([
			'title' => 'Batida de Lisboa',
			'slug' => 'batida-de-lisboa',
			'director' => 'Rita Maia e Vasco Viana',
			'year' => 2019,
			'genre' => 'Documentario',
			'country' => 'PT',
			'version' => 'Versión orixinal subtitulada ao galego',
			'duration' => '01:16:00',
			'text' => 'Unha viaxe pelos suburbios de Lisboa a través da vida de unha serie de músicos que establecen o seu lugar para existir nunha cidade con complexas loitas de identidade. Os “bairros de lata” eran os barrios sociais para onde foron centenas de millares de migrantes das antigas colonias africanas despois da independencia de Portugal, a mediados da década dos 70.

Desmantelados nos anos 90, os seus habitantes foron aloxados en novos barrios nas periferias da cidade, case sen servizos públicos. Este filme lévanos a estes barrios para descubrir a música de raíz africana, da mais folclórica á mais electrónica e urbana, tocada por varias xeracións con raíces en Angola, São Tomé e Príncipe, Cabo Verde, Moçambique e Guiné-Bissau.'
		]);

		$film_7 = Film::factory()->create([
			'title' => 'Prazer Camaradas!',
			'slug' => 'prazer-camaradas',
			'director' => 'José Filipe Costa',
			'year' => 2019,
			'genre' => 'Documentario',
			'country' => 'PT',
			'version' => 'Versión orixinal subtitulada ao galego',
			'duration' => '01:46:00',
			'text' => '1975 – despois da revolución do 25 de Abril. Eduarda, João e Mick viaxan desde a Europa do Norte para traballar nas cooperativas das herdades ocupadas en Portugal. Como moitos outros veñen axudar nas actividades rurais e pecuarias, dar consultas médicas, aulas de planificación familiar, mostrar filmes de educación sexual e participar nos bailes tradicionais. Veñen facer a revolución sexual, abalando as vellas certezas de quen viviu tanto tempo en ditadura: como conviven os homes e as mulleres nas aldeas do Ribatejo? Por que as mulleres teñen que chegar virxes ao matrimonio? Por que só os homes teñen dereito ao pracer sexual?'
		]);

		$activity_1 = Activity::factory()->create([
			'title' => 'DJ Jufra',
			'slug' => 'dj-jufra',
			'summary' => 'DJ set en vinilo de discográficas independientes dos anos 70 e bandas sonoras, ES',
			'text' => 'DJ Jufra comezou a súa traxectoria artística no colectivo “La familia feliz”, na Compostela dos anos 90, pertencendo a varias formacións musicais, entre elas Taxi Driver e Hemisferio Izquierdo, formación coa que chegaría a gravar disco no programa Diario Pop de Radio 3. Máis tarde creou o seu propio proxecto musical baixo o nome de Almax, conseguido que unha das súas maquetas fose recoñecida como a segunda mellor maqueta do ano para a revista “Rock de Lux”. Destaca tamén o seu traballo como responsable dos teclados e samplers na banda Mequetrefe.DJ Jufra comezou a súa traxectoria artística no colectivo “La familia feliz”, na Compostela dos anos 90, pertencendo a varias formacións musicais, entre elas Taxi Driver e Hemisferio Izquierdo, formación coa que chegaría a gravar disco no programa Diario Pop de Radio 3. Máis tarde creou o seu propio proxecto musical baixo o nome de Almax, conseguido que unha das súas maquetas fose recoñecida como a segunda mellor maqueta do ano para a revista “Rock de Lux”. Destaca tamén o seu traballo como responsable dos teclados e samplers na banda Mequetrefe.

Nos últimos tempos compaxina a súa faceta de músico coa de DJ, realizando sesións en diferentes locais da noite galega baixo o alias de “DJ Jufra”, moitas delas có vinilo como protagonista, principalmente en Santiago de Compostela. Nas súas sesións intercámbianse os sons de Manchester, o pop-rock de discográficas independentes como Creation 4AD ou Rought Trade, os ecos dub de Bristol e o noise máis duro e tamén o máis delicado kraut, low-fi… Conta tamén con música de baile da década dos 80 e dos 90, en sesións máis comerciais e nostálxicas.',
		]);

		$activity_2 = Activity::factory()->create([
			'title' => 'Fíos de Fado',
			'slug' => 'fios-de-fado',
			'summary' => 'Iria Estévez e Gonzo Piña',
			'text' => 'Iria Estévez presenta Fíos de Fado, un concerto dinámico no que explora os distintos estilos de fado, poñéndoo en diálogo con outras músicas, como a cantiga galega e a música brasileira, entre outras, e ofrecendo unha visión ampla do que o fado supón, a partir daqueles aspectos que comparte con outros estilos musicais.
			',
		]);

		$activity_3 = Activity::factory()->create([
			'title' => 'FITA – CINEMA COM OLHOS DE VER',
			'slug' => 'fita-cinema-com-olhos-de-ver',
			'summary' => 'Taller para nenos',
			'text' => 'A partir do visionamento atento da curtametraxe “O Casaco Rosa” (O Abrigo Rosa), unha animación musical e política sobre un abrigo rosa sempre con un as na manga, o colectivo FITA &ndash; Cinema com olhos de ver impartirá un taller para nenos, nenas e xoves a partir dos 8 anos. Nun exercicio intuitivo e lúdico, escudriñaranse as claves narrativas do filme e xogarase a criar unha escena con algunhas personaxes da historia portuguesa. O taller será impartido en galego e portugués.

FITA &ndash; Cinema com olhos de ver é un colectivo educativo que nace có obxectivo de fomentar a curiosidade e a creatividade a través de un ollar atento sobre o cinema e a animación. Crendo na educación como motor de cambio e na paixón como vehículo para a aprendizaxe, Marta Ramírez Cores e Tamara González xuntaron os seus coñecementos en ilustración, deseño, cinema e pedagoxía neste proxecto de educación informal baseado na creatividade, a exploración persoal e a experiencia propia.',
		]);

		$activity_4 = Activity::factory()->create([
			'title' => 'Celeste Mariposa',
			'slug' => 'celeste-mariposa',
			'summary' => 'DJ set de música da África lusófona',
			'text' => 'A pesar de ter empezado a súa carreira no panorama da música techno underground e acid house, o DJ portugués, Celeste Mariposa, rapidamente se deixou enfeitizar pola poderosa música das antigas colonias africanas. Actualmente é un experto da diáspora musical de Angola, Cabo Verde, Guiné Bissau, Moçambique e São Tomé e Príncipe, adicándose a promover a músicas e os artistas da África lusófona por todo o mundo. A cultura portuguesa contemporánea está vinculada de forma indisociable á súa herdanza africana, e os seus sets están marcados por unha celebración de múltiples xéneros musicais como o funaná, o kuduro, a coladeira, o semba, e moitos mais.',
		]);

		$venue = Venue::create([
			'name' => 'A Casa da Memoria',
			'town' => 'Xullán, Bóveda',
			'address' => 'Rúa Maior, 1. Xullán, Bóveda 27343 Lugo',
			'map' => 'https://www.google.com/maps/place/Casa+da+memoria/@42.6392777,-7.4717012,17z/data=!3m1!4b1!4m6!3m5!1s0xd303f99e14d7301:0xdd44240b739d5051!8m2!3d42.6392738!4d-7.4691263!16s%2Fg%2F11sw2wf03p!5m1!1e4?hl=gl-ES&entry=ttu',
			'website' => 'https://acasadamemoria.com',
		]);

		$venue_1 = Venue::create([
			'name' => 'Centro do Viño da Ribeira Sacra',
			'town' => 'Monforte de Lemos',
			'address' => 'Rúa do Comercio, 6, 27400 Monforte de Lemos, Lugo',
			'map' => 'https://www.google.com/maps/place/CENTROVINO/@42.522385,-7.51352,18z/data=!4m6!3m5!1s0xd3013e87ddc942f:0x3eb93bd44cc135ca!8m2!3d42.5223848!4d-7.5135201!16s%2Fg%2F11h1z2xvz6!5m1!1e4?hl=gl-ES&entry=ttu',
			'website' => 'http://centrovino-ribeirasacra.com/'
		]);

		$venue_2 = Venue::create([
			'name' => 'Casa Da Cultura Lois Pereiro',
			'town' => 'Monforte de Lemos',
			'address' => 'Praza de España, 3, 27400 Monforte de Lemos, Lugo',
			'map' => 'https://www.google.com/maps/place/Casa+Da+Cultura+Lois+Pereiro/@42.5222892,-7.5130505,17z/data=!3m1!4b1!4m6!3m5!1s0xd3013e8670a4ceb:0x2c32a952e59c2e2!8m2!3d42.5222892!4d-7.5130505!16s%2Fg%2F11btlwp931!5m1!1e4?hl=gl-ES&entry=ttu',
			'website' => 'http://www.monfortedelemos.es/'
		]);

		DB::table('edition_film')->insert([
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_1->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_2->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_3->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_4->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_5->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_6->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'film_id' => $film_7->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		DB::table('activity_edition')->insert([
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_1->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_2->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_3->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'edition_id' => $edition_1->id,
				'activity_id' => $activity_4->id,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_1 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 23, 19, 0, 0),
			'description' => 'Cinema',
			'notes' => 'Coa presencia da realizadora. Presentación a cargo do crítico de cinema Martín Pawley.',
			'venue_id' => 1,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_1->id,
				'schedulable_id' => $film_5->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'schedule_id' => $schedule_1->id,
				'schedulable_id' => $film_1->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_2 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 23, 22, 0, 0),
			'description' => 'Cinema ao aire libre',
			'notes' => 'Presentación a cargo do crítico de cinema Martín Pawley.',
			'venue_id' => $venue->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_2->id,
				'schedulable_id' => $film_4->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_3 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 24, 0, 0, 0),
			'description' => 'Música',
			'notes' => null,
			'venue_id' => $venue->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_3->id,
				'schedulable_id' => $activity_1->id,
				'schedulable_type' => 'activity',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_4 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 24, 17, 0, 0),
			'description' => 'Cinema + Taller',
			'notes' => null,
			'venue_id' => $venue->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_4->id,
				'schedulable_id' => $film_3->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'schedule_id' => $schedule_4->id,
				'schedulable_id' => $activity_3->id,
				'schedulable_type' => 'activity',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_5 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 24, 19, 0, 0),
			'description' => 'Cinema',
			'notes' => 'Presentación a cargo do crítico de cinema Martín Pawley.',
			'venue_id' => $venue->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_5->id,
				'schedulable_id' => $film_2->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_6 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 24, 22, 0, 0),
			'description' => 'Cinema ao aire libre',
			'notes' => 'Presentación a cargo do crítico de cinema Martín Pawley.',
			'venue_id' => $venue->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_6->id,
				'schedulable_id' => $film_7->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);
		$schedule_7 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 25, 0, 0, 0),
			'description' => 'Música',
			'notes' => null,
			'venue_id' => $venue->id,
			'edition_id' => $edition_1->id
		]);
		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_7->id,
				'schedulable_id' => $activity_2->id,
				'schedulable_type' => 'activity',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_8 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 25, 13, 0, 0),
			'description' => 'Música',
			'notes' => null,
			'venue_id' => $venue_1->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_8->id,
				'schedulable_id' => $activity_4->id,
				'schedulable_type' => 'activity',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$schedule_9 = Schedule::create([
			'start_time' => Carbon::create(2024, 8, 25, 16, 30, 0),
			'description' => 'Cinema',
			'notes' => 'Coa presenza do DJ Celeste Mariposa.',
			'venue_id' => $venue_2->id,
			'edition_id' => $edition_1->id
		]);

		DB::table('schedulables')->insert([
			[
				'schedule_id' => $schedule_9->id,
				'schedulable_id' => $film_6->id,
				'schedulable_type' => 'film',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		]);

		$this->call([
			PagesSeeder::class,
		]);
	}
}
