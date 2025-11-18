<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('leave_types')->insert([
            [
                'name' => 'Annual Leave', 
                'description' => 'Cuti Tahunan', 
                'default_days' => 12,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

            [
                'name' => 'Sick Leave', 
                'description' => 'Cuti Sakit', 
                'default_days' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

            [
                'name' => 'Maternity Leave', 
                'description' => 'Cuti Melahirkan', 
                'default_days' => 90,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

            [
                'name' => 'Paternity Leave',
                'description' => 'Cuti Ayah',
                'default_days' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

            [
                'name' => 'Bereavement Leave',
                'description' => 'Cuti Duka / Kematian Keluarga',
                'default_days' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

            [
                'name' => 'Unpaid Leave',
                'description' => 'Cuti Tanpa Bayar',
                'default_days' => 0, // tidak berbayar, biasanya tanpa batas default
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

            [
                'name' => 'Special Leave',
                'description' => 'Cuti Khusus (Pernikahan, Acara Keluarga, dll)',
                'default_days' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            
            [
                'name' => 'Study Leave',
                'description' => 'Cuti Belajar / Pelatihan',
                'default_days' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],

        ]);
    }
}
