<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        $id = $this->route('id');

        return [
            'couponcode' => [
                'required',
                'regex:/\S/',
                $id ? 'unique:coupons,couponcode,' . $id . ',id' : 'unique:coupons,couponcode',
            ],
            'bannerurl' => [
                $id ? 'nullable' : 'required',
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
            'couponcode.required' => 'The coupon code is required.',
            'couponcode.regex' => 'The coupon code cannot contain spaces.',
            'couponcode.unique' => 'The coupon code has already been taken.',
            'bannerurl.required' => 'The banner is required.',
            'bannerurl.image' => 'The banner must be an image.',
            'bannerurl.mimes' => 'The banner must be a file of type: jpeg, png, jpg, gif.',
            'bannerurl.max' => 'The banner image may not be greater than 5MB.',
            'url.url' => 'The URL must be a valid URL.',
        ];
    }
}
