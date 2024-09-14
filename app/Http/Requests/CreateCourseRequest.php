<?php

namespace App\Http\Requests;

use App\Enums\CourseStatuses;
use App\Enums\CourseTypes;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $title
 * @property $description
 * @property $slug
 * @property $status
*/
class CreateCourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'video_url' => ['required', 'string', 'max:255'],
            'status' => ['integer', 'required', 'in:' . implode(',', CourseStatuses::toValuesArray())],
            'type' => ['integer', 'required', 'in:' . implode(',', CourseTypes::toValuesArray())],
        ];
    }
}
