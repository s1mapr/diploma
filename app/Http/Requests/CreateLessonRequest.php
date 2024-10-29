<?php

namespace App\Http\Requests;

use App\Enums\LessonStatuses;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $title
 * @property $estimation
 * @property $status
 */
class CreateLessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'estimation' => ['required', 'int', 'min:1'],
            'status' => ['required', 'integer', 'in:'.implode(',', LessonStatuses::toValuesArray())],
        ];
    }
}
