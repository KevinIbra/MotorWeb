<?php

namespace Database\Factories;

use App\Models\Maker;
use App\Models\MotorModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MotorModel>
 */
class MotorModelFactory extends Factory
{
    protected $model = MotorModel::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'maker_id' => fn() => Maker::factory()->create()->id
        ];
    }
}
