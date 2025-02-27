<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Details') }}
        </h2>
    </x-slot>

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                Schedule Details for Dr. {{ $schedule->doctor->user->name }}
            </div>
            <div class="card-body">
                <p><strong>Doctor ID:</strong> {{ $schedule->doctor_id }}</p>
                <p><strong>Doctor Name:</strong> {{ $schedule->doctor->user->name }}</p>
                <p>
                    <strong>Day:</strong>
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
                </p>
                <p><strong>Start Time:</strong> {{ $schedule->start_time }}</p>
                <p><strong>End Time:</strong> {{ $schedule->end_time }}</p>

            </div>
        </div>
        <div class="text-right mt-3">
            <a href="{{ route('schedules.create') }}" class="btn btn-primary btn-sm">Create New Schedule</a>
        </div>
    </div>
</x-app-layout>
