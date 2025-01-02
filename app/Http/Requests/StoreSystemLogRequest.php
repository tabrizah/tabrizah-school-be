<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystemLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create-logs');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:50'],
            'action' => ['required', 'string', 'max:255'],
            'entity_type' => ['required', 'string', 'max:255'],
            'entity_id' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'metadata' => ['nullable', 'array'],
            'status' => ['required', 'string', 'max:50'],
        ];
    }
}
