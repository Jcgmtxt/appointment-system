<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                {{ __('Edit Doctor') }}
            </div>
            <div class="card-body">
                <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="user_id">{{ __('User') }}</label>
                        <select name="user_id_disabled" id="user_id" class="form-control" disabled>
                            <option value="{{ $doctor->user->id }}">
                                {{ $doctor->user->id }} - {{ $doctor->user->name }}
                            </option>
                        </select>

                        <input type="hidden" name="user_id" value="{{ $doctor->user->id }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="specialization">{{ __('Specialization') }}</label>
                        <input type="text" name="specialization" id="specialization" class="form-control" required
                               value="{{ old('specialization', $doctor->specialization) }}">
                    </div>

                        <div class="form-group mb-3">
                            <label for="license_number">{{ __('License Number') }}</label>
                            <input type="text" name="license_number" id="license_number" class="form-control" required
                               value="{{ old('license_number', $doctor->license_number) }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">
                            {{ __('Update Doctor') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
