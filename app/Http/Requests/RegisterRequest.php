<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property string image
*/
class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'image' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg'],
        ];
    }
}
