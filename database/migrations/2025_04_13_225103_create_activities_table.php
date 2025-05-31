<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('activities', function (Blueprint $table) {
			$table->id();

			$table->string('title', 191)->unique()->index();
			$table->string('slug', 191)->unique();
			$table->string('summary');
			$table->text('text');

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('activities');
	}
};
