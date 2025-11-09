<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create() {
        return view('departments.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        // jika berhasil
        $department = Department::create($validated);
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    public function edit(Department $department) {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        // jika berhasil
        $department->update($validated);
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        try {
            $department = Department::findOrFail($id);
            $departmentName = $department->name;
            $department->delete();
            
            return redirect()->route('departments.index')
                ->with('success', "Department '{$departmentName}' has been deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('departments.index')
                ->with('error', 'Failed to delete department. Please try again.');
        }
    }
}
