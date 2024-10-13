<?php

namespace App\Models;

use App\Enums\LessonStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $title
 * @property $estimation
 * @property $status
 */
class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'estimation',
        'course_id',
        'status',
    ];

    protected $casts = [
        'status' => LessonStatuses::class,
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
