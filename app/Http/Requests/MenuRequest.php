<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'files' => 'required|array|min:1',
            'files.*' => 'file|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'files.required' => 'You must upload at least one file.',
            'files.array' => 'The files input must be an array.',
            'files.min' => 'You must upload at least one file.',
            'files.*.file' => 'Each file must be a valid file.',
            'files.*.mimes' => 'Each file must be a type of: jpeg, png, jpg, gif, pdf.',
            'files.*.max' => 'Each file may not be greater than 5MB.',
        ];
    }
}
