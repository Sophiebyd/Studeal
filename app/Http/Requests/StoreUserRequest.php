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
            ///
        ];
    }
}
