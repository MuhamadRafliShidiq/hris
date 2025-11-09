@extends('layouts.dashboard')

@section('content')            
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Edit
                </h5>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <li>{{ session('error') }}</li>
                    </div>
                @endif
                <form action="{{ route('presences.update', $presence->id) }}" class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
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
                                    value="{{ $employee->id }}" @if(old('employee_id', $presence->employee_id) == $employee->id) selected @endif 
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                >
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('$employee->fullname')
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
                            value="{{ old('check_in', $presence->check_in) }}" 
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
                            value="{{ old('check_out', $presence->check_out) }}" 
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
                            value="{{ old('date', $presence->date) }}" 
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
                            <option value="Present" {{ $presence->status == 'Present' ? 'selected' : ''}} >Present</option>
                            <option value="Sick" {{ $presence->status == 'Sick' ? 'selected' : ''}}>Sick</option>
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
                            <i class="bi bi-save2 me-1"></i> Update Presence
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div> 
@endsection
