<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
        DB::table('departments')->insert([
            ['name' => 'HR'],
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
        ]);

        DB::table('designations')->insert([
            ['name' => 'Developer'],
            ['name' => 'Manager'],
            ['name' => 'Analyst'],
        ]);

        DB::table('users')->insert([
            ['name' => 'test', 'fk_department' => 1, 'fk_designation' => 2, 'phone_number' => '9908765678'],
            ['name' => 'test2', 'fk_department' => 2, 'fk_designation' => 1, 'phone_number' => '09997654321'],
        ]);
    }
}
