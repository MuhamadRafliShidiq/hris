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
                        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
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
                <form action="{{ route('employees.update', $employee->id) }}" class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input 
                            type="text" 
                            class="form-control @error('fullname') is-invalid @enderror" 
                            id="fullname" 
                            name="fullname" 
                            value="{{ old('fullname', $employee->fullname) }}" 
                            required
                        >
                        @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="text" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $employee->email) }}" 
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input 
                            type="text" 
                            class="form-control @error('phone_number') is-invalid @enderror" 
                            id="phone_number" 
                            name="phone_number" 
                            value="{{ old('phone_number', $employee->phone_number) }}" 
                            required
                        >
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea 
                            class="form-control @error('address') is-invalid @enderror" 
                            id="address" 
                            name="address" 
                            rows="4"
                            required
                        >{{ old('address', $employee->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Birth Date</label>
                        <input 
                            type="date-local" 
                            class="form-control date @error('birth_date') is-invalid @enderror" 
                            id="birth_date"
                            name="birth_date" 
                            value="{{ old('birth_date', $employee->birth_date) }}" 
                            required
                        >
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hire_date" class="form-label">Hire Date</label>
                        <input 
                            type="date-local" 
                            class="form-control date @error('hire_date') is-invalid @enderror" 
                            id="hire_date"
                            name="hire_date" 
                            value="{{ old('hire_date', $employee->hire_date) }}" 
                            required
                        >
                        @error('hire_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select 
                            name="department_id" 
                            id="department_id"
                            class="form-control @error('department_id') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Department --</option>
                            @foreach ($departments as $department)
                                <option 
                                    value="{{ $department->id }}" @if(old('department_id', $employee->department_id) == $department->id) selected @endif 
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select 
                            name="role_id" 
                            id="role_id"
                            class="form-control @error('role_id') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option 
                                    value="{{ $role->id }}"@if(old('role_id', $employee->role_id) == $role->id) selected @endif 
                                    {{ old('role_id') == $role->id ? 'selected' : '' }}
                                >
                                    {{ $role->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
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
                            <option value="Active" {{ $employee->status == 'Active' ? 'selected' : ''}} >Active</option>
                            <option value="Inactive" {{ $employee->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input 
                                type="text" 
                                class="form-control @error('salary') is-invalid @enderror" 
                                id="salary" 
                                name="salary" 
                                value="{{ old('salary', $employee->salary) }}" 
                                required
                            >
                        </div>
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <script>
                        const salaryInput = document.getElementById('salary');

                        salaryInput.addEventListener('input', function(e) {
                            // Hapus karakter selain angka
                            let value = this.value.replace(/\D/g, '');
                            // Format ke Rupiah
                            this.value = new Intl.NumberFormat('id-ID').format(value);
                        });

                        // Sebelum submit, ubah ke angka murni
                        salaryInput.form?.addEventListener('submit', function() {
                            salaryInput.value = salaryInput.value.replace(/\D/g, '');
                        });
                    </script>

                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary px-4 me-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Update Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div> 
@endsection
