<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\ChatRepository;
use App\Repositories\MessageRepository;

class ChatService
{
    private ChatRepository $chatRepository;

    private MessageRepository $messageRepository;

    private S3Service $s3Service;

    public function __construct(ChatRepository $chatRepository, MessageRepository $messageRepository, S3Service $s3Service)
    {
        $this->chatRepository = $chatRepository;
        $this->messageRepository = $messageRepository;
        $this->s3Service = $s3Service;
    }

    public function getStudentChats(Student $student)
    {
        return $this->chatRepository->getStudentChats($student->id);
    }

    public function getTeacherChats(Teacher $teacher)
    {
        return $this->chatRepository->getTeacherChats($teacher->id);
    }
}
