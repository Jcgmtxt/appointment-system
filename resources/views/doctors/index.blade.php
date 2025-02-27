<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctors List') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="container my-4">
            <a href="{{ route('doctor.create') }}" class="btn btn-primary btn-md">Add New Doctor</a>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Speciality</th>
                    <th>License Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->user->name }}</td>
                        <td>{{ $doctor->user->email }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->license_number }}</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm">View</a>
                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                            <form action="" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
