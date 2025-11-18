<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payroll')->insert([
            [
                'employee_id' => 1,
                'salary' => 5000000,
                'bonuses' => 2000000,
                'deductions' => 55000,
                'net_salary' => 5000000 - 55000 + 2000000,  // 6.945.000
                'pay_date' => Carbon::parse('2025-10-28'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'salary' => 5500000,
                'bonuses' => 200000,
                'deductions' => 60500,
                'net_salary' => 5500000 - 60500 + 200000,  // 5.653.500
                'pay_date' => Carbon::parse('2025-10-28'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 3,
                'salary' => 8000000,
                'bonuses' => 1000000,
                'deductions' => 88000,
                'net_salary' => 8000000 - 88000 + 1000000, // 8.912.000
                'pay_date' => Carbon::parse('2025-10-28'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
