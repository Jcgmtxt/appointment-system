<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'specialization' => $this->faker->randomElement(['Cardiologist', 'Dermatologist', 'General Physician', 'Gynecologist', 'Neurologist', 'Orthopedic Surgeon', 'Pediatrician', 'Psychiatrist', 'Radiologist', 'Surgeon']),
            'license_number' => $this->faker->randomNumber(9),
        ];
    }
}
