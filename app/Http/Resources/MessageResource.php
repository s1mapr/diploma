<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Message
 */
class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'chat_id' => $this->chat_id,
            'teacher_id' => $this->teacher_id,
            'student_id' => $this->student_id,
            'content' => $this->content,
            'content_type' => $this->content_type,
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
