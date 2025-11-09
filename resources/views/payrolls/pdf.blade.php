<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - {{ $payroll->employee->fullname }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            font-size: 11px;
            line-height: 1.4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #333;
        }
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h2 {
            font-size: 20px;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        .header p {
            font-size: 10px;
            opacity: 0.9;
        }
        .info-section {
            display: table;
            width: 100%;
            border-bottom: 2px solid #333;
        }
        .info-left, .info-right {
            display: table-cell;
            width: 50%;
            padding: 15px;
            vertical-align: top;
        }
        .info-right {
            border-left: 1px solid #ddd;
        }
        .info-row {
            margin-bottom: 8px;
        }
        .info-label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #000;
        }
        .earnings-deductions {
            display: table;
            width: 100%;
        }
        .earnings, .deductions {
            display: table-cell;
            width: 50%;
            padding: 15px;
            vertical-align: top;
        }
        .deductions {
            border-left: 1px solid #ddd;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #fff;
            background-color: #555;
            padding: 6px 10px;
            margin-bottom: 10px;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 10px;
            border-bottom: 1px dotted #ddd;
        }
        .item-row:last-child {
            border-bottom: none;
        }
        .item-label {
            color: #333;
        }
        .item-value {
            font-weight: bold;
            color: #000;
        }
        .summary {
            background-color: #f8f9fa;
            border-top: 2px solid #333;
            padding: 15px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 10px;
            font-size: 12px;
        }
        .summary-row.total {
            background-color: #1e3c72;
            color: white;
            font-weight: bold;
            font-size: 14px;
            margin-top: 5px;
            padding: 12px 10px;
        }
        .summary-label {
            font-weight: bold;
        }
        .footer {
            padding: 15px;
            text-align: center;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }
        .footer p {
            font-size: 9px;
            color: #666;
            font-style: italic;
        }
        .signature-section {
            display: table;
            width: 100%;
            padding: 30px 15px 15px;
        }
        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
        }
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 5px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>SLIP GAJI KARYAWAN</h2>
            <p>PAYROLL SLIP</p>
        </div>

        <!-- Employee Info -->
        <div class="info-section">
            <div class="info-left">
                <div class="info-row">
                    <span class="info-label">Nama Karyawan</span>
                    <span class="info-value">: {{ $payroll->employee->fullname }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">NIK/ID Karyawan</span>
                    <span class="info-value">: {{ $payroll->employee->id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Departemen</span>
                    <span class="info-value">: {{ $department->name ?? '-' }}</span>
                </div>
            </div>
            <div class="info-right">
                <div class="info-row">
                    <span class="info-label">Periode</span>
                    <span class="info-value">: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Bayar</span>
                    <span class="info-value">: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('d F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">No. Slip</span>
                    <span class="info-value">: {{ $payroll->id }}</span>
                </div>
            </div>
        </div>

        <!-- Earnings and Deductions -->
        <div class="earnings-deductions">
            <!-- Earnings -->
            <div class="earnings">
                <div class="section-title">PENGHASILAN</div>
                <div class="item-row">
                    <span class="item-label">Gaji Pokok</span>
                    <span class="item-value">Rp {{ number_format($payroll->salary, 0, ',', '.') }}</span>
                </div>
                <div class="item-row">
                    <span class="item-label">Bonus & Tunjangan</span>
                    <span class="item-value">Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</span>
                </div>
                <div class="item-row" style="border-top: 2px solid #333; margin-top: 5px; padding-top: 8px;">
                    <span class="item-label" style="font-weight: bold;">Total Penghasilan</span>
                    <span class="item-value" style="color: #28a745;">Rp {{ number_format($payroll->salary + $payroll->bonuses, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Deductions -->
            <div class="deductions">
                <div class="section-title">POTONGAN</div>
                <div class="item-row">
                    <span class="item-label">Total Potongan</span>
                    <span class="item-value" style="color: #dc3545;">Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="summary">
            <div class="summary-row">
                <span class="summary-label">Total Penghasilan</span>
                <span>Rp {{ number_format($payroll->salary + $payroll->bonuses, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Total Potongan</span>
                <span style="color: #dc3545;">Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row total">
                <span>GAJI BERSIH (TAKE HOME PAY)</span>
                <span>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="signature-box">
                <div>Karyawan,</div>
                <div class="signature-line">{{ $payroll->employee->fullname }}</div>
            </div>
            <div class="signature-box">
                <div>HRD Manager,</div>
                <div class="signature-line">(...........................)</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dicetak secara otomatis oleh sistem HRIS dan sah tanpa tanda tangan basah</p>
            <p>Slip gaji ini bersifat rahasia dan hanya untuk keperluan karyawan yang bersangkutan</p>
        </div>
    </div>
</body>
</html>