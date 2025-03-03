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
        $usersDoctorRolewithoutRelacionDoctorTable = $this->doctorService->getUsersWithDoctorRole();

        $regularUsers = $this->doctorService->getRegularUsers();

        return view('doctors.create', compact('usersDoctorRolewithoutRelacionDoctorTable', 'regularUsers'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'specialization' => 'required|string|max:255',
                'license_number' => 'required|string|max:255',
            ]);

            $this->doctorService->createDoctor($data);

            session()->flash('success', 'Doctor created successfully');

            return redirect()->route('doctors.index');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
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
