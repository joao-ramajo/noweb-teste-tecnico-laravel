<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|max:50|email|unique:users,email',
            'password' => 'required|max:12|min:6|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ];
    }

    public function messages(): array
    {
         return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de :max caracteres.',

            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'email.max' => 'O email não pode ter mais de :max caracteres.',
            'email.unique' => 'Email não disponível.',

            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
            'password.confirmed' => 'As senhas devem ser iguais.',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.'
    ];
    }
}
