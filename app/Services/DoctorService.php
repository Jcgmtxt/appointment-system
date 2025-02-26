<?php

namespace App\Services;

use App\Models\Doctor;
use App\Services\Contracts\DoctorServiceInterface;

class DoctorService implements DoctorServiceInterface
{
    public function getDoctorByUserId(string $id)
    {
        return Doctor::where('user_id', $id)->first();
    }

    public function getAllDoctors()
    {
        return Doctor::all();
    }

    public function getDoctorById(string $id)
    {
        return Doctor::find($id);
    }

    public function createDoctor(array $data)
    {
        return Doctor::create($data);
    }

    public function updateDoctor(string $id, array $data)
    {
        $doctor = Doctor::find($id);
        $doctor->update($data);
        return $doctor;
    }

    public function deleteDoctor(string $id)
    {
        return Doctor::destroy($id);
    }

    public function advancedSearch(array $data)
    {
        $query = Doctor::query();

        if (isset($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (isset($data['specialty'])) {
            $query->where('specialty', 'like', '%' . $data['specialty'] . '%');
        }

        if (isset($data['location'])) {
            $query->where('location', 'like', '%' . $data['location'] . '%');
        }

        return $query->get();
    }
}

