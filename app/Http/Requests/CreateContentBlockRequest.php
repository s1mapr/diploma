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
        $rules =  [
            'type' => ['integer', 'required', 'in:' . implode(',', ContentTypes::toValuesArray())],
        ];

        if ($this->input('type') == ContentTypes::TEXT->value) {
            $rules['content'] = ['required', 'string' ,'max:4000'];
        } else if ($this->input('type') == ContentTypes::IMAGE->value) {
            $rules['content'] = ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'];
        } else if ($this->input('type') == ContentTypes::VIDEO->value) {
            $rules['content'] = ['required', 'url', 'max:255'];
        }

        return $rules;
    }
}
