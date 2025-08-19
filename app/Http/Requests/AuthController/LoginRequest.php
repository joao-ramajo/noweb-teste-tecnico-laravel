<?php

namespace App\Http\Requests\AuthController;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email|max:50',
            'password' => 'required|max:12'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve estar em um formato válido',
            'email.exists' => 'Usuário ou senha incorretos',
            'email.max' => 'O email não pode passar de :max caracteres',
            'password.required' => 'A senha é obrigatória',
            'password.max' => 'A senha não deve conter mais que :max caracteres'
        ];
    }
}
