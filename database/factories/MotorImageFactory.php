<?php

namespace Database\Factories;

use App\Models\MotorImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MotorImage>
 */
class MotorImageFactory extends Factory
{
    protected $model = MotorImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => $this->faker->imageUrl(640, 480, 'motorcycle'),
            'is_primary' => false,
        ];
    }
}
