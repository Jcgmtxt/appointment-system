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
                <form method="POST" action="{{ route('doctors.store') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="user_id">{{ __('Users not registered in the Doctors table but with the doctors role') }}</label>
                        <select name="user_id" id="select_doctor" class="form-control" onchange="toggleSelects('select_doctor', 'select_user')">
                            <option value="">{{ __('Select Doctor') }}</option>
                            @foreach($usersDoctorRolewithoutRelacionDoctorTable as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->id }} - {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="user_id">{{ __('Select the user you want to convert into a doctor') }}</label>
                        <select name="user_id" id="select_user" class="form-control" onchange="toggleSelects('select_doctor', 'select_user')">
                            <option value="">{{ __('Select User') }}</option>
                            @foreach ($regularUsers as $regularUser)
                                <option value="{{ $regularUser->user_id }}">
                                    {{ $regularUser->id }} - {{$regularUser->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="specialization">{{ __('Specialization') }}</label>
                        <input type="text" name="specialization" id="specialization" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="license_number">{{ __('License Number') }}</label>
                        <input type="text" name="license_number" id="license_number" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('Create Doctor') }}
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('doctors.index') }}" class="btn btn-secondary mt-3">
            {{ __('Back to Doctors') }}
        </a>
    </div>

    <script>
        function toggleSelects( select_user, select_doctor){

            const selected = document.getElementById(select_user);
            const other = document.getElementById(select_doctor);

            if (selected.value !== "") {
                other.disabled = true;
            } else {
                other.disabled = false;
            }

        }
    </script>

</x-app-layout>
