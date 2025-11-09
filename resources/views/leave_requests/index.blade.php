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
                <h3>Leave Requests</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('leave_requests.index') }}">Leave Requests</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('leave_requests.create') }}" class="btn btn-primary mb-3 ms-auto">New Leave Request</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            @if(session('role') === 'Admin HR')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave_requests as $leave_request)
                        <tr>
                            <td>{{ $leave_request->employee->fullname }}</td>
                            <td>{{ $leave_request->leave_type }}</td>
                            <td>{{ $leave_request->start_date }}</td>
                            <td>{{ $leave_request->end_date }}</td>
                            <td>
                                @if ($leave_request->status == 'Approved')
                                    <span class="badge bg-success">{{ ucfirst($leave_request->status) }}</span>
                                @elseif ($leave_request->status == 'Rejected')
                                    <span class="badge bg-danger">{{ ucfirst($leave_request->status) }}</span>
                                @else
                                    <span class="badge bg-warning">{{ ucfirst($leave_request->status) }}</span>
                                @endif
                            </td>
                            @if(session('role') === 'Admin HR')
                                <td>
                                    @if ($leave_request->status == 'Pending' || $leave_request->status == 'Rejected')
                                        <a href="{{ route('leave_requests.confirm', $leave_request->id) }}" class="btn btn-success btn-sm">Confirm</a>
                                    @else
                                        <a href="{{ route('leave_requests.reject', $leave_request->id) }}" class="btn btn-danger btn-sm">Rejected</a>
                                    @endif
                                    <a href="{{ route('leave_requests.show', $leave_request->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('leave_requests.edit', $leave_request->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('leave_requests.destroy', $leave_request->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button" data-employee-name="{{ $leave_request->employee->fullname }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Handle all delete buttons
                                            const deleteButtons = document.querySelectorAll('.delete-button');
                                            
                                            deleteButtons.forEach(button => {
                                                button.addEventListener('click', function(e) {
                                                    e.preventDefault();
                                                    const form = this.closest('.delete-form');
                                                    const employeeName = this.getAttribute('data-employee-name');
                                                    
                                                    Swal.fire({
                                                        title: 'Are you sure?',
                                                        html: `You are about to delete <strong>Leave Request ${employeeName}</strong>.<br>This action cannot be undone!`,
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#6c757d',
                                                        confirmButtonText: '<i class="bi bi-trash"></i> Yes, delete it!',
                                                        cancelButtonText: '<i class="bi bi-x-circle"></i> Cancel',
                                                        reverseButtons: true,
                                                        focusCancel: true
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            form.submit();
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                        </script>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div> 
@endsection
