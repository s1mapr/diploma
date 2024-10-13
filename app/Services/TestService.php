<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Test;
use App\Repositories\TestRepository;

class TestService
{
    private TestRepository $testRepository;

    private OpenAIService $openAIService;

    public function __construct(TestRepository $testRepository, OpenAIService $openAIService)
    {
        $this->testRepository = $testRepository;
        $this->openAIService = $openAIService;
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

    public function getExplanationOfTest(Test $test, array $userAnswer, array $rightAnswers)
    {
        $userAnswerString = implode(', ', $userAnswer);
        $rightAnswersString = implode(', ', $rightAnswers);

        $exp = $this->openAIService->getExplanation($test->content, $userAnswerString, $rightAnswersString);

        return $exp;
    }
}
