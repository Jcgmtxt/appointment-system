<x-app-layout>
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h2>Schedule Details</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Doctor ID</th>
                            <td>{{ $schedule->doctor_id }}</td>
                        </tr>
                        <tr>
                            <th>Doctor Name</th>
                            <td>{{ $schedule->doctor->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Day</th>
                            <td>
                                @switch($schedule->day)
                                    @case('0')
                                        Monday
                                        @break
                                    @case('1')
                                        Tuesday
                                        @break
                                    @case('2')
                                        Wednesday
                                        @break
                                    @case('3')
                                        Thursday
                                        @break
                                    @case('4')
                                        Friday
                                        @break
                                    @case('5')
                                        Saturday
                                        @break
                                    @case('6')
                                        Sunday
                                        @break
                                    @default
                                        Invalid day
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Start Time</th>
                            <td>{{ $schedule->start_time }}</td>
                        </tr>
                        <tr>
                            <th>End Time</th>
                            <td>{{ $schedule->end_time }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary mt-3">Back to Schedules List</a>
                <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning mt-3">Edit Schedule</a>
                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Delete Schedule</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
