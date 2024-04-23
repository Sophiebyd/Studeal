<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules\Password;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'last_name' => 'required|string|max:30',
            'first_name' => 'required|string|max:30',
            'birthday' => 'required|date',
            'phone' => 'required|number|max:6',
            'email' => 'required|string|max:30',
            'password' => [
                'required', 'confirmed',
                Password::min(8) // minimum 8 caractères   
                    ->mixedCase() // au moins 1 minuscule et une majuscule
                    ->letters()  // au moins une lettre
                    ->numbers() // au moins un chiffre
                    ->symbols() // au moins un caractère spécial parmi ! @ # $ % ^ & * ?  
            ],
        ];
    }

    public function messages()
    {
        return [
            'pseudo.required' => 'Le pseudo est requis.',
            'pseudo.string' => 'Le pseudo doit être une chaîne de caractères.',
            'pseudo.min' => 'Le pseudo doit faire au moins 2 caractères.',
            'pseudo.max' => 'Le pseudo ne doit pas dépasser 20 caractères.',
            'pseudo.unique' => 'pseudo déjà utilisé.',
            'email.unique' => 'email déjà utilisé.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'Email invalide.',
            'password.required' => 'Le mot de passe est requis.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.confirmed' => 'Confirmation du mot de passe incorrecte.',
        ];
    }
}
