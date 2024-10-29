<?php

namespace App\Models;

use App\Enums\CourseStatuses;
use App\Enums\CourseTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

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
    use HasFactory, Searchable;

    protected $fillable = [
        'teacher_id',
        'category_id',
        'title',
        'description',
        'image_url',
        'video_url',
        'status',
        'type',
        'connection_code',
    ];

    public function toSearchableArray()
    {
        if ($this->status == CourseStatuses::ACTIVE && $this->type == CourseTypes::PUBLIC) {
            return [
                'id' => $this->connection_code,
                'title' => $this->title,
            ];
        }

        return [];
    }

    protected $casts = [
        'status' => CourseStatuses::class,
        'type' => CourseTypes::class,
    ];

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value !== null ?
                config('services.storage_base_url').$value : null
        );
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->using(CourseStudent::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
