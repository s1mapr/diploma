<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property float $result
 */
class SendTestResultRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'result' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
