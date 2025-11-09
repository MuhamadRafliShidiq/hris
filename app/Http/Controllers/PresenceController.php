<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Employee;

class PresenceController extends Controller
{
    public function index()
    {
        if (session('role') === 'Admin HR') {
            $presences = Presence::all();
            $employees = Employee::all();
        } else {
            $presences = Presence::where('employee_id', session('employee_id'))->get();
            $employees = Employee::where('id', session('employee_id'))->get();
        }
        
        return view('presences.index', compact('presences', 'employees'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('presences.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'date' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
        ]);

        // Jika Berhasil
        Presence::create($validated);
        return redirect()->route('presences.index')->with('success', 'Presence created successfully');
    }

    public function show(Presence $presence)
    {
        $presence = Presence::findOrFail($presence->id);
        return view('presences.show', compact('presence'));
    }

    public function edit(Presence $presence)
    {
        $presence = Presence::findOrFail($presence->id);
        $employees = Employee::all();
        return view('presences.edit', compact('presence', 'employees'));
    }

    public function update(Request $request, Presence $presence)
    {
        $validated = $request->validate([
            'employee_id' => 'required',
            'date' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required',
        ]);

        // Jika Berhasil
        $presence->update($validated);
        return redirect()->route('presences.index')->with('success', 'Presence updated successfully');
    }

    public function destroy($id)
    {
        try {
            $presence = Presence::findOrFail($id);
            $employee = Employee::findOrFail($presence->employee_id);
            $employeeName = $employee->fullname;
            $presence->delete();
            
            return redirect()->route('presences.index')
                ->with('success', "Presence '{$employeeName}' has been deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('presences.index')
                ->with('error', 'Failed to delete employee. Please try again.');
        }
    }
       
}
