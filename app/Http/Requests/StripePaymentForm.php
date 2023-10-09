<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripePaymentForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'fullName' => 'required|min:2|max:20|regex:/^[a-zA-Z ]{2,30}$/',
            'cardNumber' => 'required|numeric|max:16|min:16',
            'cvv' => 'required|numeric',
            'month' => 'required',
            'year' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fullName.required' => 'This field is required.',
            'fullName.regex' => 'This format is invalid.',
            'fullName.min' => 'The name field must be at least 2 characters.',
            'fullName.max' => 'This field must contain maximum 20 letters only.',
            'cardNumber.required' => 'This field is required.',
            'cvv.required' => 'This field is required',
            'cvv.numeric' => 'This field must be numeric.',
            'month.required' => 'This field is required.',
            'year.required' => 'This field is required.',
        ];
    }   
}
