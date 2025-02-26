<?php

namespace App\Http\Controllers;

use App\Services\Contracts\DoctorServiceInterface;
use App\Services\Contracts\ScheduleServiceInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;

    protected $doctorService;

    public function __construct(
        ScheduleServiceInterface $scheduleService,
        DoctorServiceInterface $doctorService)
    {
        $this->scheduleService = $scheduleService;
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        $schedules = $this->scheduleService->getAllSchedules();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $doctors = $this->doctorService->getAllDoctors();

        return view('schedules.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        try {
            $data =$request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'day' => 'required|in:0,1,2,3,4,5,6',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            $this->scheduleService->createSchedule($data);

            session()->flash('success', 'Schedule created successfully');

            return redirect()->route('schedules.index');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $schedule = $this->scheduleService->getScheduleById($id);
        return view('schedules.show', compact('schedule'));
    }

    public function edit(string $id)
    {
        $schedule = $this->scheduleService->getScheduleById($id);

        $doctors = $this->doctorService->getAllDoctors();

        return view('schedules.edit', compact('schedule', 'doctors'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'day' => 'required|in:0,1,2,3,4,5,6',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            $this->scheduleService->updateSchedule($id, $data);
            return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->scheduleService->deleteSchedule($id);
            return redirect()->route('schedules.index')->with('success', 'Horario eliminado con éxito.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar el horario: ' . $e->getMessage()]);
        }
    }
}
