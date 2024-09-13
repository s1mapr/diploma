<?php

namespace App\Models;

use App\Enums\CourseStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $title
 * @property $description
 * @property $slug
 * @property $status
*/
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'status',
        'teacher_id'
    ];

    protected $casts = [
        'status' => CourseStatuses::class,
    ];
}
