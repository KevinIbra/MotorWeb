<?php


namespace Database\Seeders;

use App\Models\Motor;
use App\Models\MotorImage;
use Illuminate\Database\Seeder;

class MotorSeeder extends Seeder
{
    public function run(): void
    {
        Motor::factory(10)->create()->each(function ($motor) {
            // Create 3 random images for each motor
            $images = MotorImage::factory(3)->create([
                'motor_id' => $motor->id,
                'is_primary' => false,
            ]);

            // Set the first image as primary
            if ($images->isNotEmpty()) {
                $firstImage = $images->first();
                $firstImage->update(['is_primary' => true]);
                $motor->update(['primary_image_id' => $firstImage->id]);
            }
        });
    }
}