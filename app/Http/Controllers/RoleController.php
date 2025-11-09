<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create() {
        return view('roles.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'description' => 'required',
        ]);

        // jika berhasil
        $role = Role::create($validated);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Role $role) {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role) {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // jika berhasil
        $role->update($validated);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

     public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $roleName = $role->title;
            $role->delete();
            
            return redirect()->route('roles.index')
                ->with('success', "Role '{$roleName}' has been deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('Roles.index')
                ->with('error', 'Failed to delete role. Please try again.');
        }
    }



}
