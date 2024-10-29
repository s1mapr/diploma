<?php

namespace App\Http\Requests;

use App\Enums\CourseStatuses;
use App\Enums\CourseTypes;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $category_id
 * @property $title
 * @property $description
 * @property $image
 * @property $video_url
 * @property $status
 * @property $type
 */
class UpdateCourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'video_url' => ['nullable', 'url', 'max:255'],
            'status' => ['nullable', 'integer', 'in:'.implode(',', CourseStatuses::toValuesArray())],
            'type' => ['nullable', 'integer', 'in:'.implode(',', CourseTypes::toValuesArray())],
        ];
    }
}
