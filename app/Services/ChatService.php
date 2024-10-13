<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\ChatRepository;

class ChatService
{
    private ChatRepository $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function createChat(array $data)
    {
        $data['is_started'] = false;

        return $this->chatRepository->createChat($data);
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
