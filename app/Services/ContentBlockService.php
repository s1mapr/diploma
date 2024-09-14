<?php

namespace App\Services;

use App\Models\Lesson;
use App\Repositories\ContentBlockRepository;

class ContentBlockService
{
    public ContentBlockRepository $contentBlockRepository;

    public function __construct(ContentBlockRepository $contentBlockRepository)
    {
        $this->contentBlockRepository = $contentBlockRepository;
    }

    public function createContentBlock(Lesson $lesson, array $data)
    {
        $data['lesson_id'] = $lesson->id;
        return $this->contentBlockRepository->createContentBlock($data);
    }
}
