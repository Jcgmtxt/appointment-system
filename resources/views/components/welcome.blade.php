<div class="container">
    <h1 class="my-4">Welcome to the Dashboard</h1>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">View User</h5>
                    <p class="card-text">Access and manage user information.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Go to User</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Schedulea</h5>
                    <p class="card-text">Book an appointment with a doctor.</p>
                    <a href="{{ route('schedules.index') }}" class="btn btn-primary">Schedule Now</a>
                    <a href="{{ route('schedules.create') }}" class="btn btn-primary">Create Schedule</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">View Doctors</h5>
                    <p class="card-text">Browse the list of available doctors.</p>
                    <a href="{{ route('doctors.index') }}" class="btn btn-primary">View Doctors</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Check Appointment Availability</h5>
                    <p class="card-text">See available slots for appointments.</p>
                    <a href="{{ route('appointments.index') }}" class="btn btn-primary">Check Availability</a>
                </div>
            </div>
        </div>
    </div>
</div>

