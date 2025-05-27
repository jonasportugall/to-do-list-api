<?php

namespace App\Http\Requests;

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
            'email'   => 'required|email',
            'password'=> 'required'
        ]; 
    }
    /**
     * Mensagens de erro personalizadas em português.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
            'password.required' => 'A senha é obrigatória.',
        ];
    }

    public function toDTO():LoginDTO{
        return new LoginDTO(
            email: $this->email,
            password:$this->password
        );
    }
}
