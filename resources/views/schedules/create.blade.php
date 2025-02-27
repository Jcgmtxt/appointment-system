<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Schedule') }}
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
                {{ __('New Schedule') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('schedules.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="doctor_id">{{ __('Doctor') }}</label>
                        <select name="doctor_id" id="doctor_id" class="form-control">
                            <option value="">{{ __('Select a Doctor') }}</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{$doctor->id}} - {{ $doctor->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="day">{{ __('Day') }}</label>
                        <select name="day" id="day" class="form-control">
                            <option value="0">{{ __('Monday') }}</option>
                            <option value="1">{{ __('Tuesday') }}</option>
                            <option value="2">{{ __('Wednesday') }}</option>
                            <option value="3">{{ __('Thursday') }}</option>
                            <option value="4">{{ __('Friday') }}</option>
                            <option value="5">{{ __('Saturday') }}</option>
                            <option value="6">{{ __('Sunday') }}</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="start_time">{{ __('Start Time') }}</label>
                        <input type="time" name="start_time" id="start_time" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="end_time">{{ __('End Time') }}</label>
                        <input type="time" name="end_time" id="end_time" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Schedule') }}
                    </button>
                </form>
            </div>
        </div>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary mt-3">
            {{ __('Back to Schedule') }}
        </a>
    </div>
</x-app-layout>
