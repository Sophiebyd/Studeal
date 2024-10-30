<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'last_name' => 'nullable|string|min:2|max:30',
            'first_name' => 'nullable|string|min:2|max:30',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|digits:10',
            'email' => 'nullable|unique:users|string|max:50',
            'password' => [
                'nullable', 'confirmed',
                Password::min(8) // minimum 8 caractères   
                    ->mixedCase() // au moins 1 minuscule et une majuscule
                    ->letters()  // au moins une lettre
                    ->numbers() // au moins un chiffre
                    ->symbols() // au moins un caractère spécial parmi ! @ # $ % ^ & * ?  
            ],
        ];
    }
}
