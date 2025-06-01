<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('pages', function (Blueprint $table) {
			$table->id();
			$table->string('title', 191)->unique();
			$table->string('slug', 191)->unique();
			$table->string('type')->default('custom');
			$table->text('content')->nullable();
			$table->boolean('is_published')->default(false);
			$table->boolean('in_menu')->default(false);

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('pages');
	}
};
