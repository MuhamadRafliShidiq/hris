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
                <h3>Employees</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
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
                    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3 ms-auto">New Employee</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->fullname }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td>{{ $employee->role->title }}</td>
                            <td>
                                @if ($employee->status == 'Active')
                                    <span class="badge bg-success">Active</span>
                                @elseif ($employee->status == 'Inactive')
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($employee->salary, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-employee-name="{{ $employee->fullname }}">
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
                                                    html: `You are about to delete <strong>${employeeName}</strong>.<br>This action cannot be undone!`,
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div> 
@endsection
