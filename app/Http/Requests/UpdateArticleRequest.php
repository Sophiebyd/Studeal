<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:50',
            'address' => 'nullable|string|min:2|max 100',
            'content' => 'nullable|string|min:2|max:5000',
            'price' => 'nullable|numeric|min:0|max:300',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:15360'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.min' => 'Le titre doit faire au moins 2 caractères.',
            'title.max' => 'Le titre ne doit pas dépasser 50 caractères.',

            'address.string' => 'L\'adresse doit être une chaîne de caractères.',
            'address.min' => 'L\'adresse doit faire au moins 2 caractères.',
            'address.max' => 'L\'adresse ne doit pas dépasser 100 caractères.',

            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'content.min' => 'Le contenu doit faire au moins 2 caractères.',
            'content.max' => 'Le contenu ne doit pas dépasser 5000 caractères.',

            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix doit être au moins de 0.',
            'price.max' => 'Le prix ne doit pas dépasser 300.',

            'picture.image' => 'Le fichier doit être une image.',
            'picture.mimes' => 'L\'image doit être au format jpg, jpeg, png ou svg.',
            'picture.max' => 'L\'image ne doit pas dépasser 15 Mo.',
        ];
    }
}
