<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class HrisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        DB::table('departments')->insert([
            [
                'name' => 'HR',
                'description' => 'Human Resource',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'IT',
                'description' => 'Information Technology',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sales',
                'description' => 'Sales',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('roles')->insert([            
            [
                'title' => 'HR',
                'description' => 'Handling Team',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Developer',
                'description' => 'Handling Codes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sales',
                'description' => 'Handling Sales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('employees')->insert([
            [
                'fullname' => $faker->name,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->dateTimeBetween('-40 years', '-22 years'),
                'hire_date' => Carbon::now(),
                'department_id' => 1,
                'role_id' => 1,
                'status' => 'Active',
                'salary' => $faker->randomFloat(2, 10000, 50000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ],
            [
                'fullname' => $faker->name,
                'email' => $faker->email,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->dateTimeBetween('-40 years', '-22 years'),
                'hire_date' => Carbon::now(),
                'department_id' => 1,
                'role_id' => 1,
                'status' => 'Active',
                'salary' => $faker->randomFloat(2, 10000, 50000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null
            ],
        ]);

        DB::table('tasks')->insert([
            [
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'assigned_to' => 1,
                'due_date' => Carbon::parse('2025-10-28'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title' => $faker->sentence(3),
                'description' => $faker->paragraph,
                'assigned_to' => 1,
                'due_date' => Carbon::parse('2025-10-28'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('payroll')->insert([
            [
                'employee_id' => 1,
                'salary' => $faker->randomFloat(2, 10000, 50000),
                'bonuses' => $faker->randomFloat(2, 10000, 50000),
                'deductions' => $faker->randomFloat(2, 300, 1000),
                'net_salary' => $faker->randomFloat(2, 10000, 50000),
                'pay_date' => Carbon::parse('2025-10-28'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'salary' => $faker->randomFloat(2, 10000, 50000),
                'bonuses' => $faker->randomFloat(2, 10000, 50000),
                'deductions' => $faker->randomFloat(2, 300, 1000),
                'net_salary' => $faker->randomFloat(2, 10000, 50000),
                'pay_date' => Carbon::parse('2025-10-28'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('presences')->insert([
            [
                'employee_id' => 1,
                'check_in' => Carbon::parse('2025-10-28 08:00:00'),
                'check_out' => Carbon::parse('2025-10-28 17:00:00'),
                'date' => Carbon::parse('2025-10-28'),
                'status' => 'Present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),   
            ],
            [
                'employee_id' => 2,
                'check_in' => Carbon::parse('2025-10-28 08:00:00'),
                'check_out' => Carbon::parse('2025-10-28 17:00:00'),
                'date' => Carbon::parse('2025-10-28'),
                'status' => 'Present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),   
            ],
        ]);

        DB::table('leave_requests')->insert([
            [
                'employee_id' => 1,
                'leave_type' => 'Sick Leave',
                'start_date' => Carbon::parse('2025-10-28'),
                'end_date' => Carbon::parse('2025-10-31'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 2,
                'leave_type' => 'Vacation',
                'start_date' => Carbon::parse('2025-10-28'),
                'end_date' => Carbon::parse('2025-10-31'),
                'status' => 'Pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
