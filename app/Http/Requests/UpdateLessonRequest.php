<?php

namespace App\Http\Requests;

use App\Enums\LessonStatuses;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $title
 * @property $estimation
 * @property $status
 */
class UpdateLessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:100'],
            'estimation' => ['int', 'min:1'],
            'status' => ['integer', 'in:'.implode(',', LessonStatuses::toValuesArray())],
        ];
    }
}
