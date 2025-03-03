<x-app-layout>
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h2>User Details</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role }}</td>
                        </tr>
                    </tbody>
                </table>
                @if ($user->role == 'doctor')
                    <h3>Doctor Details</h3>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Speciality</th>
                                <td>{{ $user->doctor->speciality }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user->doctor->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to Users List</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mt-3">Edit User</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Delete User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
