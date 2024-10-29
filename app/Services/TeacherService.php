<?php

namespace App\Services;

use App\Models\Teacher;
use App\Repositories\TeacherRepository;
use Illuminate\Support\Facades\DB;

class TeacherService
{
    private TeacherRepository $teacherRepository;

    private S3Service $s3Service;

    public function __construct(TeacherRepository $teacherRepository, S3Service $s3Service)
    {
        $this->teacherRepository = $teacherRepository;
        $this->s3Service = $s3Service;
    }

    public function getTeacherByEmail(string $email)
    {
        return $this->teacherRepository->getTeacherByEmail($email);
    }

    public function updateTeacherData(Teacher $teacher, array $data)
    {
        try {
            DB::beginTransaction();
            if (isset($data['image'])) {
                $data['avatar_url'] = $this->s3Service->uploadFile(
                    'users/teachers/'.$teacher->id,
                    $data['image'],
                    uniqid('avatar_', true)
                );
            }

            $updatedTeacher = $this->teacherRepository->updateTeacher($teacher, $data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $updatedTeacher;
    }
}
