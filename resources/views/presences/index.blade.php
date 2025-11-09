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
                <h3>Presences</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('presences.index') }}">Presences</a></li>
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
                    <a href="{{ route('presences.create') }}" class="btn btn-primary mb-3 ms-auto">New Presence</a>
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
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Date</th>
                            <th>Status</th>
                            @if(session('role') === 'Admin HR')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $presence)
                        <tr>
                            <td>{{ $presence->employee->fullname }}</td>
                            <td>{{ $presence->check_in }}</td>
                            <td>{{ $presence->check_out }}</td>
                            <td>{{ $presence->date }}</td>
                            <td>
                                @if ($presence->status == 'Present')
                                    <span class="badge bg-success">Present</span>
                                @elseif ($presence->status == 'Sick')
                                    <span class="badge bg-danger">Sick</span>
                                @endif
                            </td>
                            <td>
                                @if(session('role') === 'Admin HR')
                                    <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button" data-employee-name="{{ $presence->employee->fullname }}">
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
                                                        html: `You are about to delete <strong>Presence ${employeeName}</strong>.<br>This action cannot be undone!`,
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
                                @endif
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
