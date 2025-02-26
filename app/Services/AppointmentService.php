<?php

namespace App\Services;

use App\Services\Contracts\AppointmentServiceInterface;
use App\Models\Appointment;

class AppointmentService implements AppointmentServiceInterface
{
    public function getAllAppointments()
    {
        return Appointment::all();
    }

    
}
