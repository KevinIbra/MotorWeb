<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MotorFeaturesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'abs' => fake()->boolean(),
            'keyless' => fake()->boolean(),
            'alarm_system' => fake()->boolean(),
            'led_lights' => fake()->boolean(),
            'digital_speedometer' => fake()->boolean(),
            'bluetooth_connectivity' => fake()->boolean(),
            'usb_charging' => fake()->boolean(),
            'engine_kill_switch' => fake()->boolean(),
            'side_stand_sensor' => fake()->boolean(),
            'traction_control' => fake()->boolean()
        ];
    }
}
