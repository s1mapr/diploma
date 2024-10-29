<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'test1'],
            ['name' => 'test2'],
            ['name' => 'test3'],
            ['name' => 'test4'],
            ['name' => 'test5'],
            ['name' => 'test6'],
            ['name' => 'test7'],
            ['name' => 'test8'],
            ['name' => 'test9'],
            ['name' => 'test10'],
        ];

        foreach ($tags as $tag) {
            Category::create($tag);
        }
    }
}
