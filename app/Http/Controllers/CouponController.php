<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        $coupons = Coupon::where('displayfrom', '<=', $today)
            ->where('displayto', '>=', $today)
            ->get();

        $sliderId = 'coupon-slider';
        return view('coupons.index', compact('coupons', 'sliderId'));
    }

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.show', compact('coupon'));
    }
}
