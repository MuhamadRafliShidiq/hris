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
                        <li class="breadcrumb-item"><a href="{{ route('payrolls.index') }}">Salary Slip</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
    <section class="section py-4">
        <div class="container">
            <div class="card shadow-sm border-0 rounded-3" id="salary-slip">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white"><i class="bi bi-file-earmark-text me-2"></i>Slip Gaji</h5>
                        <span class="badge bg-white text-primary">{{ \Carbon\Carbon::parse($payroll->pay_date)->format('F Y') }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Company & Employee Info -->
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-primary mt-3 mb-2">Informasi Perusahaan</h6>
                            <p class="mb-1 fw-semibold">PT. Nama Perusahaan</p>
                            <p class="mb-0 text-muted small">Alamat perusahaan lengkap</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="text-primary mt-3 mb-2">Informasi Karyawan</h6>
                            <p class="mb-1 fw-semibold">{{ $payroll->employee->fullname }}</p>
                            <p class="mb-0 text-muted small">ID: {{ $payroll->employee->id }}</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Salary Details -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h6 class="text-primary border-bottom pb-2 mb-3">
                                <i class="bi bi-cash-stack me-2"></i>Rincian Gaji
                            </h6>
                        </div>

                        <!-- Pendapatan -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Gaji Pokok</span>
                                    <span class="fw-semibold">Rp {{ number_format($payroll->salary, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Bonus</span>
                                    <span class="fw-semibold text-success">Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total Pendapatan</span>
                                    <span class="fw-bold text-success">Rp {{ number_format($payroll->salary + $payroll->bonuses, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Potongan -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Potongan</span>
                                    <span class="fw-semibold text-danger">Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total Potongan</span>
                                    <span class="fw-bold text-danger">Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Net Salary -->
                    <div class="alert alert-primary d-flex justify-content-between align-items-center mb-4" role="alert">
                        <div>
                            <h6 class="mb-0 text-white"><i class="bi bi-wallet2 me-2"></i>Gaji Bersih (Take Home Pay)</h6>
                            <small class="text-white">Tanggal Pembayaran: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('d F Y') }}</small>
                        </div>
                        <h4 class="mb-0 fw-bold text-white">Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</h4>
                    </div>
                    <!-- Additional Info -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h6 class="text-primary border-bottom pb-2 mb-3">
                                <i class="bi bi-info-circle me-2"></i>Informasi Tambahan
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Periode Gaji</label>
                                <p class="mb-0 fw-medium">
                                    <i class="bi bi-calendar-range me-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($payroll->pay_date)->format('F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded">
                                <label class="form-label fw-semibold text-muted small mb-1">Status Pembayaran</label>
                                <p class="mb-0 fw-medium">
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>Dibayarkan
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Note -->
                    <div class="text-center text-muted small mt-4 pt-3 border-top">
                        <p class="mb-0">Dokumen ini dicetak secara otomatis dan tidak memerlukan tanda tangan</p>
                        <p class="mb-0">Untuk pertanyaan, hubungi HR Department</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center pt-4 border-top m-3">
                        <a href="{{ route('payrolls.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('payrolls.pdf', $payroll->id) }}" class="btn btn-primary" target="_blank">
                            <i class="bi bi-printer me-1"></i> Cetak Slip Gaji (PDF)
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div> 

@push('scripts')


<style>
@media print {
    /* Hide elements */
    .burger-btn,
    .breadcrumb-header,
    .btn,
    .sidebar,
    header,
    nav {
        display: none !important;
    }
    
    /* Adjust layout for print */
    .page-heading {
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .container {
        max-width: 100% !important;
        padding: 0 !important;
    }
    
    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
    }
    
    /* Ensure colors print correctly */
    .bg-primary {
        background-color: #0d6efd !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    .text-white {
        color: #ffffff !important;
    }
    
    /* Page break settings */
    .card {
        page-break-inside: avoid;
    }
}
</style>
@endpush



@endsection