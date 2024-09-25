<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $userAnswers
*/
class UserAnswerRequest extends FormRequest
{
   public function rules(): array
    {
        return [
            'userAnswers' => ['required', 'array'],
            'userAnswers.*' => ['required', 'string'],
        ];
    }
}
