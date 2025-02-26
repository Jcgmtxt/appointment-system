<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Schedule') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                {{ __('Edit Schedule') }}
            </div>
            <div class="card-body">
                <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="doctor_id">{{ __('Doctor') }}</label>
                        <select name="doctor_id" id="doctor_id" class="form-control">
                            <option value="">{{ __('Select a Doctor') }}</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $schedule->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{$doctor->id}} - {{ $doctor->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="day">{{ __('Day') }}</label>
                        <select name="day" id="day" class="form-control">
                            <option value="0" {{ $schedule->day == 0 ? 'selected' : '' }}>{{ __('Monday') }}</option>
                            <option value="1" {{ $schedule->day == 1 ? 'selected' : '' }}>{{ __('Tuesday') }}</option>
                            <option value="2" {{ $schedule->day == 2 ? 'selected' : '' }}>{{ __('Wednesday') }}</option>
                            <option value="3" {{ $schedule->day == 3 ? 'selected' : '' }}>{{ __('Thursday') }}</option>
                            <option value="4" {{ $schedule->day == 4 ? 'selected' : '' }}>{{ __('Friday') }}</option>
                            <option value="5" {{ $schedule->day == 5 ? 'selected' : '' }}>{{ __('Saturday') }}</option>
                            <option value="6" {{ $schedule->day == 6 ? 'selected' : '' }}>{{ __('Sunday') }}</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="start_time">{{ __('Start Time') }}</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $schedule->start_time }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="end_time">{{ __('End Time') }}</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $schedule->end_time }}">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Schedule') }}
                    </button>
                </form>
            </div>
        </div>
        <a href="{{ route('schedule.index') }}" class="btn btn-secondary mt-3">
            {{ __('Back to Schedule') }}
        </a>
    </div>
</x-app-layout>
