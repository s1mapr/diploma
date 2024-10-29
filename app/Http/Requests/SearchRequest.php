<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $search_query
 */
class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search_query' => ['required', 'string'],
        ];
    }
}
