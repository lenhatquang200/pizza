<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Enums\ImageTypeEnum;
use App\Models\Coupon;

class HomeController extends Controller
{
    public function index()
    {
        // Get the featured coupon
        $featuredCoupon = Coupon::where('isfeatured', true)->first();

        // Get images for home banner and menu banner
        $bannerHomeImages = Image::where('imagetype', ImageTypeEnum::BANNERHOME)->get();
        $bannerMenuImages = Image::where('imagetype', ImageTypeEnum::BANNERMENU)->get();

        // Get the 2 latest coupons
        $coupons = Coupon::latest()->take(2)->get();

        // Return view with all necessary data
        return view('home', [
            'featuredCoupon' => $featuredCoupon,
            'bannerHomeImages' => $bannerHomeImages,
            'bannerMenuImages' => $bannerMenuImages,
            'coupons' => $coupons,
        ]);
    }
}
