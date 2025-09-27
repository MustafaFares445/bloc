<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required' , 'min:3' , 'max:255'],
            'description' => ['sometimes', 'string' , 'min:2' , 'max:1024'],
            'categoryId' => ['required', Rule::exists('categories', 'id')],
            'tagsIds' => ['nullable', 'array'],
            'tagsIds.*' => ['integer', Rule::exists('tags', 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function validated($key = null, $default = null)
    {
        return [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'category_id' => $this->input('categoryId'),
        ];
    }
}
