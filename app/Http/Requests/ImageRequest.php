<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow if the user is logged in
        return backpack_auth()->check();
    }

    public function rules()
    {
        $id = $this->route('id'); // Get the ID from the route if present

        return [
            'imageurl' => [
                $id ? 'nullable' : 'required', // Make imageurl not required for updates
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:5120',
            ],
            'url' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== '#' && !filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('The :attribute must be a valid URL.');
                    }
                }
            ],
        ];
    }

    public function messages()
    {
        return [
            'imageurl.required' => 'An image is required.',
            'imageurl.image' => 'The file must be an image.',
            'imageurl.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'imageurl.max' => 'The image may not be greater than 5MB.',
            'url.url' => 'The URL must be a valid URL.',
        ];
    }
}

