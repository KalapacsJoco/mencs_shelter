<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species');
            $table->unsignedInteger('age');
            $table->string('color');
            $table->enum('sex', ['male', 'female']);
            $table->enum('status', ['available', 'adopted', 'fostered']);
            $table->json('vaccines')->nullable();
            $table->text('message')->nullable();
            $table->foreignId('shelter_id')->constrained('shelters')->cascadeOnDelete();
            $table->foreignId('species_id')->constrained('species')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
