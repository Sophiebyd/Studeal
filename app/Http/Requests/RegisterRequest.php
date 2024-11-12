<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|String|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|unique:users',
            'birthday' => 'required|date',
            'phone' => 'required|digits:10',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Le prénom est requis.',
            'first_name.string' => 'Le prénom doit être une chaîne de caractères.',
            'first_name.min' => 'Le prénom doit faire au moins 2 caractères.',
            'first_name.max' => 'Le prénom ne doit pas dépasser 50 caractères.',

            'last_name.required' => 'Le nom est requis.',
            'last_name.string' => 'Le nom doit être une chaîne de caractères.',
            'last_name.min' => 'Le nom doit faire au moins 2 caractères.',
            'last_name.max' => 'Le nom ne doit pas dépasser 50 caractères.',

            'email.required' => 'L\'email est requis.',
            'email.string' => 'L\'email doit être une chaîne de caractères.',
            'email.email' => 'L\'email doit être une adresse valide.',
            'email.unique' => 'L\'email est déjà utilisé.',

            'birthday.required' => 'La date de naissance est requise.',
            'birthday.date' => 'La date de naissance doit être une date valide.',

            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.digits' => 'Le numéro de téléphone doit comporter 10 chiffres.',

            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ];
    }
}
