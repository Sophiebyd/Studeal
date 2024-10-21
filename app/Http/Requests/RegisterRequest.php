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
            'last_name' => 'required|string|min:2|max:5000',
            'email' => 'required|string|email|unique:users',
            'birthday' => 'required|date',
            'phone' => 'required|digits:10',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.min' => 'Le titre doit faire au moins 2 caractères.',
            'title.max' => 'Le titre ne doit pas dépasser 50 caractères.',
    
            'content.required' => 'Le contenu est requis.',
            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'content.min' => 'Le contenu doit faire au moins 2 caractères.',
            'content.max' => 'Le contenu ne doit pas dépasser 5000 caractères.',
        ];
    }
}