<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Test;
use App\Repositories\TestRepository;

class TestService
{
    private TestRepository $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function createTest(Lesson $lesson, array $data)
    {
        $data['lesson_id'] = $lesson->id;
        return $this->testRepository->createTest($data);
    }

    public function updateTest(Test $test, array $data)
    {
        $test->update($data);
        return $test;
    }

    public function deleteTest(Test $test)
    {
        $test->delete();
    }

    public function findAllTestsOfLesson(Lesson $lesson)
    {
        return $this->testRepository->findAllTestsOfLesson($lesson->id);
    }
}
