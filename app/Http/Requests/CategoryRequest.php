<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required' , 'string' , 'min:2' , 'max:255' , Rule::unique('categories' , 'name')],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
