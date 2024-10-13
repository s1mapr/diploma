<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $student_id
 * @property int $teacher_id
 * @property boolean $is_started
*/
class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'is_started',
    ];
}
