<?php

namespace App\Models;

use App\Enums\ContentTypes;
use App\Enums\MessageType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $student_id
 * @property int $teacher_id
 * @property int $chat_id
 * @property string $content
 * @property MessageType $content_type
 * @property \Carbon\Carbon $created_at
*/
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'content',
        'content_type',
        'chat_id'
    ];

    protected $casts = [
        'content_type' => MessageType::class
    ];

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn( $value) => $this->content_type === MessageType::MEDIA ?
                config('services.storage_base_url') . $value : $value
        );
    }
}
