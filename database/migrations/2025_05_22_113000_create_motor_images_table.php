<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First remove foreign key constraint if exists
        Schema::table('motor', function (Blueprint $table) {
            if (Schema::hasColumn('motor', 'primary_image_id')) {
                $table->dropForeign(['primary_image_id']);
                $table->dropColumn('primary_image_id');
            }
        });

        // Now we can safely drop and recreate the motor_images table
        Schema::dropIfExists('motor_images');

        Schema::create('motor_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_id')
                  ->constrained('motor')
                  ->onDelete('cascade');
            $table->string('path');
            $table->boolean('is_primary')->default(false);
            $table->integer('position')->default(1); // Add position column
            $table->timestamps();

            // Add indexes for faster queries
            $table->index(['motor_id', 'is_primary']);
            $table->index('position');
        });

        // Add back primary_image_id to motor table
        Schema::table('motor', function (Blueprint $table) {
            $table->foreignId('primary_image_id')
                  ->nullable()
                  ->constrained('motor_images')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        // Remove foreign key from motor table first
        Schema::table('motor', function (Blueprint $table) {
            $table->dropForeign(['primary_image_id']);
            $table->dropColumn('primary_image_id');
        });

        // Then drop the images table
        Schema::dropIfExists('motor_images');
    }
};