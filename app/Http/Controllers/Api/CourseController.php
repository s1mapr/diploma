<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Services\CourseService;
use App\Services\LessonService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private CourseService $courseService;
    private LessonService $lessonService;

    public function __construct(CourseService $courseService, LessonService $lessonService)
    {
        $this->courseService = $courseService;
        $this->lessonService = $lessonService;
    }

    public function createCourse(CreateCourseRequest $request)
    {
        $user = $request->user();
        $course = $this->courseService->createCourse($user, $request->validated());

        return $this->success([
            'course' => CourseResource::make($course)
        ]);
    }

    public function createLesson(CreateLessonRequest $request, Course $course)
    {
        $lesson = $this->lessonService->createLesson($course, $request->validated());

        return $this->success([
            'lesson' => LessonResource::make($lesson)
        ]);
    }

    public function getCourseData(Course $course)
    {
        $lessons = $this->lessonService->findAllLessonsOfCourse($course);

        return $this->success([
            'course' => CourseResource::make($course),
            'lessons' => LessonResource::collection($lessons)
        ]);
    }

    public function getAllTeacherCourses(Request $request)
    {
        $user = $request->user();
        $courses = $this->courseService->getAllTeacherCourses($user);

        return $this->success([
            'current_page'=> $courses->currentPage(),
            'last_page'=> $courses->lastPage(),
            'total'=> $courses->total(),
            'courses' => CourseResource::collection($courses)
        ]);
    }

    public function updateCourse(UpdateCourseRequest $request, Course $course)
    {
        $course = $this->courseService->updateCourse($course, $request->validated());

        return $this->success([
            'course' => CourseResource::make($course)
        ]);
    }

    public function deleteCourse(Course $course)
    {
        $this->courseService->deleteCourse($course);

        return $this->successWithoutData([
            'message' => 'Course deleted successfully'
        ]);
    }

    public function subscribeToCourse(Course $course, Request $request)
    {
        $user = $request->user();
        $this->courseService->subscribeToCourse($course, $user);

        return $this->successWithoutData([
            'message' => 'Subscribed to course successfully'
        ]);
    }
}
