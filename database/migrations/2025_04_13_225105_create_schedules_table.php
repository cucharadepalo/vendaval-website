<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('schedules', function (Blueprint $table) {
			$table->id();
			$table->dateTime('start_time');
			$table->string('description')->nullable();
			$table->text('notes')->nullable();

			$table->foreignId('venue_id');
			$table->timestamps();
		});

		Schema::create('schedulables', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('schedule_id');
			$table->unsignedInteger('schedulable_id');
			$table->string('schedulable_type');

			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('schedules');
		Schema::dropIfExists('schedulables');
	}
};
