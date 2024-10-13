<?php

namespace App\Repositories;

use App\Models\Chat;

class ChatRepository
{
    public function createChat(array $data)
    {
        return Chat::save($data);
    }

    public function getStudentChats(int $studentId)
    {
        return Chat::where('student_id', $studentId)->get();
    }

    public function getTeacherChats(int $teacherId)
    {
        return Chat::where('teacher_id', $teacherId)->where('is_started', true)->get();
    }
}
