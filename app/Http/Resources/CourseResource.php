<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Course
 */
class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'teacher_id' => $this->teacher_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'video_url' => $this->video_url,
            'status' => $this->status,
            'type' => $this->type,
            'connection_code' => $this->connection_code,
        ];
    }
}
