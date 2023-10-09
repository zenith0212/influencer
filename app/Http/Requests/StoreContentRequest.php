<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
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
            //
            'title_en' => 'required|min:2|max:20|regex:/^[a-zA-Z ]{2,30}$/',
            'description_en' => 'required',
            'keyword_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => 'This field is required.',
            // 'title_en.unique' => 'This title is already taken.',
            'title_en.regex' => 'This format is invalid.',
            'title_en.min' => 'The title field must be at least 2 characters.',
            'title_en.max' => 'This field must contain maximum 20 letters only.',
            'description_en.required' => 'This field is required.',
            // 'description_en.regex' => 'This format is invalid.',
            'keyword_en.required' => 'This field is required.',
        ];
    }
}
