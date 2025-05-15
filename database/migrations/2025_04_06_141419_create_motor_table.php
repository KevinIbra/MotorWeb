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
        Schema::create('motor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maker_id')->constrained();
            $table->foreignId('model_id')->constrained();
            $table->year('year');
            $table->decimal('price', 12, 2);
            $table->string('vin', 17);
            $table->decimal('mileage', 10, 2)->nullable();
            $table->foreignId('motor_type_id')->constrained();
            $table->foreignId('fuel_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->string('address');
            $table->string('phone');
            $table->text('description');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};
