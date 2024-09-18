<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $content
 */
class UpdateTestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['string'],
        ];
    }
}
