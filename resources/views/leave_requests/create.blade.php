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
                        <li class="breadcrumb-item"><a href="{{ route('leave_requests.index') }}">Leave Request</a></li>
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
                <form action="{{ route('leave_requests.store') }}" method="POST">
                    @csrf

                    @if (session('role') === 'Admin HR')
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
                    @endif

                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type</label>
                        <select 
                            name="leave_type" 
                            id="leave_type" 
                            class="form-control @error('leave_type') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Leave Type --</option>
                            <option value="Vacation" >Vacation</option>
                            <option value="Sick Leave">Sick Leave</option>
                        </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input 
                            type="date-local" 
                            class="form-control date @error('start_date') is-invalid @enderror" 
                            id="start_date"
                            name="start_date" 
                            value="{{ old('start_date') }}" 
                            required
                        >
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input 
                            type="date-local" 
                            class="form-control date @error('end_date') is-invalid @enderror" 
                            id="end_date"
                            name="end_date" 
                            value="{{ old('end_date') }}" 
                            required
                        >
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (session('role') === 'Admin HR')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select 
                                name="status" 
                                id="status" 
                                class="form-control @error('status') is-invalid @enderror"
                                required
                            >
                                <option value="" disabled selected>-- Select Status --</option>
                                <option value="Pending" >Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary px-4 me-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Create Leave Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div> 
@endsection
