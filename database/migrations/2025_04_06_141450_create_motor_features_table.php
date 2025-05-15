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
        Schema::create('motor_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_id')->constrained('motor')->onDelete('cascade');
            $table->boolean('abs')->default(false);
            $table->boolean('keyless')->default(false);
            $table->boolean('alarm_system')->default(false);
            $table->boolean('led_lights')->default(false);
            $table->boolean('digital_speedometer')->default(false);
            $table->boolean('bluetooth_connectivity')->default(false);
            $table->boolean('usb_charging')->default(false);
            $table->boolean('engine_kill_switch')->default(false);
            $table->boolean('side_stand_sensor')->default(false);
            $table->boolean('traction_control')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor_features');
    }
};
