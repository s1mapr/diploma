<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVariantRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Http\Requests\UserAnswerRequest;
use App\Http\Resources\TestResource;
use App\Http\Resources\VariantResource;
use App\Models\Test;
use App\Services\TestService;
use App\Services\VariantService;

class TestController extends Controller
{
    private VariantService $variantService;

    private TestService $testService;

    public function __construct(VariantService $variantService, TestService $testService)
    {
        $this->variantService = $variantService;
        $this->testService = $testService;
    }

    public function createVariant(CreateVariantRequest $request, Test $test)
    {
        $variant = $this->variantService->createVariant($test, $request->validated());

        return $this->success([
            'variant' => VariantResource::make($variant),
        ]);
    }

    public function getTestData(Test $test)
    {
        $variants = $this->variantService->findAllVariantsOfTest($test);

        return $this->success([
            'test' => TestResource::make($test),
            'variants' => VariantResource::collection($variants),
        ]);
    }

    public function updateTest(UpdateTestRequest $request, Test $test)
    {
        $test = $this->testService->updateTest($test, $request->validated());

        return $this->success([
            'test' => TestResource::make($test),
        ]);
    }

    public function deleteTest(Test $test)
    {
        $this->testService->deleteTest($test);

        return $this->successWithoutData('Test deleted successfully!');
    }

    public function getExplanationOfTest(UserAnswerRequest $request, Test $test)
    {
        $userAnswer = $request->userAnswers;
        $rightAnswers = $this->variantService->getRightAnswersStringArray($test);

        $exp = $this->testService->getExplanationOfTest($test, $userAnswer, $rightAnswers);

        return $this->success([
            'explanation' => $exp,
        ]);
    }
}
