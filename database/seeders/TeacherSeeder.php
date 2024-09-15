<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'first_name' => 'Maksym',
            'last_name' => 'Prokopenko',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
