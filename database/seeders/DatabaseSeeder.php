<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $doctorUser = User::factory(10)->doctor()->create();

        $doctors =collect();
        foreach ($doctorUser as $user) {
            $doctor =Doctor::factory()->create([
                'user_id' => $user->id
            ]);
            $doctors->push($doctor);
        }

        $schedules = collect();
        foreach ($doctors as $doctor) {
            $schedule = Schedule::factory()->create([
                'doctor_id' => $doctor->id,
            ]);
            $schedules->push($schedule);
        }

        User::factory(50)->patient()->create();
    }
}
