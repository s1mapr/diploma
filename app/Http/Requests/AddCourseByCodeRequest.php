<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $connection_code
*/
class AddCourseByCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'connection_code' => ['required', 'string', 'min:8', 'max:8']
        ];
    }
}
