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
        Schema::create('ring_models', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Обручальное','Помолвочное','Бесконечность']);
            $table->string('name');
            $table->string('model_path'); // путь к .glb файлу
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ring_models');
    }
};
