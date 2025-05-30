<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('films', function (Blueprint $table) {
			$table->id();

			$table->string('title', 191)->index();
			$table->string('director', 191);
			$table->year('year')->nullable();
			$table->string('genre', 191)->nullable();
			$table->string('country', 191)->nullable();
			$table->string('version', 191)->nullable();
			$table->time('duration', precision: 0)->nullable();
			$table->text('text');

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('films');
	}
};
