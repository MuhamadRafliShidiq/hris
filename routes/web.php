<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\LeaveRequestController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['role:Admin HR,Developer,Sales']);
    Route::get('/dashboard/presence', [DashboardController::class, 'presence']);

    // Handle Employee
    Route::resource('/employees', EmployeeController::class)->middleware(['role:Admin HR']);

    // Handle Task
    Route::resource('/tasks', TaskController::class)->middleware(['role:Admin HR,Developer,Sales']);
    Route::get('/tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done')->middleware(['role:Admin HR,Developer,Sales']);
    Route::get('/tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending')->middleware(['role:Admin HR,Developer,Sales']);

    // Handle Departement
    Route::resource('/departments', DepartmentController::class)->middleware(['role:Admin HR']);

    // Handle Role
    Route::resource('/roles', RoleController::class)->middleware(['role:Admin HR']);

    // Handle Presences
    Route::resource('/presences', PresenceController::class)->middleware(['role:Admin HR,Developer,Sales']);

    // Handle Payroll
    Route::resource('/payrolls', PayrollController::class)->middleware(['role:Admin HR,Developer,Sales']);
    Route::get('/payrolls/{id}/pdf', [PayrollController::class, 'generatePDF'])->name('payrolls.pdf');


    // Handle Leave Request
    Route::resource('/leave_requests', LeaveRequestController::class)->middleware(['role:Admin HR,Developer,Sales']);

    Route::get('/leave_requests/confirm/{id}', [LeaveRequestController::class, 'confirm'])->name('leave_requests.confirm')->middleware(['role:Admin HR']);
    Route::get('/leave_requests/reject/{id}', [LeaveRequestController::class, 'reject'])->name('leave_requests.reject')->middleware(['role:Admin HR']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
