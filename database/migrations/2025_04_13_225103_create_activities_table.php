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
			$table->foreignId('edition_id');

			$table->string('title', 191)->index();
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
