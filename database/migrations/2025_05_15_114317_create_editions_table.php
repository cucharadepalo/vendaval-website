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
			$table->date('date');
			$table->string('title', 191)->nullable();
			$table->boolean('is_active')->default(false);
			$table->json('colors')->nullable();
			$table->string('splash_alt_text', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('editions');
	}
};
