<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "employe_id" => ['required', 'string', 'exists:users,employe_id'],
            "password" => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            "employe_id.required" => "Employee ID is required",
            "employe_id.string" => "Employee ID must be a string",
            "employe_id.exists" => "Employee ID does not exist",
            "password.required" => "Password is required",
            "password.string" => "Password must be a string",
        ];
    }
}
