<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $value
 * @property $is_correct
 */
class CreateVariantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => ['required', 'string'],
            'is_correct' => ['required', 'boolean'],
        ];
    }
}
