<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('editions', function (Blueprint $table) {
			$table->id();
			$table->string('name', 191)->unique()->index();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('title', 191)->nullable();
			$table->boolean('is_active')->default(false);
			$table->json('colors')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('edition_film', function (Blueprint $table) {
			$table->id();
			$table->foreignId('edition_id')->constrained()->onDelete('cascade');
			$table->foreignId('film_id')->constrained()->onDelete('cascade');

			$table->timestamps();
		});

		Schema::create('activity_edition', function (Blueprint $table) {
			$table->id();
			$table->foreignId('edition_id')->constrained()->onDelete('cascade');
			$table->foreignId('activity_id')->constrained()->onDelete('cascade');

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('editions');
		Schema::dropIfExists('edition_film');
		Schema::dropIfExists('activity_edition');
	}
};
