<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\UpdateTaskStatusDTO;

class UpdateTaskStatusRequest extends FormRequest
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
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O status deve ser uma das seguintes opções: pending, in_progress, completed ou cancelled.',
        ];
    }

    public function toDTO(): UpdateTaskStatusDTO
    {
        return new UpdateTaskStatusDTO(
            status: $this->status
        );
    }
}

