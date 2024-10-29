<?php

namespace App\Services;

use App\Enums\CourseStatuses;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\ChatRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use Illuminate\Support\Facades\DB;

class CourseService
{
    protected const OBFUSCATING_PRIME = 350561363;
    protected const MAX_PRIME = 83476331;
    protected const CHARACTERS_FOR_GENERATION = 'A92D47N8GF531V0X6';
    protected const CODE_LENGTH = 8;

    private CourseRepository $courseRepository;
    private LessonRepository $lessonRepository;
    private ChatRepository $chatRepository;
    private S3Service $s3Service;
    private UniqueCodesService $uniqueCodesGenerationService;

    public function __construct(CourseRepository $courseRepository, S3Service $s3Service, UniqueCodesService $uniqueCodesGenerationService, LessonRepository $lessonRepository, ChatRepository $chatRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->s3Service = $s3Service;
        $this->uniqueCodesGenerationService = $uniqueCodesGenerationService;
        $this->lessonRepository = $lessonRepository;
        $this->chatRepository = $chatRepository;
    }

    public function createCourse(Teacher $user, array $data)
    {
        $data['teacher_id'] = $user->id;

        try {
            DB::beginTransaction();

            $data['connection_code'] = 'CODE';
            $course = $this->courseRepository->createCourse($data);

            if (str_contains($data['video_url'], 'youtube.com') && !str_contains($data['video_url'], '/embed/')) {
                $firstSubStr = explode("v=", $data['video_url'])[1];
                $secondSubStr = explode("&", $firstSubStr)[0];
                $data['video_url'] = "https://www.youtube.com/embed/" . $secondSubStr;
            }

            if (isset($data['image'])) {
                $data['image_url'] = $this->s3Service->uploadFile(
                    'courses/' . $course->id,
                    $data['image'],
                    uniqid('course_pic_', true)
                );
            }
            $code = $this->uniqueCodesGenerationService
                ->setObfuscatingPrime(self::OBFUSCATING_PRIME)
                ->setMaxPrime(self::MAX_PRIME)
                ->setCharacters(self::CHARACTERS_FOR_GENERATION)
                ->setLength(self::CODE_LENGTH)
                ->generate($course->id);
            $data['connection_code'] = $code;

            $course->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $course;
    }

    public function getAllTeacherCourses(Teacher $teacher)
    {
        return $this->courseRepository->getAllTeacherCourses($teacher->id);
    }

    public function updateCourse(Course $course, array $data)
    {
        if (isset($data['image'])) {
            $data['image_url'] = $this->s3Service->uploadFile(
                'courses/' . $course->id,
                $data['image'],
                uniqid('course_pic_', true)
            );
        }

        $course->update($data);
        return $course;
    }

    public function deleteCourse(Course $course)
    {
        $course->delete();
    }

    public function subscribeToCourse(Course $course, Student $user)
    {
        $this->subscribeToCourseAndLessons($course, $user);

        $this->createChat($course, $user);
    }

    public function getAllStudentCourses(Student $student)
    {
        return $this->courseRepository->getAllStudentCourses($student->id);
    }

    public function getAllActiveCourses()
    {
        return $this->courseRepository->getAllActiveCourses();
    }

    public function addCourseByCode(Student $user, string $connection_code)
    {
        $course = $this->courseRepository->getCourseByCode($connection_code);

        if ($course === null || $course->status !== CourseStatuses::ACTIVE) {
            throw new \Exception('No such course');
        }

        $this->subscribeToCourseAndLessons($course, $user);
        $this->createChat($course, $user);

        return $course;
    }

    public function isSubscribedToCourse(Course $course, Student $user)
    {
        return $course->students()->where('student_id', $user->id)->exists();
    }

    private function subscribeToCourseAndLessons(Course $course, Student $student)
    {
        if (!$this->isSubscribedToCourse($course, $student)) {
            $lessons = $this->lessonRepository->findAllPublishedLessonsOfCourse($course->id);

            foreach ($lessons as $lesson) {
                $student->courses()->attach($student->id, [
                    'lesson_id' => $lesson->id,
                    'is_completed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function searchCourses(string $query)
    {
        return $this->courseRepository->searchCourses($query);
    }

    private function createChat(Course $course, Student $student)
    {

        $searchCriteria = [
            'teacher_id' => $course->teacher_id,
            'student_id' => $student->id,
        ];

        $data = [
            'teacher_id' => $course->teacher_id,
            'student_id' => $student->id,
            'is_started' => false,
        ];

        $chat = $this->chatRepository->getChat($searchCriteria);

        if ($chat) {
            unset($data['is_started']);
        }

        $this->chatRepository->createChat($searchCriteria, $data);
    }
}
