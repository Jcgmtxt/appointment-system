<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'day' => strval($this->faker->numberBetween(0, 6)),
            'start_time' => $this->faker->time('H:i:s', '08:00:00'),
            'end_time' => $this->faker->time('H:i:s', '17:00:00'),
        ];
    }
}
