<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('motor_images')) {
            Schema::create('motor_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('motor_id')->constrained('motor')->onDelete('cascade');
                $table->string('path');
                $table->boolean('is_primary')->default(false);
                $table->timestamps();
            });
        } else {
            Schema::table('motor_images', function (Blueprint $table) {
                if (!Schema::hasColumn('motor_images', 'path')) {
                    $table->string('path')->after('motor_id');
                }
                if (!Schema::hasColumn('motor_images', 'is_primary')) {
                    $table->boolean('is_primary')->default(false)->after('path');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('motor_images');
    }
};