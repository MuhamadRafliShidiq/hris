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
                <h3>Departements</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Departments</a></li>
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
                    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3 ms-auto">New Department</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->description }}</td>
                            <td>
                                @if ($department->status == 'Active')
                                    <span class="badge bg-success">Active</span>
                                @elseif ($department->status == 'Inactive')
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-department-name="{{ $department->name }}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Tangkap semua tombol hapus
                                        const deleteButtons = document.querySelectorAll('.delete-button');
                                        
                                        deleteButtons.forEach(button => {
                                            button.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                const form = this.closest('.delete-form');
                                                const departmentName = this.getAttribute('data-department-name'); // ✅ konsisten

                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    html: `You are about to delete <strong>${departmentName}</strong>.<br>This action cannot be undone!`,
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
