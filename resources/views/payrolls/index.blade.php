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
                <h3>Payroll</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payroll</a></li>
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
                    @if(session('role') === 'Admin HR' || session('role') === 'Super Admin')
                        <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3 ms-auto">New Payroll</a>
                    @endif
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
                            <th>Salary</th>
                            <th>Bonuses</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Pay Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                        <tr>
                            <td>{{ $payroll->employee->fullname }}</td>
                            <td>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</td>
                            <td>{{ $payroll->pay_date }}</td>
                            <td>
                                <a href="{{ route('payrolls.show', $payroll->id) }}" class="btn btn-info btn-sm">Salary Slip</a>
                                @if(session('role') === 'Admin HR' || session('role') === 'Super Admin')
                                    <a href="{{ route('payrolls.edit', $payroll->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('payrolls.destroy', $payroll->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button" data-employee-name="{{ $payroll->employee->fullname }}">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
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
                                                    html: `You are about to delete <strong>Payroll ${employeeName}</strong>.<br>This action cannot be undone!`,
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
