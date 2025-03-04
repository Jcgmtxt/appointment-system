<?php


namespace App\Services;

use App\Services\Contracts\ScheduleServiceInterface;
use App\Models\Schedule;

class ScheduleService implements ScheduleServiceInterface
{
    public function getAllSchedules()
    {
        return Schedule::with('doctor.user')->get();
    }

    public function getSchedulesByDoctorId(int $id)
    {
        return Schedule::with('doctor.user')->where('doctor_id', $id)->get();
    }

    public function createSchedule(array $data)
    {
        $confilct = Schedule::where('doctor_id', $data['doctor_id'])
        ->where('day', $data['day'])
        ->where(function ($query) use ($data) {
            $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                  ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                  ->orWhere(function ($query) use ($data) {
                      $query->where('start_time', '<=', $data['start_time'])
                            ->where('end_time', '>=', $data['end_time']);
                  });
        })
        ->exists();

        if ($confilct) {
            throw new \Exception('Schedule conflict');
        }

        return Schedule::create($data);
    }

    public function getScheduleById(int $id)
    {
        return Schedule::with('doctor.user')->findOrFail($id);
    }

    public function updateSchedule(int $id, array $data)
    {
        $schedule = Schedule::findOrFail($id);

        $conflict = Schedule::where('doctor_id', $data['doctor_id'])
        ->where('day', $data['day'])
        ->where('id', '!=', $id)
        ->where(function ($query) use ($data) {
            $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                  ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                  ->orWhere(function ($query) use ($data) {
                      $query->where('start_time', '<=', $data['start_time'])
                            ->where('end_time', '>=', $data['end_time']);
                  });
                })
        ->exists();

        if ($conflict) {
            throw new \Exception('Schedule conflict');
        }
        $schedule->update($data);
        return $schedule;
    }

    public function deleteSchedule(int $id)
    {
        $schedule = $this->getScheduleById($id);
        $schedule->delete();
    }
}
