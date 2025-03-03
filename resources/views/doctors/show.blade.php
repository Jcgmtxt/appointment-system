<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ 'More Info' }}
        </h2>
    </x-slot>
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h3>Docto Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Doctor Id</th>
                            <td>{{ $doctor->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $doctor->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Mail</th>
                            <td>{{ $doctor->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Specialization</th>
                            <td>{{ $doctor->specialization }}</td>
                        </tr>
                        <tr>
                            <th>License Number</th>
                            <td>{{ $doctor->license_number }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary mt-3">Bact to Doctors List</a>
                <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning mt-3">Edit Doctor</a>
                <a href="#" class="btn btn-info mt-3">Show Schedules</a>
                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Delete Schedule</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
