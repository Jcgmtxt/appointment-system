<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
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

        $patients = User::factory(50)->patient()->create();

        $dayNames = [
            '0' => 'Sunday',
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
        ];

        for ($i = 0; $i < 10; $i++) {
            $schedule = $schedules->random();
            $targerDay = $schedule->day;
            $dayName = $dayNames[$targerDay];

            $appointmentDate = Carbon::now()->next($dayName)->toDateString();

            $patient = $patients->random();

            Appointment::factory()->create([
                'doctor_id' => $schedule->doctor_id,
                'user_id' => $patient->id,
                'date' => $appointmentDate,
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time,

            ]);
        }
    }
}
