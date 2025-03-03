<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function show(string $id)
    {
        $doctor = $this->doctorService->getDoctorById($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit(string $id)
    {
        $doctor = $this->doctorService->getDoctorById($id);

        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validation = $request->validate([
                'user_id'=>'required|exists:users,id',
                'specialization'  => 'required|string|max:255',
                'license_number'  => 'required|string|max:255',
            ]);

            $doctor = $this->doctorService->updateDoctor($id, $validation);

            return redirect()->route('doctors.show', $doctor)->with('success', 'Doctor updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try{
            $this->doctorService->deleteDoctor($id);
            return redirect()->route('doctor.index')->with('success', 'Doctor successfully deleted.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error deleting schedule: ' . $e->getMessage()]);
        }
    }
}
