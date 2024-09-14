<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $title
 * @property $estimation
*/
class CreateLessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'estimation' => ['required', 'int', 'min:1'],
        ];
    }
}
