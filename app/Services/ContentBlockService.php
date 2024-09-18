<?php

namespace App\Services;

use App\Enums\ContentTypes;
use App\Models\Lesson;
use App\Repositories\ContentBlockRepository;

class ContentBlockService
{
    private ContentBlockRepository $contentBlockRepository;
    private S3Service $s3Service;

    public function __construct(ContentBlockRepository $contentBlockRepository, S3Service $s3Service)
    {
        $this->contentBlockRepository = $contentBlockRepository;
        $this->s3Service = $s3Service;
    }

    public function createContentBlock(Lesson $lesson, array $data)
    {
        $data['lesson_id'] = $lesson->id;

        if($data['type'] == ContentTypes::IMAGE->value){
            $data['content'] = $this->s3Service->uploadFile(
                'courses/' . $lesson->course_id . '/lessons/' . $lesson->id . '/content_blocks',
                $data['content'],
                uniqid('content_block_pic_', true)
            );
        }
        return $this->contentBlockRepository->createContentBlock($data);
    }

    public function findAllContentBlocksOfLesson(Lesson $lesson)
    {
        return $this->contentBlockRepository->findAllContentBlocksOfLesson($lesson->id);
    }
}
