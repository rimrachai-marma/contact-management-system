<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        return [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users",
            "password" => [
                "required",
                "confirmed",
                Password::min(8)->max(16)->mixedCase()->numbers()->symbols(),
            ],
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Name field is required.',
            'name.max' => 'Name must not be greater than 255 characters.',

            'email.required' => 'Email field is required.',
            'email.email' => 'Invalid email.',
            'email.unique' => 'Email already exist.',

            'password.required' => 'Password field is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not be greater than 16 characters.', 
            'password.mixed' => 'Password must contain both uppercase and lowercase letters.',
            'password.numbers' => 'Password must contain at least one number.',
            'password.symbols' => 'Password must contain at least one special character.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
