<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;

class StudentService
{
    protected StudentRepository $userRepository;
    protected S3Service $s3Service;

    public function __construct(StudentRepository $userRepository, S3Service $s3Service)
    {
        $this->userRepository = $userRepository;
        $this->s3Service = $s3Service;
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getStudentByEmail($email);
    }

    public function createStudent(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->userRepository->createStudent($data);

            if (isset($data['image'])) {
                $data['avatar_url'] = $this->s3Service->uploadFile(
                    'users/students/' . $user->id,
                    $data['image'],
                    uniqid('avatar_', true)
                );
                dump($data['avatar_url']);
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
}
