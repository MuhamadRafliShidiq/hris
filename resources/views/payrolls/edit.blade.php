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
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Payroll</a></li>
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
                <form action="{{ route('payrolls.update', $payroll->id) }}" class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select 
                            name="employee_id" 
                            id="employee_id"
                            class="form-control @error('employee_id') is-invalid @enderror"
                            required
                        >
                            <option value="" disabled selected>-- Select Employee --</option>
                            @foreach ($employees as $employee)
                                <option 
                                    value="{{ $employee->id }}" @if(old('employee_id', $payroll->employee_id) == $employee->id) selected @endif 
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}
                                >
                                    {{ $employee->fullname}}
                                </option>
                            @endforeach
                        </select>
                        @error('$employee->fullname')
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
                                value="{{ old('salary', $payroll->salary) }}" 
                                required
                            >
                        </div>
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bonuses" class="form-label">Bonuses</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input 
                                type="text" 
                                class="form-control @error('bonuses') is-invalid @enderror" 
                                id="bonuses" 
                                name="bonuses"
                                value="{{ old('bonuses', $payroll->bonuses) }}" 
                                required
                            >
                        </div>
                        @error('bonuses')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deductions" class="form-label">Deductions</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input 
                                type="text" 
                                class="form-control @error('deductions') is-invalid @enderror" 
                                id="deductions" 
                                name="deductions" 
                                value="{{ old('deductions', $payroll->deductions) }}" 
                                required
                            >
                        </div>
                        @error('deductions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="net_salary" class="form-label">Net Salary</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input 
                                type="text" 
                                class="form-control @error('net_salary') is-invalid @enderror" 
                                id="net_salary" 
                                name="net_salary" 
                                value="{{ old('net_salary', $payroll->net_salary) }}" 
                                required
                            >
                        </div>
                        @error('net_salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Ambil semua elemen input berdasarkan ID
                            const inputs = ['salary', 'bonuses', 'deductions', 'net_salary'];
                            const salaryInput = document.getElementById('salary');
                            const bonusesInput = document.getElementById('bonuses');
                            const deductionsInput = document.getElementById('deductions');
                            const netSalaryInput = document.getElementById('net_salary');

                            // Format Uang Rupiah
                            inputs.forEach(id => {
                                const input = document.getElementById(id);

                                if (input) {
                                    // Saat user mengetik, format angka menjadi Rupiah (tanpa simbol Rp)
                                    input.addEventListener('input', function(e) {
                                        // Hapus karakter non-digit
                                        let value = this.value.replace(/\D/g, '');
                                        // Format angka
                                        this.value = new Intl.NumberFormat('id-ID').format(value);
                                    });

                                    // Sebelum form disubmit, ubah ke angka murni (tanpa titik)
                                    input.form?.addEventListener('submit', function() {
                                        input.value = input.value.replace(/\D/g, '');
                                    });
                                }
                            });

                            // Fungsi bantu untuk ambil angka murni dari input
                            function parseNumber(value) {
                                return parseInt(value.replace(/\D/g, '')) || 0;
                            }

                            // Fungsi bantu untuk format angka ke Rupiah (tanpa simbol Rp)
                            function formatRupiah(angka) {
                                return new Intl.NumberFormat('id-ID').format(angka);
                            }

                            // Fungsi utama untuk hitung Net Salary
                            function updateNetSalary() {
                                const salary = parseNumber(salaryInput.value);
                                const bonuses = parseNumber(bonusesInput.value);
                                const deductions = parseNumber(deductionsInput.value);

                                const net = salary + bonuses - deductions;
                                netSalaryInput.value = formatRupiah(net);
                            }

                            // Pasang event listener pada ketiga input
                            [salaryInput, bonusesInput, deductionsInput].forEach(input => {
                                input.addEventListener('input', updateNetSalary);
                            });
                        });
                    </script>

                    <div class="mb-3">
                        <label for="pay_date" class="form-label">Pay Date</label>
                        <input 
                            type="date-local" 
                            class="form-control date @error('pay_date') is-invalid @enderror" 
                            id="pay_date"
                            name="pay_date" 
                            value="{{ old('pay_date', $payroll->pay_date) }}" 
                            required
                        >
                        @error('pay_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary px-4 me-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Update Payroll
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </section>
</div> 
@endsection
