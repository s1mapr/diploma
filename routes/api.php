<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContentBlockController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\VariantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('/add-by-code', 'addCourseByCode')->middleware('auth:api_student');
    Route::post('/{course}/lesson', 'createLesson')->middleware('auth:api_teacher');
    Route::post('/{course}/update', 'updateCourse')->middleware('auth:api_teacher');
    Route::post('/{course}/subscribe', 'subscribeToCourse')->middleware('auth:api_student');
    Route::get('/', 'getAllActiveCourses')->middleware('auth:api_student');
    Route::get('/teacher', 'getAllTeacherCourses')->middleware('auth:api_teacher');
    Route::get('/search', 'searchCourses')->middleware('auth:api_student');
    Route::get('/{course}', 'getCourseData')->middleware('auth:api_teacher,api_student');
    Route::delete('/{course}', 'deleteCourse')->middleware('auth:api_teacher');
});

Route::prefix('lessons')->controller(LessonController::class)->group(function () {
    Route::post('/{lesson}/content-block', 'createContentBlock')->middleware('auth:api_teacher');
    Route::post('/{lesson}/test', 'createTest')->middleware('auth:api_teacher');
    Route::post('/{lesson}/finish', 'finishLesson')->middleware('auth:api_student');
    Route::post('/{lesson}/test-result', 'setTestResult')->middleware('auth:api_student');
    Route::get('/{lesson}/tests', 'getLessonTests')->middleware('auth:api_student');
    Route::get('/{lesson}', 'getLessonData')->middleware('auth:api_teacher');
    Route::patch('/{lesson}', 'updateLesson')->middleware('auth:api_teacher,api_student');
    Route::delete('/{lesson}', 'deleteLesson')->middleware('auth:api_teacher');
});

Route::prefix('tests')->controller(TestController::class)->group(function () {
    Route::post('/{test}/variant', 'createVariant')->middleware('auth:api_teacher');
    Route::get('/{test}/explanation', 'getExplanationOfTest')->middleware('auth:api_student');
    Route::get('/{test}', 'getTestData')->middleware('auth:api_teacher,api_student');
    Route::patch('/{test}', 'updateTest')->middleware('auth:api_teacher');
    Route::delete('/{test}', 'deleteTest')->middleware('auth:api_teacher');
});

Route::prefix('variants')->controller(VariantController::class)->group(function () {
    Route::get('/{variant}', 'getVariantData')->middleware('auth:api_teacher');
    Route::patch('/{variant}', 'updateVariant')->middleware('auth:api_teacher');
    Route::delete('/{variant}', 'deleteVariant')->middleware('auth:api_teacher');
});

Route::prefix('/students')->controller(StudentController::class)->group(function () {
    Route::get('/courses', 'getAllStudentCourses')->middleware('auth:api_student');
    Route::patch('/', 'updateStudentData')->middleware('auth:api_student');
});

Route::prefix('/content-blocks')->controller(ContentBlockController::class)->group(function () {
    Route::get('/{contentBlock}', 'getContentBlockData')->middleware('auth:api_teacher');
    Route::patch('/{contentBlock}', 'updateContentBlock')->middleware('auth:api_teacher');
    Route::delete('/{contentBlock}', 'deleteContentBlock')->middleware('auth:api_teacher');
});
