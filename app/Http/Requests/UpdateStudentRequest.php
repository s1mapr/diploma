<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @property string first_name
 * @property string last_name
 * @property string image
 */
class UpdateStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'image' => ['image', 'max:2048', 'mimes:jpeg,png,jpg'],
        ];
    }
}
