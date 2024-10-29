<?php

namespace App\Http\Requests;

use App\Enums\MessageType;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'content_type' => ['integer', 'required', 'in:'.implode(',', MessageType::toValuesArray())],
        ];

        if ($this->input('content_type') == MessageType::TEXT->value) {
            $rules['content'] = ['required', 'string' ,'max:4000'];
        } else if ($this->input('content_type') == MessageType::MEDIA->value) {
            $rules['content'] = ['required', 'file', 'max:2048'];
        }

        return $rules;
    }
}
