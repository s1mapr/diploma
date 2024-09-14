<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContentBlockRequest;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Repositories\ContentBlockRepository;
use App\Services\ContentBlockService;
use App\Services\LessonService;

class LessonController extends Controller
{
    private LessonService $lessonService;
    private ContentBlockService $contentBlockService;

    public function __construct(LessonService $lessonService, ContentBlockService $contentBlockService)
    {
        $this->lessonService = $lessonService;
        $this->contentBlockService = $contentBlockService;
    }

    public function createContentBlock(CreateContentBlockRequest $request, Lesson $lesson)
    {
        $contentBlock = $this->contentBlockService->createContentBlock($lesson, $request->validated());

        return $this->success([
            'contentBlock' => LessonResource::make($contentBlock)
        ]);
    }

    public function getLessonData(Lesson $lesson)
    {
        $contentBlocks = $this->contentBlockService->findAllContentBlocksOfLesson($lesson);

        return $this->success([
            'lesson' => LessonResource::make($lesson),
            'contentBlocks' => LessonResource::collection($contentBlocks)
        ]);
    }
}
