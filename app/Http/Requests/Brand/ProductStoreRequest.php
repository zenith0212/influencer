<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name_en' => ['required', 'string'],
            'keyword_en' => ['required', 'string'],
            'category_id' => ['required', 'numeric'],
            'product_link' => ['required', 'url', 'active_url'],
            'price' => ['required','numeric'],
            'is_available' => ['in:1,0'],
            'is_featured' => ['in:1,0'],
            'short_description_en' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'product_main_image' => ['required', 'image'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Category is required',

            'name_en.required' => 'Product name is required',
            'name_en.string' => 'Product name value is invalid',

            'keyword_en.required' => 'Product keyword is required',
            'keyword_en.string' => 'Product keyword value is invalid',

            'description_en.required' => 'Product description is required',
            'description_en.string' => 'Product description value is invalid',
            
            'short_description_en.required' => 'Product short description is required',
            'short_description_en.string' => 'Product short description value is invalid',
        ];
    }
}
