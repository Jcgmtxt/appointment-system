<?php

namespace App\Services;

use App\Services\Contracts\UserServiceInterface;
use App\Models\User;
use App\Models\Doctor;
use App\Services\Contracts\DoctorServiceInterface;

class DoctorService implements DoctorServiceInterface
{

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

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

    public function getUsersWithDoctorRole()
    {
        return User::where('role', 'doctor')
        ->whereDoesntHave('doctor')
        ->get();
    }

    public function getRegularUsers()
    {
        return User::where('role', '!=', 'doctor')
        ->whereDoesntHave('doctor')
        ->get();
    }

    public function createDoctor(array $data)
    {
        $user = $this->userService->getUserById($data['user_id']);

        if ($user == null) {
            throw new \Exception('User not found');
        }

        if ($user->role != 'doctor' && isset($data['convert_to_doctor'])) {
            $this->userService->convertUserToDoctor($data['user_id']);
        }

        return Doctor::create([
            'user_id' => $user->id,
            'specialization' => $data['specialization'],
            'license_number' => $data['license_number'],
        ]);
    }
    
    public function updateDoctor(string $id, array $data)
    {
        $doctor = Doctor::find($id);
        $doctor->update([
            'specialty' => $data['specialty'],
            'location' => $data['location'],
        ]);
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

