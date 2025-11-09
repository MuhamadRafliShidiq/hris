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
                <h3>Roles</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
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
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3 ms-auto">New Role</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->title }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-role-name="{{ $role->name }}">
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
                                                const roleName = this.getAttribute('data-role-name'); // ✅ konsisten

                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    html: `You are about to delete <strong>${roleName}</strong>.<br>This action cannot be undone!`,
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
