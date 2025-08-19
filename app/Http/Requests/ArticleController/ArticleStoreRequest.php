<?php

namespace App\Http\Requests\ArticleController;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:articles,title|max:50',
            'content' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O titúlo é obrigatório',
            'title.unique' => 'Este titúlo não está disponivel',
            'title.max' => 'O título não pode conter mais que :max caracteres',
            'content.required' => 'A notícia não pode estar vazia'
        ];
    }
}
