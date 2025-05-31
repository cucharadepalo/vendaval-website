<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('venues', function (Blueprint $table) {
			$table->id();
			$table->string('name', 191)->index();
			$table->string('town', 191);
			$table->string('map', 255)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('website')->nullable();
			$table->text('content')->nullable();

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('venues');
	}
};
