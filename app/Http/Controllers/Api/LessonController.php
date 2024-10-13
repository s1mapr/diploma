<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContentBlockRequest;
use App\Http\Requests\CreateTestRequest;
use App\Http\Requests\SendTestResultRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\ContentBlockResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\TestResource;
use App\Http\Resources\TestWithVariantsResource;
use App\Models\Lesson;
use App\Services\ContentBlockService;
use App\Services\LessonService;
use App\Services\TestService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private LessonService $lessonService;

    private ContentBlockService $contentBlockService;

    private TestService $testService;

    public function __construct(LessonService $lessonService, ContentBlockService $contentBlockService, TestService $testService)
    {
        $this->lessonService = $lessonService;
        $this->contentBlockService = $contentBlockService;
        $this->testService = $testService;
    }

    public function createContentBlock(CreateContentBlockRequest $request, Lesson $lesson)
    {
        $contentBlock = $this->contentBlockService->createContentBlock($lesson, $request->validated());

        return $this->success([
            'contentBlock' => ContentBlockResource::make($contentBlock),
        ]);
    }

    public function getLessonData(Request $request, Lesson $lesson)
    {
        $user = $request->user();
        $contentBlocks = $this->contentBlockService->findAllContentBlocksOfLesson($lesson);
        $tests = $this->testService->findAllTestsOfLesson($lesson);

        if ($user->isStudent()) {
            return $this->success([
                'lesson' => LessonResource::make($lesson),
                'contentBlocks' => ContentBlockResource::collection($contentBlocks),
            ]);
        }

        return $this->success([
            'lesson' => LessonResource::make($lesson),
            'contentBlocks' => ContentBlockResource::collection($contentBlocks),
            'tests' => TestResource::collection($tests),
        ]);
    }

    public function updateLesson(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson = $this->lessonService->updateLesson($lesson, $request->validated());

        return $this->success([
            'lesson' => LessonResource::make($lesson),
        ]);
    }

    public function deleteLesson(Lesson $lesson)
    {
        $this->lessonService->deleteLesson($lesson);

        return $this->successWithoutData('Lesson deleted successfully');
    }

    public function createTest(CreateTestRequest $request, Lesson $lesson)
    {
        $test = $this->testService->createTest($lesson, $request->validated());

        return $this->success([
            'test' => TestResource::make($test),
        ]);
    }

    public function getLessonTests(Lesson $lesson)
    {
        $tests = $this->testService->findAllTestsOfLesson($lesson);

        return $this->success([
            'tests' => TestWithVariantsResource::collection($tests),
        ]);
    }

    public function finishLesson(Request $request, Lesson $lesson)
    {
        $student = $request->user();
        $this->lessonService->finishLesson($lesson, $student);

        return $this->successWithoutData('Lesson completed successfully');
    }

    public function setTestResult(SendTestResultRequest $request, Lesson $lesson)
    {
        $user = $request->user();
        $this->lessonService->setTestResult($lesson, $user, $request->result);

        return $this->successWithoutData('Test result sent successfully');
    }
}
