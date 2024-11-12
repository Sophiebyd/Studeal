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
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:15360',
            'last_name' => 'required|string|min:2|max:30',
            'first_name' => 'required|string|min:2|max:30',
            'birthday' => 'required|date',
            'phone' => 'required|digits:10',
            'email' => 'required|unique:users|string|max:50',
            'password' => [
                'required', 'confirmed',
                Password::min(8)
                    ->mixedCase() // au moins 1 minuscule et une majuscule
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    public function messages()
    {
        return [
            'picture.image' => 'Le fichier doit être une image.',
            'picture.mimes' => 'L\'image doit être au format jpg, jpeg, png ou svg.',
            'picture.max' => 'L\'image ne doit pas dépasser 15 Mo.',
    
            'last_name.required' => 'Le nom est requis.',
            'last_name.string' => 'Le nom doit être une chaîne de caractères.',
            'last_name.min' => 'Le nom doit faire au moins 2 caractères.',
            'last_name.max' => 'Le nom ne doit pas dépasser 30 caractères.',
    
            'first_name.required' => 'Le prénom est requis.',
            'first_name.string' => 'Le prénom doit être une chaîne de caractères.',
            'first_name.min' => 'Le prénom doit faire au moins 2 caractères.',
            'first_name.max' => 'Le prénom ne doit pas dépasser 30 caractères.',
    
            'birthday.required' => 'La date de naissance est requise.',
            'birthday.date' => 'La date de naissance doit être une date valide.',
    
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.digits' => 'Le numéro de téléphone doit comporter 10 chiffres.',
    
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'email.string' => 'L\'adresse e-mail doit être une chaîne de caractères.',
            'email.max' => 'L\'adresse e-mail ne doit pas dépasser 50 caractères.',
    
            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'Le mot de passe de confirmation ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ];
    }
    
}
