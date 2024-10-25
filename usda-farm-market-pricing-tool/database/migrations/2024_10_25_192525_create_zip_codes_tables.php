<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->id();
			$table->string('zip_code', 5)->unique();
            $table->timestamps();
        });

		Schema::create('town_zip_code', function (Blueprint $table) {
			$table->id();
			$table->foreignId('town_id')->constrained('towns')->cascadeOnDelete();
			$table->foreignId('zip_code_id')->constrained('zip_codes')->cascadeOnDelete();
			$table->timestamps();

			$table->unique(['town_id', 'zip_code_id']);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zip_codes');
		Schema::dropIfExists('town_zip_code');
    }
};
