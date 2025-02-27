<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Doctor') }}
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
                {{ __('New Doctor') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('doctor.store') }}">
                    @csrf

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            {{ __('Select User') }}
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="userTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="doctor-role-tab" data-bs-toggle="tab" data-bs-target="#doctor-role" type="button" role="tab" aria-controls="doctor-role" aria-selected="true">
                                        {{ __('Users with Doctor Role') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="regular-user-tab" data-bs-toggle="tab" data-bs-target="#regular-user" type="button" role="tab" aria-controls="regular-user" aria-selected="false">
                                        {{ __('Regular Users') }}
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content pt-3" id="userTabContent">
                                <div class="tab-pane fade show active" id="doctor-role" role="tabpanel" aria-labelledby="doctor-role-tab">
                                    <div class="form-group mb-3">
                                        <label for="doctor_role_user_id">{{ __('Users with Doctor Role') }}</label>
                                        <select name="user_id" id="doctor_role_user_id" class="form-control doctor-user-select">
                                            <option value="">{{ __('Select a User') }}</option>
                                            @foreach($doctorRoleUsers as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @if(count($doctorRoleUsers) === 0)
                                            <small class="text-muted">{{ __('No users with doctor role available.') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="regular-user" role="tabpanel" aria-labelledby="regular-user-tab">
                                    <div class="form-group mb-3">
                                        <label for="regular_user_id">{{ __('Regular Users') }}</label>
                                        <select name="user_id" id="regular_user_id" class="form-control doctor-user-select">
                                            <option value="">{{ __('Select a User') }}</option>
                                            @foreach($regularUsers as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @if(count($regularUsers) === 0)
                                            <small class="text-muted">{{ __('No regular users available.') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="convert_to_doctor" id="convert_to_doctor" value="1" checked>
                                        <label class="form-check-label" for="convert_to_doctor">
                                            {{ __('Convert this user to doctor role') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-light">
                            {{ __('Doctor Information') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="specialization">{{ __('Specialization') }}</label>
                                <input type="text" name="specialization" id="specialization" class="form-control" required>
                                @error('specialization')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="license_number">{{ __('License Number') }}</label>
                                <input type="text" name="license_number" id="license_number" class="form-control" required>
                                @error('license_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('Create Doctor') }}
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('doctor.index') }}" class="btn btn-secondary mt-3">
            {{ __('Back to Doctors') }}
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Referencias a los elementos
            const doctorRoleTab = document.getElementById('doctor-role-tab');
            const regularUserTab = document.getElementById('regular-user-tab');
            const doctorRoleSelect = document.getElementById('doctor_role_user_id');
            const regularUserSelect = document.getElementById('regular_user_id');
            const userSelects = document.querySelectorAll('.doctor-user-select');

            // Función para deseleccionar el otro selector cuando se selecciona uno
            userSelects.forEach(select => {
                select.addEventListener('change', function() {
                    if (this.value !== '') {
                        // Deseleccionar los otros selectores
                        userSelects.forEach(otherSelect => {
                            if (otherSelect !== this) {
                                otherSelect.value = '';
                            }
                        });
                    }
                });
            });

            // Cambio entre pestañas
            doctorRoleTab.addEventListener('click', function() {
                // Limpiar el selector de usuarios regulares cuando se cambia a esta pestaña
                regularUserSelect.value = '';
            });

            regularUserTab.addEventListener('click', function() {
                // Limpiar el selector de usuarios con rol de doctor cuando se cambia a esta pestaña
                doctorRoleSelect.value = '';
            });
        });
    </script>
</x-app-layout>
