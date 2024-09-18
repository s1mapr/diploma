<?php

namespace App\Repositories;

use App\Models\Test;

class TestRepository
{
    public function createTest(array $data)
    {
        return Test::create($data);
    }

    public function findAllTestsOfLesson($id)
    {
        return Test::where('lesson_id', $id)->get();
    }
}
