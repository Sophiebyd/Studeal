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
            'user2_id' => 'required|integer|different:user1_id',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'last_name' => 'required|string|min:2|max:30',
            'first_name' => 'required|string|min:2|max:30',
            'birthday' => 'required|date',
            'phone' => 'required|number|max:6',
            'email' => 'required|unique|string|max:50',
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
            'last_name.required' => 'Le nom de famille est requis.',
            'last_name.string' => 'Le nom de famille doit être une chaîne de caractères.',
            'last_name.min' => 'Le nom de famille doit faire au moins 2 caractères.',
            'last_name.max' => 'Le nom de famille ne doit pas dépasser 30 caractères.',

            'first_name.required' => 'Le prénom est requis.',
            'first_name.string' => 'Le prénom doit être une chaîne de caractères.',
            'first_name.min' => 'Le prénom doit faire au moins 2 caractères.',
            'first_name.max' => 'Le prénom ne doit pas dépasser 30 caractères.',

            'email.required' => 'L\'email est requis.',
            'email.unique' => 'Email déjà utilisé.',
            'email.email' => 'Email invalide.',
            'email.max' => 'L\'email ne doit pas dépasser 50 caractères.',

            'birthday.required' => 'La date de naissance est requise.',
            'birthday.date' => 'La date de naissance doit être sous format date.',

            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.number' => 'Le numéro de téléphone ne peut être composé que de chiffre.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 6 chiffres.',

            'image.required' => 'La photo de profil est obligatoire.',
            'image.mimes' => 'Veuillez respecter les formats d\'images: jpg,jpeg,png,svg.',
            'image.max' => 'Le nom de l\'image est trop volumineux, il ne doit pas dépasser 2048 caractères.',


            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'Confirmation du mot de passe incorrecte.',
            'password.min' => 'Le mot de passe doit faire au moins 8 caractères.',
            'password.mixedCase' => 'Le mot de passe doit être composé d\'au moins 1 minuscule et une majuscule.',
            'password.letters' => 'Le mot de passe doit être composé d\'au moins une lettre.',
            'password.numbers' => 'Le mot de passe doit être composé d\'au moins un chiffre.',
            'password.symbols' => 'Le mot de passe doit être composé d\'au moins un caractère spécial parmi ! @ # $ % ^ & * ?.',
        ];
    }
}
