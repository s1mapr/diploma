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
class CreateCourseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['integer', 'exists:categories,id'],
            'title' => ['string', 'max:100'],
            'description' => ['string', 'max:1000'],
            'image' => ['image', 'max:2048', 'mimes:jpeg,png,jpg'],
            'video_url' => ['url', 'max:255'],
            'status' => ['required', 'in:'.implode(',', CourseStatuses::toValuesArray())],
            'type' => ['required', 'in:'.implode(',', CourseTypes::toValuesArray())],
        ];
    }
}
