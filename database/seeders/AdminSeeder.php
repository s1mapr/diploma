<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'email' => 'admin@gmail.com',
            'name' => 'Maksym',
            'password' => bcrypt('password'),
        ]);
    }
}
