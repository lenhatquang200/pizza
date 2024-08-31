<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $isUpdate = $this->route('coupon') !== null;

        return [
            'couponcode' => [
                'required',
                'regex:/\S/', // Ensure no whitespace
                $isUpdate ? 'unique:coupons,couponcode,'.$this->route('coupon') : 'unique:coupons,couponcode',
            ],
            'bannerurl' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
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
          'couponcode.required' => 'The coupon code is required.',
            'couponcode.regex' => 'The coupon code cannot contain spaces.',
            'couponcode.unique' => 'The coupon code has already been taken.',
            'bannerurl.required' => 'The banner is required.',
            'url.url' => 'The URL must be a valid URL.',
            'bannerurl.image' => 'The banner must be an image.',
            'bannerurl.mimes' => 'The banner must be a file of type: jpeg, png, jpg, gif.',
            'bannerurl.max' => 'The banner image may not be greater than 5MB.',
        ];
    }
}
