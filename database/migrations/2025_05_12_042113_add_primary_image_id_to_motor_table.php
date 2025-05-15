<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('motor', function (Blueprint $table) {
            $table->foreignId('primary_image_id')->nullable()->constrained('motor_images')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('motor', function (Blueprint $table) {
            $table->dropForeign(['primary_image_id']);
            $table->dropColumn('primary_image_id');
        });
    }
};