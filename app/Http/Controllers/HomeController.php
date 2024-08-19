<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Enums\ImageTypeEnum;
use App\Models\Coupon;

class HomeController extends Controller
{
    //
    public function index()
    {
        $bannerHomeImages = Image::where('imagetype', ImageTypeEnum::BANNERHOME)->get();
        $bannerMenuImages = Image::where('imagetype', ImageTypeEnum::BANNERMENU)->get();
        $coupons = Coupon::take(2)->get();

        $coupon1 = $coupons->get(0);
        $coupon2 = $coupons->get(1);

        return view('home', [
            'bannerHomeImages' => $bannerHomeImages,
            'bannerMenuImages' => $bannerMenuImages,
            'coupon1' => $coupon1,
            'coupon2' => $coupon2,
        ]);
    }
}
