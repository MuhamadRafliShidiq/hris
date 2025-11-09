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
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Task Detail</h5>
            </div>

            <div class="card-body mt-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Title</label>
                        <p class="fs-6">{{ $task->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Status</label>
                        <p>
                            @if ($task->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($task->status === 'on progress')
                                <span class="badge bg-info text-dark">On Progress</span>
                            @else
                                <span class="badge bg-success">Done</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Due Date</label>
                        <p>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Assigned To</label>
                        <p>{{ $task->employee->fullname ?? '-' }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Description</label>
                    <div class="p-3 border rounded bg-light">
                        <p class="mb-0">{{ $task->description }}</p>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary px-4">
                        <i class="bi bi-pencil-square"></i> Edit Task
                    </a>
                </div>
            </div>
        </div>
    </section>
</div> 
@endsection
