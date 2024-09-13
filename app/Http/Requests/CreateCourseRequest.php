<?php

namespace App\Http\Requests;

use App\Enums\CourseStatuses;
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
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'slug' => ['required', 'string', 'max:50'],
            'status' => ['integer', 'required', 'in:' . implode(',', CourseStatuses::toValuesArray())],
        ];
    }
}
