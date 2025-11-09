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
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input 
                            type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $task->title) }}" 
                            placeholder="Enter task title"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Employee -->
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label fw-semibold">Employee</label>
                        <select 
                            name="assigned_to" 
                            id="assigned_to"
                            class="form-select @error('assigned_to') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled>-- Select Employee --</option>
                            @foreach ($employees as $employee)
                                <option 
                                    value="{{ $employee->id }}" 
                                    @selected(old('assigned_to', $task->assigned_to) == $employee->id)
                                >
                                    {{ $employee->fullname }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select 
                            name="status" 
                            id="status" 
                            class="form-select @error('status') is-invalid @enderror"
                            required
                        >
                            <option value="pending" @selected(old('status', $task->status) == 'pending')>Pending</option>
                            <option value="on progress" @selected(old('status', $task->status) == 'on progress')>On Progress</option>
                            <option value="completed" @selected(old('status', $task->status) == 'completed')>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Due Date -->
                    <div class="mb-3">
                        <label for="due_date" class="form-label fw-semibold">Due Date</label>
                        <input 
                            type="date" 
                            class="form-control date @error('due_date') is-invalid @enderror" 
                            id="due_date"
                            name="due_date" 
                            value="{{ old('due_date', $task->due_date) }}" 
                            required
                        >
                        @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea 
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description" 
                            name="description" 
                            rows="4"
                            placeholder="Enter detailed description..."
                            required
                        >{{ old('description', $task->description) }}</textarea>
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
                            <i class="bi bi-save2 me-1"></i> Update Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div> 
@endsection
