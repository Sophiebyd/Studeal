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
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'Le prix est requis.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.digits_between' => 'Le prix doit avoir entre 1 et 4 chiffres.',
        ];
    }
}
