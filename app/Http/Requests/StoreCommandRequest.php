<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandRequest extends FormRequest
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
            'price' => 'required|Number|digite:1, 4',
            'title' => 'required|string|min:2|max:50'
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Le prix est requis.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.digits_between' => 'Le prix doit comporter entre 1 et 4 chiffres.',

            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.min' => 'Le titre doit faire au moins 2 caractères.',
            'title.max' => 'Le titre ne doit pas dépasser 50 caractères.',
        ];
    }
}
