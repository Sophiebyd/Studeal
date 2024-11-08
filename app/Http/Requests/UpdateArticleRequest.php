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
            'address'=> 'nullable|string|min:2|max 100',
            'content' => 'nullable|string|min:2|max:5000',
            'price' => 'nullable|numeric|min:0|max:300',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:15360'
        ];
    }
}
