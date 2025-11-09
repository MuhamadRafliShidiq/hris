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
                        <li class="breadcrumb-item active" aria-current="page">New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Create
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input 
                            type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            id="title" 
                            name="title" 
                            value="{{ old('title') }}" 
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Employee</label>
                        <select 
                            name="assigned_to" 
                            id="assigned_to"
                            class="form-control @error('assigned_to') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Employee --</option>
                            @foreach ($employees as $employee)
                                <option 
                                    value="{{ $employee->id }}" 
                                    {{ old('assigned_to') == $employee->id ? 'selected' : '' }}
                                >
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
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
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="on progress" {{ old('status') == 'on progress' ? 'selected' : '' }}>On Progress</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input 
                            type="datetime-local" 
                            class="form-control date @error('due_date') is-invalid @enderror" 
                            id="due_date"
                            name="due_date" 
                            value="{{ old('due_date') }}" 
                            required
                        >
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea 
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description" 
                            name="description" 
                            rows="4" 
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary px-4 me-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div> 
@endsection
