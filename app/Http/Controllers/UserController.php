<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService,)
    {
        $this->userService = $userService;
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

                $user = $this->userService->createUser($data);

                return redirect()->route('users.show', $user)->with('success', 'User created successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                throw new \Exception('User not found');
            }

            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validation = $request->validate([
                'name' => 'required|string|regex:/^[\pL\s]+$/u|min:6|max:255',
                'email' => 'required|email',
                'role' => 'required|in:admin,doctor,patient',
            ]);

            $user = $this->userService->updateUser($id, $validation);

            return redirect()->route('users.show', $user)->with('success', 'User update successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->userService->deleteUser($id);
            return redirect()->route('users.index')->with('success', 'User successfully deleted.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error deleting schedule: ' . $e->getMessage()]);
        }
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
