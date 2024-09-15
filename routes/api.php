<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/student-login', 'studentLogin');
    Route::post('/teacher-login', 'teacherLogin');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth:api_user');
});

Route::prefix('courses')->controller(CourseController::class)->group(function () {
    Route::post('/', 'createCourse')->middleware('auth:api_teacher');
    Route::post('/{course}/lesson', 'createLesson')->middleware('auth:api_teacher');
    Route::post('/{course}/update', 'updateCourse')->middleware('auth:api_teacher');
    Route::get('/', 'getAllTeacherCourses')->middleware('auth:api_teacher');
    Route::get('/{course}', 'getCourseData')->middleware('auth:api_teacher');
    Route::delete('/{course}', 'deleteCourse')->middleware('auth:api_teacher');
});

Route::prefix('lessons')->controller(LessonController::class)->group(function () {
    Route::post('/{lesson}/content-block', 'createContentBlock')->middleware('auth:api_teacher');
});
