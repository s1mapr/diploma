<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentBlockSeeder extends Seeder
{
    public function run()
    {
        ContentBlock::factory()->count(450)->create();
    }
}
