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
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employee</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section py-4">
    <div class="container">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white"><i class="bi bi-person-badge me-2"></i>Employee Detail</h5>
                    <span class="badge bg-white text-primary">ID: {{ $employee->id }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <!-- Personal Information Section -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2 mb-3">
                        <i class="bi bi-person-circle me-2"></i>Personal Information
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Fullname</label>
                                <p class="mb-0 fw-medium">{{ $employee->fullname }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Email</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-envelope me-1 text-primary"></i>{{ $employee->email }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Phone Number</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-telephone me-1 text-primary"></i>{{ $employee->phone_number }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Birth Date</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-calendar-event me-1 text-primary"></i>{{ \Carbon\Carbon::parse($employee->birth_date)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Address</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-geo-alt me-1 text-primary"></i>{{ $employee->address }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employment Information Section -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2 mb-3">
                        <i class="bi bi-briefcase me-2"></i>Employment Information
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Department</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-building me-1 text-primary"></i>{{ $employee->department->name }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Role</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-award me-1 text-primary"></i>{{ $employee->role->title }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Hire Date</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-calendar-check me-1 text-primary"></i>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Status</label>
                                <p class="mb-0">
                                    @if ($employee->status === 'Active')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle me-1"></i>Inactive
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-white rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Salary</label>
                                <p class="mb-0 fw-medium text-success fs-5">
                                    <i class="bi bi-cash-stack me-1"></i>Rp {{ number_format($employee->salary, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil-square me-1"></i> Edit Employee
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
    
</div> 
@endsection
