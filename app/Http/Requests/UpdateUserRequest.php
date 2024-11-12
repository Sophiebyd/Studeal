<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

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
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:15360',
            'last_name' => 'nullable|string|min:2|max:30',
            'first_name' => 'nullable|string|min:2|max:30',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|digits:10',
            'email' => [
                'nullable',
                Rule::unique('users')->ignore($this->user),
                'email'
            ],
            'password' => [
                'nullable',
                'confirmed',
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
            'picture.image' => 'Le fichier doit être une image.',
            'picture.mimes' => 'L\'image doit être au format jpg, jpeg, png ou svg.',
            'picture.max' => 'L\'image ne doit pas dépasser 15 Mo.',

            'last_name.string' => 'Le nom doit être une chaîne de caractères.',
            'last_name.min' => 'Le nom doit faire au moins 2 caractères.',
            'last_name.max' => 'Le nom ne doit pas dépasser 30 caractères.',

            'first_name.string' => 'Le prénom doit être une chaîne de caractères.',
            'first_name.min' => 'Le prénom doit faire au moins 2 caractères.',
            'first_name.max' => 'Le prénom ne doit pas dépasser 30 caractères.',

            'birthday.date' => 'La date de naissance doit être une date valide.',

            'phone.digits' => 'Le numéro de téléphone doit contenir exactement 10 chiffres.',

            'email.unique' => 'Cet email est déjà utilisé.',
            'email.email' => 'L\'email doit être une adresse email valide.',

            'password.confirmed' => 'Le mot de passe et la confirmation doivent correspondre.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.mixedCase' => 'Le mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.',
            'password.letters' => 'Le mot de passe doit contenir au moins une lettre.',
            'password.numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols' => 'Le mot de passe doit contenir au moins un caractère spécial (! @ # $ % ^ & * ?).',
        ];
    }
}
