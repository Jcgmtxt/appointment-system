<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule List') }}
        </h2>
    </x-slot>

    <div class="container my-4">
        <div class="container my-4">
            <a href="{{ route('schedules.create') }}" class="btn btn-primary btn-md">Create new user</a>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Doctor id</th>
                    <th>Doctor name</th>
                    <th>Day</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->doctor_id }}</td>
                        <td>{{ $schedule->doctor->user->name }}</td>
                        <td>
                            @switch($schedule->day)
                                @case(0)
                                    Monday
                                    @break
                                @case(1)
                                    Thursday
                                    @break
                                @case(2)
                                    Wednesday
                                    @break
                                @case(3)
                                    Thursday
                                    @break
                                @case(4)
                                    Friday
                                    @break
                                @case(5)
                                    Saturday
                                    @break
                                @case(6)
                                    Sunday
                                    @break
                                @default
                                    Invalid day
                            @endswitch
                        </td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>
                            <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
