<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;

class StudentService
{
    protected StudentRepository $studentRepository;
    protected S3Service $s3Service;

    public function __construct(StudentRepository $userRepository, S3Service $s3Service)
    {
        $this->studentRepository = $userRepository;
        $this->s3Service = $s3Service;
    }

    public function getUserByEmail($email)
    {
        return $this->studentRepository->getStudentByEmail($email);
    }

    public function createStudent(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->studentRepository->createStudent($data);

            if (isset($data['image'])) {
                $data['avatar_url'] = $this->s3Service->uploadFile(
                    'users/students/' . $user->id,
                    $data['image'],
                    uniqid('avatar_', true)
                );
            }

            $user->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $user;
    }

    public function logout(Student $user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function updateStudentData(Student $student, array $data)
    {
        try {
            DB::beginTransaction();
            if (isset($data['image'])) {
                $data['avatar_url'] = $this->s3Service->uploadFile(
                    'users/students/' . $student->id,
                    $data['image'],
                    uniqid('avatar_', true)
                );
            }

            $student = $this->studentRepository->updateStudent($student, $data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

        return $student;
    }
}
