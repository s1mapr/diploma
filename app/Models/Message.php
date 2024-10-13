<?php

namespace App\Models;

use App\Enums\MessageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $student_id
 * @property int $teacher_id
 * @property string $content
 * @property MessageType $type
*/
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'content',
        'type'
    ];

    protected $casts = [
        'type' => MessageType::class
    ];
}
