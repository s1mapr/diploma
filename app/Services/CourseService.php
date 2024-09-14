<?php

namespace App\Services;

use App\Models\Teacher;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\DB;

class CourseService
{
    protected const OBFUSCATING_PRIME = 350561363;
    protected const MAX_PRIME = 83476331;
    protected const CHARACTERS_FOR_GENERATION = 'A92D47N8GF531V0X6';
    protected const CODE_LENGTH = 8;

    private CourseRepository $courseRepository;
    private S3Service $s3Service;
    private UniqueCodesService $uniqueCodesGenerationService;

    public function __construct(CourseRepository $courseRepository, S3Service $s3Service, UniqueCodesService $uniqueCodesGenerationService)
    {
        $this->courseRepository = $courseRepository;
        $this->s3Service = $s3Service;
        $this->uniqueCodesGenerationService = $uniqueCodesGenerationService;
    }

    public function createCourse(Teacher $user, array $data)
    {
        $data['teacher_id'] = $user->id;

        try {
            DB::beginTransaction();

            $data['connection_code']='CODE';
            $course = $this->courseRepository->createCourse($data);

            if(isset($data['image'])) {
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
                ->generate($user->id);
            $data['connection_code'] = $code;

            $course->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $course;
    }
}
