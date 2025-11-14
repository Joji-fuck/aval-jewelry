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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Ожидает оплаты', 'Оплачен', 'В работе', 'Завершен', 'Отменен'])->default('Ожидает оплаты');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
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
            $table->decimal('total_price', 8, 2);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
