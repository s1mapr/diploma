<?php

namespace App\Models;

use App\Enums\CourseStatuses;
use App\Enums\CourseTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $teacher_id
 * @property $category_id
 * @property $title
 * @property $description
 * @property $image_url
 * @property $video_url
 * @property $status
 * @property $type
 * @property $connection_code
*/
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'category_id',
        'title',
        'description',
        'image_url',
        'video_url',
        'status',
        'type',
        'connection_code'
    ];

    protected $casts = [
        'status' => CourseStatuses::class,
        'type' => CourseTypes::class
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value !== null ?
                config('services.storage_base_url') . $value : null
        );
    }
}
