<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payroll;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    public function index()
    {
        if (session ('role') === 'Admin HR') {
            $payrolls = Payroll::all();
        } else {
            $payrolls = Payroll::where('employee_id', session('employee_id'))->get();
        }
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $payrolls = Payroll::all();
        $employees = Employee::all();
        return view('payrolls.create', compact('payrolls', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'salary' => 'required',
            'bonuses' => 'required',
            'deductions' => 'required',
            'net_salary' => 'required',
            'pay_date' => 'required',
        ]);

        // Jika Berhasil
        Payroll::create($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payroll created successfully');
    }

    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $payroll = Payroll::findOrFail($payroll->id);
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'salary' => 'required',
            'bonuses' => 'required',
            'deductions' => 'required',
            'net_salary' => 'required',
            'pay_date' => 'required',
        ]);

        // Jika Berhasil
        $payroll->update($validated);
        return redirect()->route('payrolls.index')->with('success', 'Payroll updated successfully');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully');
    }

    public function generatePDF($id)
    {
        $payroll = Payroll::with('employee.department')->findOrFail($id);
        
        $pdf = Pdf::loadView('payrolls.pdf', compact('payroll'))
                ->setPaper('a4', 'portrait');

        // Bisa langsung tampil di browser:
        return $pdf->stream('Slip_Gaji_' . $payroll->employee->fullname . '.pdf');

        // Atau kalau mau langsung download:
        // return $pdf->download('Slip_Gaji_' . $payroll->employee->fullname . '.pdf');
    }
}
