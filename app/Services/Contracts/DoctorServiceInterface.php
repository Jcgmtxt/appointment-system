<?php

namespace App\Services\Contracts;

interface DoctorServiceInterface
{
    public function getDoctorByUserId(string $id);

    public function getAllDoctors();

    public function getDoctorById(string $id);

    public function createDoctor(array $data);

    public function updateDoctor(string $id, array $data);

    public function deleteDoctor(string $id);

    public function advancedSearch(array $data);
}
