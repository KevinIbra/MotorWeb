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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('maker_id')->constrained('makers');
            $table->foreignId('model_id')->constrained('motor_models');
            $table->year('year');
            $table->decimal('price', 12, 2);
            $table->string('vin')->nullable();
            $table->integer('mileage');
            $table->foreignId('motor_type_id')->constrained('motor_types');
            $table->foreignId('fuel_type_id')->constrained('fuel_types');
            $table->foreignId('city_id')->constrained('cities');
            $table->text('address');
            $table->string('phone_number', 20);
            $table->text('description');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            // $table->softDeletes(); // This adds the deleted_at column
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
