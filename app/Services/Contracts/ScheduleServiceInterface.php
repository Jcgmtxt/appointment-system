<?php

namespace App\Services\Contracts;

interface ScheduleServiceInterface
{
    public function getAllSchedules();

    public function getSchedulesByDoctorId(int $id);

    public function createSchedule(array $data);

    public function getScheduleById(int $id);

    public function updateSchedule(int $id, array $data);

    public function deleteSchedule(int $id);
}
