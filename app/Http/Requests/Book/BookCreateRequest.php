<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'         => 'required|string|min:3',
            'author'        => 'required|string|min:3',
            'create_date'   => 'required|min:4|max:4'
        ];
    }
}
