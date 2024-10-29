<?php

namespace App\Http\Resources;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Chat
*/
class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user()->isTeacher() ?
            StudentResource::make($this->student()->first()) :
            TeacherResource::make($this->teacher()->first());
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'teacher_id' => $this->teacher_id,
            'user'=> $user,
        ];
    }
}
