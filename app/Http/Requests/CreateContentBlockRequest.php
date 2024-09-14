<?php

namespace App\Http\Requests;

use App\Enums\ContentTypes;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $content
 * @property $type
*/
class CreateContentBlockRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:4000'],
            'type' => ['integer', 'required', 'in:' . implode(',', ContentTypes::toValuesArray())],
        ];
    }
}
