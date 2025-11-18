<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'fullname' => 'Muhamad Rafli Shidiq',
                'email' => 'ainadanshidiq@gmail.com',
                'phone_number' => '082134716388',
                'address' => 'Bandung, Indonesia',
                'birth_date' => '2003-08-19',
                'hire_date' => Carbon::now(),
                'department_id' => 3, // IT Department
                'role_id' => 1, // Super Admin
                'status' => 'Active',
                'salary' => 5000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ],
            // HR
            [
                'fullname' => 'Siti Maulida',
                'email' => 'hr@example.com',
                'phone_number' => '081200000002',
                'address' => 'Bekasi, Indonesia',
                'birth_date' => '1993-04-22',
                'hire_date' => Carbon::now(),
                'department_id' => 1, // HR Department
                'role_id' => 2, // Admin HR
                'status' => 'Active',
                'salary' => 5500000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ],

            // HR Manager
            [
                'fullname' => 'Budi Saputra',
                'email' => 'manager@example.com',
                'phone_number' => '081200000003',
                'address' => 'Depok, Indonesia',
                'birth_date' => '1988-11-05',
                'hire_date' => Carbon::now(),
                'department_id' => 1, // HR Department
                'role_id' => 3, // HR Manager
                'status' => 'Active',
                'salary' => 8000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ],

            // Operator
            [
                'fullname' => 'Rizky Pratama',
                'email' => 'operator@example.com',
                'phone_number' => '081200000004',
                'address' => 'Karawang, Indonesia',
                'birth_date' => '1999-07-18',
                'hire_date' => Carbon::now(),
                'department_id' => 4, // Operations
                'role_id' => 4, // Employee
                'status' => 'Active',
                'salary' => 4000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ],
        ]);
    }
}
