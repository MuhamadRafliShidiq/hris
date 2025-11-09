<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Department;
use App\Models\Presence;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $presence = Presence::count();
        $tasks = Task::all();

        return view('dashboard.index' , compact('employee', 'department', 'payroll', 'presence', 'tasks'));
    }

    public function presence()
    {
        // Ambil data jumlah present per bulan (bulan = 1..12)
        $data = Presence::where('status', 'Present')
            ->selectRaw('MONTH(date) as month, COUNT(*) as total_present')
            ->groupBy('month')
            ->get();

        // Buat array 12 elemen default 0
        $result = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $monthIndex = intval($item->month) - 1; // ubah ke 0-based index
            if ($monthIndex >= 0 && $monthIndex < 12) {
                $result[$monthIndex] = intval($item->total_present);
            }
        }

        return response()->json($result);
    }

}
