<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        return [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:8|max:16|confirmed", 
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
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
