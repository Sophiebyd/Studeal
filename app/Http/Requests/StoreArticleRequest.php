<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'address'=> 'required|string|min:2|max 100',
            'content' => 'required|string|min:2|max:5000',
            'price' => 'required|numeric|min:0|max:300'
        ];
    }

    public function messages()
    {
        return [
            ///
        ];
    }
}
