<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    public function index()
    {
        if (session ('role') === 'Admin HR' || session('role') === 'Super Admin') {
            $employees = Employee::all();
            $leave_requests = LeaveRequest::all();
        } else {
            $employees = Employee::where('id', session('employee_id'))->get();
            $leave_requests = LeaveRequest::where('employee_id', session('employee_id'))->get();
        }
       
        return view('leave_requests.index', compact('employees', 'leave_requests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('leave_requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        if (session ('role') === 'Admin HR') {
            $validated = $request -> validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            ]);
            
            $request->merge([
                'status' => 'Pending',
            ]);
        
            // Jika Berhasil
            LeaveRequest::create($validated);
        } else {
            LeaveRequest::create([
                'employee_id' => session('employee_id'),
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'Pending',
            ]);
        }
        
        return redirect()->route('leave_requests.index')->with('success', 'Leave Request created successfully');
    }
    
    public function edit(LeaveRequest $leave_request)
    {
        $employees = Employee::all();
        return view('leave_requests.edit', compact('leave_request', 'employees'));
    }

    public function update(Request $request, LeaveRequest $leave_request)
    {
        $validated = $request -> validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // Jika Berhasil
        $leave_request->update($validated);
        return redirect()->route('leave_requests.index')->with('success', 'Leave Request updated successfully');
    }

    public function destroy(LeaveRequest $leave_request)
    {
        $leave_request->delete();
        return redirect()->route('leave_requests.index')->with('success', 'Leave Request deleted successfully');
    }

    public function confirm($id)
    {
        $leave_request = LeaveRequest::findOrFail($id);
        $leave_request->update (['status' => 'Approved']);
        $leave_request->save();
        return redirect()->route('leave_requests.index')->with('success', 'Leave Request approved successfully');
    }

    public function reject($id)
    {
        $leave_request = LeaveRequest::findOrFail($id);
        $leave_request->update (['status' => 'Rejected']);
        $leave_request->save();
        return redirect()->route('leave_requests.index')->with('success', 'Leave Request rejected successfully');
    }
}
