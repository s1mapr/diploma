<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Student;
use App\Repositories\LessonRepository;

class LessonService
{
    private LessonRepository $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function createLesson(Course $course, array $data)
    {
        $data['course_id'] = $course->id;

        return $this->lessonRepository->createLesson($data);
    }

    public function findAllLessonsOfCourse(Course $course)
    {
        return $this->lessonRepository->findAllLessonsOfCourse($course->id);
    }

    public function updateLesson(Lesson $lesson, array $data)
    {
        $lesson->update($data);

        return $lesson;
    }

    public function deleteLesson(Lesson $lesson)
    {
        $lesson->delete();
    }

    public function finishLesson(Lesson $lesson, Student $student)
    {
        $student->courses()->where('lesson_id', $lesson->id)->update([
            'is_completed' => true,
        ]);
    }

    public function setTestResult(Lesson $lesson, Student $user, float $result)
    {
        $user->courses()->where('lesson_id', $lesson->id)->update([
            'test_result' => $result,
        ]);
    }
}
