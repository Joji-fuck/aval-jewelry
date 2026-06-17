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
        Schema::create('ring_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('ring_model_id')->constrained('ring_models');
            $table->foreignId('material_id')->constrained('materials');
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->string('house_number');
            $table->string('zip_code');
            $table->decimal('ring_size', 3, 1);
            $table->text('comment')->nullable();
            $table->enum('status', ['Ожидает оплаты','Оплачен','В работе','Завершён','Отменён'])
                ->default('Ожидает оплаты');
            $table->decimal('total', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ring_orders');
    }
};
