<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Enums\ImageTypeEnum;
use App\Models\Coupon;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        $featuredCoupon = Coupon::where('isfeatured', true)
            ->where('displayfrom', '<=', $today)
            ->where('displayto', '>=', $today)
            ->first();

        $bannerHomeImages = Image::where('imagetype', ImageTypeEnum::BANNERHOME)->get();
        $bannerMenuImages = Image::where('imagetype', ImageTypeEnum::BANNERMENU)->get();

        $coupons = Coupon::where('displayfrom', '<=', $today)
            ->where('displayto', '>=', $today)
            ->latest()
            ->take(2)
            ->get();

        return view('home', [
            'featuredCoupon' => $featuredCoupon,
            'bannerHomeImages' => $bannerHomeImages,
            'bannerMenuImages' => $bannerMenuImages,
            'coupons' => $coupons,
        ]);
    }
}
