@extends('layouts.dashboard')

@section('content')            
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
            
<div class="page-heading">
    <div class="page-fullname">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-fullname">
                    Create
                </h5>
            </div>
            <div class="card-body">
                @if(session('role') === 'Admin HR')
                <form action="{{ route('presences.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select 
                            name="employee_id" 
                            id="employee_id"
                            class="form-control @error('employee_id') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Employee --</option>
                            @foreach ($employees as $employee)
                                <option 
                                    value="{{ $employee->id }}" 
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                >
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check In</label>
                        <input 
                            type="date-local" 
                            class="form-control datetime @error('check_in') is-invalid @enderror" 
                            id="check_in"
                            name="check_in" 
                            value="{{ old('check_in') }}" 
                            required
                        >
                        @error('check_in')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input 
                            type="date-local" 
                            class="form-control datetime @error('check_out') is-invalid @enderror" 
                            id="check_out"
                            name="check_out" 
                            value="{{ old('check_out') }}" 
                            required
                        >
                        @error('check_out')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input 
                            type="date-local" 
                            class="form-control date @error('date') is-invalid @enderror" 
                            id="date"
                            name="date" 
                            value="{{ old('date') }}" 
                            required
                        >
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select 
                            name="status" 
                            id="status" 
                            class="form-control @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Status --</option>
                            <option value="Present" >Present</option>
                            <option value="Sick">Sick</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="{{ route('presences.index') }}" class="btn btn-secondary px-4 me-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Create Presence
                        </button>
                    </div>
                </form>
                @else
                    <form action="{{ route('presences.store') }}" method="POST">
                        @csrf

                        <div class="mb-3"><b>Note</b> : Mohon izinkan akses lokasi, supaya presensi diterima</div>
                        <div class="mb-3">
                            <label for="" class= "form-label">Latitude</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="latitude"
                                name="latitude" 
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="" class= "form-label">Longitude</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="longitude"
                                name="longitude" 
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <iframe id="map" width="500" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                        </div>

                        <button type="submit" class="btn btn-primary px-4" id="btn-presence" disabled>
                            Presence
                        </button>
                    </form>
                @endif
            </div>
        </div>

    </section>
</div>

<script>
    const iframe = document.querySelector('iframe');
    const officeLat = -6.952019;
    const officeLong = 107.6105109;
    const threshold = 0.01;

    navigator.geolocation.getCurrentPosition(function(position) {
        const lat = position.coords.latitude;
        const long = position.coords.longitude;

        iframe.src = `https://www.google.com/maps?q=${lat},${long}&z=15&output=embed`;
    })

    document.addEventListener('DOMContentLoaded', (event) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = long;
                
                // Compare lokasi sekarang dengan lokasi kantor
                const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(long - officeLong, 2));

                if (distance <= threshold) {
                    // Posisi ada di sekitar kantor
                    alert('Kamu berada di kantor, selamat bekerja');
                    document.getElementById('btn-presence').removeAttribute('disabled');
                } else {
                    // Posisi ada di luar kantor
                    alert('Kamu berada di luar kantor');
                }
            })
        }
    });

</script>
@endsection
