<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Role;



class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required',
            'role_id' => 'required',
            'status' => 'required',
            'salary' => 'required|numeric',
        ]);

        // Jika Berhasil
        $employee = Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'department_id' => 'required',
            'role_id' => 'required',
            'status' => 'required',
            'salary' => 'required|numeric',
        ]);

        // Jika Berhasil
        $employee = Employee::findOrFail($id);
        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employeeName = $employee->fullname;
            $employee->delete();
            
            return redirect()->route('employees.index')
                ->with('success', "Employee '{$employeeName}' has been deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('employees.index')
                ->with('error', 'Failed to delete employee. Please try again.');
        }
    }
}
