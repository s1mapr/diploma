<?php

namespace App\Repositories;

use App\Models\Chat;

class ChatRepository
{
    public function createChat(array $searchCriteria, array $data)
    {
        return Chat::updateOrCreate($searchCriteria, $data);
    }

    public function getStudentChats(int $studentId)
    {
        return Chat::where('student_id', $studentId)->paginate();
    }

    public function getTeacherChats(int $teacherId)
    {
        return Chat::where('teacher_id', $teacherId)->where('is_started', true)->paginate();
    }

    public function getChat(array $searchCriteria)
    {
        return Chat::where($searchCriteria)->first();
    }
}
