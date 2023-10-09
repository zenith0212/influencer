<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|min:2|max:20|unique:categories,name_en|regex:/^[a-zA-Z ]{2,30}$/',
            'description_en' => 'required|regex:/([A-Za-z])+( [A-Za-z]+)/',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => 'This field is required.',
            'name_en.unique' => 'This name is already taken.',
            'name_en.regex' => 'This format is invalid.',
            'name_en.min' => 'The name field must be at least 2 characters.',
            'name_en.max' => 'This field must contain maximum 20 letters only.',
            'description_en.required' => 'This field is required.',
            'description_en.regex' => 'This format is invalid.',
            'image.required' => 'This field is required.',

        ];
    }
}
