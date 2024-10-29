<?php

namespace App\Services;

use App\Enums\ContentTypes;
use App\Models\ContentBlock;
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

        if ($data['type'] == ContentTypes::IMAGE->value) {
            $data['content'] = $this->s3Service->uploadFile(
                'courses/' . $lesson->course_id . '/lessons/' . $lesson->id . '/content_blocks',
                $data['content'],
                uniqid('content_block_pic_', true)
            );
        } else if ($data['type'] == ContentTypes::VIDEO->value) {
            if (str_contains($data['content'], 'youtube.com') && !str_contains($data['content'], '/embed/')) {
                $firstSubStr = explode("v=", $data['content'])[1];
                $secondSubStr = explode("&", $firstSubStr)[0];
                $data['content'] = "https://www.youtube.com/embed/" . $secondSubStr;
            }
        }

        return $this->contentBlockRepository->createContentBlock($data);
    }

    public function findAllContentBlocksOfLesson(Lesson $lesson)
    {
        return $this->contentBlockRepository->findAllContentBlocksOfLesson($lesson->id);
    }

    public function deleteContentBlock(ContentBlock $contentBlock)
    {
        $contentBlock->delete();
    }

    public function updateContentBlock(ContentBlock $contentBlock, array $data)
    {
        if (isset($data['type']) && $data['type'] == ContentTypes::IMAGE->value) {
            $data['content'] = $this->s3Service->uploadFile(
                'courses/' . $contentBlock->lesson->course_id . '/lessons/' . $contentBlock->lesson->id . '/content_blocks',
                $data['content'],
                uniqid('content_block_pic_', true)
            );
        }
        $contentBlock->update($data);
    }
}
