<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $value
 * @property $is_correct
 */
class UpdateVariantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => ['string'],
            'is_correct' => ['boolean'],
        ];
    }
}
