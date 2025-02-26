<?php

namespace App\Http\Controllers;

use App\Services\Contracts\DoctorServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    protected $doctorService;

    public function __construct(
        UserServiceInterface $userService,
        DoctorServiceInterface $doctorService)
    {
        $this->userService = $userService;
        $this->doctorService = $doctorService;
    }


    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        try {

            $data = $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email',
                    'role' => 'required|in:admin,doctor,patient',
                    'password' => 'required|string|min:8|confirmed',
                ]);

                $data['password'] = bcrypt($data['password']);

                $this->userService->createUser($data);

                return redirect()->route('users.index')->with('success', 'User created successfully');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                throw new \Exception('User not found');
            }

            if ($user->role === 'doctor') {

                $dataDoctor = $this->doctorService->getDoctorByUserId($id);

                return view('doctors.show', compact('user', 'dataDoctor'));
            }



            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

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

    public function convertUserToDoctor(string $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                throw new \Exception('User not found');
            }

            if ($user->role === 'admin') {
                throw new \Exception('User is an admin');
            }

            if ($user->role === 'doctor') {
                throw new \Exception('User is already a doctor');
            }

            $this->userService->convertUserToDoctor($id);

            return redirect()->route('users.index')->with('success', 'User converted to doctor successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
