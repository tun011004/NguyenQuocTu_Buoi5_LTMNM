<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'title' => [
                'required','string','max:255',
                Rule::unique('articles','title')->ignore($this->route('article'))
            ],
            'body'  => ['required','string','min:10'],
            'tags'  => ['sometimes','nullable','string'],
            'image' => ['sometimes','nullable','image','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
}
