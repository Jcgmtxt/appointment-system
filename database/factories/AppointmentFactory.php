<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'user_id'    => null,
            'doctor_id'  => null,
            'date'        => $this->faker->date(),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time'   => $this->faker->time('H:i:s'),
            'status'     => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
}
