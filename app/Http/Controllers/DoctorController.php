<?php

namespace App\Http\Controllers;

use App\Services\Contracts\DoctorServiceInterface;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    protected $doctorService;

    public function __construct(DoctorServiceInterface $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();

        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $doctorRoleUsers = $this->doctorService->getUsersWithDoctorRole();

        $regularUsers = $this->doctorService->getRegularUsers();

        return view('doctors.create', compact('doctorRoleUsers', 'regularUsers'));
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
