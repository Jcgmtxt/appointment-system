<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                {{ __('Edit User') }}
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="user_id">{{ __('User') }}</label>
                        <select name="user_id_disabled" id="user_id" class="form-control" disabled>
                            <option value="{{ $user->id }}">
                                {{ $user->id }} - {{ $user->name }}
                            </option>
                        </select>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" required
                               value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email ">{{ __('Email') }}</label>
                        <input type="text" name="email" id="email" class="form-control" required
                               value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group mb-3"></div>
                        <label for="role">{{ __('Role') }}</label>
                        @if ($user->role === 'doctor')
                            <input type="hidden" name="role" value="doctor" disabled>
                                <option value="{{ $user->role }}">Doctor</option>
                        @endif
                        <select name="role" id="role" class="form-control">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                Administrator
                            </option>
                            <option value="patient" {{ $user->role === 'patient' ? 'selected' : '' }}>
                                Patient
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-3">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
